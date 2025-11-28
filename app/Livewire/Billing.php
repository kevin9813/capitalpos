<?php

namespace App\Livewire;
use App\Models\Product;
use App\Models\CashShift;
use App\Models\Sale;

use App\Http\Controllers\BillingController;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Billing extends Component
{
    public $showModalTurno = false;
    public $showReporte = false;
    public $modalCerrarTurno = false;

    public $items = [];
    public $total = 0;
    public $codigo = '';
    public $opening_amount;
    public $payment_method = 'Efectivo';
    public $facturas;
    public $shift;
    public $autoPrint = false;
    public $total_expenses, $closing_amount;

    public function render()
    {
        $this->shift = CashShift::where('user_id', session('userId'))
            ->where('status', 'open')
            ->first();

        if (!$this->shift) {
            $this->showModalTurno = true;
        }else{
            $this->facturas = $this->shift->sales()->with('details')->orderBy('id', 'desc')->get();
        }


        return view('livewire.billing')
            ->layout('layouts.app', [
                'title' => 'Facturacion',
                'script' => 'billing'
            ]);
    }

    public function buscarProducto()
    {
        $codigo = trim($this->codigo);
        if (!$codigo) return;

        $producto = Product::where('code', $codigo)->first();

        if (!$producto) {
            $this->dispatch('toast', title: 'Producto no encontrado', icon: 'error');
            return;
        }

        // Si el producto se vende por unidad, solo aumentamos cantidad si ya existe
        foreach ($this->items as &$item) {
            if ($item['code'] === $producto->code && $producto->unit_type !== 'kl') {
                $item['quantity']++;
                $item['subtotal'] = $item['quantity'] * $item['price'];
                $this->calcularTotal();
                $this->dispatch('toast', title: 'Cantidad aumentada', icon: 'info');
                return;
            }
        }

        // Si no existe, lo agregamos
        $lineId = uniqid();
        $this->items[$lineId] = [
            'id' => $producto->id,
            'code' => $producto->code,
            'name' => $producto->name,
            'unit_type' => $producto->unit_type,
            'quantity' => 1,
            'weight' => 1,
            'price' => $producto->price,
            'subtotal' => $producto->price,
        ];

        $this->calcularTotal();
        $this->dispatch('toast', title: 'Producto agregado', icon: 'success');

        $this->codigo = '';
    }

    public function eliminarItem($lineId)
    {
        unset($this->items[$lineId]);
        $this->calcularTotal();
    }

    public function actualizarPeso($lineId, $value)
    {
        if (isset($this->items[$lineId])) {
            $item = &$this->items[$lineId];
            $item['weight'] = floatval($value);
            $item['subtotal'] = $item['price'] * $item['weight'];
            $this->calcularTotal();
        }
    }

    public function actualizarCantidad($lineId, $value)
    {
        if (isset($this->items[$lineId])) {
            $item = &$this->items[$lineId];
            $item['quantity'] = floatval($value);
            $item['subtotal'] = $item['price'] * $item['quantity'];
            $this->calcularTotal();
        }
    }


    public function calcularTotal()
    {
        $this->total = collect($this->items)->sum('subtotal');
    }

    public function facturar()
    {
        if (empty($this->items)) {
            $this->dispatch('toast', title: 'No hay productos para facturar.', icon: 'warning');
            return;
        }
        
        $controller = new BillingController();
    
        $request = new \Illuminate\Http\Request([
            'items' => $this->items,
            'total' => $this->total,
            'payment_method' => $this->payment_method ?? 'Efectivo',
        ]);

        $response = $controller->store($request);
        $result = $response->getData(true);

        if ($result['success']) {

            // Si el switch está activado, enviamos el evento con el HTML del ticket
            if ($this->autoPrint) {
                 $ticketHtml = view('livewire.invoices.ticket', [
                    'items' => $this->items,
                    'total' => $this->total,
                    'payment_method' => $this->payment_method ?? 'Efectivo',
                    'sale_id' => $result['sale_id'],
                ])->render();

                $this->dispatch('print-ticket', html: $ticketHtml);

            }

            $this->items = [];
            $this->total = 0;

            $this->dispatch('alert', title: "Factura", text: $result['message'], icon: 'success');
        } else {
            $this->dispatch('alert', title: "Factura", text: 'No se pudo registrar la venta.', icon: 'success');
        }

        $this->payment_method = 'Efectivo';
    }

    public function abrirTurno()
    {
        $this->validate([
            'opening_amount' => 'required|numeric|min:0',
        ]);

        CashShift::create([
            'user_id' => session('userId'),
            'opening_amount' => $this->opening_amount,
            'opened_at' => now(),
            'status' => 'open',
        ]);

        $this->showModalTurno = false;

        $this->dispatch('alert',  title: "Turno", text:'Turno abierto correctamente.', icon: 'success');
    }

    public function cerrarTurno()
    {
        $shift = CashShift::where('user_id', session('userId'))
        ->where('status', 'open')
        ->first();

        if (!$shift) {
            return; // No hay turno abierto
        }


        $shift->update([
            'total_sales' => $this->facturas->sum('total'),
            'total_cash' => $this->facturas->where('payment_method', 'Efectivo')->sum('total'),
            'total_transfer' => $this->facturas->where('payment_method', 'Transferencia')->sum('total'),
            'total_card' => $this->facturas->where('payment_method', 'Banco')->sum('total'),
            'closing_amount' => $this->closing_amount ?? 0,
            'total_expenses' => $this->total_expenses ?? 0,
            'status' => 'closed',
            'closed_at' => now(),
        ]);

        // Ocultar el modal
        $this->modalCerrarTurno = false;

        $this->dispatch('alert', title: 'Turno cerrado', text: 'El turno se ha cerrado correctamente.', icon: 'success');

    }

}
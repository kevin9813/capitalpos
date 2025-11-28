<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CashShift;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Support\Facades\DB;

class BillingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array|min:1',
            'total' => 'required|numeric|min:0',
            'payment_method' => 'required|in:Efectivo,Banco,Transferencia',
        ]);

        $userId = session('userId');

        // Obtener el turno actual del usuario
        $cashShift = CashShift::where('user_id', $userId)
            ->where('status', 'open')
            ->latest()
            ->first();

        if (!$cashShift) {
            return response()->json(['success' => false, 'message' => 'Debe abrir un turno antes de facturar.'], 403);
        }

        try {
            DB::beginTransaction();

            // Crear la venta
            $sale = Sale::create([
                'user_id' => $userId,
                'cash_shift_id' => $cashShift->id,
                'total' => $validated['total'],
                'payment_method' => $validated['payment_method'],
            ]);

            // Insertar los detalles
            foreach ($validated['items'] as $item) {
                SaleDetail::create([
                    'sale_id' => $sale->id,
                    'product_id' => $item['id'],
                    'product_name' => $item['name'],
                    'unit_type' => $item['unit_type'],
                    'quantity' => ($item['unit_type'] == "kl") ? $item['weight'] : $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['subtotal'],
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Venta registrada correctamente',
                'sale_id' => $sale->id,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al guardar la venta: ' . $e->getMessage(),
            ], 500);
        }

    }
}

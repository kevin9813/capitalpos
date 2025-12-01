<?php

namespace App\Livewire;

use App\Models\CashShift;
use App\Models\Expense;

use Livewire\Component;
use Livewire\Attributes\On;

class Expenses extends Component
{
    public $showModalGastos = false;
    public $expenses = [];
    public $description, $price;

    public function render()
    {
        $this->getExpenses();
        return view('livewire.expenses');
    }
    
    #[On('open-expense-modal')]
    public function openModal()
    {
        $this->reset(['description', 'price']);
        $this->showModalGastos = true;
    }

    public function getExpenses()
    {
        $cashShift = CashShift::where('user_id', session('userId'))
            ->where('status', 'open')
            ->latest()
            ->first();

        if($cashShift){
            $this->expenses = Expense::where('cash_shift_id', $cashShift->id)
                ->orderBy('id', 'desc')
                ->get();
        }
    }
   
    public function save()
    {
        $this->validate([
            'description' => 'required',
            'price' => 'required',
        ]);

        $cashShift = CashShift::where('user_id', session('userId'))
            ->where('status', 'open')
            ->latest()
            ->first();

        $numeric = preg_replace('/\D/', '', $this->price);
        Expense::create([
            'description'   => $this->description,
            'price'         => $numeric,
            'cash_shift_id' => $cashShift->id,
            'status'        => true,
        ]);

        // Recalcular total de gastos del turno
        $total = Expense::where('cash_shift_id', $cashShift->id)
                        ->where('status', true)
                        ->sum('price');

        // Guardar en cash_shift
        $cashShift->update([
            'total_expenses' => $total,
        ]);


        $this->description = "";
        $this->price = "";

        $this->dispatch('toast', title: 'Gasto insertado correctamente.', icon: 'success');

    }

    public function updatedPrice($value)
    {
        $numeric = preg_replace('/\D/', '', $value);

        if ($numeric === '') {
            $this->price = '';
            return;
        }

        $this->price = number_format($numeric, 0, ',', '.');
    }
}

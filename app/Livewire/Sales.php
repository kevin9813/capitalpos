<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CashShift;

class Sales extends Component
{
    public $showReporte = false;
    public $cashShifts = [];

    //Reporte
    public $shift;
    public $facturas;



    public function render()
    {
        return view('livewire.sales')
            ->layout('layouts.app', [
                'title' => 'Ventas'
            ]);
    }

    public function mount()
    {
        $companyId = session('companyId');
        $this->cashShifts = CashShift::whereHas('user', function ($query) use ($companyId) {
            // Aquí filtramos los usuarios cuya company_id sea igual a la de la sesión
            $query->where('company_id', $companyId);
        })
        ->with('user')
        ->orderBy('id', 'desc')
        ->get();
    }

    public function viewCashShift(CashShift $cashShift) 
    {
        $this->shift = $cashShift;
        $this->facturas = $this->shift->sales()->with('details')->orderBy('id', 'desc')->get();

        $this->showReporte = true;
    }

}

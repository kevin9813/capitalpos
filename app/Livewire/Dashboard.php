<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class Dashboard extends Component
{
    public $countProducts = 0;
    public $countsuppliers = 0;

    public function render(){
        $this->ProductsCount();
        return view('livewire.dashboard')
            ->layout('layouts.app', ['title' => 'Inicio']);
    }

    public function ProductsCount()
    {
        $this->countProducts = Product::where('status', 1)->count();
    }
}

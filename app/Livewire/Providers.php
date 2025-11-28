<?php

namespace App\Livewire;

use Livewire\Component;

class Providers extends Component
{
    public function render()
    {
        return view('livewire.providers')
            ->layout('layouts.app', ['title' => 'Proveedores']);
    }
}

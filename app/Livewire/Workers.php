<?php

namespace App\Livewire;

use Livewire\Component;

class Workers extends Component
{
    public function render()
    {
        return view('livewire.workers')->layout('layouts.app', [
                'title' => 'Trabajadores'
            ]);
    }
}

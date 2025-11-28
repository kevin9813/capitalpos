<?php

namespace App\Livewire;

use Livewire\Component;
//
use App\Models\Product;

class Products extends Component
{
    public $products = [];
    public $ProductIdBeingEdited = null;
    public $code, $name, $unit_type = 'kl', $description, $price, $tax_percent = 0;
    public $showModal = false;
    public $confirmingDeleteId = null;
    
    public function render()
    {
    
        return view('livewire.products')
            ->layout('layouts.app', ['title' => 'Productos']);
    }

    public function mount()
    {
        $this->products = Product::where('company_id', session('companyId'))->get();
    }

    public function create()
    {
        $this->resetFields();
        $this->showModal = true;
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        $this->ProductIdBeingEdited = $id;
        $this->code = $product->code;
        $this->name = $product->name;
        $this->unit_type = $product->unit_type;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->tax_percent = $product->tax_percent ?? 0;

        $this->showModal = true;
    }

    public function save()
    {
        $company_id = session('companyId');
        if (!$company_id) {
            session()->flash('message', 'No hay empresa activa en sesión.');
            return;
        }

        $this->validate([
            'code' => 'required',
            'name' => 'required',
            'unit_type' => 'required',
            'price' => 'required|numeric|min:0',
            'tax_percent' => 'nullable|numeric|min:0|max:100',
        ]);

        if ($this->ProductIdBeingEdited) {
            // Editar
            $product = Product::findOrFail($this->ProductIdBeingEdited);
            $product->update([
                'code' => $this->code,
                'name' => $this->name,
                'unit_type' => $this->unit_type,
                'price' => $this->price,
                'tax_percent' => $this->tax_percent,
            ]);


            $this->dispatch('alert',  title: "Actualizar", text:'Producto actualizado correctamente.', icon: 'success');
        }else{
            Product::create([
                'company_id' => intval($company_id),
                'code' => $this->code,
                'name' => $this->name,
                'unit_type' => $this->unit_type,
                'description' => $this->description,
                'price' => $this->price,
                'tax_percent' => $this->tax_percent ?? 0,
                'status' => true,
            ]);

            $this->dispatch('alert',  title: "Crear", text:'Producto creado correctamente.', icon: 'success');
        }

        $this->showModal = false;
        $this->mount();
    }

    
    // Función para pedir confirmación de eliminación (desde el botón)
    public function askDelete($id)
    {
        $this->confirmingDeleteId = $id;
    }

    public function deleteConfirmed($id)
    {
        Product::find($id)?->delete();
        $this->confirmingDeleteId = null;
        $this->dispatch('alert',  title: "Eliminar", text:'Producto eliminado correctamente.', icon: 'success');
        $this->mount();
    }

    private function resetFields()
    {
        $this->ProductIdBeingEdited = null;
        $this->code = '';
        $this->name = '';
        $this->unit_type = 'kl';
        $this->description = '';
        $this->price = '';
        $this->tax_percent = 0;
    }
}

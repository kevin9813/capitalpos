<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Company;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class Settings extends Component
{
    use WithFileUploads;
    public $company_id;
    public $name;
    public $slogan;
    public $nit;
    public $email;
    public $logo;
    public $logoPreview;
    public $status;
    public $primary_color;
    public $secondary_color;

    public function mount()
    {
        $company = Company::where('id', session('companyId'))->first();
        
        if ($company) {
            $this->company_id = $company->id;
            $this->name = $company->name;
            $this->slogan = $company->slogan;
            $this->nit = $company->nit;
            $this->email = $company->email;
            $this->status = $company->status;
            $this->primary_color = $company->primary_color;
            $this->secondary_color = $company->secondary_color;
            $this->logoPreview = $company->logo ? asset($company->logo) : null;
        }
    }

    public function render()
    {

        return view('livewire.settings')->layout('layouts.app', [
                'title' => 'Configuracion'
            ]);
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slogan' => 'nullable|string|max:255',
            'nit' => 'required|string|max:50',
            'email' => 'required|email',
            'status' => 'required|boolean',

            // 'primary_color' => 'nullable|string|max:20',
            // 'secondary_color' => 'nullable|string|max:20',

            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240'
        ];
    }

    public function save()
    {
        $this->validate();

        $company = Company::find($this->company_id);

        if (!$company) {
            $this->dispatch('alert',  title: "Configuracion", text:'No se encontró la compañía.', icon: 'error');
            return;
        }

        if ($this->logo) {
            // Guardar el logo
            $path = public_path("logos/company_{$company->id}");
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $extension = $this->logo->getClientOriginalExtension();
            $fileName = "logocompany_{$company->id}.{$extension}";

            // Crear manager con driver GD
            $manager = new ImageManager(new Driver());
            // Leer la imagen subida
            $img = $manager->read($this->logo->getRealPath());
            // Redimensionar manteniendo proporción
            $img->resize(1024, 900, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize(); // evita que se agrande la imagen
            });
            // Guardar en JPEG con 80% calidad
            $img->toJpeg(80)->save($path . '/' . $fileName);

            // Guardar la ruta relativa en la DB
            $company->logo = "logos/company_{$company->id}/{$fileName}";
        }

        $company->name = $this->name;
        $company->slogan = $this->slogan;
        $company->nit = $this->nit;
        $company->email = $this->email;
        $company->status = $this->status;
        // $company->primary_color = $this->primary_color;
        // $company->secondary_color = $this->secondary_color;

        $company->save();

        $this->dispatch('alert',  title: "Configuracion", text:'Actualizada correctamente.', icon: 'success');
    }

    public function updatedLogo()
    {
        $this->validateOnly('logo');
        $this->logoPreview = $this->logo->temporaryUrl();
    }
}

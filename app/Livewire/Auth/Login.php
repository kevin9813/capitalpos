<?php

namespace App\Livewire\Auth;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Company;

class Login extends Component
{
    public $usuario;
    public $password;
    public $errorMessage;

    public function render()
    {
        return view('livewire.auth.login')
            ->layout('layouts.blank');
    }

    public function mount()
    {
        if (auth()->check()) {
            return redirect()->route('home');
        }
    }

    public function login()
    {
        $this->validate([
            'usuario' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('usuario', $this->usuario)->first();

        if (!$user || !Hash::check($this->password, $user->password)) {
            $this->errorMessage = 'Usuario o contraseña incorrectos.';
            return;
        }

        if (!$user->status) {
            $this->errorMessage = 'Usuario inactivo.';
            return;
        }

        $company = Company::where('id', $user->company_id)->first();     
        $permissions = $user->role->permissions()->pluck('permissions.name', 'permissions.code')->toArray();
                    
        Auth::login($user);
        session(['userId' => $user->id]);
        session(['userName' => $user->name]);
        session(['usuario' => $user->usuario]);
        session(['companyId' => $user->company_id]);
        session(['userRoleId' => $user->role_id]);
        session(['userStatus' => $user->status]);
        session(['companyName' => $company->name]);
        session(['companyNit' => $company->nit]);
        session(['permissions' => $permissions]);

        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('login');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\User;
use App\Models\Roles;
use App\Models\Permission;
use App\Models\RolePermission;

use Illuminate\Support\Facades\Hash;

class Users extends Component
{

    public $users, $roles, $permissions;
    public $name, $user, $password, $roleId, $statusId;
    public $userIdBeingEdited = null;
    public $showModal = false;

    public $selectedRole = false;
    public $rolePermissions = [];

    protected $rules = [
        'name' => 'required|min:3',
        'user' => 'required|min:4',
        'roleId' => 'required',
    ];

    public function render()
    {
    
        $this->users = User::with('role')->where('company_id', session('companyId'))->orderBy('name', 'asc')->get();
        $this->roles = Roles::where('is_global',1)->orwhere('company_id', session('companyId'))->orderBy('name', 'asc')->get();
        $this->permissions = Permission::orderBy('orden', 'asc')->get();

        return view('livewire.users')
            ->layout('layouts.app', ['title' => 'Usuarios']);
    }

    public function create()
    {
        $this->resetFields();
        $this->showModal = true;
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        $this->userIdBeingEdited = $id;
        $this->name = $user->name;
        $this->user = $user->usuario;
        $this->roleId = $user->role_id;

        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->userIdBeingEdited) {
            // Editar usuario
            $user = User::findOrFail($this->userIdBeingEdited);
            $user->update([
                'name' => $this->name,
                'usuario' => $this->user,
                'role_id' => $this->roleId,
                'status' => $this->statusId
            ]);

            if ($this->password) {
                $user->update(['password' => Hash::make($this->password)]);
            }

            $this->dispatch('alert',  title: "Actualizar", text:'Usuario actualizado correctamente.', icon: 'success');

        } else {
            // Crear nuevo usuario
            User::create([
                'name' => $this->name,
                'usuario' => $this->user,
                'role_id' => $this->roleId,
                'password' => Hash::make($this->password ?? '123456'),
                'company_id' => session('companyId'),
                'status' =>1
            ]);

            $this->dispatch('alert',  title: "Crear", text:'Usuario creado correctamente.', icon: 'success');
        }

        $this->resetFields();
        $this->showModal = false;
    }

    private function resetFields()
    {
        $this->userIdBeingEdited = null;
        $this->name = '';
        $this->user = '';
        $this->password = '';
        $this->roleId = '';
    }

    //Permission
    public function updatedSelectedRole($roleId)
    {
        if (!$roleId) {
            $this->rolePermissions = [];
            return;
        }

        // Cargar el rol con sus permisos
        $role = Roles::with('permissions')->find($roleId);

        // Traer solo los IDs de los permisos del rol
        $this->rolePermissions = $role->permissions->pluck('id')->toArray();
    }

    public function togglePermission( $permissionId)
    {
        $roleId = $this->selectedRole;
        $existing = RolePermission::where('role_id',  $roleId)
            ->where('permission_id', $permissionId)
            ->first();

        if ($existing) {
            $existing->delete();
            $this->dispatch('toast', title: 'Permiso eliminado correctamente', icon: 'error');

        } else {
            RolePermission::create([
                'role_id' => $roleId,
                'permission_id' => $permissionId,
            ]);

            $this->dispatch('toast', title: 'Permiso creado correctamente', icon: 'success');
        }

        $this->dispatch('updatedPermissions');
    }
}

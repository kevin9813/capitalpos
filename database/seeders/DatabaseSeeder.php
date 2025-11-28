<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Company;
use App\Models\Permission;
use App\Models\Roles;
use App\Models\RolePermission;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    
         // Compañía
        Company::create([
            'id' => 1,
            'name' => 'Compania 1 test',
            'slogan' => 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit',
            'nit' => '12345',
            'email' => 'email@email.com'
        ]); 

         // Permisos
        $permissions = [
            // 1 Compañia
            ['code' => 'CONFSYST', 'name' => 'Configuracion del sistema', 'orden' => 1, 'description' => 'Configuración general del sistema'],

            // 2 Usuarios y Roles
            ['code' => 'VERUSRS', 'name' => 'Ver usuarios', 'orden' => 2, 'description' => 'Permite ver la lista de usuarios'],
            ['code' => 'EDTUSRS', 'name' => 'Editar usuarios', 'orden' => 3, 'description' => 'Permite editar usuarios'],
            ['code' => 'DELUSRS', 'name' => 'Eliminar usuarios', 'orden' => 4, 'description' => 'Permite eliminar usuarios'],
            ['code' => 'ASGPRMS', 'name' => 'Asignar Permisos', 'orden' => 5, 'description' => 'Permite asignar permisos a roles'],

            // 3 Productos y Menús
            ['code' => 'VRPRDTS', 'name' => 'Ver productos', 'orden' => 6, 'description' => 'Permite ver productos'],
            ['code' => 'CRTPRDT', 'name' => 'Crear productos', 'orden' => 7, 'description' => 'Permite crear nuevos productos'],
            ['code' => 'EDTPRDT', 'name' => 'Editar productos', 'orden' => 8, 'description' => 'Permite editar productos'],
            ['code' => 'DELPRDT', 'name' => 'Eliminar productos', 'orden' => 9, 'description' => 'Permite eliminar productos'],

            // 5 Facturación
            ['code' => 'FACTURC', 'name' => 'Facturacion', 'orden' => 10, 'description' => 'Acceso al módulo de facturación'],

            // 6 Reportes y Finanzas
            ['code' => 'GSTGAST', 'name' => 'Gestionar gastos', 'orden' => 11, 'description' => 'Permite registrar y gestionar gastos'],
            ['code' => 'GSTINVN', 'name' => 'Gestionar inventario', 'orden' => 12, 'description' => 'Permite gestionar el inventario'],
            ['code' => 'EXPRPTS', 'name' => 'Exportar reportes', 'orden' => 13, 'description' => 'Permite exportar reportes'],
            ['code' => 'VRFINNZ', 'name' => 'Ver estado financiero', 'orden' => 14, 'description' => 'Permite ver el estado financiero'],
        ];
        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        // Rol
        Roles::create([
            'id' => 1,
            'name' => 'Administrador',
            'is_global' => 1
        ]);

        // Usuario
        User::create([
            'id' => 1,
            'name' => 'Test User',
            'usuario' => 'kevin13',
            'password' => '$2y$12$wWYkIN0fpQLnVFygCc2OkOKoE3zecKohKHZCxedjh2wejmswkkUU.',
            'company_id' => 1,
            'role_id' => 1,
        ]); 

        $rolePermissions = [
            ['role_id' => 1, 'permission_id' => 1],
            ['role_id' => 1, 'permission_id' => 2],
            ['role_id' => 1, 'permission_id' => 3],
            ['role_id' => 1, 'permission_id' => 4],
            ['role_id' => 1, 'permission_id' => 5],
            ['role_id' => 1, 'permission_id' => 6],
            ['role_id' => 1, 'permission_id' => 7],
            ['role_id' => 1, 'permission_id' => 8],
            ['role_id' => 1, 'permission_id' => 9],
            ['role_id' => 1, 'permission_id' => 10],
            ['role_id' => 1, 'permission_id' => 11],
            ['role_id' => 1, 'permission_id' => 12],
            ['role_id' => 1, 'permission_id' => 13],
            ['role_id' => 1, 'permission_id' => 14],
        ];

        foreach ($rolePermissions as $rolePermission) {
            RolePermission::create($rolePermission);
        }

    }
}

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


        $products = [
            ['company_id' => 1, 'code' => '001', 'name', 'Bola negra', 'unit_type' => 'kl', 'price' => 38000],
            ['company_id' => 1, 'code' => '002', 'name', 'Caderita', 'unit_type' => 'kl', 'price' => 34000],
            ['company_id' => 1, 'code' => '003', 'name', 'Centro cadera', 'unit_type' => 'kl', 'price' => 30000],
            ['company_id' => 1, 'code' => '004', 'name', 'Ampolleta especial', 'unit_type' => 'kl', 'price' => 28000],
            ['company_id' => 1, 'code' => '005', 'name', 'Ampolleta corriente', 'unit_type' => 'kl', 'price' => 26000],
            ['company_id' => 1, 'code' => '006', 'name', 'Muchacho', 'unit_type' => 'kl', 'price' => 22000],
            ['company_id' => 1, 'code' => '007', 'name', 'Lomo redondo', 'unit_type' => 'kl', 'price' => 26000],
            ['company_id' => 1, 'code' => '008', 'name', 'Lomo caracho', 'unit_type' => 'kl', 'price' => 32000],
            ['company_id' => 1, 'code' => '009', 'name', 'Punta de anca', 'unit_type' => 'kl', 'price' => 32000],
            ['company_id' => 1, 'code' => '010', 'name', 'Caderita super especial', 'unit_type' => 'kl', 'price' => 34000],
            ['company_id' => 1, 'code' => '011', 'name', 'Lomo biche especial', 'unit_type' => 'kl', 'price' => 32000],
            ['company_id' => 1, 'code' => '012', 'name', 'Lomo biche corriente', 'unit_type' => 'kl', 'price' => 30000],
            ['company_id' => 1, 'code' => '013', 'name', 'Milanesa especial', 'unit_type' => 'kl', 'price' => 28000],
            ['company_id' => 1, 'code' => '014', 'name', 'Pecho', 'unit_type' => 'kl', 'price' => 30000],
            ['company_id' => 1, 'code' => '015', 'name', 'Sobrebarriga', 'unit_type' => 'kl', 'price' => 26000],
            ['company_id' => 1, 'code' => '016', 'name', 'Espaldilla', 'unit_type' => 'kl', 'price' => 26000],
            ['company_id' => 1, 'code' => '017', 'name', 'Sobaco crespa', 'unit_type' => 'kl', 'price' => 18000],
            ['company_id' => 1, 'code' => '018', 'name', 'Pepino', 'unit_type' => 'kl', 'price' => 32000],
            ['company_id' => 1, 'code' => '019', 'name', 'Molida especial', 'unit_type' => 'kl', 'price' => 28000],
            ['company_id' => 1, 'code' => '020', 'name', 'Costi falda', 'unit_type' => 'kl', 'price' => 24000],
            ['company_id' => 1, 'code' => '021', 'name', 'Morrillo', 'unit_type' => 'kl', 'price' => 25000],
            ['company_id' => 1, 'code' => '022', 'name', 'Punta falda', 'unit_type' => 'kl', 'price' => 22000],
            ['company_id' => 1, 'code' => '023', 'name', 'Costilla especail', 'unit_type' => 'kl', 'price' => 23000],
            ['company_id' => 1, 'code' => '024', 'name', 'Costilla corriente', 'unit_type' => 'kl', 'price' => 20000],
            ['company_id' => 1, 'code' => '025', 'name', 'Cogote especial', 'unit_type' => 'kl', 'price' => 19000],
            ['company_id' => 1, 'code' => '026', 'name', 'Espinazo', 'unit_type' => 'kl', 'price' => 18000],
            ['company_id' => 1, 'code' => '027', 'name', 'Llanera', 'unit_type' => 'kl', 'price' => 28000],
            ['company_id' => 1, 'code' => '028', 'name', 'Coditos cerdo', 'unit_type' => 'kl', 'price' => 19000],
            ['company_id' => 1, 'code' => '029', 'name', 'Hueso sustancia', 'unit_type' => 'kl', 'price' => 19000],
            ['company_id' => 1, 'code' => '030', 'name', 'Paquete de hueso x3 libras', 'unit_type' => 'unidad', 'price' => 1000],
            ['company_id' => 1, 'code' => '031', 'name', 'Cola res especial', 'unit_type' => 'kl', 'price' => 22000],
            ['company_id' => 1, 'code' => '032', 'name', 'Aguja especial', 'unit_type' => 'kl', 'price' => 20000],
            ['company_id' => 1, 'code' => '033', 'name', 'Higado nacional', 'unit_type' => 'kl', 'price' => 19000],
            ['company_id' => 1, 'code' => '034', 'name', 'Boffe res', 'unit_type' => 'kl', 'price' => 16000],
            ['company_id' => 1, 'code' => '035', 'name', 'Pajarilla', 'unit_type' => 'kl', 'price' => 17000],
            ['company_id' => 1, 'code' => '036', 'name', 'Corazon', 'unit_type' => 'unidad', 'price' => 7500],
            ['company_id' => 1, 'code' => '037', 'name', 'Callo', 'unit_type' => 'kl', 'price' => 24000],
            ['company_id' => 1, 'code' => '038', 'name', 'Librillo callo', 'unit_type' => 'kl', 'price' => 19000],
            ['company_id' => 1, 'code' => '039', 'name', 'Cuajo', 'unit_type' => 'kl', 'price' => 19000],
            ['company_id' => 1, 'code' => '040', 'name', 'Sonrisa', 'unit_type' => 'kl', 'price' => 18000],
        ];

    }
}

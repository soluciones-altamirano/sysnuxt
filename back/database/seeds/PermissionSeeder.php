<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'crear admins']);
        Permission::create(['name' => 'depurar']);

        Permission::create(['name' => 'permiso directo 1']);
        Permission::create(['name' => 'permiso directo 2']);
        Permission::create(['name' => 'permiso directo 3']);
    }
}

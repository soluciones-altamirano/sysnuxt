<?php

use App\Models\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class,1)->create(['username' => 'admin'])->each(function (User $user){

            $user->syncRoles([Role::DEVELOPER,Role::SUPERADMIN,Role::ADMIN]);

            $user->syncPermissions(['permiso directo 1','permiso directo 2']);
        });

        factory(User::class,9)->create()->each(function (User $user){
            $user->syncRoles([Role::OPERADOR]);
        });
    }
}

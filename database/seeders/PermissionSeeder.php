<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $dashboardModule = Module::updateOrCreate(['name'=>'Admin Dashboard']);
        Permission::updateOrCreate([

            'module_id' => $dashboardModule->id,
            'name' => 'Access Dashboard',
            'slug' => 'app.dashboard'

        ]);


        $roleModule = Module::updateOrCreate(['name'=>'Role Management']);
        Permission::updateOrCreate([

            'module_id' => $roleModule->id,
            'name' => 'Access Role',
            'slug' => 'app.role.index'

        ]);


        Permission::updateOrCreate([

            'module_id' => $roleModule->id,
            'name' => 'Create Role',
            'slug' => 'app.role.create'

        ]);



        Permission::updateOrCreate([

            'module_id' => $roleModule->id,
            'name' => 'Edit Role',
            'slug' => 'app.role.edit'

        ]);


        Permission::updateOrCreate([

            'module_id' => $roleModule->id,
            'name' => 'Delete Role',
            'slug' => 'app.role.delete'

        ]);




        $usersModule = Module::updateOrCreate(['name'=>'User Management']);
        Permission::updateOrCreate([

            'module_id' => $usersModule->id,
            'name' => 'Access User',
            'slug' => 'app.users.index'

        ]);


        Permission::updateOrCreate([

            'module_id' => $usersModule->id,
            'name' => 'Create User',
            'slug' => 'app.users.create'

        ]);


        Permission::updateOrCreate([

            'module_id' => $usersModule->id,
            'name' => 'Edit User',
            'slug' => 'app.users.edit'

        ]);


        Permission::updateOrCreate([

            'module_id' => $usersModule->id,
            'name' => 'Delete User',
            'slug' => 'app.users.delete'

        ]);
    }
}

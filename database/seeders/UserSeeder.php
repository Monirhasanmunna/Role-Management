<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate([

            'role_id' => Role::where('slug','admin')->first()->id,
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt(11111111),
            'status' => true,

        ]);


        User::updateOrCreate([

            'role_id' => Role::where('slug','user')->first()->id,
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt(11111111),
            'status' => false,
        ]);
    }
}

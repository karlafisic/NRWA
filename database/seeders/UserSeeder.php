<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $editorRole = Role::where('name', 'editor')->first();
        $userRole = Role::where('name', 'user')->first();

        User::create([
            'name' => 'Karla',
            'email' => 'karla@gmail.com',
            'password' => Hash::make('karla123'),
            'role_id' => $adminRole->id,
        ]);

        User::create([
            'name' => 'Editor',
            'email' => 'editor@gmail.com',
            'password' => Hash::make('editor123'),
            'role_id' => $editorRole->id,
        ]);

        User::create([
            'name' => 'Netko',
            'email' => 'netko@gmail.com',
            'password' => Hash::make('netko123'),
            'role_id' => $userRole->id,
        ]);
    }
}

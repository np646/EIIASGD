<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin'
            ],
            [
                'name' => 'Adam User',
                'email' => 'adam@example.com',
                'password' => Hash::make('password'),
                'role' => 'adam'
            ],
            [
                'name' => 'Eve User',
                'email' => 'eve@example.com',
                'password' => Hash::make('password'),
                'role' => 'eve'
            ],
        ];

        foreach ($users as $userData) {
            $role = $userData['role'];
            unset($userData['role']);
            
            $user = User::create($userData);
            $user->roles()->attach(Role::where('name', $role)->first());
        }
    }
}

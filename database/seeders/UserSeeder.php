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
                'name' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'roles' => ['admin']
            ],
            [
                'name' => 'titulacion',
                'email' => 'titulacion@example.com',
                'password' => Hash::make('password'),
                'roles' => ['titulacion']
            ],
            [
                'name' => 'practicas',
                'email' => 'practicas@example.com',
                'password' => Hash::make('password'),
                'roles' => ['practicas']
            ],
            [
                'name' => 'asistente',
                'email' => 'asistente@example.com',
                'password' => Hash::make('password'),
                'roles' => ['asistente']
            ],
            [
                'name' => 'director',
                'email' => 'director@example.com',
                'password' => Hash::make('password'),
                'roles' => ['director']
            ],
        ];

        foreach ($users as $userData) {
            $roles = $userData['roles'];
            unset($userData['roles']);

            $user = User::create($userData);
            $roleIds = Role::whereIn('name', $roles)->pluck('id')->toArray();
            $user->roles()->attach($roleIds);
        }
    }
}

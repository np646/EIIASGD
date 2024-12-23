<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'read'],
            ['name' => 'write'],
            ['name' => 'delete'],
            ['name' => 'create'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        // Assign permissions to roles
        $adminRole = Role::where('name', 'admin')->first();
        //$guestRole = Role::where('name', 'guest')->first(); // guest has no permissions at the moment, if they're a guest they simply can't access the contents of the site
        $titulacionRole = Role::where('name', 'titulacion')->first();
        $p_preprofesionalesRole = Role::where('name', 'p_preprofesionales')->first();
        $p_vinculacionRole = Role::where('name', 'p_vinculacion')->first();
        $asistenteRole = Role::where('name', 'asistente')->first();
        $directorRole = Role::where('name', 'director')->first();

        $adminRole->permissions()->attach(Permission::all());
        $titulacionRole->permissions()->attach(Permission::all());
        $p_preprofesionalesRole->permissions()->attach(Permission::all());
        $p_vinculacionRole->permissions()->attach(Permission::all());
        $asistenteRole->permissions()->attach(Permission::where('name', 'read')->first());
        $directorRole->permissions()->attach(Permission::where('name', 'read')->first());
    }
}

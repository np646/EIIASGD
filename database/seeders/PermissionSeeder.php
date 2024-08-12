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
            ['name' => 'view_section_t', 'description' => 'Can view section T'],
            ['name' => 'view_section_p', 'description' => 'Can view section P'],
            // Add more permissions as needed
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        // Assign permissions to roles
        $adminRole = Role::where('name', 'admin')->first();
        $adamRole = Role::where('name', 'adam')->first();
        $eveRole = Role::where('name', 'eve')->first();

        $adminRole->permissions()->attach(Permission::all());
        $adamRole->permissions()->attach(Permission::all());
        $eveRole->permissions()->attach(Permission::where('name', 'view_section_p')->first());
    }
}

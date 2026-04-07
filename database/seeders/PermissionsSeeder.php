<?php

namespace Database\Seeders;

use Galaxy\Admin\Resources\Database\Seeders\UserPermissionsSeeder;
use Galaxy\Admin\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends UserPermissionsSeeder
{
    /**
     * Create role's and give permissions to those roles
     *
     * createRoles is seperate from the Galaxy permission seeder
     * cause the roles and permissions can defer with each site
     */
    protected function createRoles(): void
    {
        // User permissions
        $extern = Role::updateOrCreate(['name' => 'user'], ['name' => 'user']);
        $extern->givePermissionTo();

        // Admin permissions
        $admin = Role::updateOrCreate(['name' => 'admin'], ['name' => 'admin']);
        $admin->givePermissionTo();

        // Superadmin permissions
        $superadmin = Role::updateOrCreate(['name' => 'superadmin'], ['name' => 'superadmin']);
        $superadmin->givePermissionTo(Permission::all());

        // Give the user superadmin role.
        User::find(1)->assignRole('superadmin');
    }
}

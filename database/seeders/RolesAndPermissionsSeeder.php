<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Misc
        $miscPermission = Permission::create(['name' => 'N/A', 'guard_name' => 'web']);

        // USER MODEL
        $userPermission1 = Permission::create(['name' => 'create:user', 'guard_name' => 'web']);
        $userPermission2 = Permission::create(['name' => 'show:user', 'guard_name' => 'web']);
        $userPermission3 = Permission::create(['name' => 'update:user', 'guard_name' => 'web']);
        $userPermission4 = Permission::create(['name' => 'delete:user', 'guard_name' => 'web']);

        // ROLE MODEL
        $rolePermission1 = Permission::create(['name' => 'create:role', 'guard_name' => 'web']);
        $rolePermission2 = Permission::create(['name' => 'show:role', 'guard_name' => 'web']);
        $rolePermission3 = Permission::create(['name' => 'update:role', 'guard_name' => 'web']);
        $rolePermission4 = Permission::create(['name' => 'delete:role', 'guard_name' => 'web']);

        // PERMISSION MODEL
        $permission1 = Permission::create(['name' => 'create:permission', 'guard_name' => 'web']);
        $permission2 = Permission::create(['name' => 'show:permission', 'guard_name' => 'web']);
        $permission3 = Permission::create(['name' => 'update:permission', 'guard_name' => 'web']);
        $permission4 = Permission::create(['name' => 'delete:permission', 'guard_name' => 'web']);

        // CREATE ROLES
        $userRole = Role::create(['name' => 'user', 'guard_name' => 'web'])->syncPermissions([
            $miscPermission,
        ]);

        $superAdminRole = Role::create(['name' => 'admin', 'guard_name' => 'web'])->syncPermissions([
            $userPermission1,
            $userPermission2,
            $userPermission3,
            $userPermission4,
            $rolePermission1,
            $rolePermission2,
            $rolePermission3,
            $rolePermission4,
            $permission1,
            $permission2,
            $permission3,
            $permission4,
        ]);
        $memberRole = Role::create(['name' => 'member', 'guard_name' => 'web'])->syncPermissions([
            $userPermission1,
        ]);
    }
}

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
        $miscPermission = Permission::create(['name' => 'N/A']);

        // USER MODEL
        $userPermission1 = Permission::create(['name' => 'create:user']);
        $userPermission2 = Permission::create(['name' => 'view:user']);
        $userPermission3 = Permission::create(['name' => 'update:user']);
        $userPermission4 = Permission::create(['name' => 'delete:user']);

        // ROLE MODEL
        $rolePermission1 = Permission::create(['name' => 'create:role']);
        $rolePermission2 = Permission::create(['name' => 'view:role']);
        $rolePermission3 = Permission::create(['name' => 'update:role']);
        $rolePermission4 = Permission::create(['name' => 'delete:role']);

        // PERMISSION MODEL
        $permission1 = Permission::create(['name' => 'create:permission']);
        $permission2 = Permission::create(['name' => 'view:permission']);
        $permission3 = Permission::create(['name' => 'update:permission']);
        $permission4 = Permission::create(['name' => 'delete:permission']);

        // POST MODEL
        $postPermission1 = Permission::create(['name' => 'create:post']);
        $postPermission2 = Permission::create(['name' => 'view:post']);
        $postPermission3 = Permission::create(['name' => 'update:post']);
        $postPermission4 = Permission::create(['name' => 'delete:post']);

        // GAME MODEL
        $gamePermission1 = Permission::create(['name' => 'create:game']);
        $gamePermission2 = Permission::create(['name' => 'view:game']);
        $gamePermission3 = Permission::create(['name' => 'update:game']);
        $gamePermission4 = Permission::create(['name' => 'delete:game']);

        // ALBUM MODEL
        $albumPermission1 = Permission::create(['name' => 'create:album']);
        $albumPermission2 = Permission::create(['name' => 'view:album']);
        $albumPermission3 = Permission::create(['name' => 'update:album']);
        $albumPermission4 = Permission::create(['name' => 'delete:album']);

        // AGENDA MODEL
        $eventPermission1 = Permission::create(['name' => 'create:event']);
        $eventPermission2 = Permission::create(['name' => 'view:event']);
        $eventPermission3 = Permission::create(['name' => 'update:event']);
        $eventPermission4 = Permission::create(['name' => 'delete:event']);

        // CREATE ROLES
        $userRole = Role::create(['name' => 'user'])->syncPermissions([
            $miscPermission,
        ]);

        $superAdminRole = Role::create(['name' => 'admin'])->syncPermissions([
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
            $postPermission1,
            $postPermission2,
            $postPermission3,
            $postPermission4,
            $gamePermission1,
            $gamePermission2,
            $gamePermission3,
            $gamePermission4,
            $albumPermission1,
            $albumPermission2,
            $albumPermission3,
            $albumPermission4,
            $eventPermission1,
            $eventPermission2,
            $eventPermission3,
            $eventPermission4,
        ]);
        $memberRole = Role::create(['name' => 'member'])->syncPermissions([
            $userPermission1,
            $userPermission2,
            $postPermission1,
            $postPermission2,
            $gamePermission1,
            $gamePermission2,
            $albumPermission1,
            $albumPermission2,
            $eventPermission1,
            $eventPermission2,
        ]);
    }
}

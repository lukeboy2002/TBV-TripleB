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

        // USER MODEL
        $userPermission1 = Permission::create(['name' => 'create:user']);
        $userPermission2 = Permission::create(['name' => 'show:user']);
        $userPermission3 = Permission::create(['name' => 'update:user']);
        $userPermission4 = Permission::create(['name' => 'delete:user']);

        // ROLE MODEL
        $rolePermission1 = Permission::create(['name' => 'create:role']);
        $rolePermission2 = Permission::create(['name' => 'show:role']);
        $rolePermission3 = Permission::create(['name' => 'update:role']);
        $rolePermission4 = Permission::create(['name' => 'delete:role']);

        // PERMISSION MODEL
        $permission1 = Permission::create(['name' => 'create:permission']);
        $permission2 = Permission::create(['name' => 'show:permission']);
        $permission3 = Permission::create(['name' => 'update:permission']);
        $permission4 = Permission::create(['name' => 'delete:permission']);

        // ADMINS
        $adminPermission1 = Permission::create(['name' => 'create:admin']);
        $adminPermission2 = Permission::create(['name' => 'show:admin']);
        $adminPermission3 = Permission::create(['name' => 'update:admin']);
        $adminPermission4 = Permission::create(['name' => 'delete:admin']);

        // POSTS
        $postPermission1 = Permission::create(['name' => 'create:post']);
        $postPermission2 = Permission::create(['name' => 'show:post']);
        $postPermission3 = Permission::create(['name' => 'update:post']);
        $postPermission4 = Permission::create(['name' => 'delete:post']);

        // GAMES
        $gamePermission1 = Permission::create(['name' => 'create:game']);
        $gamePermission2 = Permission::create(['name' => 'show:game']);
        $gamePermission3 = Permission::create(['name' => 'update:game']);
        $gamePermission4 = Permission::create(['name' => 'delete:game']);

        // ALBUMS
        $albumPermission1 = Permission::create(['name' => 'create:album']);
        $albumPermission2 = Permission::create(['name' => 'show:album']);
        $albumPermission3 = Permission::create(['name' => 'update:album']);
        $albumPermission4 = Permission::create(['name' => 'delete:album']);

        // ALBUMS
        $imagePermission1 = Permission::create(['name' => 'create:image']);
        $imagePermission2 = Permission::create(['name' => 'show:image']);
        $imagePermission3 = Permission::create(['name' => 'update:image']);
        $imagePermission4 = Permission::create(['name' => 'delete:image']);

        // CREATE ROLES
        $userRole = Role::create(['name' => 'user']);

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
            $adminPermission1,
            $adminPermission2,
            $adminPermission3,
            $adminPermission4,
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
            $imagePermission1,
            $imagePermission2,
            $imagePermission3,
            $imagePermission4,
        ]);
        $memberRole = Role::create(['name' => 'member'])->syncPermissions([
            $userPermission1,
            $postPermission1,
            $gamePermission1,
            $albumPermission1,
            $imagePermission1,
        ]);
    }
}

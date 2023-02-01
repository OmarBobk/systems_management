<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $supervisor     = Role::create(['name' => 'supervisor']);
        $supervisor_per = [
            Permission::create(['guard_name' => 'web', 'name' => 'show_product',]),
            Permission::create(['guard_name' => 'web', 'name' => 'create_product',]),
            Permission::create(['guard_name' => 'web', 'name' => 'update_product',]),
            Permission::create(['guard_name' => 'web', 'name' => 'delete_product',]),
            Permission::create(['guard_name' => 'web', 'name' => 'show_category',]),
            Permission::create(['guard_name' => 'web', 'name' => 'create_category',]),
            Permission::create(['guard_name' => 'web', 'name' => 'update_category',]),
            Permission::create(['guard_name' => 'web', 'name' => 'delete_category',]),
            Permission::create(['guard_name' => 'web', 'name' => 'show_brand',]),
            Permission::create(['guard_name' => 'web', 'name' => 'create_brand',]),
            Permission::create(['guard_name' => 'web', 'name' => 'update_brand',]),
            Permission::create(['guard_name' => 'web', 'name' => 'delete_brand',]),
            Permission::create(['guard_name' => 'web', 'name' => 'show_seller',]),
            Permission::create(['guard_name' => 'web', 'name' => 'create_seller',]),
            Permission::create(['guard_name' => 'web', 'name' => 'update_seller',]),
            Permission::create(['guard_name' => 'web', 'name' => 'delete_seller',]),
        ];
        $supervisor->syncPermissions($supervisor_per);

        $user       = Role::create(['name' => 'user']);
        $user_per = [
            Permission::create(['guard_name' => 'web', 'name' => 'email_active',]),
        ];
        $user->syncPermissions($user_per);


        $superadmin     = Role::create(['name' => 'superadmin']);
        // TODO Give all permissions to superadmin Role
        $superadmin_per = [
            Permission::create(['guard_name' => 'web', 'name' => 'show_user',]),
            Permission::create(['guard_name' => 'web', 'name' => 'create_user',]),
            Permission::create(['guard_name' => 'web', 'name' => 'update_user',]),
            Permission::create(['guard_name' => 'web', 'name' => 'delete_user',]),
            Permission::create(['guard_name' => 'web', 'name' => 'show_role',]),
            Permission::create(['guard_name' => 'web', 'name' => 'create_role',]),
            Permission::create(['guard_name' => 'web', 'name' => 'update_role',]),
            Permission::create(['guard_name' => 'web', 'name' => 'delete_role',]),
            Permission::create(['guard_name' => 'web', 'name' => 'show_permission',]),
            Permission::create(['guard_name' => 'web', 'name' => 'create_permission',]),
            Permission::create(['guard_name' => 'web', 'name' => 'update_permission',]),
            Permission::create(['guard_name' => 'web', 'name' => 'delete_permission',]),
        ];

        $superadmin->syncPermissions(Permission::all());

    }
}

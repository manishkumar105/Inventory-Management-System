<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;


class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Clear cache for changes take effect
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        // 2. Create permissions 
        $createInventory = Permission::firstOrCreate(['name' => 'create inventory', 'guard_name' => 'web']);
        $editInventory   = Permission::firstOrCreate(['name' => 'edit inventory', 'guard_name' => 'web']);
        $deleteInventory = Permission::firstOrCreate(['name' => 'delete inventory', 'guard_name' => 'web']);
        $viewInventory   = Permission::firstOrCreate(['name' => 'view inventory', 'guard_name' => 'web']);

        // 3. Create roles
        $admin          = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $inventoryStaff = Role::firstOrCreate(['name' => 'inventorystaff', 'guard_name' => 'web']);
        // Create a role for any viewers 
        $viewerRole = Role::firstOrCreate(['name' => 'inventory_viewer', 'guard_name' => 'web']);

        // Assign only view permission to the role
        $viewerRole->syncPermissions([$viewInventory]);

        // 4. Assign permissions
        $admin->syncPermissions(Permission::all()); // admin gets all permissions

        $inventoryStaff->syncPermissions([
            $createInventory,
            $editInventory,
            // $deleteInventory, //staff can't delete
            $viewInventory
        ]); // inventory staff gets only inventory CRUD

        // 5. Created default users and assign roles
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@manish.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('1234567890')
            ]
        );
        $adminUser->assignRole($admin);

        $inventoryUser = User::firstOrCreate(
            ['email' => 'staff@manish.com'],
            [
                'name' => 'Inventory Staff',
                'password' => Hash::make('1234567890')
            ]
        );
        $inventoryUser->assignRole($inventoryStaff);

        $this->command->info('Default Admin and Inventory Staff created with roles & permissions.');
    }
}

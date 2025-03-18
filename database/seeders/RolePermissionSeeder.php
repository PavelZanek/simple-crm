<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

/**
 * Seeder to assign permissions to roles.
 */
class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // SUPER ADMIN: assign all permissions
        $superAdmin = Role::query()->where('name', Role::SUPER_ADMIN)->firstOrFail();
        $allPermissions = Permission::query()->get();
        $superAdmin->syncPermissions($allPermissions);

        // ADMIN: assign all permissions except those related to force delete and restore actions
        $admin = Role::query()->where('name', Role::ADMIN)->firstOrFail();
        $adminPermissions = Permission::query()
            ->where('name', 'not like', 'force_delete_%')
            ->where('name', 'not like', 'force_delete_any_%')
            ->where('name', 'not like', 'restore_%')
            ->where('name', 'not like', 'restore_any_%')
            ->get();
        $admin->syncPermissions($adminPermissions);

        // AUTHENTICATED: assign only employee-related permissions (without force delete and restore)
        $authenticated = Role::query()->where('name', Role::AUTHENTICATED)->firstOrFail();
        $employeePermissions = Permission::query()->whereIn('name', [
            'view_any_employee',
            'view_employee',
            'create_employee',
            'update_employee',
            'delete_employee',
            'delete_any_employee',
            'replicate_employee',
            'reorder_employee',
        ])->get();
        $authenticated->syncPermissions($employeePermissions);
    }
}

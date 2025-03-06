<?php

namespace Database\Seeders;

use App\Enums\RolesEnum;
use App\Enums\PermissionsEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        Permission::create(['name' => PermissionsEnum::MANAGE_USERS->value]);
        Permission::create(['name' => PermissionsEnum::DELETE_CLIENTS->value]);
        Permission::create(['name' => PermissionsEnum::DELETE_PROJECTS->value]);
        Permission::create(['name' => PermissionsEnum::DELETE_TASKS->value]);

        $role = Role::findByName(RolesEnum::ADMIN->value);
        $role->givePermissionTo([
            PermissionsEnum::MANAGE_USERS,
            PermissionsEnum::DELETE_CLIENTS,
            PermissionsEnum::DELETE_PROJECTS,
            PermissionsEnum::DELETE_TASKS,
        ]);
    }
}

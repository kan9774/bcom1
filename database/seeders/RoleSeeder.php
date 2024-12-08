<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $Role = Role::create(['name' => 'Admin']);
        $Role1 = Role::create(['name' => 'Escribiente']);

        Permission::create(['name' => 'admin.home'])->syncRoles($Role);
        Permission::create(['name' => 'admin.users.index'])->syncRoles($Role);
        Permission::create(['name' => 'admin.users.edit'])->syncRoles($Role);
        Permission::create(['name' => 'admin.users.create'])->syncRoles($Role);
        Permission::create(['name' => 'admin.users.destroy'])->syncRoles($Role);
    }
}

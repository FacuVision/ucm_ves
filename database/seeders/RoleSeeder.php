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

        $admin = Role::create(["name" => "admin"]);
        $docente = Role::create(["name" => "usuario"]);

        //POR TERMINAR LOS ROLES

        // $role = Role::create(['name' => 'writer']);
        // $permission = Permission::create(['name' => 'edit articles']);
    }
}
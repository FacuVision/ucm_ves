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
        $super_user = Role::create(["name" => "super_admin"]);
        $usuario = Role::create(["name" => "usuario"]);

        //POR TERMINAR LOS ROLES

        // $role = Role::create(['name' => 'writer']);
        // $permission = Permission::create(['name' => 'edit articles']);

        //menu administrador inicial
        Permission::create(["name"=>"admin.home"])->syncRoles([$admin,$super_user,$usuario]);

        //PERMISOS DE LOS USUARIOS
        Permission::create(["name"=>"admin.users.index"])->syncRoles([$admin,$super_user,$usuario]);
        Permission::create(["name"=>"admin.users.create"])->syncRoles([$admin,$super_user,$usuario]);
        Permission::create(["name"=>"admin.users.edit"])->syncRoles([$admin,$super_user,$usuario]);
        Permission::create(["name"=>"admin.users.show"])->syncRoles([$admin,$super_user,$usuario]);
        Permission::create(["name"=>"admin.users.destroy"])->syncRoles([$admin,$super_user]);

        //PERMISOS DE LOS VEHICULOS

        Permission::create(["name"=>"admin.cars.index"]);
        Permission::create(["name"=>"admin.cars.create"]);
        Permission::create(["name"=>"admin.cars.edit"]);
        Permission::create(["name"=>"admin.cars.show"]);
        Permission::create(["name"=>"admin.cars.destroy"]);


        //PERMISOS DE LOS PRODUCTOS
        Permission::create(["name"=>"admin.supplies.index"]);
        Permission::create(["name"=>"admin.supplies.create"]);
        Permission::create(["name"=>"admin.supplies.edit"]);
        Permission::create(["name"=>"admin.supplies.show"]);
        Permission::create(["name"=>"admin.supplies.destroy"]);

        //PERMISOS DE LOS MOVIMIENTOS
        Permission::create(["name"=>"admin.motions.index"]);
        Permission::create(["name"=>"admin.motions.create"]);
        Permission::create(["name"=>"admin.motions.edit"]);
        Permission::create(["name"=>"admin.motions.show"]);
        Permission::create(["name"=>"admin.motions.destroy"]);
    }
}

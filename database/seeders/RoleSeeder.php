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
        Permission::create(["name"=>"admin.users.index"])->syncRoles([$admin,$super_user]);
        Permission::create(["name"=>"admin.users.show"])->syncRoles([$admin,$super_user]);
        Permission::create(["name"=>"admin.users.create"])->syncRoles([$super_user]);
        Permission::create(["name"=>"admin.users.edit"])->syncRoles([$super_user]);
        Permission::create(["name"=>"admin.users.destroy"])->syncRoles([$super_user]);

        //PERMISOS DE LOS VEHICULOS

        Permission::create(["name"=>"admin.cars.index"])->syncRoles([$admin,$super_user,$usuario]);
        Permission::create(["name"=>"admin.cars.create"])->syncRoles([$admin,$super_user,$usuario]);
        Permission::create(["name"=>"admin.cars.edit"])->syncRoles([$admin,$super_user]);
        Permission::create(["name"=>"admin.cars.show"])->syncRoles([$admin,$super_user,$usuario]);
        Permission::create(["name"=>"admin.cars.destroy"])->syncRoles([$admin,$super_user]);


        //PERMISOS DE LOS PRODUCTOS
        Permission::create(["name"=>"admin.supplies.index"])->syncRoles([$admin,$super_user,$usuario]);
        Permission::create(["name"=>"admin.supplies.create"])->syncRoles([$admin,$super_user,$usuario]);
        Permission::create(["name"=>"admin.supplies.edit"])->syncRoles([$admin,$super_user,$usuario]);
        Permission::create(["name"=>"admin.supplies.show"])->syncRoles([$admin,$super_user,$usuario]);
        Permission::create(["name"=>"admin.supplies.destroy"])->syncRoles([$admin,$super_user]);

        //PERMISOS DE LOS MOVIMIENTOS
        Permission::create(["name"=>"admin.motions.index"])->syncRoles([$admin,$super_user,$usuario]);
        Permission::create(["name"=>"admin.motions.create"])->syncRoles([$admin,$super_user,$usuario]);
        Permission::create(["name"=>"admin.motions.show"])->syncRoles([$admin,$super_user,$usuario]);
        Permission::create(["name"=>"admin.motions.destroy"])->syncRoles([$admin,$super_user,$usuario]);

        //PERMISOS DE LOS HISTORIALES DE PRODUCTOS
        Permission::create(["name"=>"admin.histories.index"])->syncRoles([$admin,$super_user,$usuario]);
        Permission::create(["name"=>"admin.histories.show"])->syncRoles([$admin,$super_user,$usuario]);


    }

    //notas
    //admin.motions.destroy = ver detalles del vehículo desde el menu de historial
}
    //admin.histories.show = ver detalles de los datos antiguos y nuevos del producto
    //seleccionado

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $super_admin = User::create([
            "name" => "Munives",
            "email" => "desarrolloudt@munives.gob.pe",
            "password" => bcrypt("desarrolloudt@munives.gob.pe")
        ]);

        $super_admin->profile()->create(
            [
                "name" => "Munives",
                "lastname" => "2023",
                "dni" => "20232023",
                "phone" => "999888777",
                "address" => "Villa el Salvador"
            ]
        );

        $super_admin->assignRole('super_admin');


        ////////////////




        $admin = User::create([
            "name" => "admin",
            "email" => "admin@munives.gob.pe",
            "password" => bcrypt("admin")
        ]);

        $admin->profile()->create(
            [
                "name" => "admin",
                "lastname" => "admin",
                "dni" => "85236974",
                "phone" => "963258789",
                "address" => "Villa el Salvador"
            ]
        );

        $admin->assignRole('admin');




        ///////////////


        $user = User::create([
            "name" => "user",
            "email" => "user@munives.gob.pe",
            "password" => bcrypt("user")
        ]);

        $user->profile()->create(
            [
                "name" => "user",
                "lastname" => "user",
                "dni" => "85697412",
                "phone" => "963258785",
                "address" => "Villa el Salvador"
            ]
        );

        $user->assignRole('usuario');


    }
}

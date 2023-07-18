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
        $admin = User::create([
            "name" => "emmanuel",
            "email" => "emmanuel@gmail.com",
            "password" => bcrypt("emmanuel@gmail.com")
        ]);

        $admin->profile()->create(
            [
                "name" => "Emmanuel",
                "lastname" => "Garayar",
                "dni" => "74741985",
                "phone" => "987372725",
                "address" => "ves"
            ]
        );

    }
}

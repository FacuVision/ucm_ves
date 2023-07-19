<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Car;


class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $car = Car::create([
            "type" => "bus",
            "plate" => "506-584",
            "mileage" => "4500",
            "brand" => "toyota",
            "color" => "rojo",
            "model" => "chico"
        ]);

        $car = Car::create([
            "type" => "moto",
            "plate" => "005-584",
            "mileage" => "500",
            "brand" => "XXX",
            "color" => "amarillo",
            "model" => "grande"
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Motion;


class MotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Motion::create([
            "user_id" => 1,
            "car_id" => 1,
            "title" => "primer movimiento",
            "detail" => "detalle 1"
        ]);
    }
}


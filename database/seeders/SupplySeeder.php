<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supply;

class SupplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

            $supply = Supply::create([
                "code" => "abcdef",
                "name" => "aerosol",
                "detail" => "aea",
                "cant" => "50",
                "line" => "parte",
                "brand" => "marca001",
                "unit" => "globales"
            ]);
            $supply = Supply::create([
                "code" => "abcd5646f",
                "name" => "aceite",
                "detail" => "sdsdasdas",
                "cant" => "100",
                "line" => "suministro",
                "brand" => "vvv",
                "unit" => "litros"
            ]);


    }
}

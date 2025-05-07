<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = json_decode(file_get_contents(storage_path('app/private/lithuanian_cities.json')), true);
        foreach ($cities as $city)
            City::create(['name' => $city]);
    }
}

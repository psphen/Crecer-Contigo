<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            [
                'name' => 'Colombia',
                'numeric_code'=>'+57',
                'is_active'=>true
            ]
        ];
        foreach ($countries as $countryData) {
            $country = new Country();
            $country->name = $countryData['name'];
            $country->numeric_code = $countryData['numeric_code'];
            $country->is_active = $countryData['is_active'];
            $country->save();
        }
    }
}

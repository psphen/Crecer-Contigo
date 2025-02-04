<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(
            [
                CountrySeeder::class,
                StateSeeder::class,
                LanguageSeeder::class,
                MonthSeeder::class,
                RoleSeeder::class,
                UserSeeder::class,
                WeekDaySeeder::class,
                SettingSeeder::class
            ]
        );
    }
}

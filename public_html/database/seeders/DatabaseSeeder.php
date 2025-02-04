<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
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

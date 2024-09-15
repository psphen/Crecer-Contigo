<?php

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
                 CurrencySeeder::class,
                 LanguageSeeder::class,
                 MonthSeeder::class,
                 CitySeeder::class,
                 RoleSeeder::class,
                 UserSeeder::class,
                 WeekDaySeeder::class,
                 SettingSeeder::class
             ]
            );
    }
}

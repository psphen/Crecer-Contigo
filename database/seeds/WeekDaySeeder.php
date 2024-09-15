<?php

use Illuminate\Database\Seeder;
use App\Models\WeekDay;
class WeekDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = [
            [
                'name'=>'Monday'
            ],
            [
                'name'=>'Tuesday'
            ],
            [
                'name'=>'Wednesday'
            ],
            [
                'name'=>'Thursday'
            ],
            [
                'name'=>'Friday'
            ],
            [
                'name'=>'Saturday'
            ],
            [
                'name'=>'Sunday'
            ]
        ];
        foreach ($days as $dayData) {
            $day = new WeekDay();
            $day->name = $dayData['name'];
            $day->save();
        }
    }
}

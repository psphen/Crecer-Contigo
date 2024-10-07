<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Month;
class MonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mounths = [
           [
               'name'=>'January'
           ],
            [
                'name'=>'February'
            ],
            [
                'name'=>'March'
            ],
            [
                'name'=>'April'
            ],
            [
                'name'=>'May'
            ],
            [
                'name'=>'June'
            ],
            [
                'name'=>'July'
            ],
            [
                'name'=>'August'
            ],
            [
                'name'=>'September'
            ],
            [
                'name'=>'October'
            ],
            [
                'name'=>'November'
            ],
            [
                'name'=>'December'
            ]
        ];
        foreach ($mounths as $mounthData) {
            $mounth = new Month();
            $mounth->name = $mounthData['name'];
            $mounth->save();
        }
    }
}

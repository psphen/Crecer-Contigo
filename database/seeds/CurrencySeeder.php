<?php

use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = [
            [
                'name'=>'Peso Colombiano',
                'code'=>'COD',
                'is_active'=>true
            ],
            [
                'name'=>'Dolar',
                'code'=>'USD',
                'is_active'=>true
            ]
        ];
        foreach ($currencies as $currencyData) {
            $currency = new Currency();
            $currency->name = $currencyData['name'];
            $currency->code = $currencyData['code'];
            $currency->is_active = $currencyData['is_active'];
            $currency->save();
        }
    }
}

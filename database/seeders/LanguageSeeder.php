<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = [
            [
                'name'=>'Ingles',
                'code'=>'EN',
                'is_active'=>true
            ],
            [
                'name'=>'Español',
                'code'=>'ES',
                'is_active'=>true
            ]
        ];
        foreach ($languages as $languageData) {
            $language = new Language();
            $language->name = $languageData['name'];
            $language->code = $languageData['code'];
            $language->is_active = $languageData['is_active'];
            $language->save();
        }
    }
}

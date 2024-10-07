<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\State;
class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            [
                'name' => 'Amazonas',
                'country_id' => 1,
                'is_active' => false
            ],
            [
                'name' => 'Antioquia',
                'country_id' => 1,
                'is_active' => false
            ],
            [
                'name' => 'Arauca',
                'country_id' => 1,
                'is_active' => false
            ],
            [
                'name' => 'Atlántico',
                'country_id' => 1,
                'is_active' => false
            ],
            [
                'name' => 'Bogotá',
                'country_id' => 1,
                'is_active' => false
            ],
            [
                'name' => 'Bolívar',
                'country_id' => 1,
                'is_active' => false
            ],
            [
                'name' => 'Boyacá',
                'country_id' => 1,
                'is_active' => false
            ],
            [
                'name' => 'Caldas',
                'country_id' => 1,
                'is_active' => false
            ],
            [
                'name' => 'Caquetá',
                'country_id' => 1,
                'is_active' => false
            ],
            [
                'name' => 'Casanare',
                'country_id' => 1,
                'is_active' => false
            ],
            [
                'name' => 'Cauca',
                'country_id' => 1,
                'is_active' => false
            ],
            [
                'name' => 'Cesar',
                'country_id' => 1,
                'is_active' => false
            ],
            [
                'name' => 'Chocó',
                'country_id' => 1,
                'is_active' => false
            ],
            [
                'name' => 'Córdoba',
                'country_id' => 1,
                'is_active' => false
            ],
            [
                'name' => 'Cundinamarca',
                'country_id' => 1,
                'is_active' => false
            ],
            [
                'name' => 'Guainía',
                'country_id' => 1,
                'is_active' => false
            ],
            [
                'name' => 'Guaviare',
                'country_id' => 1,
                'is_active' => false
            ],
            [
                'name' => 'Huila',
                'country_id' => 1,
                'is_active' => false
            ],
            [
                'name' => 'La Guajira',
                'country_id' => 1,
                'is_active' => false
            ],
            [
                'name' => 'Magdalena',
                'country_id' => 1,
                'is_active' => false
            ],
            [
                'name' => 'Meta',
                'country_id' => 1,
                'is_active' => true
            ],
            [
                'name' => 'Nariño',
                'country_id' => 1,
                'is_active' => false
            ],
            [
                'name' => 'Norte de Santander',
                'country_id' => 1,
                'is_active' => false
            ],
            [
                'name' => 'Putumayo',
                'country_id' => 1,
                'is_active' => false
            ],
            [
                'name' => 'Quindío',
                'country_id' => 1,
                'is_active' => false
            ],
            [
                'name' => 'Risaralda',
                'country_id' => 1,
                'is_active' => false
            ],
            [
                'name' => 'San Andrés y Providencia',
                'country_id' => 1,
                'is_active' => false
            ],
            [
                'name' => 'Santander',
                'country_id' => 1,
                'is_active' => false
            ],
            [
                'name' => 'Sucre',
                'country_id' => 1,
                'is_active' => false
            ],
            [
                'name' => 'Tolima',
                'country_id' => 1,
                'is_active' => false
            ],
            [
                'name' => 'Valle del Cauca',
                'country_id' => 1,
                'is_active' => false
            ],
            [
                'name' => 'Vaupés',
                'country_id' => 1,
                'is_active' => false
            ],
            [
                'name' => 'Vichada',
                'country_id' => 1,
                'is_active' => false
            ]
        ];
        foreach ($states as $stateData) {
            $state = new State();
            $state->name = $stateData['name'];
            $state->country_id = $stateData['country_id'];
            $state->is_active = $stateData['is_active'];
            $state->save();
        }
    }
}

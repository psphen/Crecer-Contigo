<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Admin',
//            'slug'=>\Illuminate\Support\Str::slug('name'),
            'email'=>'adminlicontigo@gmail.com',
            'password'=>bcrypt('AdCrecer23*')
        ])->assignRole('SuperAdmin');
    }
}

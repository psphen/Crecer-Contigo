<?php

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
            'email'=>'superadmin@agro.com',
            'password'=>bcrypt('123456789')
        ])->assignRole('SuperAdmin');
        User::create([
            'name'=>'Vendor',
//            'slug'=>\Illuminate\Support\Str::slug('name'),
            'email'=>'vendor@agro.com',
            'password'=>bcrypt('123456789')
        ])->assignRole('Vendor');
    }
}

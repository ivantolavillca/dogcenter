<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            'name'  => 'IVAN TOLA',
            'email' => 'navi@upea.bo',
            'password' => bcrypt('12345678')
        ])->assignRole('Admin');
        User::create([
            'name'  => 'HERNAN',



            'email' => 'emolqui@upea.bo',
            'password' => bcrypt('12345678')
        ])->assignRole('Admin');
        User::create([
            'name'  => 'JHESENIA PEREZ',



            'email' => 'perezjhesenia6@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Admin');
    }
}

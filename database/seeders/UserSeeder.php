<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'is_active' => 1,
                'password' => Hash::make('admin123'),
            ],
            [
                'name' => 'Member',
                'email' => 'member@gmail.com',
                'role' => 'member',
                'is_active' => 1,
                'password' => Hash::make('member123'),
            ],
            [
                'name' => 'Guest',
                'email' => 'guest@gmail.com',
                'role' => 'guest',
                'is_active' => 0,
                'password' => Hash::make('guest123'),
            ],

        ];

        foreach ($users as $user) {
            User::create($user);
        }

        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 40; $i++) {

            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'role' => 'member',
                'phone' => $faker->phoneNumber,
                'is_active' => 1,
                'password' => Hash::make('member123'),
            ]);
        }
    }
}

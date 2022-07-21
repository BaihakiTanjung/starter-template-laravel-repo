<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Referral;
use Faker\Factory as Faker;

class ReferralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 20; $i++) {

            // insert data ke table pegawai menggunakan Faker
            Referral::create([
                'sending_user_id' => $faker->numberBetween(1, 20),
                'new_user_id' => $faker->numberBetween(21, 40)
            ]);
        }
    }
}

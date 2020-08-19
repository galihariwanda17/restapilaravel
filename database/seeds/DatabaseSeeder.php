<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $faker = Faker\Factory::create(); // import library faker
        $limit = 20; // batas banyak data yang akan dimasukkan

        for($i=0; $i<$limit; $i++){
            DB::table('kontak')->insert([
                'nama' => $faker->name,
                'email' => $faker->unique()->email,
                'nohp' => $faker->phoneNumber,
                'alamat' => $faker->address,
            ]);
        }
    }
}

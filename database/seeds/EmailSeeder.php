<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Email : inbox
        $faker = Faker::create('en_US');
        foreach (range(1,50) as $index) {
            DB::table('emails')->insert([
                'sender' => 0,
                'name' => $faker->name,
                'to' => $faker->email,
                'from' => $faker->email,
                'subject' => $faker->realText(100),
                'message' =>$faker->realText(500),
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ]);
        }

        //Email: sent
        foreach (range(1,50) as $index) {
            DB::table('emails')->insert([
                'sender' => 1,
                'name' => $faker->name,
                'to' => $faker->email,
                'from' => $faker->email,
                'subject' => $faker->realText(100),
                'message' =>$faker->realText(500),
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ]);
        }

        //Email: Draft
        foreach (range(1,50) as $index) {
            DB::table('emails')->insert([
                'sender' => null,
                'name' => $faker->name,
                'to' => $faker->email,
                'from' => $faker->email,
                'subject' => $faker->realText(100),
                'message' =>$faker->realText(500),
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ]);
        }
    }
}

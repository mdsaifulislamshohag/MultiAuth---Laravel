<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker; 

class ToDoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('en_US');
        foreach (range(1,5) as $index) {
            DB::table('to_dos')->insert([
                'task' => $faker->realText(100),
                'status' => '1',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ]);
        }
        foreach (range(1,5) as $index) {
            DB::table('to_dos')->insert([
                'task' => $faker->realText(100),
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ]);
        }
    }
}

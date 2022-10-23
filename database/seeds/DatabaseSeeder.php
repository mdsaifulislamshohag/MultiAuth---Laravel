<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('apps')->insert([
            'name' => 'Laravel',
            'moto' => 'We Dream The Future',
            'category' => 'E-commerce',
            'image' => 'logo.png',
            'location' => 'Location of website',
            'details' =>'Details of website',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);
    
    }
}

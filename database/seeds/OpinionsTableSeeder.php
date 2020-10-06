<?php

use Illuminate\Database\Seeder;

class OpinionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('pl_PL');
        
        for($i=1;$i<=200;$i++)
        {
            DB::table('opinions')->insert([
            'content' => $faker->text(500),
            'rating' =>  $faker->numberBetween(1, 5), 
            'user_id' => $faker->numberBetween(1, 10),
            'opinionable_type' => 'App\Book',   
            'book_id' => $faker->numberBetween(1, 50),   
        ]);
        }
    }
}

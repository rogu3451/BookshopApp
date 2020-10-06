<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('pl_PL');
        
        for($i=1;$i<=50;$i++)
        {
            DB::table('orders')->insert([
            'user_id' => $faker->numberBetween(1, 10),
            'books' => $faker->unique()->word,
            'total_price' => $faker->numberBetween(10, 500),
			'status' => $faker->randomElement(['opłacone','nieopłacone']),
        ]);
        }
    }
}

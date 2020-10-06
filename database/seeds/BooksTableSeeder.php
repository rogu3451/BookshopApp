<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
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
            DB::table('books')->insert([
            'title' => $faker->unique()->word,
            'author' => $faker->lastName,
            'year' => $faker->numberBetween(1950, 2019),
            'price' => $faker->numberBetween(10, 200),
            'description' => $faker->text(1000),
			'category' => $faker->randomElement(['promocja','bestseller','lektura','informatyka','historia','fantastyka']),
        ]);
        }
    }
}

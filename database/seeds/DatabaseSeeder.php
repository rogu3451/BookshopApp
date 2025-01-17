<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        $this->call(OpinionsTableSeeder::class);
		$this->call(LikeablesTableSeeder::class);
		$this->call(OrdersTableSeeder::class);
		$this->call(PhotosTableSeeder::class);
		$this->call(RolesTableSeeder::class);
		$this->call(RoleUserTableSeeder::class);
        
    }
}

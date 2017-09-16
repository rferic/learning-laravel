<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		factory(\App\User::class, 10)->create();
		factory(\App\Author::class, 10)->create();
		factory(\App\Library::class, 10)->create()->each(function ($library)
		{
			factory(\App\Book::class, 2)->make()->each(function($book) use($library)
			{
				$library->books()->save($book);
			});
		});
	}
}

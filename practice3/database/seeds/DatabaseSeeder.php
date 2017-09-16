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
        //TODO Seeder create X Users
        factory(\App\User::class, 10)->create();
        //TODO Seeder create X Authors
        factory(\App\Author::class, 10)->create();
        //TODO Seeder create X Libraries and looping Libraries
        factory(\App\Library::class, 10)->create()->each(function($library){
            //TODO Seeder create X Books and looping Books
            factory(\App\Book::class, 10)->make()->each(function($book) use($library){
                //TODO Seeder asign Books to Libraries (relationship)
                $library->books()->save($book);
            });
        });
    }
}

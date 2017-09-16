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
        factory(\App\User::class, 10)->create()->each(function($user){
            //TODO Seeder create X Users and looping Users
            factory(\App\Project::class, 10)->make()->each(function($project) use($user){
                //TODO Seeder asign Project to Users (relationship)
                $user->projects()->save($project);
            });
        });
    }
}

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
		//EXEC 'php artisan db:seed
		//CALL SEEDER FOR INSERT ROLES IN DB
        $this->call(RolesTableSeeder::class);
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; //CLASS GESTION DATES

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		//AUTO INSERT ROLES IN DB
        DB::table('roles')->insert(Array(
			Array(
				'name' => 'admin',
				//Carbon::now() = datetime NOW
				'created_at' => Carbon::now()->format('Y-m-d H:i:s')
			),
			Array(
				'name' => 'registered',
				//Carbon::now() = datetime NOW
				'created_at' => Carbon::now()->format('Y-m-d H:i:s')
			),
		));
    }
}

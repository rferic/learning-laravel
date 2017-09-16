<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('roles')->insert([
           [
               'name' => 'admin',
               'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
           ],
            [
                'name' => 'registered',
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}

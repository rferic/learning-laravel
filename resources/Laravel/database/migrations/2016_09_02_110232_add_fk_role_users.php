<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkRoleUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table)
        {
            $table->integer('role_id')->unsigned()->default(2);
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table)
        {
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
            DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        });
    }
}

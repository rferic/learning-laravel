<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddFkUsersRoleId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('users', function(Blueprint $table){
			//ADD COLUMN ROLE_ID ON USERS
			$table->integer('role_id')->unsigned()->default(2);
			//ASIGN FOREIGNKEY USERS.ROLE_ID => ROLES.ID
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
		Schema::table('users', function(Blueprint $table){
			//DISABLE ALL FOREIGN KEYS (TEMPORAL)
			DB::statement('SET FOREIGN_KEY_CHECKS = 0');
			//REMOVE FOREIGNKEY USERS.ROLE_ID
			$table->dropForeign(['role_id']);
			//REMOVE COLUMN USERS.ROLE_ID
			$table->dropColumn('role_id');
			//BACK TO ENABLE ALL FOREIGN KEYS (USERS.ROLE_ID NOT EXIST - HAS BEEN REMOVED -
			DB::statement('SET FOREIGN_KEY_CHECKS = 1');
		});
    }
}

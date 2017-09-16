<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePizzasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pizzas', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->string('name');
			$table->string('description');
			$table->float('price', 10, 2);			
            $table->timestamps();
			//ADD FOREIGNKEY PIZZAS.USER_ID => USERS.ID
			$table->foreign('user_id')->references('id')->on('users');
			//LOGIC REMOVE (TIMESTAMP IDENTIFICATE IF THIS ROW HAS BEEN REMOVED)
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pizzas');
    }
}

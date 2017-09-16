<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
USE \Illuminate\Support\Facades\DB;

class CreatePizzaIngredientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredient_pizza', function (Blueprint $table) {
            $table->integer('pizza_id')->unsigned();
            $table->foreign('pizza_id')->references('id')->on('pizzas');
            $table->integer('ingredient_id')->unsigned();
            $table->foreign('ingredient_id')->references('id')->on('ingredients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists("ingredient_pizza");
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

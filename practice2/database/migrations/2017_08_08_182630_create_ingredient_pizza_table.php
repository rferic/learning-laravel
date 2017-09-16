<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateIngredientPizzaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredient_pizza', function (Blueprint $table) {
			//ARTISAN FOR ORM WORK HOW A PIVOT TABLE (ingredient_pizza SINGULAR!)
			//php artisan make:migration create_ingrediend_pizza --create=ingredient_pizza
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
        Schema::dropIfExists('ingredient_pizza');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('books', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('isbn');
			$table->text('summary');

			$table->integer('author_id')->unsigned();
			$table->foreign('author_id')->references('id')->on('authors');

			$table->integer('created_by')->unsigned();
			$table->foreign('created_by')->references('id')->on('users');

			$table->integer('updated_by')->nullable()->unsigned();
			$table->foreign('updated_by')->references('id')->on('users');

			$table->integer('deleted_by')->nullable()->unsigned();
			$table->foreign('deleted_by')->references('id')->on('users');

			$table->timestamps();
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
		Schema::drop('books');
	}
}

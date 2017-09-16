<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookLibraryTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('book_library', function (Blueprint $table)
		{
			$table->integer('book_id')->unsigned();
			$table->foreign('book_id')->references('id')->on('books');

			$table->integer('library_id')->unsigned();
			$table->foreign('library_id')->references('id')->on('libraries');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('book_library');
	}
}

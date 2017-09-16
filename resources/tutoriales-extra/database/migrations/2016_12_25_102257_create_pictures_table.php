<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicturesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pictures', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('album_id')->unsigned();
			$table->foreign('album_id')->references('id')->on('albums');

			$table->string('filename')->comment("Nombre de la imagen");
			$table->string('file_section')->comment("Zona desde donde se ha subido la imagen, E.J(Plupload 1, Plupload 2)");
			$table->string('extension');
			$table->string('mime_type');
			$table->string('file_id');
			$table->string('original_name');
			$table->string('file_size');
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
		Schema::drop('pictures');
	}
}

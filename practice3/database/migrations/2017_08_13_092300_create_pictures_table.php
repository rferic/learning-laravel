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
        Schema::create('pictures', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('album_id')->unsigned();
            $table->foreign('album_id')->references('id')->on('albums');
            //comment() => include a comment on column table DB
            $table->string('filename')->comment('Image name');
            $table->string('file_section')->comment('Zone where image has been uploaded');
            $table->string('extension');
            $table->string('mime_type');
            $table->string('file_id');
            $table->string('original_name');
            $table->string('file_size');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pictures');
    }
}

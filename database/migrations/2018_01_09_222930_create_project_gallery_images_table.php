<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectGalleryImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_gallery_images', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('project_gallery_id');
            $table->string('color', 7); // HEX Color, including the #

            $table->foreign('project_gallery_id')->references('id')->on('project_galleries')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('image');
            $table->string('width');
            $table->string('height');
            $table->string('background_size');
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
        Schema::dropIfExists('project_gallery_images');
    }
}

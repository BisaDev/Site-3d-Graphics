<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateProjectsTable
 */
class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');

            /*
             * Hero information
             */
            $table->string('name', 50);
            $table->string('description', 50);
            $table->string('preloader', 50);
            $table->string('hero_image');
            $table->string('hero_image_preview');
            $table->string('hero_color', 7); // HEX Color, including the #

            /*
             * Main description
             */
            //$table->string('info_title', 140);
            $table->string('info_subtitle', 140);
            $table->string('info_description', 300);
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->on('countries')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            /*
             * Client information
             */
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->boolean('is_featured')->default(false);
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
        Schema::dropIfExists('projects');
    }
}

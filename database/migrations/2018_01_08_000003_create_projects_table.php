<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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

            /*
             * Main description
             */
            $table->string('info_title', 140);
            $table->string('info_description', 300);
            $table->string('info_year', 11);
            $table->string('info_country', 3);

            /*
             * Client information
             */
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients')
                ->onDelete('restrict')
                ->onUpdate('cascade');

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

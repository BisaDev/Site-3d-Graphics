<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTextInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_text_informations', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('title', 255);
            $table->text('body');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_text_informations');
    }
}

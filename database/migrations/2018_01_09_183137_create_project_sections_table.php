<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_sections', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            // FQCN for the model and ID of the record in the table.
            $table->string('model_class');
            $table->string('model_id');

            $table->string('color', 7)->nullable();
            $table->boolean('is_dark')->default(false);
            $table->string('background_image')->nullable();
            $table->boolean('is_parallax')->default(false);
            $table->integer('order')->default(0);

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
        Schema::dropIfExists('project_sections');
    }
}

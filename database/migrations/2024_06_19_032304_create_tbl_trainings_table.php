<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_trainings', function (Blueprint $table) {
            $table->id();
            $table->string('opencohort', 100)->nullable();
            $table->integer('opencohortno')->nullable();
            $table->string('training_title', 255)->nullable();
            $table->string('announcement_details', 500)->nullable();
            $table->integer('training_provider')->nullable();
            $table->date('training_date')->nullable();
            $table->time('training_time')->nullable();
            $table->integer('duration')->nullable();
            $table->string('email', 255)->nullable();
            $table->integer('phone')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->integer('created_by')->nullable();
            $table->date('created_on')->nullable();
            $table->integer('updated_by')->nullable();
            $table->date('updated_on')->nullable();
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
        Schema::dropIfExists('tbl_trainings');
    }
}

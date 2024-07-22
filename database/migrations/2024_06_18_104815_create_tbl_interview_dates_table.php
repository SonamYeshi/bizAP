<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblInterviewDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_interview_dates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appID')->nullable();
            $table->unsignedBigInteger('trainingID')->nullable();
            $table->date('interview_date')->nullable();
            $table->time('interview_time')->nullable();
            $table->tinyInteger('sent')->default(0);
            $table->date('senton')->nullable();
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
        Schema::dropIfExists('tbl_interview_dates');
    }
}

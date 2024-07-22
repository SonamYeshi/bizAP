<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblInterviewStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_interview_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trainingID')->nullable();
            $table->unsignedBigInteger('appID')->nullable();
            $table->unsignedInteger('pannelID')->nullable();
            $table->decimal('score', 40, 2)->nullable();
            $table->string('remarks', 255)->default('');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('tbl_interview_statuses');
    }
}

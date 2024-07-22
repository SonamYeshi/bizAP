<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblMentoringTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_mentoring', function (Blueprint $table) {
            $table->id();
            $table->string('SupportType', 255)->default('');
            $table->date('StartDate')->nullable();
            $table->date('EndDate')->nullable();
            $table->string('Mentor', 255)->nullable();
            $table->integer('NoofPartipants')->nullable();
            $table->string('Objective', 500)->nullable();
            $table->string('Requirements', 500)->nullable();
            $table->string('TrainingFunding', 255)->default('');
            $table->string('EligibleCohorts', 500)->default('');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->date('created_on')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->date('updated_on')->nullable();
            $table->tinyInteger('sent')->default(0);
            $table->date('senton')->nullable();
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
        Schema::dropIfExists('tbl_mentoring');
    }
}

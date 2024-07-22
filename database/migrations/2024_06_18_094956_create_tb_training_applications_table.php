<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbTrainingApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_training_applications', function (Blueprint $table) {
            $table->increments('id'); // Creates an INT primary key column named 'id' with auto-increment
            $table->string('opencohort', 100)->nullable();
            $table->integer('opencohortno')->nullable();
            $table->integer('trainingid')->nullable();
            $table->bigInteger('cid')->nullable();
            $table->string('name', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->bigInteger('mobileno')->nullable();
            $table->date('dob')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->tinyInteger('qualification')->default(0);
            $table->string('businessanme_qualification', 255)->nullable();
            $table->tinyInteger('dzongkhag')->nullable();
            $table->tinyInteger('job_status')->nullable();
            $table->string('job_status_other', 500)->nullable();
            $table->tinyInteger('commit_hr')->nullable();
            $table->tinyInteger('commit_period')->nullable();
            $table->tinyInteger('laptop')->default(0);
            $table->string('challenge', 10000)->default('');
            $table->string('youtubelink', 1000)->default('');
            $table->string('rfname1', 255)->nullable();
            $table->string('rfposition1', 255)->nullable();
            $table->string('rforg1', 255)->nullable();
            $table->string('rfrelation1', 255)->nullable();
            $table->string('rfmobileno1', 255)->nullable();
            $table->string('rfemail1', 255)->nullable();
            $table->string('rfname2', 255)->nullable();
            $table->string('rfposition2', 255)->nullable();
            $table->string('rforg2', 255)->nullable();
            $table->string('rfrelation2', 255)->nullable();
            $table->string('rfmobileno2', 255)->nullable();
            $table->string('rfemail2', 255)->nullable();
            $table->string('awareness', 255)->nullable();
            $table->tinyInteger('agree')->default(0);
            $table->tinyInteger('screening_status')->nullable();
            $table->tinyInteger('shortlist_status')->nullable();
            $table->tinyInteger('interview_status')->nullable();
            $table->decimal('totalscore', 10, 2)->default(0.00);
            $table->date('created_on')->nullable();
            $table->date('updated_on')->nullable();
            $table->date('shortlist_on')->nullable();
            $table->decimal('sltotalscore', 10, 2)->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_training_applications');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblHardSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_hard_skills', function (Blueprint $table) {
            $table->id();
            $table->integer('appid')->nullable();
            $table->tinyInteger('GraphicDesign')->nullable();
            $table->tinyInteger('WebsiteDesgn')->nullable();
            $table->tinyInteger('Photoshop')->nullable();
            $table->tinyInteger('MobileDevelopment')->nullable();
            $table->tinyInteger('DataEntry')->nullable();
            $table->tinyInteger('DigitalMarketing')->nullable();
            $table->tinyInteger('WritingandTranslation')->nullable();
            $table->tinyInteger('VideoandAnimation')->nullable();
            $table->tinyInteger('MusicandAudio')->nullable();
            $table->tinyInteger('Finance')->nullable();
            $table->tinyInteger('HealthandFitness')->nullable();
            $table->tinyInteger('Others')->nullable();
            $table->string('oteherdetails', 1000)->default('');
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
        Schema::dropIfExists('tbl_hard_skills');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblSoftSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_soft_skills', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('appid')->nullable();
            $table->tinyInteger('Communication')->nullable();
            $table->tinyInteger('Negotiation')->nullable();
            $table->tinyInteger('TimeManagement')->nullable();
            $table->tinyInteger('ProblemSolvingSkills')->nullable();
            $table->tinyInteger('Punctuality')->nullable();
            $table->tinyInteger('TeamWorkSkills')->nullable();
            $table->tinyInteger('Flexibility')->nullable();
            $table->tinyInteger('Abilitytoacceptandlearnfromcriticism')->nullable();
            $table->tinyInteger('MarketingSkills')->nullable();
            $table->tinyInteger('Passiontolearn')->nullable();
            $table->tinyInteger('Persistency')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->unsignedInteger('created_by')->nullable();
            $table->date('created_on')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->date('updated_on')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_soft_skills');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblSitevisitSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_sitevisit_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('fundid')->nullable();
            $table->string('mode', 200)->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->string('agenda', 255)->nullable();
            $table->date('actualdate')->nullable();
            $table->time('actualtime')->nullable();
            $table->string('observations', 500)->nullable();
            $table->string('instructions', 500)->nullable();
            $table->string('siteVisitReport', 250)->nullable();
            $table->string('filename', 200)->nullable();
            $table->string('virtual_form', 500)->default('');
            $table->string('virtual_form_ent', 200)->nullable();
            $table->string('status', 250)->nullable();
            $table->unsignedInteger('created_by')->nullable();
            $table->date('created_on')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
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
        Schema::dropIfExists('tbl_sitevisit_schedules');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPresentationDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_presentation_dates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appID')->nullable();
            $table->unsignedBigInteger('FundID')->nullable();
            $table->date('ppt_date')->nullable();
            $table->time('ppt_time')->nullable();
            $table->tinyInteger('sent')->default(0);
            $table->date('senton')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->date('created_on')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('tbl_presentation_dates');
    }
}

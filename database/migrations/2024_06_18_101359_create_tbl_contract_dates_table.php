<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblContractDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_contract_dates', function (Blueprint $table) {
            $table->id();
            $table->integer('appID')->nullable();
            $table->integer('FundID')->nullable();
            $table->bigInteger('cid')->nullable();
            $table->date('sign_date')->nullable();
            $table->time('sign_time')->nullable();
            $table->string('venue', 255)->nullable();
            $table->string('instructions', 500)->nullable();
            $table->date('effective_date')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->tinyInteger('sent')->default(0);
            $table->date('senton')->nullable();
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
        Schema::dropIfExists('tbl_contract_dates');
    }
}

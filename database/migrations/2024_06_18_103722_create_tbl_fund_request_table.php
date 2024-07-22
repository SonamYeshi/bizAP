<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblFundRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_fund_request', function (Blueprint $table) {
            $table->id();
            $table->integer('fundid')->nullable();
            $table->string('tranche', 255)->nullable();
            $table->string('usage', 500)->nullable();
            $table->string('proof', 255)->nullable();
            $table->string('paid_to', 255)->nullable();
            $table->integer('created_by')->nullable();
            $table->date('created_on')->nullable();
            $table->integer('updated_by')->nullable();
            $table->date('updated_on')->nullable();
            $table->tinyInteger('review')->default(0);
            $table->tinyInteger('approve_ach')->default(0);
            $table->tinyInteger('approve_asd')->default(0);
            $table->tinyInteger('disbursement')->default(0);
            $table->date('disbursement_date')->nullable();
            $table->integer('disbursement_by')->nullable();
            $table->tinyInteger('bank_review')->default(0);
            $table->date('approval_date')->nullable();
            $table->tinyInteger('approve_dir')->default(0);
            $table->integer('trancheno')->nullable();
            $table->string('receipt', 255)->nullable();
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
        Schema::dropIfExists('tbl_fund_request');
    }
}

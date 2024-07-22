<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblBankDisbursementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_bank_disbursement', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fundrequestid')->nullable();
            $table->bigInteger('cid')->nullable();
            $table->string('name', 255)->nullable();
            $table->string('remarks', 500)->nullable();
            $table->string('document', 255)->nullable();
            $table->date('date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_bank_disbursement');
    }
}

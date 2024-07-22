<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblRefundTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_refund', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fundid')->nullable();
            $table->string('refund_amount', 100)->nullable();
            $table->date('refund_date')->nullable();
            $table->integer('created_by')->nullable();
            $table->date('created_on')->nullable();
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
        Schema::dropIfExists('tbl_refund');
    }
}

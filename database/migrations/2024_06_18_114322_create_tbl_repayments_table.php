<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblRepaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_repayments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fundid')->nullable();
            $table->bigInteger('cid')->nullable();
            $table->decimal('principal', 30, 2)->nullable();
            $table->decimal('administrative_fee', 30, 2)->nullable();
            $table->decimal('principal_repayment', 30, 2)->nullable();
            $table->decimal('emi_amount', 20, 2)->nullable();
            $table->decimal('closing_balance', 30, 2)->nullable();
            $table->date('payment_date')->nullable();
            $table->string('payment_mode', 255)->nullable();
            $table->date('cheque_date')->nullable();
            $table->bigInteger('cheque_number')->nullable();
            $table->string('reference_no_transaction_no', 255)->nullable();
            $table->tinyInteger('emi_refund')->default(0);
            $table->date('due_date')->nullable();
            $table->decimal('penalty', 30, 2)->nullable();
            $table->tinyInteger('review_status')->default(0);
            $table->string('review_remarks', 500)->nullable();
            $table->integer('reviewed_by')->nullable();
            $table->date('reviewed_on')->nullable();
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
        Schema::dropIfExists('tbl_repayments');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPaymentDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_payment_docs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paymentid')->nullable();
            $table->unsignedBigInteger('fundid')->nullable();
            $table->string('file_name', 50)->default('');
            $table->string('doc_path', 200)->default('');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->date('created_at')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->date('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_payment_docs');
    }
}

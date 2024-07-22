<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblBudgetDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_budget_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('FinancialYear', 250)->default('');
            $table->integer('BudgetHeadID')->nullable();
            $table->string('Activity', 500)->default('');
            $table->decimal('BudgetAmount', 11, 2)->nullable();
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
        Schema::dropIfExists('tbl_budget_details');
    }
}

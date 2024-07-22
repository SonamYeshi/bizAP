<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblBudgetExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_budget_expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('BudgetHeadID')->nullable();
            $table->string('ExpenseHeadName', 250)->nullable();
            $table->string('ExpenseHeadCode', 250)->nullable();
            $table->string('ExpenseHeadDescription', 500)->nullable();
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
        Schema::dropIfExists('tbl_budget_expenses');
    }
}

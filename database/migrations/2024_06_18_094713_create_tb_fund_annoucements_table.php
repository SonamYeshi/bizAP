<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbFundAnnoucementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_fund_annoucements', function (Blueprint $table) {
            $table->increments('id'); // Creates an INT primary key column named 'id' with auto-increment
            $table->string('opencohort', 100)->nullable();
            $table->integer('opencohortno')->nullable();
            $table->string('title', 255)->nullable();
            $table->string('details', 2000)->nullable();
            $table->date('submission_date')->nullable();
            $table->time('submission_time')->nullable();
            $table->string('email', 255)->nullable();
            $table->unsignedBigInteger('phone')->nullable();
            $table->boolean('active')->default(true);
            $table->unsignedInteger('created_by')->nullable();
            $table->date('created_on')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->date('updated_on')->nullable();
            $table->integer('tenure')->nullable();
            $table->string('intres_rate', 11)->nullable();
            $table->string('emiintres_rate', 11)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_fund_annoucements');
    }
}

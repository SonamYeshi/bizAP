<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblScreeningStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_screening_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('appid')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->string('reason', 500)->nullable();
            $table->tinyInteger('active')->default(1);
            $table->unsignedInteger('created_by')->nullable();
            $table->date('created_on')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
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
        Schema::dropIfExists('tbl_screening_statuses');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPosttrainingStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_posttraining_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appID')->nullable();
            $table->string('status', 100)->default('');
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
        Schema::dropIfExists('tbl_posttraining_statuses');
    }
}

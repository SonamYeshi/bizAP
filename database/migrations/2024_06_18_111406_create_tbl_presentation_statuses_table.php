<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPresentationStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_presentation_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fundID')->nullable();
            $table->unsignedBigInteger('appID')->nullable();
            $table->unsignedBigInteger('pannelID')->nullable();
            $table->decimal('score', 30, 2)->nullable();
            $table->string('remarks')->default('');
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
        Schema::dropIfExists('tbl_presentation_statuses');
    }
}

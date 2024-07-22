<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblSliStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_sli_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('fundID')->nullable();
            $table->unsignedInteger('appID')->nullable();
            $table->unsignedInteger('pannelID')->nullable();
            $table->decimal('score', 30, 2)->nullable();
            $table->string('remarks', 255)->default('');
            $table->unsignedInteger('created_by')->nullable();
            $table->date('created_at')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
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
        Schema::dropIfExists('tbl_sli_statuses');
    }
}

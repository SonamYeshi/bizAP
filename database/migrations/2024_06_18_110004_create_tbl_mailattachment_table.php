<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblMailattachmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_mailattachment', function (Blueprint $table) {
            $table->id();
            $table->string('cohortopen', 100)->nullable();
            $table->integer('cohortopenno')->nullable();
            $table->string('filename', 250)->nullable();
            $table->string('filepath', 250)->nullable();
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
        Schema::dropIfExists('tbl_mailattachment');
    }
}

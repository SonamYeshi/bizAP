<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblShortlistpannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_shortlistpannels', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('trainingid')->nullable();
            $table->string('name', 255)->nullable();
            $table->string('designation', 255)->nullable();
            $table->unsignedInteger('role')->nullable();
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
        Schema::dropIfExists('tbl_shortlistpannels');
    }
}

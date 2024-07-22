<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstVillagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_villages', function (Blueprint $table) {
            $table->increments('village_id');
            $table->unsignedInteger('dzongkhag_id')->nullable();
            $table->unsignedInteger('gewog_id')->nullable();
            $table->string('village_name', 255)->nullable();
            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('mst_villages');
    }
}

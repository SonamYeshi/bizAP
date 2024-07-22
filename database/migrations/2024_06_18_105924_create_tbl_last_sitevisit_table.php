<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblLastSitevisitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_last_sitevisit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fundid')->nullable();
            $table->date('lastvisitdate')->nullable();
            $table->string('laststatus', 100)->nullable();
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
        Schema::dropIfExists('tbl_last_sitevisit');
    }
}

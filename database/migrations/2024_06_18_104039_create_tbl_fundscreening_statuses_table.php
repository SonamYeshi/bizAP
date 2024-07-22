<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblFundscreeningStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_fundscreening_statuses', function (Blueprint $table) {
            $table->id();
            $table->integer('appid')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->string('reason', 500)->nullable();
            $table->tinyInteger('active')->default(1);
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
        Schema::dropIfExists('tbl_fundscreening_statuses');
    }
}

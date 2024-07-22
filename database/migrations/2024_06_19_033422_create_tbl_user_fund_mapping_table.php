<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblUserFundMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_user_fund_mapping', function (Blueprint $table) {
            $table->id();
            $table->integer('fundappid')->nullable();
            $table->integer('userid')->nullable();
            $table->timestamps();
        });
        // To match the AUTO_INCREMENT value of 127 from your SQL script
        // DB::statement('ALTER TABLE tbl_user_fund_mapping AUTO_INCREMENT = 127;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_user_fund_mapping');
    }
}

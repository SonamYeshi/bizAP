<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingApplicationDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_training_app_docs', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('appid')->nullable();
            $table->string('passport');
            $table->string('cid');
            $table->string('noc');
            $table->string('cv');
            $table->string('certificate');
            $table->string('supporting')->nullable();
            $table->string('workexample')->nullable();
            $table->string('sample1')->nullable();
            $table->string('sample2')->nullable();
            $table->string('doc_path');
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('tbl_training_app_docs');
    }
}

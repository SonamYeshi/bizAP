<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblTrainingProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_training_providers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('country');
            $table->string('address');
            $table->string('contact_person');
            $table->string('email');
            $table->unsignedBigInteger('phone');
            $table->tinyInteger('active')->default(1);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->date('created_on')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('tbl_training_providers');
    }
}

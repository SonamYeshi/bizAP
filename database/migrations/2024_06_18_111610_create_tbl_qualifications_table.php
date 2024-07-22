<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_qualifications', function (Blueprint $table) {
            $table->id();
            $table->string('qualification')->nullable(false);
            $table->unsignedBigInteger('created_by')->nullable(false);
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
        Schema::dropIfExists('tbl_qualifications');
    }
}

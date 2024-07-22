<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblDhifundingapplicationDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_dhifundingapplication_docs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('appid')->nullable();
            $table->string('filecat', 100)->default('');
            $table->string('file_name', 500)->default('');
            $table->string('doc_path', 200)->default('');
            $table->date('created_at')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('tbl_dhifundingapplication_docs');
    }
}

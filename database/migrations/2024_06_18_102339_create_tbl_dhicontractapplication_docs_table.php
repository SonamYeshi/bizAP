<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblDhicontractapplicationDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_dhicontractapplication_docs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('appid')->nullable();
            $table->bigInteger('cid')->nullable();
            $table->string('file_name', 250)->default('');
            $table->string('doc_path', 200)->default('');
            $table->date('created_at')->nullable();
            $table->integer('created_by')->nullable();
            $table->date('updated_at')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_dhicontractapplication_docs');
    }
}

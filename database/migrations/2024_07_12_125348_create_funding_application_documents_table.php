<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundingApplicationDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funding_application_documents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('appid')->nullable();
            $table->string('passport');
            $table->string('cid');
            $table->string('cib');
            $table->string('acc_statement');
            $table->string('business_proposal');
            $table->string('cv')->nullable();
            $table->string('business_license')->nullable();
            $table->string('sc')->nullable();
            $table->string('tax_clearance')->nullable();
            $table->string('recomendation')->nullable();
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
        Schema::dropIfExists('funding_application_documents');
    }
}

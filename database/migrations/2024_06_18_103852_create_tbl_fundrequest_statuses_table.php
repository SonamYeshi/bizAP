<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblFundrequestStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_fundrequest_statuses', function (Blueprint $table) {
            $table->id();
            $table->integer('fundrequestid')->nullable();
            $table->string('approvedfund', 100)->default('');
            $table->tinyInteger('review_status')->default(0);
            $table->string('review_remarks', 500)->nullable();
            $table->string('review_attachment', 255)->nullable();
            $table->integer('reviewed_by')->nullable();
            $table->date('review_date')->nullable();
            $table->string('approve_asd_remarks', 500)->default('');
            $table->tinyInteger('approve_status_asd')->default(0);
            $table->integer('approevd_asd_by')->nullable();
            $table->date('approved_asd_date')->nullable();
            $table->tinyInteger('approved_status_ach')->default(0);
            $table->string('approved_ach_remarks', 500)->nullable();
            $table->integer('approved_ach_by')->nullable();
            $table->date('approved_ach_date')->nullable();
            $table->tinyInteger('approved_status_dir')->default(0);
            $table->integer('approved_dir_by')->nullable();
            $table->date('approved_dir_date')->nullable();
            $table->string('approve_dir_remarks', 500)->nullable();
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
        Schema::dropIfExists('tbl_fundrequest_statuses');
    }
}

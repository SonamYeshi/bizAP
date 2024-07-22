<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbDhifundApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_dhifund_applications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('fundid')->nullable();
            $table->string('cohortopen', 100)->nullable();
            $table->unsignedInteger('cohortopenno')->nullable();
            $table->unsignedBigInteger('cid')->nullable();
            $table->string('initial', 10)->default('');
            $table->string('name', 255)->default('');
            $table->date('dob')->nullable();
            $table->unsignedBigInteger('mobileno')->nullable();
            $table->string('email', 100)->default('');
            $table->string('current_address', 500)->default('');
            $table->string('source_of_income', 255)->default('');
            $table->string('source_of_income_others', 255)->nullable();
            $table->unsignedInteger('business_type')->nullable();
            $table->string('business_name', 100)->default('');
            $table->string('business_location', 255)->default('');
            $table->text('business_description')->nullable(false);
            $table->string('business_sector', 255)->default('');
            $table->string('business_sector_others', 255)->nullable();
            $table->text('business_to_address')->nullable(false);
            $table->string('business_activity', 255)->nullable();
            $table->string('business_status', 255)->nullable();
            $table->string('revenue', 255)->nullable();
            $table->string('customer_target', 255)->nullable();
            $table->string('no_of_current_customer', 255)->nullable();
            $table->date('company_start_date')->nullable();
            $table->string('money_invested', 255)->nullable();
            $table->string('raise_finance', 255)->nullable();
            $table->string('employees_hired', 255)->nullable();
            $table->string('team', 255)->default('');
            $table->string('team_others', 255)->nullable();
            $table->text('biggest_challenge')->nullable(false);
            $table->text('specific_resources')->nullable(false);
            $table->text('business_opportunity')->nullable(false);
            $table->boolean('screening_status')->nullable();
            $table->boolean('shortlist_status')->nullable();
            $table->boolean('presentation_status')->nullable();
            $table->boolean('selected')->nullable();
            $table->date('created_on')->nullable();
            $table->date('updated_on')->nullable();
            $table->string('business_licence_no', 100)->nullable();
            $table->string('financing_account_no', 100)->nullable();
            $table->string('bank_account_no', 100)->nullable();
            $table->unsignedInteger('selected_by')->nullable();
            $table->date('selected_on')->nullable();
            $table->decimal('totalscore', 10, 2)->default(0.00);
            $table->string('total_disbursed', 100)->default('');
            $table->string('actual_disbursed', 100)->nullable();
            $table->date('disbursed_date')->nullable();
            $table->date('approved_date')->nullable();
            $table->date('shortlist_on')->nullable();
            $table->boolean('disbursement')->default(false);
            $table->boolean('contractupload')->default(false);
            $table->boolean('disbursementupload')->default(false);
            $table->decimal('sltotalscore', 10, 2)->default(0.00);
            $table->string('bank', 45)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_dhifund_applications');
    }
}

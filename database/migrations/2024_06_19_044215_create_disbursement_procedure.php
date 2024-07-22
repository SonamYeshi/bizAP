<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateDisbursementProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = '
            CREATE PROCEDURE `disbursement`()
            BEGIN
                SELECT app.id as fundid, app.cohortopen, app.cohortopenno, app.fundid as fid, app.cid, app.name, app.mobileno, app.business_name, app.business_type,
                SUM(DISTINCT app.actual_disbursed) as actual_disbursed, SUM(DISTINCT app.actual_disbursed) as totaldisbursed
                FROM tb_dhifund_applications app
                WHERE app.disbursement = \'1\'
                GROUP BY app.cid 
                ORDER BY app.id DESC;
            END
        ';

        DB::unprepared("DROP PROCEDURE IF EXISTS `disbursement`");
        DB::unprepared($procedure);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS `disbursement`");
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateDisbursementSearchProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = '
            CREATE PROCEDURE `disbursement_search`(IN fundid INT(11))
            BEGIN
                SELECT app.id as fundid, app.cohortopen, app.cohortopenno, app.cid, app.name, app.mobileno, app.business_name, 
                SUM(DISTINCT app.actual_disbursed) as actual_disbursed, SUM(DISTINCT app.actual_disbursed) as totaldisbursed
                FROM tb_dhifund_applications app
                WHERE app.fundid = fundid
                GROUP BY app.cid;
            END
        ';

        DB::unprepared("DROP PROCEDURE IF EXISTS `disbursement_search`");
        DB::unprepared($procedure);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS `disbursement_search`");
    }
}

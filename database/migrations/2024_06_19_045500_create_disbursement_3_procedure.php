<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateDisbursement3Procedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = '
            CREATE PROCEDURE `disbursement_3`(IN id INT(11))
            BEGIN
                SELECT app.id as fundid, app.fundid as fid, app.cohortopen, app.cohortopenno, app.cid, app.name, app.mobileno, app.business_name, app.business_type,
                SUM(DISTINCT app.actual_disbursed) as actual_disbursed, SUM(DISTINCT app.actual_disbursed) as totaldisbursed
                FROM tb_dhifund_applications app
                WHERE app.disbursement = \'1\' AND app.business_type = id
                GROUP BY app.cid 
                ORDER BY app.id DESC;
            END
        ';

        DB::unprepared("DROP PROCEDURE IF EXISTS `disbursement_3`");
        DB::unprepared($procedure);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS `disbursement_3`");
    }
}

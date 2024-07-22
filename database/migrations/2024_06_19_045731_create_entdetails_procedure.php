<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateEntdetailsProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = '
            CREATE PROCEDURE `entdetails`(IN id INT(11))
            BEGIN
                SELECT app.id as fundid, app.fundid as fid, app.cid, app.name, app.email, app.mobileno, app.business_name, app.business_type,
                SUM(DISTINCT app.actual_disbursed) as actual_disbursed, SUM(DISTINCT fs.approvedfund) as totaldisbursed
                FROM tb_dhifund_applications app
                LEFT JOIN tbl_fund_request fr ON app.id = fr.fundid
                LEFT JOIN tbl_fundrequest_statuses fs ON fr.id = fs.fundrequestid
                WHERE fr.disbursement = \'1\' AND app.id = id
                GROUP BY app.cid;
            END
        ';

        DB::unprepared("DROP PROCEDURE IF EXISTS `entdetails`");
        DB::unprepared($procedure);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS `entdetails`");
    }
}

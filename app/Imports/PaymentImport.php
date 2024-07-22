<?php
namespace App\Imports;
use App\Models\Funding;
use App\Models\Repayments;
use App\Models\ContractDateTime;
use App\Models\FundingApplication;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PaymentImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
        $cid = $row['cid'];
        $emi = $row['emi_amount'];

        $count = count(Repayments::where('cid', $cid)->get());
        $co = FundingApplication::where('cid', $cid)->sum('cohortopen');
        $cono = FundingApplication::where('cid', $cid)->sum('cohortopenno');
        $interest = Funding::where('opencohort', $co)->where('opencohortno', $cono)->value('intres_rate');

        if($count == '0')
          {
            $principalamount = FundingApplication::where('cid', $cid)->sum('actual_disbursed');
            $administrativefee = round(($interest/100*$principalamount)/12, 2);
            $principalrepayment = round($emi - $administrativefee, 2);
            $closingbalance = round($principalamount - $principalrepayment, 2);

            $ed = ContractDateTime::where('cid', $cid)->orderBy('id', 'asc')->value('effective_date');
            $duedate=date('Y-m-d', strtotime('+1 year', strtotime($ed)) );
            $dyear = date('y', strtotime($duedate));
            $dmonth = date('m', strtotime($duedate));
            if($dmonth !='02'){
            $dday = '30'; } else { $dday = '28'; }
            $date = $dyear.'-'.$dmonth.'-'.$dday;
            $ddate = date("Y-m-d",strtotime($date));

                    return new Repayments([
                     'cid' => $cid,
                     'principal' => $principalamount,
                     'administrative_fee' => $administrativefee,
                     'principal_repayment' => $principalrepayment,
                     'emi_amount'      => $emi,
                     'due_date'      => $ddate,
                     'closing_balance' => $closingbalance,
                     'payment_date'   => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['payment_date'])->format('Y-m-d')
                    ]);
          }
          else
          {
            $principalamount = Repayments::where('cid', $cid)->orderBy('id', 'desc')->value('closing_balance');
            $administrativefee = round(($interest/100*$principalamount)/12, 2);
            $principalrepayment = round($emi - $administrativefee, 2);
            $closingbalance = round($principalamount - $principalrepayment, 2);

            $predueate = Repayments::where('cid', $cid)->orderBy('id', 'desc')->value('due_date');
            $nextdate = date('Y-m-d', strtotime('+1 month', strtotime($predueate)) );
            $dyear = date('y', strtotime($nextdate));
            $dmonth = date('m', strtotime($nextdate));
            if($dmonth !='02'){
            $dday = '30'; } else { $dday = '28'; }
            $date = $dyear.'-'.$dmonth.'-'.$dday;
            $ddate = date("Y-m-d",strtotime($date));
            return new Repayments([
             'cid' => $cid,
             'principal' => $principalamount,
             'administrative_fee' => $administrativefee,
             'principal_repayment' => $principalrepayment,
             'emi_amount'      => $emi,
             'due_date'      => $ddate,
             'closing_balance' => $closingbalance,
             'payment_date'   => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['payment_date'])->format('Y-m-d')
            ]);

          }

    }
}

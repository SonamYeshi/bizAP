<?php

namespace App\Http\Controllers\Report;
use Illuminate\Support\Facades\Session;
use App\Mail\SendFundShortlist;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Mail\SendPresentationDate;
use App\Mail\SendContractDate;
use App\Models\User;
use App\Models\FundingApplication;
use App\Models\TrainingApplication;
use App\Models\Interviewpanel;
use App\Models\PaymentDefaults;
use App\Models\Funding;
use App\Models\FundRequest;
use App\Models\Repayments;
use App\Models\ApplicationUserMap;
use DB;
use Mail;
use PDF;

class ReportController extends Controller
{


    public function training()
    {
        $allapplication = TrainingApplication::orderBy('totalscore', 'desc')->get();
        return view('reports.index1', compact('allapplication'));
    }

    public function funding()
    {
        $allapplication = DB::select("CALL disbursement()");
        $count = count($allapplication);
        return view('reports.index', compact('allapplication', 'count'));
    }

    public function fundingedd()
    {
        $allapplication = DB::select("CALL disbursement()");
        $count = count($allapplication);
        return view('reports.indexedd', compact('allapplication', 'count'));
    }

    public function fundsearch(Request $request)
    {
       $cohortopenall = $request->cohortopenall;
       $cohortopenno = $request->cohortopenno;
       $business_type = $request->business_type;

       if($cohortopenall == 'all' && $cohortopenno == '' && $business_type == '')
       {
        $allapplication = DB::select("CALL disbursement()");
        $count = count($allapplication);
        return view('reports.searchresult', compact('allapplication', 'count'));
       }

       if($cohortopenall == 'COHORT' && $cohortopenno == '' && $business_type == '')
       {
        $allapplication = DB::select("CALL disbursement_1()");
        $count = count($allapplication);
        return view('reports.searchresult', compact('allapplication', 'count'));
       }

       if($cohortopenall == 'COHORT' && $cohortopenno != '' && $business_type == '')
       {
        $allapplication = DB::select("CALL disbursement_2($cohortopenno)");
        $count = count($allapplication);
        return view('reports.searchresult', compact('allapplication', 'count'));
       }

       if($cohortopenall == 'OPEN' && $cohortopenno == '' && $business_type == '')
       {
        $allapplication = DB::select("CALL disbursement_11()");
        $count = count($allapplication);
        return view('reports.searchresult', compact('allapplication', 'count'));
       }

       if($cohortopenall == 'OPEN' && $cohortopenno != '' && $business_type == '')
       {
        $allapplication = DB::select("CALL disbursement_22($cohortopenno)");
        $count = count($allapplication);
        return view('reports.searchresult', compact('allapplication', 'count'));
       }

       if($cohortopenall == '' && $cohortopenno == '' && $business_type != '')
       {
        $allapplication = DB::select("CALL disbursement_3($business_type)");
        $count = count($allapplication);
        return view('reports.searchresult', compact('allapplication', 'count'));
       }
    }

    public function tsearch(Request $request)
    {
       $cohortopenall = $request->cohortopenall;
       $cohortopenno = $request->cohortopenno;


       if($cohortopenall == 'all' && $cohortopenno == '')
       {
        $allapplication = TrainingApplication::orderBy('id', 'desc')->get();
        $count = count($allapplication);
        return view('reports.searchresult1', compact('allapplication', 'count'));
       }

       if($cohortopenall == 'COHORT' && $cohortopenno == '' )
       {
        $allapplication = TrainingApplication::where('opencohort', 'COHORT')->orderBy('id', 'desc')->get();
        $count = count($allapplication);
        return view('reports.searchresult1', compact('allapplication', 'count'));
       }

       if($cohortopenall == 'COHORT' && $cohortopenno != '')
       {
        $allapplication = TrainingApplication::where('opencohort', 'COHORT')->where('opencohortno', $cohortopenno)->orderBy('id', 'desc')->get();
        $count = count($allapplication);
        return view('reports.searchresult1', compact('allapplication', 'count'));
       }

       if($cohortopenall == 'OPEN' && $cohortopenno == '')
       {
        $allapplication = TrainingApplication::where('opencohort', 'OPEN')->orderBy('id', 'desc')->get();
        $count = count($allapplication);
        return view('reports.searchresult1', compact('allapplication', 'count'));
       }

       if($cohortopenall == 'OPEN' && $cohortopenno != '')
       {
        $allapplication = TrainingApplication::where('opencohort', 'OPEN')->where('opencohortno', $cohortopenno)->orderBy('id', 'desc')->get();
        $count = count($allapplication);
        return view('reports.searchresult1', compact('allapplication', 'count'));
       }

       if($cohortopenall == 'BATCH' && $cohortopenno == '')
       {
        $allapplication = TrainingApplication::where('opencohort', 'BATCH')->orderBy('id', 'desc')->get();
        $count = count($allapplication);
        return view('reports.searchresult1', compact('allapplication', 'count'));
       }

       if($cohortopenall == 'BATCH' && $cohortopenno != '')
       {
        $allapplication = TrainingApplication::where('opencohort', 'BATCH')->where('opencohortno', $cohortopenno)->orderBy('id', 'desc')->get();
        $count = count($allapplication);
        return view('reports.searchresult1', compact('allapplication', 'count'));
       }
    }

    public function details($fundid)
    {

        $allapplication = DB::select("CALL entdetails($fundid)");
        $count = count($allapplication);
        $cid = FundingApplication::where('id', $fundid)->value('cid');
        $disbursementdate = FundingApplication::where('id', $fundid)->value('disbursed_date');
        $effectivedate = date('Y-m-d', strtotime('+1 year', strtotime($disbursementdate)));
        $curdate = date('Y-m-d');
        $disbursement = FundingApplication::where('cid', $cid)->get();
        $repayment = Repayments::where('cid', $cid)->orderBy('id', 'asc')->get();
        $totaldisbursed = FundingApplication::where('cid', $cid)->sum('actual_disbursed');
        $totalrefund = Repayments::where('cid', $cid)->where('emi_refund', '1')->sum('emi_amount');
        $totalrepayment = Repayments::where('cid', $cid)->where('emi_refund', '0')->sum('emi_amount');
        $defaults = PaymentDefaults::where('cid', $cid)->get();
        return view('reports.details', compact('defaults', 'cid', 'effectivedate', 'curdate', 'allapplication', 'totaldisbursed', 'totalrefund', 'totalrepayment',
         'count', 'disbursement', 'disbursementdate', 'repayment', 'fundid'));
    }

    public function detailsedd($fundid)
    {
        $allapplication = DB::select("CALL entdetails($fundid)");
        $count = count($allapplication);
        $cid = FundingApplication::where('id', $fundid)->value('cid');
        $disbursementdate = FundingApplication::where('id', $fundid)->value('disbursed_date');
        $effectivedate = date('Y-m-d', strtotime('+1 year', strtotime($disbursementdate)));
        $curdate = date('Y-m-d');
        $disbursement = FundingApplication::where('cid', $cid)->get();
        $repayment = Repayments::where('cid', $cid)->orderBy('id', 'asc')->get();
        $totaldisbursed = FundingApplication::where('cid', $cid)->sum('actual_disbursed');
        $totalrefund = Repayments::where('cid', $cid)->where('emi_refund', '1')->sum('emi_amount');
        $totalrepayment = Repayments::where('cid', $cid)->where('emi_refund', '0')->sum('emi_amount');
        $defaults = PaymentDefaults::where('cid', $cid)->get();

        return view('reports.detailsedd', compact('defaults', 'cid', 'effectivedate', 'curdate', 'allapplication', 'totaldisbursed', 'totalrefund', 'totalrepayment',
         'count', 'disbursement', 'disbursementdate', 'repayment', 'fundid'));
    }

    public function tdetails($appid)
    {
        $allapplication = TrainingApplication::where('id', $appid)->get();
        $trainingid = TrainingApplication::where('id', $appid)->value('trainingid');
        $count = count($allapplication);
        $pannels = Interviewpanel::where('trainingid', $trainingid)->get();
        return view('reports.details1', compact('allapplication', 'count', 'pannels', 'appid'));
    }


}

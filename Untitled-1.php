<?php
namespace App\Http\Controllers\Applicant;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Models\user;
use App\Models\Funding;
use App\Models\DelayCount;
use App\Models\BankEmail;
use App\Models\PaymentDefaults;
use App\Models\Refund;
use App\Models\FundingApplication;
use App\Models\ApplicationUserMap;
use App\Models\FundRequest;
use App\Models\FundRequestStatus;
use App\Models\BankDisbursement;
use App\Mail\SendRejectEmail;
use App\Mail\Repaymentmail;
use App\Models\Repayments;
use App\Models\PaymentDocs;
use App\Models\SitevisitDateTime;
use App\Mail\SendSiteVisit;
use App\Mail\Fundrequestmail;
use App\Mail\FundReviewmail;
use App\Mail\Virtualmail;
use App\Models\SitevisitLast;
use App\Imports\PaymentImport;
use App\Imports\DisburseImport;
use App\Models\ContractDateTime;
use App\Models\DisbursementDocs;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use DB;
use Mail;
use PDF;
use DateTime;

use function PHPUnit\Framework\isNull;

class ApplicantController extends Controller
{
    public function updateinfo()
    {
         $userid = $role=Auth::user()->id;
         $fundappid = ApplicationUserMap::where('userid', $userid)->value('fundappid');
         $mobileno = FundingApplication::where('id', $fundappid)->value('mobileno');
         $email = FundingApplication::where('id', $fundappid)->value('email');
         return view('fundrequest.updateinfo', compact('mobileno', 'email', 'fundappid', 'userid'));
    }

    public function postupdate(Request $request)
    {
        $userid = $request->userid;
        $fundid = $request->fundid;
        $bano = $request->bano;
        $blno = $request->blno;
        $email = $request->email;
        $mobileno = $request->mobileno;

        $info = new FundingApplication;
        $info::where('id', $fundid)
            ->update([
                'business_licence_no' => $request->blno,
                'bank_account_no' => $request->bano,
                'mobileno' => $request->mobileno,
                'email' => $request->email
            ]);

        return redirect()->route('updateinfo')->with('success','Information Updated Successfully!');
    }

    public function approvedbusiness()
    {
        $userid = $role=Auth::user()->id;
	    $fundid = ApplicationUserMap::where('userid', $userid)->value('fundappid');
        $allapplication = ApplicationUserMap::where('userid', $userid)->get();
	    $FundRequest = FundRequest::where('fundid', $fundid)->get();
        return view('fundrequest.index', compact('FundRequest', 'fundid', 'allapplication'));
    }

    public function fundapp($id)
    {
        $fundappid = $id;
        $allapplication = FundingApplication::where('id', $fundappid)->get();
        return view('fundrequest.fundrequest', compact('allapplication', 'fundappid'));
    }

    public function releasefund(Request $request)
    {
        $business_name = $request->business_name;
        $fundappid = $request->fundappid;
        $name = FundingApplication::where('id', $fundappid)->value('name');
            foreach ($request->proof as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/proof' ;
                $file->move($path,$filename);
                FundRequest::create([
                    'fundid' => $request->fundappid,
                    'tranche' => $request->tranche,
                    'usage' => $request->usage,
                    'proof' => $filename,
                    'paid_to' => $request->paidto,
                    'created_by' => Auth::user()->id,
                    'created_on' => date('Y-m-d')
                ]);
            }
            $Emails = User::where('role_id', '1')->get();
            foreach ($Emails as $e)
            {
               Mail::to($e->email)->send(new Fundrequestmail($business_name, $name));
            }
        Alert::success('Success', 'You\'ve successfully submitted the Application');
        return redirect()->route('fundrequest');
    }

    public function fundreview()
    {
        $key = '0';
        $allapplication = FundRequest::
         orderBy('id', 'desc')
        ->get();
        return view('fundrequest.reviewlist', compact('allapplication', 'key'));
    }

    public function fundreviewsearch(Request $request)
    {
        $key = $request->key;
        $allapplication = DB::table('tbl_fund_request')
        ->join('tb_dhifund_applications', 'tbl_fund_request.fundid', '=', 'tb_dhifund_applications.id')
        ->where('tb_dhifund_applications.fundid', $key)
        ->select('tbl_fund_request.*')
        ->orderBy('tbl_fund_request.id', 'desc')
        ->get();
       return view('fundrequest.reviewlist1', compact('allapplication', 'key'));
    }

    public function fundreviewsearchid($key)
    {
        $allapplication = DB::table('tbl_fund_request')
        ->join('tb_dhifund_applications', 'tbl_fund_request.fundid', '=', 'tb_dhifund_applications.id')
        ->where('tb_dhifund_applications.fundid', $key)
        ->select('tbl_fund_request.*')
        ->orderBy('tbl_fund_request.id', 'desc')
        ->get();
       return view('fundrequest.reviewlist1', compact('allapplication', 'key'));
    }

    public function fundappreview($id, $key)
    {
        $fundappid = FundRequest::where('id', $id)->value('fundid');
        $allapplication = FundingApplication::where('id', $fundappid)->get();
        return view('fundrequest.review', compact('allapplication', 'fundappid', 'id', 'key'));
    }

    public function postfundreview(Request $request)
    {
        $key = $request->key;
        $business_name = $request->business_name;
        $fundappid = $request->fundappid;
        $name = FundingApplication::where('id', $fundappid)->value('name');
        $remarks = $request->remarks;
            $review = new FundRequestStatus;
            $review->fundrequestid = $request->fundid;
            $review->approvedfund = $request->approvedfundamount;
            $review->review_status = $request->reviewstatus;
            $review->review_remarks = $request->remarks;
            $review->reviewed_by = Auth::user()->id;
            $review->review_date = date('Y-m-d');
            $review->save();

            $fundrequest = new FundRequest;
            $fundrequest::where('id', $request->fundid)->update(['review' => '1']);
            $fundapplication = new FundingApplication;
            $fundapplication::where('id', $request->fundappid)
            ->update([
                'actual_disbursed' => $request->approvedfundamount
	    ]);

           if($request->reviewstatus == '1')
            {
                $Emails = User::where('role_id', '4')->orwhere('role_id', '5')->orwhere('role_id', '12')->get();
                foreach ($Emails as $e)
                {
                 Mail::to($e->email)->send(new FundReviewmail($business_name, $name));
	            }
	        }

	     if($request->reviewstatus == '2')
	         {
                 $email = FundingApplication::where('id',  $fundappid)->value('email');
                 Mail::to($email)->send(new SendRejectEmail($remarks));
             }
        Alert::success('Success', 'Reviewed successfully');
        if($key == '0'){
	    return redirect()->route('fundreview');
        }
        else
        {
        return redirect()->route('fundrequest_searchid', $key);
        }
    }

    public function reviewach($id)
    {
        $fundappid = FundRequest::where('id', $id)->value('fundid');
        $review = FundRequestStatus::where('fundrequestid', $id)->get();
        $allapplication = FundingApplication::where('id', $fundappid)->get();
        return view('fundrequest.review_ach', compact('allapplication', 'fundappid', 'id', 'review'));
    }

    public function postreviewach(Request $request)
    {
        $fundrequest = new FundRequestStatus;
        $fundrequest::where('fundrequestid', $request->fundid)
        ->update([
        'approved_status_ach' => $request->ach_status,
        'approved_ach_remarks' => $request->ahc_remarks,
        'approved_ach_by' => Auth::user()->id,
        'approved_ach_date' => date('Y-m-d')
         ]);
         $fundrequest = new FundRequest;
         $fundrequest::where('id', $request->fundid)->update(['approve_ach' => '1']);
         Alert::success('Success', 'Application Approved Successfully');
        return view('dashboard');
    }

    public function reviewasd($id)
    {
        $fundappid = FundRequest::where('id', $id)->value('fundid');
        $review = FundRequestStatus::where('fundrequestid', $id)->get();
        $allapplication = FundingApplication::where('id', $fundappid)->get();
        return view('fundrequest.review_asd', compact('allapplication', 'fundappid', 'id', 'review'));
    }

    public function postreviewasd(Request $request)
    {
        $fundrequest = new FundRequestStatus;
        $role=Auth::user()->role_id;
        if($role == '5'){
        $fundrequest::where('fundrequestid', $request->fundid)
        ->update([
        'approve_status_asd' => $request->asd_status,
        'approve_asd_remarks' => $request->asd_remarks,
        'approevd_asd_by' => Auth::user()->id,
        'approved_asd_date' => date('Y-m-d')
         ]);
        }
        if($role == '12'){
            $fundrequest::where('fundrequestid', $request->fundid)
            ->update([
            'approved_status_dir' => $request->asd_status,
            'approve_dir_remarks' => $request->asd_remarks,
            'approved_dir_by' => Auth::user()->id,
            'approved_dir_date' => date('Y-m-d')
             ]);
            }
         $fundrequest = new FundRequest;
         if($role == '12'){
            $fundrequest::where('id', $request->fundid)->update(['approve_dir' => '1', 'approval_date' => date('Y-m-d')]);
            }
         if($role == '5'){
         $fundrequest::where('id', $request->fundid)->update(['approve_asd' =>'1']);
        }
        if($role == '12'){
            $fundrequest::where('id', $request->fundid)->update(['approval_date' => date('Y-m-d')]);
           }

        Alert::success('Success', 'Application Approved Successfully');
        return view('dashboard');
    }

    public function disbursement()
    {
        $key = "0";
        $allapplication = FundRequest::where('review', '1')
        ->where('approve_ach', '1')
        ->where('approve_asd', '1')
        ->where('approve_dir', '1')
        ->orderBy('id', 'desc')->get();
        $count = count($allapplication);
        return view('fundrequest.disbursementlist', compact('allapplication', 'count', 'key'));
    }

    public function disbursementsearch(Request $request)
    {
        $key = $request->key;

        $allapplication = DB::table('tbl_fund_request')
        ->join('tb_dhifund_applications', 'tbl_fund_request.fundid', '=', 'tb_dhifund_applications.id')
        ->where('tbl_fund_request.review', '1')
        ->where('tbl_fund_request.approve_ach', '1')
        ->where('tbl_fund_request.approve_asd', '1')
        ->where('tbl_fund_request.approve_dir', '1')
        ->where('tb_dhifund_applications.fundid', $key)
        ->select('tbl_fund_request.*')
        ->orderBy('tbl_fund_request.id', 'desc')
        ->get();
        $count = count($allapplication);
        return view('fundrequest.disbursementlist1', compact('allapplication', 'count', 'key'));
    }

    public function disbursementsearchid($key)
    {

        $allapplication = DB::table('tbl_fund_request')
        ->join('tb_dhifund_applications', 'tbl_fund_request.fundid', '=', 'tb_dhifund_applications.id')
        ->where('tbl_fund_request.review', '1')
        ->where('tbl_fund_request.approve_ach', '1')
        ->where('tbl_fund_request.approve_asd', '1')
        ->where('tbl_fund_request.approve_dir', '1')
        ->where('tb_dhifund_applications.fundid', $key)
        ->select('tbl_fund_request.*')
        ->orderBy('tbl_fund_request.id', 'desc')
        ->get();
        $count = count($allapplication);
        return view('fundrequest.disbursementlist', compact('allapplication', 'count', 'key'));
    }

    public function DisbursementUpload(Request $request)
    {
        $key = $request->key;
       $fundid = $request->fundid;
        $cid =  FundingApplication::where('id', $fundid)->value('cid');
        if ($request->disbursement != 0) {
            foreach ($request->disbursement as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/disbursementdocs' ;
                $file->move($path,$filename);
                DisbursementDocs::create([
                    'appid' => $request->fundid,
                    'cid' => $cid,
                    'file_name' => $filename,
                    'doc_path' => $path,
                    'created_at' => date('Y-m-d'),
                    'created_by' => Auth::user()->id
                ]);
            }

            $fund = new FundingApplication;
            $fund::where('id', $fundid)
            ->update([
                'disbursementupload' => "1"
            ]);
        }
        $filename =  DisbursementDocs::where('appid', $fundid)->value('file_name');
        $Emails = BankEmail::all();
         foreach ($Emails as $e)
             {
                $data["email"] = $e->email;
	         }

        $data["title"] = "Fund Disbursement Notification ";
        $attechfiles = [ public_path().'/uploads/disbursementdocs/'.$filename];
        Mail::send('fundrequest.disbursementmail', $data, function($message)use($data, $attechfiles) {
            $message->to($data["email"], $data["email"])
                        ->subject($data["title"]);
            foreach ($attechfiles as $file){
                $message->attach($file);
            }
        });
        Alert::success('Success', 'A notification is sent to Bank');
        if($key == '0'){
        return redirect()->route('disbursement');
        }
        else
        {
            return redirect()->route('disburse_searchid', $key);
        }

    }

    public function disbursed()
    {
        $allapplication = FundingApplication::where('disbursement', '1')->get();
        return view('fundrequest.disbursedtlist', compact('allapplication'));
    }

    public function delayall()
    {
        $allapplication = DelayCount::where('active', '0')->get();
        return view('repayment.delaylist', compact('allapplication'));
    }

    public function disbursementview($fundid, $key)
    {
        $fundrequest = new FundRequest;
        $id = FundRequest::where('fundid', $fundid)->value('id');
        $fundrequest::where('fundid', $fundid)
        ->update([
        'disbursement' => '1',
        'disbursement_date' => date('Y-m-d'),
        'disbursement_by' => Auth::user()->id
	]);
	     $accounthead = User::where('role_id', '4')->value('name');
        $ad = User::where('role_id', '5')->value('name');
        $allapplication = FundingApplication::where('id', $fundid)->get();
        $fundapplication = new FundingApplication;

        $fundapplication::where('id', $fundid)->update(['disbursed_date' => date('Y-m-d'), 'disbursement' => '1']);
        return view('fundrequest.reviewdisbursement', compact('allapplication', 'id', 'accounthead', 'ad', 'fundid', 'key'));
    }

    public function disbursementviewPDF($fundid, $key)
    {
        $fundrequest = new FundRequest;
        $id = FundRequest::where('fundid', $fundid)->value('id');
        $fundrequest::where('fundid', $fundid)
        ->update([
        'disbursement' => '1',
        'disbursement_date' => date('Y-m-d'),
        'disbursement_by' => Auth::user()->id
         ]);
        $accounthead = User::where('role_id', '4')->value('name');
        $ad = User::where('role_id', '5')->value('name');
        $allapplication = FundingApplication::where('id', $fundid)->get();
        $fundapplication = new FundingApplication;
        $fundapplication::where('id', $fundid)->update(['disbursed_date' => date('Y-m-d'), 'disbursement' => '1']);
        $pdf = PDF::loadView('fundrequest.reviewdisbursementpdf', compact('allapplication', 'id', 'accounthead', 'ad', 'fundid'));
        return $pdf->download('disbursement.pdf');
    }

    public function bankview($id)
    {
        $fundappid = FundRequest::where('id', $id)->value('fundid');
        $allapplication = FundingApplication::where('id', $fundappid)->get();
        return view('fundrequest.bankdisbursement', compact('allapplication', 'fundappid', 'id'));
    }

    public function postbankreview(Request $request)
    {
         if ($request->bankdoc != 0)
        {
            foreach ($request->bankdoc as $file) {
                $path = $file->store('bankdocuments');
                BankDisbursement::create([
                    'fundrequestid' => $request->fundid,
                    'cid' => $request->received_cid,
                    'name' => $request->received_name,
                    'remarks' => $request->remarks,
                    'document' => $path,
                    'date' => date('Y-m-d')
                ]);
            }
            $fundrequest = new FundRequest;
	    $fundrequest::where('id', $request->fundid)->update(['bank_review' => '1']);
	    $fundid = FundRequest::where('id', $request->fundid)->value('fundid');
            $fundapplication = new FundingApplication;
            $fundapplication::where('id', $fundid)->update(['disbursed_date' => date('Y-m-d'), 'disbursement' => '1']);
        }
        else
        {
            $review = new BankDisbursement;
            $review->fundrequestid = $request->fundid;
            $review->cid = $request->received_cid;
            $review->name = $request->received_name;
            $review->remarks = $request->remarks;
            $review->document = "";
            $review->date = date('Y-m-d');
            $review->save();

            $fundrequest = new FundRequest;
	    $fundrequest::where('id', $request->fundid)->update(['bank_review' => '1']);
	    $fundid = FundRequest::where('id', $request->fundid)->value('fundid');
            $fundapplication = new FundingApplication;
            $fundapplication::where('id', $fundid)->update(['disbursed_date' => date('Y-m-d'), 'disbursement' => '1']);
        }
        return view('dashboard')->with('success','Application Reviewed Successfully');
    }

    public function repayment()
    {
        $userid = $role=Auth::user()->id;
        $allapplication = ApplicationUserMap::where('userid', $userid)->get();
        return view('repayment.index', compact('allapplication'));
    }

    public function allrepayment($fundid, $cid, $tfd)
    {
       $allapplication = Repayments::where('cid', $cid)->orderBy('id', 'asc')->get();
       return view('repayment.allpayment', compact('fundid', 'cid', 'tfd', 'allapplication'));
    }

    public function updatepayment($fundid, $cid, $tfd)
    {
        $total_disbursed = FundingApplication::where('cid', $cid)->sum('actual_disbursed');
        $co = FundingApplication::where('id', $fundid)->sum('cohortopen');
        $cono = FundingApplication::where('id', $fundid)->sum('cohortopenno');
        $intres_rate = Funding::where('opencohort', $co)->where('opencohortno', $cono)->value('intres_rate');
        $tenure = Funding::where('opencohort', $co)->where('opencohortno', $cono)->value('tenure');

        $interest = (float)$intres_rate;
        $period = (float)$tenure;
        $loan_amount = (float)$total_disbursed;
        $interest = $interest / 1200;
        $amount = $interest * -$loan_amount * pow((1+$interest),$period) / (1 - pow((1+$interest), $period));
        $emi = (is_numeric($amount) && is_numeric(100) ) ? (ceil($amount/100)*100) : false;
        return view('repayment.updatepayment', compact('fundid', 'cid', 'tfd', 'emi'));
    }


    public function insertpayment(Request $request)
    {
        $cid = $request->cid;
        $fundid = $request->fundid;
        $emi_amount = $request->PaymentAmount;
        $co = FundingApplication::where('id', $fundid)->sum('cohortopen');
        $cono = FundingApplication::where('id', $fundid)->sum('cohortopenno');
        $interest = Funding::where('opencohort', $co)->where('opencohortno', $cono)->value('intres_rate');
        $tenure = Funding::where('opencohort', $co)->where('opencohortno', $cono)->value('tenure');
        $count = count(Repayments::where('cid', $cid)->get());

        if($count == '0')
          {
            $principalamount = FundingApplication::where('cid', $cid)->sum('actual_disbursed');
            $administrativefee = round(($interest/100*$principalamount)/12, 2);
            $principalrepayment = round($emi_amount - $administrativefee, 2);
            $closingbalance = round($principalamount - $principalrepayment, 2);

            $ed = ContractDateTime::where('cid', $cid)->value('effective_date');
            $duedate=date('Y-m-d', strtotime('+1 year', strtotime($ed)) );
            $dyear = date('y', strtotime($duedate));
            $dmonth = date('m', strtotime($duedate));
            if($dmonth !='02'){
            $dday = '30'; } else { $dday = '28'; }
            $date = $dyear.'-'.$dmonth.'-'.$dday;
            $ddate = date("Y-m-d",strtotime($date));

        $payment = new Repayments;
        $payment->fundid = $request->fundid;
        $payment->cid = $request->cid;
        $payment->principal = $principalamount;
        $payment->administrative_fee = $administrativefee;
        $payment->principal_repayment = $principalrepayment;
        $payment->emi_amount = $request->PaymentAmount;
        $payment->closing_balance = $closingbalance;
        $payment->payment_date = $request->DateofDeposit;
        $payment->payment_mode = $request->PaymentMode;
        $payment->cheque_date = $request->ChequeDate;
        $payment->cheque_number = $request->ChequeNumber;
        $payment->reference_no_transaction_no = $request->ReferenceNo;
        $payment->emi_refund = '1';
        $payment->due_date = $ddate;
        $payment->created_by = Auth::user()->id;
        $payment->created_on = date('Y-m-d');
        $payment->save();
        $paymentid = $payment->id;

        if ($request->proof != 0) {
            foreach ($request->proof as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/paymentsdocs' ;
                $file->move($path,$filename);
                PaymentDocs::create([
                    'paymentid' => $paymentid,
                    'fundid' => $request->fundid,
                    'file_name' => $file->getClientOriginalName(),
                    'doc_path' => $path,
                    'created_by'=>Auth::user()->id,
                    'created_at' => date('Y-m-d')
                ]);
            }
        }
    }
    else
    {

           $principalamount = Repayments::where('cid', $cid)->orderBy('id', 'desc')->value('closing_balance'); echo "<br>";
           $administrativefee = round(($interest/100*$principalamount)/12, 2);
            $principalrepayment = round($emi_amount - $administrativefee, 2);
            $closingbalance = round($principalamount - $principalrepayment, 2);

            $predueate = Repayments::where('cid', $cid)->orderBy('id', 'desc')->value('due_date');
            $nextdate = date('Y-m-d', strtotime('+1 month', strtotime($predueate)) );
            $dyear = date('y', strtotime($nextdate));
            $dmonth = date('m', strtotime($nextdate));
            if($dmonth !='02'){
            $dday = '30'; } else { $dday = '28'; }
            $date = $dyear.'-'.$dmonth.'-'.$dday;
            $ddate = date("Y-m-d",strtotime($date));

        $payment = new Repayments;
        $payment->fundid = $request->fundid;
        $payment->cid = $request->cid;
        $payment->principal = $principalamount;
        $payment->administrative_fee = $administrativefee;
        $payment->principal_repayment = $principalrepayment;
        $payment->emi_amount = $request->PaymentAmount;
        $payment->closing_balance = $closingbalance;
        $payment->payment_date = $request->DateofDeposit;
        $payment->payment_mode = $request->PaymentMode;
        $payment->cheque_date = $request->ChequeDate;
        $payment->cheque_number = $request->ChequeNumber;
        $payment->reference_no_transaction_no = $request->ReferenceNo;
        $payment->emi_refund = '1';
        $payment->due_date = $ddate;
        $payment->created_by = Auth::user()->id;
        $payment->created_on = date('Y-m-d');
        $payment->save();
        $paymentid = $payment->id;

        if ($request->proof != 0) {
            foreach ($request->proof as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/paymentsdocs' ;
                $file->move($path,$filename);
                PaymentDocs::create([
                    'paymentid' => $paymentid,
                    'fundid' => $request->fundid,
                    'file_name' => $file->getClientOriginalName(),
                    'doc_path' => $path,
                    'created_by'=>Auth::user()->id,
                    'created_at' => date('Y-m-d')
                ]);
            }
        }

    }
        $Emails = User::where('role_id', '1')->get();
        $business_name = FundingApplication::where('cid', $cid)->sum('business_name');
        $name = FundingApplication::where('cid', $cid)->sum('name');
        foreach ($Emails as $e)
        {
         Mail::to($e->email)->send(new Repaymentmail($business_name, $name));
        }
    Alert::success('Success', 'Repayment successful');
    return redirect()->route('allrepayment', array($request->fundid, $request->cid, $request->tfd));
   }
    public function viewpayment($fundid,$year,$month,$emi,$ddate)
    {
       $allapplication = Repayments::where('fundid', $fundid)->where('month', $month)->where('year', $year)->get();
       $pid = Repayments::where('fundid', $fundid)->where('month', $month)->where('year', $year)->value('id');
       return view('repayment.viewpayment', compact('allapplication', 'pid', 'fundid', 'year', 'month', 'emi', 'ddate'));
    }


    public function repaymentdhi()
    {   $key = "0";
        $allapplication = DB::select("CALL disbursement()");
        return view('repayment.dhi', compact('allapplication', 'key'));
    }

    public function repaymentdhisearch(Request $request)

    {
         $key = $request->key;
         $allapplication = DB::select("CALL disbursement_search($key)");
         return view('repayment.dhi1', compact('allapplication', 'key'));
    }

    public function repaymentdhisearchid($key)
    {
        $allapplication = DB::select("CALL disbursement()");
        return view('repayment.dhi1', compact('allapplication', 'key'));
    }

    public function cidsearch(Request $request)
    {
        $searchterm = $request->cid;
        $allapplication = DB::select("CALL disbursement_search($searchterm)");
        $count = count($allapplication);
        return view('repayment.dhisearch', compact('allapplication', 'count'));
    }

    public function import(Request $request)
    {

         $validatedData = $request->validate(['file' => 'required',]);
         Excel::import(new PaymentImport, $request->file('file'));
         return redirect()->route('repaymentdhi')->with('success', 'Payment Details are Imported to Database');
    }

    public function importdisbursement(Request $request)
    {
         $key = $request->key;
         $validatedData = $request->validate(['file' => 'required',]);
         Excel::import(new DisburseImport, $request->file('file'));
         $allapplication = FundingApplication::where('fundid', NULL)->where('disbursement', '0')->get();
         if($key == '0'){
             return view('fundrequest.importeddisbursedtlist', compact('allapplication'));
         }
         else
         {
            return redirect()->route('disburse_searchid', $key);
         }

    }


    public function saveimportdisburse()
    {
        $disbursements = FundingApplication::where('fundid', NULL)->where('disbursement', '0')->orderBy('id', 'desc')->get();
        foreach($disbursements as $dis)
        {
           $fudnid = Funding::where('opencohort', $dis->cohortopen)->where('opencohortno', $dis->cohortopenno)->value('id');
           $fundrequest = new FundingApplication;
           $flag = '1';
           $fundrequest::where('id', $dis->id)->update(['fundid' => $fudnid, 'disbursement' => $flag]);
        }
        $allapplication = FundingApplication::where('disbursement', '0')->get();
        $count = count($allapplication);
        return view('fundrequest.disbursementlist', compact('allapplication', 'count'))->with('success', 'Disbursement Details are Imported to Database');;

    }


    public function allrepaymentdhi($fundid, $cid, $key)
    {
	    $allapplication = Repayments::where('cid', $cid)->orderBy('id', 'asc')->get();
	    $name = FundingApplication::where('id', $fundid)->value('name');
        return view('repayment.allpaymentdhi', compact('fundid', 'cid', 'allapplication', 'name', 'key'));
    }

    public function updatepaymentdhi($fundid, $cid, $key)
    {
        $total_disbursed = FundingApplication::where('cid', $cid)->sum('actual_disbursed');
        $co = FundingApplication::where('id', $fundid)->sum('cohortopen');
        $cono = FundingApplication::where('id', $fundid)->sum('cohortopenno');
        $intres_rate = Funding::where('opencohort', $co)->where('opencohortno', $cono)->value('intres_rate');
        $tenure = Funding::where('opencohort', $co)->where('opencohortno', $cono)->value('tenure');

        $interest = (float)$intres_rate;
        $period = (float)$tenure;
        $loan_amount = (float)$total_disbursed;
        $interest = $interest / 1200;
        $amount = $interest * -$loan_amount * pow((1+$interest),$period) / (1 - pow((1+$interest), $period));
        $emior = (is_numeric($amount) && is_numeric(100) ) ? (ceil($amount/100)*100) : false;
        $penalty = Repayments::where('cid', $cid)->orderBy('id', 'desc')->value('penalty');
        if($penalty == '0')
        {
            $emi = $emior;
        }
        else
        {
            $emi = ($emior +  $penalty);
        }
       return view('repayment.updatepaymentdhi', compact('fundid', 'cid', 'emi', 'penalty', 'key'));
    }

    public function refundpaymentdhi($fundid, $cid, $tfd, $key)
    {
       return view('repayment.refund', compact('fundid', 'cid', 'tfd', 'key'));
    }

    public function insertpaymentdhi(Request $request)
    {

        $key = $request->key;
        $cid = $request->cid;
        $fundid = $request->fundid;
        $emi_amount = $request->PaymentAmount;
        $payment_date = $request->DateofDeposit;
        $total_disbursed = FundingApplication::where('cid', $cid)->sum('actual_disbursed');
        $co = FundingApplication::where('id', $fundid)->sum('cohortopen');
        $cono = FundingApplication::where('id', $fundid)->sum('cohortopenno');
        $interest = Funding::where('opencohort', $co)->where('opencohortno', $cono)->value('intres_rate');
        $tenure = Funding::where('opencohort', $co)->where('opencohortno', $cono)->value('tenure');
        $count = count(Repayments::where('cid', $cid)->get());

        $emiintrest = '5';
        $interest = (float)$emiintrest;
        $period = (float)$tenure;
        $loan_amount = (float)$total_disbursed;
        $interest = $interest / 1200;
        $amount = $interest * -$loan_amount * pow((1+$interest),$period) / (1 - pow((1+$interest), $period));
       echo $emi = (is_numeric($amount) && is_numeric(100) ) ? (ceil($amount/100)*100) : false; echo "<br>";


        $interest = Funding::where('opencohort', $co)->where('opencohortno', $cono)->value('intres_rate');
        $principalamount = FundingApplication::where('cid', $cid)->sum('total_disbursed');
        $administrativefee = round(($interest/100*$principalamount)/12, 2);
        $principalrepayment = round($emi_amount - $administrativefee, 2);
        $closingbalance = round($principalamount - $principalrepayment, 2);
       //case1 early date
        $ed = ContractDateTime::where('cid', $cid)->value('effective_date');
        $duedate=date('Y-m-d', strtotime('+1 year', strtotime($ed)) );

        $pd = date('Y-m-d',strtotime('2022-11-25'));
        $date1 = new DateTime($duedate);
        $date2 = new DateTime($pd);
        $interval = date_diff($date1, $date2);
        $edays = $interval->format('%a');
        $fine = '0';

        echo $intrest1=round(($interest/100*$principalamount*($edays/365)), 2);echo "<br>";
        echo $principle1 = (($principalamount + $intrest1) - $emi);echo "<br>";

            //case2 later date
            $date1 = date('Y-m-d',strtotime('2022-11-25'));
            $date1 = new DateTime($date1);
            $dyear = date('y', strtotime('2022-11-25'));echo "<br>";
            $dmonth = date('m', strtotime('2022-11-25'));echo "<br>";
            if($dmonth !='02'){
            $dday = '30'; } else { $dday = '28'; }
            $date = $dyear.'-'.$dmonth.'-'.$dday;
            $date2 = date("Y-m-d",strtotime($date));
            $date2 = new DateTime($date2);
           $interval = date_diff($date1, $date2);
           echo $ldays = $interval->format('%a')+1;echo "<br>";

           echo $intrest2=round(($interest/100*$principle1*($ldays/365)), 2);echo "<br>";
        echo $principle2 = ($principle1 + $intrest2);echo "<br>";

      /*  if( $days > 0) {
        $fine = round((($emi * 0.02 * $days)/365), 2);
            $delay = new DelayCount;
            $delay->cid = $cid;
            $delay->duedate = $duedate;
            $delay->paymentdate = $pd;
            $delay->save();
            $closingbalance = ($closingbalance + $fine);
        }
        $pm = date('m', strtotime($pd));
       /* if($pm > $dmonth)
        {
            $default = new PaymentDefaults;
            $default->cid = $cid;
            $default->duedate = $duedate;
            $default->emi = $request->PaymentAmount;
            $default->save();
        }
    $payment = new Repayments;
    $payment->fundid = $request->fundid;
    $payment->cid = $request->cid;
    $payment->principal = $principalamount;
    $payment->administrative_fee = $administrativefee;
    $payment->principal_repayment = $principalrepayment;
    $payment->emi_amount = $request->PaymentAmount;
    $payment->closing_balance = $closingbalance;
    $payment->payment_date = $request->DateofDeposit;
    $payment->payment_mode = $request->PaymentMode;
    $payment->cheque_date = $request->ChequeDate;
    $payment->cheque_number = $request->ChequeNumber;
    $payment->reference_no_transaction_no = $request->ReferenceNo;
    $payment->emi_refund = '0';
    $payment->due_date = $ddate;
    $payment->penalty = $fine;
    $payment->created_by = Auth::user()->id;
    $payment->created_on = date('Y-m-d');
    $payment->save();
    $paymentid = $payment->id;

    if ($request->proof != 0) {
        foreach ($request->proof as $file) {
            $filename = $file->getClientOriginalName();
            $path = public_path().'/uploads/paymentsdocs' ;
            $file->move($path,$filename);
            PaymentDocs::create([
                'paymentid' => $paymentid,
                'fundid' => $request->fundid,
                'file_name' => $file->getClientOriginalName(),
                'doc_path' => $path,
                'created_by'=>Auth::user()->id,
                'created_at' => date('Y-m-d')
            ]);
        }
    }

        ////

       /* if($count == '0')
          {
            $interest = Funding::where('opencohort', $co)->where('opencohortno', $cono)->value('intres_rate');
            $principalamount = FundingApplication::where('cid', $cid)->sum('total_disbursed');
            $administrativefee = round(($interest/100*$principalamount)/12, 2);
            $principalrepayment = round($emi_amount - $administrativefee, 2);
            $closingbalance = round($principalamount - $principalrepayment, 2);

            $ed = ContractDateTime::where('cid', $cid)->value('effective_date');
            $duedate=date('Y-m-d', strtotime('+1 year', strtotime($ed)) );
            $dyear = date('y', strtotime($duedate));
            $dmonth = date('m', strtotime($duedate));
            if($dmonth !='02'){
            $dday = '30'; } else { $dday = '28'; }
            $date = $dyear.'-'.$dmonth.'-'.$dday;
            $ddate = date("Y-m-d",strtotime($date));
            $pd = $request->DateofDeposit;
            $date1 = new DateTime($ddate);
            $date2 = new DateTime($pd);
            $interval = date_diff($date1, $date2);
            $days = $interval->format('%R%a');
            $fine = '0';

            if( $days > 0) {
            $fine = round((($emi * 0.02 * $days)/365), 2);
                $delay = new DelayCount;
                $delay->cid = $cid;
                $delay->duedate = $duedate;
                $delay->paymentdate = $pd;
                $delay->save();
                $closingbalance = ($closingbalance + $fine);
            }
            $pm = date('m', strtotime($pd));
            if($pm > $dmonth)
            {
                $default = new PaymentDefaults;
                $default->cid = $cid;
                $default->duedate = $duedate;
                $default->emi = $request->PaymentAmount;
                $default->save();
            }
        $payment = new Repayments;
        $payment->fundid = $request->fundid;
        $payment->cid = $request->cid;
        $payment->principal = $principalamount;
        $payment->administrative_fee = $administrativefee;
        $payment->principal_repayment = $principalrepayment;
        $payment->emi_amount = $request->PaymentAmount;
        $payment->closing_balance = $closingbalance;
        $payment->payment_date = $request->DateofDeposit;
        $payment->payment_mode = $request->PaymentMode;
        $payment->cheque_date = $request->ChequeDate;
        $payment->cheque_number = $request->ChequeNumber;
        $payment->reference_no_transaction_no = $request->ReferenceNo;
        $payment->emi_refund = '0';
        $payment->due_date = $ddate;
        $payment->penalty = $fine;
        $payment->created_by = Auth::user()->id;
        $payment->created_on = date('Y-m-d');
        $payment->save();
        $paymentid = $payment->id;

        if ($request->proof != 0) {
            foreach ($request->proof as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/paymentsdocs' ;
                $file->move($path,$filename);
                PaymentDocs::create([
                    'paymentid' => $paymentid,
                    'fundid' => $request->fundid,
                    'file_name' => $file->getClientOriginalName(),
                    'doc_path' => $path,
                    'created_by'=>Auth::user()->id,
                    'created_at' => date('Y-m-d')
                ]);
            }
        }
    }
    else
    {

        $interest = Funding::where('opencohort', $co)->where('opencohortno', $cono)->value('intres_rate');
        $principalamount = Repayments::where('cid', $cid)->orderBy('id', 'desc')->value('closing_balance'); echo "<br>";
        $administrativefee = round(($interest/100*$principalamount)/12, 2);

        $principalrepayment = round($emi_amount - $administrativefee, 2);
        $closingbalance = round($principalamount - $principalrepayment, 2);

        $predueate = Repayments::where('cid', $cid)->orderBy('id', 'desc')->value('due_date');
        $pm = date('m', strtotime($predueate));
        if($pm == '01'){
        list($year,$month,$day) = explode("-",$predueate);
        $month++;
        $day = min($day,date("t",strtotime($year."-".$month."-01")));
        $duedate = $year."-".$month."-".$day;
        }
        else {
        $duedate=date('Y-m-d', strtotime('+1 month', strtotime($predueate)) );
        $dyear = date('y', strtotime($duedate));
        $dmonth = date('m', strtotime($duedate));
        $dday = '30';
        $date = $dyear.'-'.$dmonth.'-'.$dday;
        $duedate = date("Y-m-d",strtotime($date));
        }
            $pd = $request->DateofDeposit;
            $date1 = new DateTime($duedate);
            $date2 = new DateTime($pd);
            $interval = date_diff($date1, $date2);
            $days = $interval->format('%R%a');
            $fine = '0';
            if( $days > 0) {
            $fine = round((($emi * 0.02 * $days)/365), 2);
                $delay = new DelayCount;
                $delay->cid = $cid;
                $delay->duedate = $duedate;
                $delay->paymentdate = $pd;
                $delay->save();
            }

            $pm = date('m', strtotime($pd));
            if($pm > $dmonth)
            {
                $default = new PaymentDefaults;
                $default->cid = $cid;
                $default->duedate = $duedate;
                $default->emi = $request->PaymentAmount;
                $default->save();
            }

        $payment = new Repayments;
        $payment->fundid = $request->fundid;
        $payment->cid = $request->cid;
        $payment->principal = $principalamount;
        $payment->administrative_fee = $administrativefee;
        $payment->principal_repayment = $principalrepayment;
        $payment->emi_amount = $request->PaymentAmount;
        $payment->closing_balance = $closingbalance;
        $payment->payment_date = $request->DateofDeposit;
        $payment->payment_mode = $request->PaymentMode;
        $payment->cheque_date = $request->ChequeDate;
        $payment->cheque_number = $request->ChequeNumber;
        $payment->reference_no_transaction_no = $request->ReferenceNo;
        $payment->emi_refund = '0';
        $payment->due_date = $duedate;
        $payment->penalty = $fine;
        $payment->created_by = Auth::user()->id;
        $payment->created_on = date('Y-m-d');
        $payment->save();
        $paymentid = $payment->id;

        if ($request->proof != 0) {
            foreach ($request->proof as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/paymentsdocs' ;
                $file->move($path,$filename);
                PaymentDocs::create([
                    'paymentid' => $paymentid,
                    'fundid' => $request->fundid,
                    'file_name' => $file->getClientOriginalName(),
                    'doc_path' => $path,
                    'created_by'=>Auth::user()->id,
                    'created_at' => date('Y-m-d')
                ]);
            }
        }
        if($emi_amount > $emi)
        {
            $delayid = DelayCount::where('cid', $cid)->orderBy('id', 'desc')->value('id');
            $delay = new DelayCount;
            $delay::where('id', $delayid)
            ->update(['active' => '1']);
        }

    }*/
    //return redirect()->route('allrepaymentdhi', array($request->fundid, $request->cid, $key))->with('success','Payment Updated Successfully');

    }

    public function insertrefund(Request $request)
    {
        $cid = $request->cid;
        $key = $request->key;
        $emi_amount = $request->PaymentAmount;
        $count = count(Repayments::where('cid', $cid)->get());
        if($count == '0')
          {
            $principalamount = FundingApplication::where('cid', $cid)->sum('total_disbursed');
            //$administrativefee = round((0.05*$principalamount)/12, 2);
            //$principalrepayment = round($emi_amount - $administrativefee, 2);
            $closingbalance = round($principalamount - $request->PaymentAmount, 2);

            $ed = ContractDateTime::where('cid', $cid)->value('effective_date');
            $duedate=date('Y-m-d', strtotime('+1 year', strtotime($ed)) );
            $dyear = date('y', strtotime($duedate));
            $dmonth = date('m', strtotime($duedate));
            if($dmonth !='02'){
            $dday = '30'; } else { $dday = '28'; }
            $date = $dyear.'-'.$dmonth.'-'.$dday;
            $ddate = date("Y-m-d",strtotime($date));

        $payment = new Repayments;
        $payment->fundid = $request->fundid;
        $payment->cid = $request->cid;
        $payment->principal = $principalamount;
        //$payment->administrative_fee = $administrativefee;
        //$payment->principal_repayment = $principalrepayment;
        $payment->emi_amount = $request->PaymentAmount;
        $payment->closing_balance = $closingbalance;
        $payment->payment_date = $request->DateofDeposit;
        $payment->payment_mode = $request->PaymentMode;
        $payment->cheque_date = $request->ChequeDate;
        $payment->cheque_number = $request->ChequeNumber;
        $payment->reference_no_transaction_no = $request->ReferenceNo;
        $payment->emi_refund = '1';
        $payment->due_date = $ddate;
        $payment->created_by = Auth::user()->id;
        $payment->created_on = date('Y-m-d');
        $payment->save();
        $paymentid = $payment->id;

        if ($request->proof != 0) {
            foreach ($request->proof as $file) {
                $path = $file->store('paymentsdocs');
                PaymentDocs::create([
                    'paymentid' => $paymentid,
                    'fundid' => $request->fundid,
                    'file_name' => $file->getClientOriginalName(),
                    'doc_path' => $path,
                    'created_by'=>Auth::user()->id,
                    'created_at' => date('Y-m-d')
                ]);
            }
        }

        $refund = new Refund;
        $refund->fundid = $request->fundid;
        $refund->refund_amount = $request->PaymentAmount;
        $refund->refund_date = $request->DateofDeposit;
        $refund->created_by = Auth::user()->id;
        $refund->created_on = date('Y-m-d');
        $refund->save();

        $actualdisbursed = FundingApplication::where('id', $request->fundid)->value('actual_disbursed');
        $newdisbursed = ($actualdisbursed - $request->PaymentAmount);
        $user = new FundingApplication;
        $user::where('id', $request->fundid)->update(['actual_disbursed' => $newdisbursed]);
    }
    else
    {
            $principalamount = Repayments::where('cid', $cid)->orderBy('id', 'desc')->value('closing_balance');
            //$administrativefee = round((0.05*$principalamount)/12, 2);
            //$principalrepayment = round($emi_amount - $administrativefee, 2);
            $closingbalance = round($principalamount - $request->PaymentAmount, 2);

            $predueate = Repayments::where('cid', $cid)->orderBy('id', 'desc')->value('due_date');
            $nextdate = date('Y-m-d', strtotime('+1 month', strtotime($predueate)) );
            $dyear = date('y', strtotime($nextdate));
            $dmonth = date('m', strtotime($nextdate));
            if($dmonth !='02'){
            $dday = '30'; } else { $dday = '28'; }
            $date = $dyear.'-'.$dmonth.'-'.$dday;
            $ddate = date("Y-m-d",strtotime($date));

        $payment = new Repayments;
        $payment->fundid = $request->fundid;
        $payment->cid = $request->cid;
        $payment->principal = $principalamount;
        //$payment->administrative_fee = $administrativefee;
        //$payment->principal_repayment = $principalrepayment;
        $payment->emi_amount = $request->PaymentAmount;
        $payment->closing_balance = $closingbalance;
        $payment->payment_date = $request->DateofDeposit;
        $payment->payment_mode = $request->PaymentMode;
        $payment->cheque_date = $request->ChequeDate;
        $payment->cheque_number = $request->ChequeNumber;
        $payment->reference_no_transaction_no = $request->ReferenceNo;
        $payment->emi_refund = '1';
        $payment->due_date = $ddate;
        $payment->created_by = Auth::user()->id;
        $payment->created_on = date('Y-m-d');
        $payment->save();
        $paymentid = $payment->id;

        if ($request->proof != 0) {
            foreach ($request->proof as $file) {
                $path = $file->store('paymentsdocs');
                PaymentDocs::create([
                    'paymentid' => $paymentid,
                    'fundid' => $request->fundid,
                    'file_name' => $file->getClientOriginalName(),
                    'doc_path' => $path,
                    'created_by'=>Auth::user()->id,
                    'created_at' => date('Y-m-d')
                ]);
            }
        }

    }
       return redirect()->route('allrepaymentdhi', array($request->fundid, $request->cid, $key))->with('success','Payment Updated Successfully');
}

    public function viewpaymentdhi($pid, $fundid, $cid, $key)
    {
       $allapplication = Repayments::where('id', $pid)->get();
       return view('repayment.viewpaymentdhi', compact('allapplication', 'pid', 'fundid', 'cid', 'key'));
    }

    public function paymentreview(Request $request)
    {
        $key = $request->key;
        $pid = $request->pid;
        $cid = $request->cid;
        $tfd = $request->tfd;
        $fundid = $request->fundid;
        $fundrequest = new Repayments;
        $fundrequest::where('id', $pid)
        ->update([
        'review_status' => $request->ReviewStatus,
        'review_remarks' => $request->remarks,
        'reviewed_by' => Auth::user()->id,
        'reviewed_on' => date('Y-m-d')
         ]);
         return redirect()->route('allrepaymentdhi', array($fundid, $cid, $key))->with('success','Payment Reviewed Successfully');
    }

    public function sitevisit()
    {
        $key = "0";
        $allapplication = ApplicationUserMap::orderBy('id', 'desc')->get();
        return view('sitevisit.index', compact('allapplication', 'key'));
    }

    public function sitevisitsearch(Request $request)
    {
        $key = $request->key;
        $allapplication = DB::table('tbl_user_fund_mapping')
        ->join('tb_dhifund_applications', 'tbl_user_fund_mapping.fundappid', '=', 'tb_dhifund_applications.id')
        ->where('tb_dhifund_applications.fundid', $key)
        ->select('tbl_user_fund_mapping.*')
        ->orderBy('tbl_user_fund_mapping.id', 'desc')
        ->get();

        return view('sitevisit.index1', compact('allapplication', 'key'));
    }

    public function sitevisitsearchid($key)
    {
        $allapplication = DB::table('tbl_user_fund_mapping')
        ->join('tb_dhifund_applications', 'tbl_user_fund_mapping.fundappid', '=', 'tb_dhifund_applications.id')
        ->where('tb_dhifund_applications.fundid', $key)
        ->select('tbl_user_fund_mapping.*')
        ->orderBy('tbl_user_fund_mapping.id', 'desc')
        ->get();
        return view('sitevisit.index1', compact('allapplication', 'key'));
    }


    public function sitevisitadd(Request $request)
    {
          $key = $request->key;

          if ($request->SiteVisitVirtualForm != 0) {
          foreach ($request->SiteVisitVirtualForm as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/virtualform' ;
                $file->move($path,$filename);
                SitevisitDateTime::create([
                    'fundid' => $request->fundid,
                    'mode' => $request->mode,
                    'date' => $request->svdate,
                    'time' => $request->svtime,
                    'agenda' => $request->Agencda,
                    'virtual_form' => $filename,
                    'doc_path' => $path,
                    'created_on' => date('Y-m-d'),
                    'created_by' => Auth::user()->id
                ]);
            }
        }
        else
        {
            SitevisitDateTime::create([
                'fundid' => $request->fundid,
                'mode' => $request->mode,
                'date' => $request->svdate,
                'time' => $request->svtime,
                'agenda' => $request->Agencda,
                'created_on' => date('Y-m-d'),
                'created_by' => Auth::user()->id
            ]);
        }


        $SitevisitLast = SitevisitLast::orderBy('id', 'desc')->get();
        foreach($SitevisitLast as $st){
            if($st->fundid != $request->fundid){
               $sv = new SitevisitLast;
               $sv->fundid = $request->fundid;
               $sv->lastvisitdate = $request->svdate;
               $sv->laststatus = "y";
               $sv->save();
            }
        }
        $myEmail = FundingApplication::where('id', $request->fundid)->value('email');
        Mail::to($myEmail)->send(new SendSiteVisit($request->fundid, $request->svdate, $request->svtime, $request->Agencda));
        Alert::success('Success', 'Site Visit Scheduled Successfully. A Mail has been to sent to the Applicant');
        return redirect()->route('scheduleindi', array($request->fundid, $key));
    }

    public function deletesitevist($id, $fundid, $key)
    {

        $user = new SitevisitDateTime;
        $user::where('id', $id)->delete();
        return redirect()->route('scheduleindi', array($fundid, $key))->with('success','Site Visit Removed Successfully !.');
    }

    public function deletesitevistupdate($id, $fundid, $key)
    {
        $rsu = new SitevisitDateTime;
            $rsu::where('id', $id)
           ->update([
               'observations' => "",
               'instructions' => "",
               'siteVisitReport' => "",
               'filename' => ""
           ]);
        return redirect()->route('scheduleindi', array($fundid, $key))->with('success','Site Visit Removed Successfully !.');
    }

    public function CtEdit(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $info = SitevisitDateTime::find($id);
            return response()->json($info);
        }
    }

    public function updatesitevisitdatetime(Request $request)
    {
        $id = $request->edit_id;
        $user = new SitevisitDateTime;
        $user::where('id', $id)
            ->update([
                'date' => $request->svdate,
                'time' => $request->svtime,
                'agenda' => $request->Agenda,
                'updated_by' => Auth::user()->id,
                'updated_on' => date('Y-m-d')
            ]);
       return redirect()->route('sitevisit')->with('success','Site Visit Date and Time Updated Successfully');

    }

    public function updatesitevisit($fundid, $key)
    {
	    $allapplication = SitevisitDateTime::where('fundid', $fundid)->orderBy('id', 'desc')->get();
	    $name = FundingApplication::where('id', $fundid)->value('name');
       return view('sitevisit.updatesitevisit', compact('allapplication', 'fundid', 'key', 'name'));

    }

    public function updatesitevisitent($fundid)
    {
       $allapplication = SitevisitDateTime::where('fundid', $fundid)->orderBy('id', 'desc')->get();
       return view('sitevisit.updatesitevisitent', compact('allapplication', 'fundid'));

    }

    public function esitevisit()
    {   $key = "0";
        $userid = $role=Auth::user()->id;
        $allapplication = ApplicationUserMap::where('userid', $userid)->get();
        return view('sitevisit.esitevisit', compact('allapplication', 'key'));
    }
    public function virtualforment(Request $request)
    {

            foreach ($request->VirtualForm as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/virtualforment' ;
                $file->move($path,$filename);
                $user = new SitevisitDateTime;
                $user::where('id', $request->siteid)->update(['virtual_form_ent' => $filename]);
	    }
	    $Emails = User::where('role_id', '1')->get();
            $business_name = FundingApplication::where('id', $request->fundid)->value('business_name');
            $name = FundingApplication::where('id', $request->fundid)->value('name');
            foreach ($Emails as $e)
            {
               Mail::to($e->email)->send(new Virtualmail($business_name, $name));
            }
            $fundid = SitevisitDateTime::where('id', $request->siteid)->value('fundid');
            Alert::success('Success', 'Virtual form Uploaded Successfully');
            return redirect()->route('scheduleindient', $fundid);
        }

    public function svid(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $info = SitevisitDateTime::find($id);
            return response()->json($info);
        }
    }

    public function addsitevisitactivity(Request $request)
    {
        $key = $request->key;
        $id = $request->siteid;
        $site = new SitevisitDateTime;
         if ($request->report != 0)
        {
            foreach ($request->report as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/sitevisitreport' ;
                $file->move($path,$filename);
                 $site::where('id', $id)
                ->update([
                'actualdate' => $request->svdate,
                'actualtime' => $request->svtime,
                'observations' => $request->Observations,
                'instructions' => $request->Instructions,
                'siteVisitReport' => $path,
                'filename' => $filename,
                'status' => $request->status,
                'updated_by' => Auth::user()->id,
                'updated_on' => date('Y-m-d')
            ]);
            }
        }
        else
        {
                 $site::where('id', $id)
                ->update([
                'actualdate' => $request->svdate,
                'actualtime' => $request->svtime,
                'observations' => $request->Observations,
                'instructions' => $request->Instructions,
                'status' => $request->status,
                'updated_by' => Auth::user()->id,
                'updated_on' => date('Y-m-d')
            ]);
        }
        $fundid = SitevisitDateTime::where('id', $id)->value('fundid');
        $svl = new SitevisitLast;
        $svl::where('fundid', $fundid)
                ->update([
                'lastvisitdate' => $request->svdate,
                'laststatus' => $request->status
		]);
      return redirect()->route('scheduleindi', array($fundid, $key))->with('success','Activity Updated Successfully!');
    }

    public function ReceiptUpload(Request $request)
    {
    if ($request->Receipt != 0)
        {
            $id = $request->rid;
            $site = new FundRequest;
            foreach ($request->Receipt as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/receipts' ;
                $file->move($path,$filename);
                 $site::where('id', $id)
                ->update([
                'receipt' => $filename
            ]);
            }
        }
        Alert::success('Success', 'You\'ve successfully uploaded the Receipt');
        return redirect()->route('fundrequest');
    }

}

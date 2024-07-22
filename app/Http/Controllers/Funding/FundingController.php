<?php

namespace App\Http\Controllers\funding;
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
use App\Mail\FundShortListMail;
use App\Mail\FundSelectedListMail;
use App\Models\User;
use App\Models\SLIStatus;
use App\Models\FundingApplication;
use App\Models\FundShortlistpanel;
use App\Models\Funding;
use App\Models\FundRequest;
use App\Models\DHICEO;
use App\Models\BusinessType;
use App\Models\DhiFundingApplicationDocs;
use App\Models\FundScreeningStatus;
use App\Models\FundShortlistStatus;
use App\Models\Presentationpanel;
use App\Models\PresentationDateTime;
use App\Models\PresentationStatus;
use App\Models\ContractDateTime;
use App\Models\DhiFundingContractDocs;
use App\Models\Attachment;
use App\Mail\SendUserDetail;
use App\Mail\FundAppmail;
use App\Models\ApplicationUserMap;
use App\Models\ICTemail;
use App\Exports\FundScoreExport;
use App\Imports\FundScoreImport;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\FundingApplicationDocument;
use DB;
use Mail;
use PDF;

class FundingController extends Controller
{
    public function index(){
        $funding = Funding::orderBy('id', 'desc')->get();
        return view('funding.index', compact('funding'));
    }

    public function addfunding(Request $request)
    {
        $user = new Funding;
        $user->opencohort = $request->opencohort;
        $user->opencohortno = $request->opencohortno;
        $user->title = $request->title;
        $user->details = $request->details;
        $user->submission_date = $request->date;
        $user->submission_time = $request->time;
        $user->email = $request->email;
        $user->phone = $request->phone;
	$user->tenure = $request->tenure;
	$user->emiintres_rate = $request->emi_fee;
        $user->intres_rate = $request->administrative_fee;
        $user->created_by = Auth::user()->id;
        $user->created_on = date('Y-m-d');
        $user->save();
        return redirect()->route('funding')->with('success','Funding Announcement Posted Successfully!');
    }

    public function editview(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $info = Funding::find($id);
            return response()->json($info);
        }
    }


    public function updateFunding(Request $request)
    {
        $id = $request->edit_id;
        $user = new Funding;
        $user::where('id', $id)
            ->update([
                'title' => $request->title,
                'details' => $request->details,
                'submission_date' => $request->date,
                'submission_time' => $request->time,
                'email' => $request->email,
                'phone' => $request->phone,
                'updated_by' => Auth::user()->id,
                'updated_on' => date('Y-m-d'),
		'tenure' => $request->tenure,
		'emiintres_rate' => $request->emi_fee,
                'intres_rate' => $request->administrative_fee
            ]);
        return redirect()->route('funding')->with('success','Funding Announcement Updated Successfully!');
    }

    public function deleteFunding($id)
    {
        $fund = new Funding;
        $fund::where('id', $id)->delete();
        return redirect()->route('funding')->with('success','Funding Announcement Removed Successfully!');
    }

    public function applicationlist(Request $request)
    {
        $funding = Funding::all();
        return view('applyfund.applist', compact('funding'));
    }

    public function viewfund($id)
    {
        $aid = $id;
        $funding = Funding::select('details')->where('id', $id)->get();
        return view('applyfund.viewdetail', compact('funding', 'aid'));
    }

    public function fundapplicationform($id)
    {
        $fundid = $id;
        return view('applyfund.applicationform', compact('fundid'));
    }


    public function applyDhiFunding(Request $request){
        $fundid = $request->fundid;

        $cohortopen = Funding::where('id', $fundid)->value('opencohort');
        $cohortopenno = Funding::where('id', $fundid)->value('opencohortno');

        $business_name = $request->business_name;
        $name = $request->name;
        $cid = $request->cid;
        $count = count(FundingApplication::where('cid', $cid)->get());
        if($count == '0'){
            $app = new FundingApplication;
            $app->fundid = $fundid;
            $app->cohortopen = $cohortopen;
            $app->cohortopenno = $cohortopenno;
            $app->cid = $request->cid;
            $app->initial = $request->initial;
            $app->name = $request->name;
            $app->dob = $request->dob;
            $app->mobileno = $request->mobileno;
            $app->email = $request->email;
            $app->current_address = $request->current_address;
            if($request->input('source_of_income') != ''){
            $app->source_of_income = implode(',', $request->input('source_of_income'));}
            $app->source_of_income_others = $request->source_of_income_others;
            $app->business_name = $request->business_name;
            $app->business_location = $request->business_location;
            $app->business_type = $request->business_type;
            $app->business_description = $request->business_description;
            if($request->input('business_sector') != ''){
            $app->business_sector = implode(',', $request->input('business_sector'));}
            $app->business_sector_others = $request->business_sector_others;
            $app->business_to_address = $request->business_to_address;
            if($request->input('business_activity') != ''){
            $app->business_activity = implode(',', $request->input('business_activity')); }
            if($request->input('business_status') != ''){
            $app->business_status = implode(',', $request->input('business_status')); }
            $app->revenue = $request->revenue;
            $app->customer_target = $request->customer_target;
            $app->no_of_current_customer = $request->no_of_current_customer;
            $app->company_start_date = $request->company_start_date;
            $app->money_invested = $request->money_invested;
            $app->raise_finance = $request->raise_finance;
            $app->employees_hired = $request->employees_hired;
            if($request->input('team') != ''){
            $app->team = implode(',', $request->input('team'));}
            $app->team_others = $request->team_others;
            $app->biggest_challenge = $request->biggest_challenge;
            $app->specific_resources = $request->specific_resources;
            $app->business_opportunity = $request->business_opportunity;
            $app->created_on = date('Y-m-d');
            $app->save();
            $appid = $app->id;

            $funding_app_docs = new FundingApplicationDocument();
            $funding_app_docs->appid = $appid;
            $relative_path = '/uploads/dhifundingapplicationdocs/'.$request->cid;
            $funding_app_docs->doc_path = $relative_path;
            $absolute_path = public_path().$relative_path ;

            $cat = 'photo';
            if ($request->passport_photo != 0) {
                foreach ($request->passport_photo as $file) {
                    $filename = $file->getClientOriginalName();
                    // $path = public_path().'/uploads/dhifundingapplicationdocs' ;
                    $file->move($absolute_path,$filename);
                    $funding_app_docs->passport = $filename;
                    // DhiFundingApplicationDocs::create([
                    //     'file_name' => $filename,
                    //     'appid' => $appid,
                    //     'filecat' => $cat,
                    //     'doc_path' => $path,
                    //     'created_at' => date('Y-m-d')
                    // ]);
                }
            }
            $cat = 'cv';
            if ($request->cv != 0) {
                foreach ($request->cv as $file) {
                    $filename = $file->getClientOriginalName();
                    // $path = public_path().'/uploads/dhifundingapplicationdocs' ;
                    $file->move($absolute_path,$filename);
                    $funding_app_docs->cv = $filename;
                    // DhiFundingApplicationDocs::create([
                    //     'file_name' => $filename,
                    //     'appid' => $appid,
                    //     'filecat' => $cat,
                    //     'doc_path' => $path,
                    //     'created_at' => date('Y-m-d')
                    // ]);
                }
            }

            $cat = 'CID';
            if ($request->CID != 0) {
                foreach ($request->CID as $file) {
                    $filename = $file->getClientOriginalName();
                    // $path = public_path().'/uploads/dhifundingapplicationdocs' ;
                    $file->move($absolute_path,$filename);
                    $funding_app_docs->cid = $filename;
                    // DhiFundingApplicationDocs::create([
                    //     'file_name' => $filename,
                    //     'appid' => $appid,
                    //     'filecat' => $cat,
                    //     'doc_path' => $path,
                    //     'created_at' => date('Y-m-d')
                    // ]);
                }
            }

            $cat = 'BusinessLicense';
            if ($request->BusinessLicense != 0) {
                foreach ($request->BusinessLicense as $file) {
                    $filename = $file->getClientOriginalName();
                    // $path = public_path().'/uploads/dhifundingapplicationdocs' ;
                    $file->move($absolute_path,$filename);
                    $funding_app_docs->business_license = $filename;
                    // DhiFundingApplicationDocs::create([
                    //     'file_name' => $filename,
                    //     'appid' => $appid,
                    //     'filecat' => $cat,
                    //     'doc_path' => $path,
                    //     'created_at' => date('Y-m-d')
                    // ]);
                }
            }

            $cat = 'CIBReport';
            if ($request->CIBReport != 0) {
                foreach ($request->CIBReport as $file) {
                    $filename = $file->getClientOriginalName();
                    // $path = public_path().'/uploads/dhifundingapplicationdocs' ;
                    $file->move($absolute_path,$filename);
                    $funding_app_docs->cib = $filename;
                    // DhiFundingApplicationDocs::create([
                    //     'file_name' => $filename,
                    //     'appid' => $appid,
                    //     'filecat' => $cat,
                    //     'doc_path' => $path,
                    //     'created_at' => date('Y-m-d')
                    // ]);
                }
            }

            $cat = 'NOC';
            if ($request->NOC != 0) {
                foreach ($request->NOC as $file) {
                    $filename = $file->getClientOriginalName();
                    // $path = public_path().'/uploads/dhifundingapplicationdocs' ;
                    $file->move($absolute_path,$filename);
                    $funding_app_docs->sc = $filename;
                    // DhiFundingApplicationDocs::create([
                    //     'file_name' => $filename,
                    //     'appid' => $appid,
                    //     'filecat' => $cat,
                    //     'doc_path' => $path,
                    //     'created_at' => date('Y-m-d')
                    // ]);
                }
            }

            $cat = 'ACCSMT';
            if ($request->ACCSMT != 0) {
                foreach ($request->ACCSMT as $file) {
                    $filename = $file->getClientOriginalName();
                    // $path = public_path().'/uploads/dhifundingapplicationdocs' ;
                    $file->move($absolute_path,$filename);
                    $funding_app_docs->acc_statement = $filename;
                    // DhiFundingApplicationDocs::create([
                    //     'file_name' => $filename,
                    //     'appid' => $appid,
                    //     'filecat' => $cat,
                    //     'doc_path' => $path,
                    //     'created_at' => date('Y-m-d')
                    // ]);
                }
            }

            $cat = 'TaxClearance';
            if ($request->TaxClearance != 0) {
                foreach ($request->TaxClearance as $file) {
                    $filename = $file->getClientOriginalName();
                    // $path = public_path().'/uploads/dhifundingapplicationdocs' ;
                    $file->move($absolute_path,$filename);
                    $funding_app_docs->tax_clearance = $filename;
                    // DhiFundingApplicationDocs::create([
                    //     'file_name' => $filename,
                    //     'appid' => $appid,
                    //     'filecat' => $cat,
                    //     'doc_path' => $path,
                    //     'created_at' => date('Y-m-d')
                    // ]);
                }
            }

            $cat = 'businessproposal';
            if ($request->business_proposal != 0) {
                foreach ($request->business_proposal as $file) {
                    $filename = $file->getClientOriginalName();
                    // $path = public_path().'/uploads/dhifundingapplicationdocs' ;
                    $file->move($absolute_path,$filename);
                    $funding_app_docs->business_proposal = $filename;
                    // DhiFundingApplicationDocs::create([
                    //     'file_name' => $filename,
                    //     'appid' => $appid,
                    //     'filecat' => $cat,
                    //     'doc_path' => $path,
                    //     'created_at' => date('Y-m-d')
                    // ]);
                }
            }
            $cat = 'recommendation';
            if ($request->recommendation != 0) {
                foreach ($request->recommendation as $file) {
                    $filename = $file->getClientOriginalName();
                    // $path = public_path().'/uploads/dhifundingapplicationdocs' ;
                    $file->move($absolute_path,$filename);
                    $funding_app_docs->recomendation = $filename;
                    // DhiFundingApplicationDocs::create([
                    //     'file_name' => $filename,
                    //     'appid' => $appid,
                    //     'filecat' => $cat,
                    //     'doc_path' => $path,
                    //     'created_at' => date('Y-m-d')
                    // ]);
                }
            }
            $funding_app_docs->save();

            $Emails = User::where('role_id', '1')->get();
            foreach ($Emails as $e){
                Mail::to($e->email)->send(new FundAppmail($business_name, $name));
            }
                Alert::success('Success', 'You\'ve successfully submitted the Application');
                return redirect()->route('applyfund');
        }else{
            Alert::success('Oops...', 'Application already Exists');
            return redirect()->route('applyfund');
        }
    }

    public function editdhifunding(Request $request)
    {
        $fundid = $request->fundid;
        $appid = $request->appid;

        $cohortopen = Funding::where('id', $fundid)->value('opencohort');
        $cohortopenno = Funding::where('id', $fundid)->value('opencohortno');
        $app = FundingApplication::findOrFail($appid);
        $app->fundid = $fundid;
        $app->cohortopen = $cohortopen;
        $app->cohortopenno = $cohortopenno;
        $app->cid = $request->cid;
        $app->initial = $request->initial;
        $app->name = $request->name;
        $app->dob = $request->dob;
        $app->mobileno = $request->mobileno;
        $app->email = $request->email;
        $app->current_address = $request->current_address;
        if($request->input('source_of_income') != ''){
        $app->source_of_income = implode(',', $request->input('source_of_income'));}
        $app->source_of_income_others = $request->source_of_income_others;
        $app->business_name = $request->business_name;
        $app->business_location = $request->business_location;
        $app->business_type = $request->business_type;
        $app->business_description = $request->business_description;
        if($request->input('business_sector') != ''){
        $app->business_sector = implode(',', $request->input('business_sector'));}
        $app->business_sector_others = $request->business_sector_others;
        $app->business_to_address = $request->business_to_address;
        if($request->input('business_activity') != ''){
        $app->business_activity = implode(',', $request->input('business_activity')); }
        if($request->input('business_status') != ''){
        $app->business_status = implode(',', $request->input('business_status')); }
        $app->revenue = $request->revenue;
        $app->customer_target = $request->customer_target;
        $app->no_of_current_customer = $request->no_of_current_customer;
        $app->company_start_date = $request->company_start_date;
        $app->money_invested = $request->money_invested;
        $app->raise_finance = $request->raise_finance;
        $app->employees_hired = $request->employees_hired;
        if($request->input('team') != ''){
        $app->team = implode(',', $request->input('team'));}
        $app->team_others = $request->team_others;
        $app->biggest_challenge = $request->biggest_challenge;
        $app->specific_resources = $request->specific_resources;
        $app->business_opportunity = $request->business_opportunity;
        $app->updated_on = date('Y-m-d');
        $app->save();
        $appid = $app->id;

        $cat = 'photo';
        $count = count(DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', $cat)->get());
        if($count == '0')
        {
        if ($request->passport_photo != 0) {
            foreach ($request->passport_photo as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/dhifundingapplicationdocs' ;
                $file->move($path,$filename);
                DhiFundingApplicationDocs::create([
                    'file_name' => $filename,
                    'appid' => $appid,
                    'filecat' => $cat,
                    'doc_path' => $path,
                    'created_at' => date('Y-m-d')
                ]);
            }
        }
    }else
    {
        if ($request->passport_photo != 0) {
            foreach ($request->passport_photo as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/applicationdocs' ;
                $file->move($path,$filename);
                $attach = new DhiFundingApplicationDocs;
                $attach::where('appid', $appid)->where('filecat', $cat)
                ->update([
                    'file_name' => $filename,
                    'appid' => $appid,
                    'filecat' => $cat,
                    'doc_path' => $path,
                    'created_at' => date('Y-m-d')
                ]);
            }
         }
    }

        $cat = 'cv';
        $count = count(DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', $cat)->get());
        if($count == '0')
        {
        if ($request->cv != 0) {
            foreach ($request->cv as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/dhifundingapplicationdocs' ;
                $file->move($path,$filename);
                DhiFundingApplicationDocs::create([
                    'file_name' => $filename,
                    'appid' => $appid,
                    'filecat' => $cat,
                    'doc_path' => $path,
                    'created_at' => date('Y-m-d')
                ]);
            }
        }
    }else
    {
        if ($request->cv != 0) {
            foreach ($request->cv as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/applicationdocs' ;
                $file->move($path,$filename);
                $attach = new DhiFundingApplicationDocs;
                $attach::where('appid', $appid)->where('filecat', $cat)
                ->update([
                    'file_name' => $filename,
                    'appid' => $appid,
                    'filecat' => $cat,
                    'doc_path' => $path,
                    'created_at' => date('Y-m-d')
                ]);
            }
         }
    }

        $cat = 'CID';
        $count = count(DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', $cat)->get());
        if($count == '0')
        {
        if ($request->CID != 0) {
            foreach ($request->CID as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/dhifundingapplicationdocs' ;
                $file->move($path,$filename);
                DhiFundingApplicationDocs::create([
                    'file_name' => $filename,
                    'appid' => $appid,
                    'filecat' => $cat,
                    'doc_path' => $path,
                    'created_at' => date('Y-m-d')
                ]);
            }
        }
    }else
    {
        if ($request->CID != 0) {
            foreach ($request->CID as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/applicationdocs' ;
                $file->move($path,$filename);
                $attach = new DhiFundingApplicationDocs;
                $attach::where('appid', $appid)->where('filecat', $cat)
                ->update([
                    'file_name' => $filename,
                    'appid' => $appid,
                    'filecat' => $cat,
                    'doc_path' => $path,
                    'created_at' => date('Y-m-d')
                ]);
            }
         }
    }

        $cat = 'BusinessLicense';
        $count = count(DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', $cat)->get());
        if($count == '0')
        {
        if ($request->BusinessLicense != 0) {
            foreach ($request->BusinessLicense as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/dhifundingapplicationdocs' ;
                $file->move($path,$filename);
                DhiFundingApplicationDocs::create([
                    'file_name' => $filename,
                    'appid' => $appid,
                    'filecat' => $cat,
                    'doc_path' => $path,
                    'created_at' => date('Y-m-d')
                ]);
            }
        }
    }else
    {
        if ($request->BusinessLicense != 0) {
            foreach ($request->BusinessLicense as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/applicationdocs' ;
                $file->move($path,$filename);
                $attach = new DhiFundingApplicationDocs;
                $attach::where('appid', $appid)->where('filecat', $cat)
                ->update([
                    'file_name' => $filename,
                    'appid' => $appid,
                    'filecat' => $cat,
                    'doc_path' => $path,
                    'created_at' => date('Y-m-d')
                ]);
            }
         }
    }

        $cat = 'CIBReport';
        $count = count(DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', $cat)->get());
        if($count == '0')
        {
        if ($request->CIBReport != 0) {
            foreach ($request->CIBReport as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/dhifundingapplicationdocs' ;
                $file->move($path,$filename);
                DhiFundingApplicationDocs::create([
                    'file_name' => $filename,
                    'appid' => $appid,
                    'filecat' => $cat,
                    'doc_path' => $path,
                    'created_at' => date('Y-m-d')
                ]);
            }
        }
    }else
    {
        if ($request->CIBReport != 0) {
            foreach ($request->CIBReport as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/applicationdocs' ;
                $file->move($path,$filename);
                $attach = new DhiFundingApplicationDocs;
                $attach::where('appid', $appid)->where('filecat', $cat)
                ->update([
                    'file_name' => $filename,
                    'appid' => $appid,
                    'filecat' => $cat,
                    'doc_path' => $path,
                    'created_at' => date('Y-m-d')
                ]);
            }
         }
    }

        $cat = 'NOC';
        $count = count(DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', $cat)->get());
        if($count == '0')
        {
        if ($request->NOC != 0) {
            foreach ($request->NOC as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/dhifundingapplicationdocs' ;
                $file->move($path,$filename);
                DhiFundingApplicationDocs::create([
                    'file_name' => $filename,
                    'appid' => $appid,
                    'filecat' => $cat,
                    'doc_path' => $path,
                    'created_at' => date('Y-m-d')
                ]);
            }
        }
    }else
    {
        if ($request->NOC != 0) {
            foreach ($request->NOC as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/applicationdocs' ;
                $file->move($path,$filename);
                $attach = new DhiFundingApplicationDocs;
                $attach::where('appid', $appid)->where('filecat', $cat)
                ->update([
                    'file_name' => $filename,
                    'appid' => $appid,
                    'filecat' => $cat,
                    'doc_path' => $path,
                    'created_at' => date('Y-m-d')
                ]);
            }
         }
    }

        $cat = 'ACCSMT';
        $count = count(DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', $cat)->get());
        if($count == '0')
        {
        if ($request->ACCSMT != 0) {
            foreach ($request->ACCSMT as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/dhifundingapplicationdocs' ;
                $file->move($path,$filename);
                DhiFundingApplicationDocs::create([
                    'file_name' => $filename,
                    'appid' => $appid,
                    'filecat' => $cat,
                    'doc_path' => $path,
                    'created_at' => date('Y-m-d')
                ]);
            }
        }
    }else
    {
        if ($request->ACCSMT != 0) {
            foreach ($request->ACCSMT as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/applicationdocs' ;
                $file->move($path,$filename);
                $attach = new DhiFundingApplicationDocs;
                $attach::where('appid', $appid)->where('filecat', $cat)
                ->update([
                    'file_name' => $filename,
                    'appid' => $appid,
                    'filecat' => $cat,
                    'doc_path' => $path,
                    'created_at' => date('Y-m-d')
                ]);
            }
         }
    }

        $cat = 'TaxClearance';
        $count = count(DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', $cat)->get());
        if($count == '0')
        {
        if ($request->TaxClearance != 0) {
            foreach ($request->TaxClearance as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/dhifundingapplicationdocs' ;
                $file->move($path,$filename);
                DhiFundingApplicationDocs::create([
                    'file_name' => $filename,
                    'appid' => $appid,
                    'filecat' => $cat,
                    'doc_path' => $path,
                    'created_at' => date('Y-m-d')
                ]);
            }
        }
    }else
    {
        if ($request->TaxClearance != 0) {
            foreach ($request->TaxClearance as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/applicationdocs' ;
                $file->move($path,$filename);
                $attach = new DhiFundingApplicationDocs;
                $attach::where('appid', $appid)->where('filecat', $cat)
                ->update([
                    'file_name' => $filename,
                    'appid' => $appid,
                    'filecat' => $cat,
                    'doc_path' => $path,
                    'created_at' => date('Y-m-d')
                ]);
            }
         }
    }

        $cat = 'businessproposal';
        $count = count(DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', $cat)->get());
        if($count == '0')
        {
        if ($request->business_proposal != 0) {
            foreach ($request->business_proposal as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/dhifundingapplicationdocs' ;
                $file->move($path,$filename);
                DhiFundingApplicationDocs::create([
                    'file_name' => $filename,
                    'appid' => $appid,
                    'filecat' => $cat,
                    'doc_path' => $path,
                    'created_at' => date('Y-m-d')
                ]);
            }
        }
    }else
    {
        if ($request->business_proposal != 0) {
            foreach ($request->business_proposal as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/applicationdocs' ;
                $file->move($path,$filename);
                $attach = new DhiFundingApplicationDocs;
                $attach::where('appid', $appid)->where('filecat', $cat)
                ->update([
                    'file_name' => $filename,
                    'appid' => $appid,
                    'filecat' => $cat,
                    'doc_path' => $path,
                    'created_at' => date('Y-m-d')
                ]);
            }
         }
    }
        $cat = 'recommendation';
        $count = count(DhiFundingApplicationDocs::where('appid', $appid)->where('filecat', $cat)->get());
        if($count == '0')
        {
        if ($request->recommendation != 0) {
            foreach ($request->recommendation as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/dhifundingapplicationdocs' ;
                $file->move($path,$filename);
                DhiFundingApplicationDocs::create([
                    'file_name' => $filename,
                    'appid' => $appid,
                    'filecat' => $cat,
                    'doc_path' => $path,
                    'created_at' => date('Y-m-d')
                ]);
            }
        }
    }else
    {
        if ($request->recommendation != 0) {
            foreach ($request->recommendation as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/applicationdocs' ;
                $file->move($path,$filename);
                $attach = new DhiFundingApplicationDocs;
                $attach::where('appid', $appid)->where('filecat', $cat)
                ->update([
                    'file_name' => $filename,
                    'appid' => $appid,
                    'filecat' => $cat,
                    'doc_path' => $path,
                    'created_at' => date('Y-m-d')
                ]);
            }
         }
    }
       return redirect()->route('screeningfund')->with('success','Application Updated successfully!');
    }

    public function screening()
    {
        $key = '0';
        $allapplication = FundingApplication::orderBy('id', 'desc')->get();
        return view('screeningfund.index', compact('allapplication', 'key'));
    }

    public function screeningsearch(Request $request)
    {
        $key = $request->key;
        $allapplication = FundingApplication::where('fundid', $key)->orderBy('id', 'desc')->get();
        return view('screeningfund.index1', compact('allapplication', 'key'));
    }

    public function screeningsearchid($key)
    {
        $allapplication = FundingApplication::where('fundid', $key)->orderBy('id', 'desc')->get();
        return view('screeningfund.index1', compact('allapplication', 'key'));
    }

    public function view_application($id, $key)
    {
        $appid = $id;
        $application =  FundingApplication::where('id', $appid)->get();
        $name =  FundingApplication::where('id', $appid)->value('name');
        return view('screeningfund.view', compact('application', 'appid', 'key', 'name'));
    }

    public function fundeditdhi($id)
    {
        $appid = $id;
        $application =  FundingApplication::where('id', $appid)->get();
        $fundid =  FundingApplication::where('id', $appid)->value('fundid');
        return view('screeningfund.edit', compact('application', 'appid', 'fundid'));
    }

    public function generateApplicationPDF($id)
    {
        $appid = $id;
        // $application =  FundingApplication::where('id', $appid)->get();
        $application = DB::table('tb_dhifund_applications as app')
        ->join('funding_application_documents as doc', 'doc.appid', 'app.id') 
        ->join('tb_fund_annoucements as fund', 'app.fundid', 'fund.id') 
        ->select('app.*',
        'doc.passport as passport',
        'doc.cid as cid_attach',
        'doc.sc as noc',
        'doc.cv as cv',
        'doc.cib as cib',
        'doc.acc_statement as acc_statement',
        'doc.business_proposal as business_proposal',
        'doc.business_license as business_license',
        'doc.tax_clearance as tax_clearance',
        'doc.recomendation as recomendation',
        'doc.doc_path as doc_path',
        'fund.title as fund_name'
        )
        ->where('app.id', $appid)->first();

        $pdf = PDF::loadView('screeningfund.app_pdf', compact('appid', 'application'));

        return $pdf->download('DHIFundApplication.pdf');
    }

    public function ScreeningStatusFast(Request $request)
    {
        $key=$request->key;
        $lic_rows = $request->rowss;
        for ($i = 0; $i < count($lic_rows['steps'][1]); $i++) {
            $count = count(FundScreeningStatus::where('appid', $lic_rows['steps'][1][$i])->get());
            if($count == '0')
            {
             $rs = new FundScreeningStatus;
             $rs->appid = $lic_rows['steps'][1][$i];
             $rs->status = $lic_rows['steps'][2][$i];
             $rs->created_by = Auth::user()->id;
             $rs->created_on = date('Y-m-d');
             $rs->save();
            }
            if($count == '1')
            {
             $id = FundScreeningStatus::where('appid', $lic_rows['steps'][1][$i])->value('id');
             $rsu = new FundScreeningStatus;
             $rsu::where('id', $id)
            ->update([
                'status' => $lic_rows['steps'][2][$i],
                'updated_by' => Auth::user()->id,
                'updated_on' => date('Y-m-d')
            ]);
            }

            $tu = FundingApplication::findOrFail($lic_rows['steps'][1][$i]);
            $tu->screening_status = '1';
            $tu->save();
        }
        if($key == '0'){
         return redirect()->route('screeningfund')->with('success','Screening Status Updated successfully!');
        }
        else
        {
            return redirect()->route('fs_searchid', $key)->with('success','Screening Status Updated successfully!');
        }
    }

    public function ScreeningStatus(Request $request)
    {
        $key = $request->key;
        $count = count(FundScreeningStatus::where('appid', $request->appid)->get());
        if($count == '0')
        {
        $ss = new FundScreeningStatus;
        $ss->appid = $request->appid;
        $ss->status = $request->screeningstatus;
        $ss->reason = $request->sreeningreason;
        $ss->created_by = Auth::user()->id;
        $ss->created_on = date('Y-m-d');
        $ss->save();
        $tu = FundingApplication::findOrFail($request->appid);
        $tu->screening_status = '1';
        $tu->save();
        }
        if($count == '1')
        {
            $id = FundScreeningStatus::where('appid', $request->appid)->value('id');
             $rsu = new FundScreeningStatus;
             $rsu::where('id', $id)
            ->update([
                'status' => $request->screeningstatus,
                'reason' => $request->sreeningreason,
                'updated_by' => Auth::user()->id,
                'updated_on' => date('Y-m-d')
            ]);
        }
        if($key == '0'){
        return redirect()->route('screeningfund')->with('success','Screening Status Updated successfully!');
        }
        else
        {
            return redirect()->route('fs_searchid', $key)->with('success','Screening Status Updated successfully!');
        }
    }

    public function shortlist(){
        $key = '0'; 

        $allapplication = DB::table('tb_dhifund_applications as app')
        ->leftjoin('tbl_sli_statuses as sl', 'app.id', '=', 'sl.appID')
        ->select(
            'app.*', 
            DB::raw('COALESCE(SUM(sl.score),0) as total_score'),
            DB::raw('ROUND(COALESCE(AVG(sl.score), 0), 2) as avg_score')
            )
        ->groupBy('app.id')
        ->orderBy('app.id', 'desc')
        ->get();

        $funding = Funding::all();

        return view('shortlistfund.index', compact('allapplication', 'funding'));
    }

    public function shortlistsearch(Request $request){  

        $fund_id = $request->key;
        $allapplication = DB::table('tb_dhifund_applications as app')
        ->leftjoin('tbl_sli_statuses as sl', 'app.id', '=', 'sl.appID')
        ->where('app.fundid', $fund_id)
        ->select(
            'app.*', 
            DB::raw('COALESCE(SUM(sl.score),0) as total_score'),
            DB::raw('ROUND(COALESCE(AVG(sl.score), 0), 2) as avg_score')
            )
        ->groupBy('app.id')
        ->orderBy('app.id', 'desc')
        ->get();

        $funding = Funding::all();

        return view('shortlistfund.index', compact('allapplication', 'funding'));
        // return view('shortlistfund.index1', compact('allapplication', 'funding'));
    }

    public function shortlistsearchid($key)
    {
        //$allapplication = FundingApplication::where('screening_status', '1')->orderBy('id', 'desc')-> get();
        $allapplication = DB::table('tb_dhifund_applications')
        ->join('tbl_fundscreening_statuses', 'tb_dhifund_applications.id', '=', 'tbl_fundscreening_statuses.appid')
        ->where('tbl_fundscreening_statuses.status', '1')
        ->where('tb_dhifund_applications.fundid', $key)
        ->select('tb_dhifund_applications.*')
        ->orderBy('tb_dhifund_applications.id', 'desc')
        ->get();
        return view('shortlistfund.index1', compact('allapplication', 'key'));
    }

    public function SlStatusFast(Request $request){
        $key = $request->key;
        $cohortopen = $request->cohortopen;
        $no = $request->cohortopenno;
        if($cohortopen == '' && $no == ''){
            $lic_rows = $request->rowss;
            if($request->fund_shortlist_score > 0){ // allowing only if the shortlisting scores are provided prior to final shortlisting
                for ($i = 0; $i < count($lic_rows['steps'][1]); $i++) {
                    $count = count(FundShortlistStatus::where('appid', $lic_rows['steps'][1][$i])->get());
                    $app = FundingApplication::find($lic_rows['steps'][1][$i]);
                    $app->shortlist_status = $lic_rows['steps'][2][$i];
                    $app->updated_on = date('Y-m-d');
                    $app->shortlist_on = date('Y-m-d');
                    $app->save();

                    // if($count == '0')
                    // {
                    //  $rs = new FundShortlistStatus;
                    //  $rs->appid = $lic_rows['steps'][1][$i];
                    //  $rs->status = $lic_rows['steps'][2][$i];
                    //  $rs->created_by = Auth::user()->id;
                    //  $rs->created_on = date('Y-m-d');
                    //  $rs->save();
                    // }
                    // if($count == '1')
                    // {
                    //  $id = FundShortlistStatus::where('appid', $lic_rows['steps'][1][$i])->value('id');
                    //  $rsu = new FundShortlistStatus;
                    //  $rsu::where('id', $id)
                    // ->update([
                    //     'status' => $lic_rows['steps'][2][$i],
                    //     'updated_by' => Auth::user()->id,
                    //     'updated_on' => date('Y-m-d')
                    // ]);
                    // }  
                }
            } 
            // if($key == '0'){
            return redirect()->route('shortlistfund')->with('success','Shortlist Status Updated successfully!');
            // }
            // else
            // {
            //     return redirect()->route('fsl_searchid', $key)->with('success','Shortlist Status Updated successfully!');
            // }
        }else{
        $allapplication = DB::table('tb_dhifund_applications')
                        // ->join('tbl_fundshortlist_statuses', 'tb_dhifund_applications.id', '=', 'tbl_fundshortlist_statuses.appid')
                        ->where('tb_dhifund_applications.cohortopen', $cohortopen)
                        ->where('tb_dhifund_applications.cohortopenno', $no)
                        ->where('tb_dhifund_applications.shortlist_status', '1')
                        // ->where('tbl_fundshortlist_statuses.status', '1')
                        ->select('tb_dhifund_applications.*')
                        ->get();
        return view('shortlistfund.shortlist', compact('allapplication', 'cohortopen', 'no'));

        }
    }

    public function funshortlistlink($cohortopen, $no)
    {
        $allapplication = DB::table('tb_dhifund_applications')
                        ->join('tbl_fundshortlist_statuses', 'tb_dhifund_applications.id', '=', 'tbl_fundshortlist_statuses.appid')
                        ->where('tb_dhifund_applications.cohortopen', $cohortopen)
                        ->where('tb_dhifund_applications.cohortopenno', $no)
                        ->where('tb_dhifund_applications.shortlist_status', '1')
                        ->where('tbl_fundshortlist_statuses.status', '1')
                        ->select('tb_dhifund_applications.*')
                        ->get();
        return view('shortlistfund.shortlist1', compact('allapplication', 'cohortopen', 'no'));
    }

    public function generateShortListPDF($cohortopen, $no)
    {
        $allapplication = FundingApplication::where('cohortopen', $cohortopen)
                                              ->where('cohortopenno', $no)
                                              ->where('screening_status', '1')
                                              ->where('shortlist_status', '1')
                                              ->get();
        $pdf = PDF::loadView('shortlistfund.shortlist', compact('allapplication', 'cohortopen', 'no'));
        return $pdf->download('Short List.pdf');
    }

    public function view_application_shortlist($id)
    {
        $appid = $id;
        // $application =  FundingApplication::where('id', $appid)->get();
        $fundid =  FundingApplication::where('id', $appid)->value('fundid');
        // $pannels = FundShortlistpanel::where('fundid', $fundid)->get();
        // $count = count(FundShortlistpanel::where('fundid', $fundid)->get());
        // $name =  FundingApplication::where('id', $appid)->value('name');

        $application = DB::table('tb_dhifund_applications as app')
                        ->join('funding_application_documents as doc', 'doc.appid', 'app.id') 
                        ->join('tb_fund_annoucements as fund', 'app.fundid', 'fund.id') 
                        ->select('app.*',
                        'doc.passport as passport',
                        'doc.cid as cid_attach',
                        'doc.sc as noc',
                        'doc.cv as cv',
                        'doc.cib as cib',
                        'doc.acc_statement as acc_statement',
                        'doc.business_proposal as business_proposal',
                        'doc.business_license as business_license',
                        'doc.tax_clearance as tax_clearance',
                        'doc.recomendation as recomendation',
                        'doc.doc_path as doc_path',
                        'fund.title as fund_name'
                        )
                        ->where('app.id', $appid)->first();

        $fundshortlist_score_exist = SLIStatus::where('fundid', $fundid)
                                    ->where('appID', $appid)
                                    ->get();

        
        if($fundshortlist_score_exist->isEmpty()){
            $pannels = DB::table('tbl_fundshortlistpannels as sp')
                ->join('tbl_panelroles as pr', 'pr.id', 'sp.role')
                ->where('sp.fundid', $fundid)
                ->select('sp.*',
                'pr.rolename as rolename', 
                DB::raw('"" as score'), 
                DB::raw('"" as remark'),
                DB::raw('"" as score_id'),
                )->get();
        }else{
            $pannels = DB::table('tbl_fundshortlistpannels as sp')
                ->leftjoin('tbl_sli_statuses as ss', 'sp.id', 'ss.pannelID')
                ->join('tbl_panelroles as pr', 'pr.id', 'sp.role')
                ->where('sp.fundid', $fundid)
                ->where('ss.appID', $appid)
                ->select('sp.*', 
                'ss.score as score', 
                'ss.remarks as remark', 
                'pr.rolename as rolename',
                'ss.id as score_id'
                )->get();
        }

        $avg_score = number_format(DB::table('tbl_sli_statuses')
                    ->where('tbl_sli_statuses.appID', $appid)
                    ->avg('score'), 2);

        return view('shortlistfund.view', compact('application', 'appid', 'pannels', 'avg_score'));
    }

    public function ShortlistStatus(Request $request)
    {
        $key = $request->key;
        $app = FundingApplication::findOrFail($request->appid);
        $totalscore = 0;
        $lic_rows = $request->rowss;
        if($lic_rows != null){
            for ($i = 0; $i < count($lic_rows['steps'][1]); $i++) {
                $shortlist_score = SLIStatus::find($lic_rows['steps'][4][$i]);
                if($shortlist_score != null){
                    $shortlist_score->score = $lic_rows['steps'][1][$i];
                    $shortlist_score->remarks = $lic_rows['steps'][2][$i];
                    $shortlist_score->updated_by = Auth::user()->id;
                    $shortlist_score->updated_at = date('Y-m-d');
                    $shortlist_score->save();
                }else{
                    $shortlist_new = new SLIStatus;
                    $shortlist_new->fundID = $app->fundid;
                    $shortlist_new->appID = $request->appid;
                    $shortlist_new->pannelID = $lic_rows['steps'][3][$i];
                    $shortlist_new->score = $lic_rows['steps'][1][$i];
                    $shortlist_new->remarks = $lic_rows['steps'][2][$i];
                    $shortlist_new->created_by = Auth::user()->id;
                    $shortlist_new->created_at = date('Y-m-d');
                    $shortlist_new->save();
                }
                
                $totalscore = ($totalscore + $lic_rows['steps'][1][$i]);
            }
            // $app->shortlist_status = '1';
            $app->sltotalscore = $totalscore;
            $app->save();
        }else{
            return redirect()->route('shortlistfund');
        }
        Session::flash('message', 'Short List Score Added Successfully !');
        Session::flash('class', 'success'); //you can replace success by [info,warning,danger]
        // if($key == '0'){
        return redirect()->route('shortlistfund')->with('success','Shortlist Status Updated successfully!');
        // }
        // else
        // {
        //     return redirect()->route('fsl_searchid', $key)->with('success','Shortlist Status Updated successfully!');
        // }
    }

    public function presentation(){
        $key = '0';

        $allapplication = DB::table('tb_dhifund_applications as app')
        ->leftjoin('tbl_presentation_dates as pp', 'app.id', '=', 'pp.appID')
        ->where('app.shortlist_status', 1)
        ->select('app.*',
        'pp.id as ppt_dateline_id',
        'pp.ppt_date as ppdate',
        'pp.ppt_time as pptime',
        )
        ->orderBy('app.id', 'desc')
        ->get();

        $funding = Funding::all();

        return view('presentation.index', compact('allapplication', 'funding'));
    }

    public function presentationsearch(Request $request)
    {
        $fund_id = $request->key;

        $allapplication = DB::table('tb_dhifund_applications as app')
        ->leftjoin('tbl_presentation_dates as pp', 'app.id', '=', 'pp.appID')
        ->where('app.shortlist_status', 1)
        ->where('app.fundid', $fund_id)
        ->select('app.*',
        'pp.id as ppt_dateline_id',
        'pp.ppt_date as ppdate',
        'pp.ppt_time as pptime',
        )
        ->orderBy('app.id', 'desc')
        ->get();

        $funding = Funding::all();

        return view('presentation.index', compact('allapplication', 'funding'));
        // return view('presentation.index1', compact('allapplication', 'key', 'funding'));
    }

    public function presentationsearchid($key)
    {
        $allapplication = FundingApplication::where('screening_status', '1')->where('shortlist_status', '1')
        ->where('presentation_status', '0')->orderBy('id', 'desc')->get();
        $allapplication = DB::table('tb_dhifund_applications')
        ->join('tbl_fundshortlist_statuses', 'tb_dhifund_applications.id', '=', 'tbl_fundshortlist_statuses.appid')
        ->where('tbl_fundshortlist_statuses.status', '1')
        ->where('tb_dhifund_applications.fundid', $key)
        ->select('tb_dhifund_applications.*')
        ->orderBy('tb_dhifund_applications.id', 'desc')
        ->get();

        return view('presentation.index1', compact('allapplication', 'key'));
    }

    public function presentation_view($appid)
    {
        // $application =  FundingApplication::where('id', $appid)->get();
        $fundid =  FundingApplication::where('id', $appid)->value('fundid');
	// $pannels = Presentationpanel::where('fundid', $fundid)->get();

    $fundppt_score_exist = PresentationStatus::where('fundID', $fundid)
                                    ->where('appID', $appid)
                                    ->get();

    if($fundppt_score_exist->isEmpty()){
        $pannels = DB::table('tbl_presentationpannels as pp')
            ->join('tbl_panelroles as pr', 'pr.id', 'pp.role')
            ->where('pp.fundid', $fundid)
            ->select('pp.*',
            'pr.rolename as rolename', 
            DB::raw('"" as score'), 
            DB::raw('"" as remark'),
            DB::raw('"" as ppt_score_id'),
            )->get();
    }else{
        $pannels = DB::table('tbl_presentationpannels as pp')
                ->leftjoin('tbl_presentation_statuses as ps', 'pp.id', 'ps.pannelID')
                ->join('tbl_panelroles as pr', 'pr.id', 'pp.role')
                ->where('pp.fundid', $fundid)
                ->where('ps.appID', $appid)
                ->select('pp.*',
                'ps.score as score',
                'ps.remarks as remark',
                'ps.id as ppt_score_id',
                'pr.rolename as rolename',
                )->get();
    }

	// $count = count(FundShortlistpanel::where('fundid', $fundid)->get());
        // $ssdate = FundScreeningStatus::where('appid', $appid)->value('created_on');
	// $sldate = FundShortlistStatus::where('appid', $appid)->value('created_on');
	// $name =  FundingApplication::where('id', $appid)->value('name');
	// $js = Presentationpanel::where('fundid', $fundid)->get();

    $application = DB::table('tb_dhifund_applications as app')
                        ->join('funding_application_documents as doc', 'doc.appid', 'app.id') 
                        ->join('tb_fund_annoucements as fund', 'app.fundid', 'fund.id')
                        ->leftjoin('tbl_presentation_dates as ppdate', 'ppdate.appID', 'app.id') 
                        ->select('app.*',
                        'doc.passport as passport',
                        'doc.cid as cid_attach',
                        'doc.sc as noc',
                        'doc.cv as cv',
                        'doc.cib as cib',
                        'doc.acc_statement as acc_statement',
                        'doc.business_proposal as business_proposal',
                        'doc.business_license as business_license',
                        'doc.tax_clearance as tax_clearance',
                        'doc.recomendation as recomendation',
                        'doc.doc_path as doc_path',
                        'fund.title as fund_name',
                        'ppdate.id as ppt_schedule_id',
                        )
                        ->where('app.id', $appid)->first();

	return view('presentation.view', compact(
		// 'count',
            // 'name',
            'appid',
            // 'sstatus',
            // 'slstatus',
            'application',
            'pannels',
            // 'ssdate',
            // 'sldate',
	    'fundid',
	    // 'js',
        // 'key'
        ));
    }

    public function addPPTDateTime(Request $request){
        $key = $request->key;
        $FundID = FundingApplication::where('id', $request->appid)->value('fundid');
        $user = new PresentationDateTime;
        $user->appID = $request->appid;
        $user->FundID = $FundID;
        $user->ppt_date = $request->pptdate;
        $user->ppt_time = $request->ppttime;
        $user->created_by = Auth::user()->id;
        $user->created_on = date('Y-m-d');
        $user->save();
        // if($key == '0'){
        return redirect()->route('presentation')->with('success','Presenation Date and Time Scheduled Successfully !.');
        // }
        // else
        // {
        //     return redirect()->route('fppt_searchid', $key)->with('success','Presenation Date and Time Scheduled Successfully !.');
        // }
    }

    public function interviewmail(Request $request)
    {
         $key = $request->key;  //need to check this key
         $cohortopen = $request->cohortopen;
         $no = $request->cohortopenno;
         $fid = Funding::where('opencohort', $cohortopen)->where('opencohortno', $no)->value('id');
        $mailslist = PresentationDateTime::where('FundID', $fid)->get();
        $appid = PresentationDateTime::where('FundID', $fid)->value('appID');
        $attachments = Attachment::where('cohortopen', $cohortopen)->where('cohortopenno', $no)->get();
        return view('presentation.maillist', compact('mailslist', 'appid', 'fid', 'cohortopen', 'no', 'attachments', 'key'));
    }

    public function mailattachment(Request $request)
    {
	    $cohortopen = $request->cohortopen;
	    $key = $request->key;
        $no = $request->cohortopenno;
        if ($request->attachment != 0) {
            foreach ($request->attachment as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/templates' ;
                $file->move($path,$filename);
                Attachment::create([
                    'cohortopen' => $cohortopen,
                    'cohortopenno' => $no,
                    'filename' => $filename,
                    'filepath' => $path
                ]);
            }
        }
        $fid = Funding::where('opencohort', $cohortopen)->where('opencohortno', $no)->value('id');
        $mailslist = PresentationDateTime::where('FundID', $fid)->get();
        $appid = PresentationDateTime::where('FundID', $fid)->value('appID');
        $attachments = Attachment::where('cohortopen', $cohortopen)->where('cohortopenno', $no)->get();
        return redirect()->route('mplist', [$fid, $cohortopen, $no, $key]);


    }

    public function deleteattachment($id, $fid, $cohortopen, $no, $key)
    {
        $user = new Attachment;
        $user::where('id', $id)->delete();
        return redirect()->route('mplist', [$fid, $cohortopen, $no, $key]);
    }
    public function mail_list($fid, $cohortopen, $no, $key)
    {
        $fid = Funding::where('opencohort', $cohortopen)->where('opencohortno', $no)->value('id');
        $mailslist = PresentationDateTime::where('FundID', $fid)->get();
        $appid = PresentationDateTime::where('FundID', $fid)->value('appID');
        $attachments = Attachment::where('cohortopen', $cohortopen)->where('cohortopenno', $no)->get();
        return view('presentation.maillist', compact('mailslist', 'appid', 'fid', 'cohortopen', 'no', 'attachments', 'key'));
    }

    public function sendmail_p($email, $date, $time, $appid, $fid, $cohortopen, $no, $key)
    {
        $rsu = new PresentationDateTime;
        $rsu::where('appID', $appid)->update(['sent' => '1', 'senton' => date('Y-m-d')]);
	    Mail::to($email)->send(new SendPresentationDate($cohortopen, $no, $date, $time));
	    Alert::success('Success', 'Email sent successfully');
        return redirect()->route('mplist', [$fid, $cohortopen, $no]);
    }

    public function sendmail_c($email, $date, $time, $appid, $fid, $cohortopen, $no, $key)
    {
        $rsu = new ContractDateTime;
        $rsu::where('appID', $appid)->update(['sent' => '1', 'senton' => date('Y-m-d')]);
        $venue = ContractDateTime::where('appID', $appid)->value('venue');
        $instruction = ContractDateTime::where('appID', $appid)->value('instructions');
	    Mail::to($email)->send(new SendContractDate($date, $time, $venue, $instruction));
	    Alert::success('Success', 'Email sent successfully');
        return redirect()->route('sendcontractmail', [$fid, $cohortopen, $no]);

    }

    public function sendmail_pselect(Request $request)
    {
	    $input = $request->all();
	    $key = $request->key;
        $pmail = $input['pmail'];
        $input['pmail'] = implode(',', $pmail);
        $addmorepost=$request->pmail;
        for ($i= 0; $i < count($addmorepost); $i++ )
          {
           $appID = $pmail[$i];
           $email = FundingApplication::where('id', $appID)->value('email');
           $cohortopen = FundingApplication::where('id', $appID)->value('cohortopen');
           $no = FundingApplication::where('id', $appID)->value('cohortopenno');
           $date = PresentationDateTime::where('appID', $appID)->value('ppt_date');
           $time = PresentationDateTime::where('appID', $appID)->value('ppt_time');

           Mail::to($email)->send(new SendPresentationDate($cohortopen, $no, $date, $time));
           $rsu = new PresentationDateTime;
           $rsu::where('appID', $appID)->update(['sent' => '1', 'senton' => date('Y-m-d')]);
           $fid = PresentationDateTime::where('appID', $appID)->value('FundID');
	     }
         Alert::success('Success', 'Emails sent successfully');
         return redirect()->route('mplist', [$fid, $cohortopen, $no, $key]);
    }

    public function mail_clist($fid, $cohortopen, $no)
    {
        $fid = Funding::where('opencohort', $cohortopen)->where('opencohortno', $no)->value('id');
        $mailslist = ContractDateTime::where('FundID', $fid)->get();
        $appid = ContractDateTime::where('FundID', $fid)->value('appID');
        return view('contractschedule.maillist', compact('mailslist', 'appid', 'fid', 'cohortopen', 'no'));
    }

    public function sendmail_cselect(Request $request)
    {
        $input = $request->all();
        $pmail = $input['pmail'];
        $input['pmail'] = implode(',', $pmail);
        $addmorepost=$request->pmail;
        for ($i= 0; $i < count($addmorepost); $i++ )
          {
           $appID = $pmail[$i];
           $fid = FundingApplication::where('id', $appID)->value('email');
           $email = FundingApplication::where('id', $appID)->value('email');
           $cohortopen = FundingApplication::where('id', $appID)->value('cohortopen');
           $no = FundingApplication::where('id', $appID)->value('cohortopenno');
           $date = ContractDateTime::where('appID', $appID)->value('sign_date');
           $time = ContractDateTime::where('appID', $appID)->value('sign_time');
           $venue = ContractDateTime::where('appID', $appID)->value('venue');
           $instruction = ContractDateTime::where('appID', $appID)->value('instructions');

           Mail::to($email)->send(new SendContractDate($date, $time, $venue, $instruction));
           $rsu = new ContractDateTime;
           $rsu::where('appID', $appID)->update(['sent' => '1', 'senton' => date('Y-m-d')]);
           $fid = ContractDateTime::where('appID', $appID)->value('FundID');
	     }
         Alert::success('Success', 'Emails sent successfully');
         return redirect()->route('mclist', [$fid, $cohortopen, $no]);
    }


    // public function addPPT(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $id = $request->id;
    //         $info = FundingApplication::find($id);
    //         return response()->json($info);
    //     }
    // }

    // public function addPPTEdit(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $id = $request->id;
    //         $info = PresentationDateTime::find($id);
    //         return response()->json($info);
    //     }
    // }

    public function updatePPTDate(Request $request)
    {
        $id = $request->edit_id;
        $user = new PresentationDateTime;
        $user::where('id', $id)
            ->update([
                'ppt_date' => $request->pptdate,
                'ppt_time' => $request->ppttime,
                'updated_by' => Auth::user()->id,
                'updated_on' => date('Y-m-d')
            ]);
        Session::flash('message', 'Presentation Date and Time Updated Successfully !');
        Session::flash('class', 'success'); //you can replace success by [info,warning,danger]
        return redirect()->route('presentation');
    }

    public function pptUpdatescore(Request $request)
    {
        $key = $request->key;
        $totalscore = 0;
        $app = FundingApplication::findOrFail($request->appid);
        $lic_rows = $request->rowss;
        if($lic_rows != null){
            for ($i = 0; $i < count($lic_rows['steps'][1]); $i++) {
                $ppt_score = PresentationStatus::find($lic_rows['steps'][4][$i]);
                if($ppt_score != null){
                    $ppt_score->score = $lic_rows['steps'][1][$i];
                    $ppt_score->remarks = $remarks = $lic_rows['steps'][2][$i];
                    $ppt_score->updated_by = Auth::user()->id;
                    $ppt_score->updated_at = date('Y-m-d');
                    $ppt_score->save();
                }else{
                    $ppt_score_new = new PresentationStatus;
                    $ppt_score_new->fundID = $request->fundid;
                    $ppt_score_new->appID = $request->appid;
                    $ppt_score_new->pannelID = $lic_rows['steps'][3][$i];
                    $ppt_score_new->score = $lic_rows['steps'][1][$i];
                    $ppt_score_new->remarks = $remarks = $lic_rows['steps'][2][$i];
                    $ppt_score_new->created_by = Auth::user()->id;
                    $ppt_score_new->created_at = date('Y-m-d');
                    $ppt_score_new->save();
                }
                $totalscore = ($totalscore + $lic_rows['steps'][1][$i]);
            }
            $app->presentation_status = 1;
            $app->totalscore = $totalscore;
            $app->save();
        }else{
            return redirect()->route('presentation');
        }

        Session::flash('message', 'Presentation Score Added Successfully !');
        Session::flash('class', 'success'); //you can replace success by [info,warning,danger]
        // if($key == '0'){
        return redirect()->route('presentation')->with('success','Presentation Score Added Successfully!');
        // }
        // else
        // {
        //     return redirect()->route('fppt_searchid', $key)->with('success','Presentation Score Added Successfully!');
        // }
    }

    public function pscore()
    {
        $key = '0';

        $allapplication = DB::table('tb_dhifund_applications as app')
        ->leftjoin('tbl_presentation_statuses as ps', 'app.id', '=', 'ps.appID')
        ->where('app.presentation_status', 1)
        ->select(
            'app.*', 
            DB::raw('COALESCE(SUM(ps.score),0) as total_score'),
            DB::raw('ROUND(COALESCE(AVG(ps.score), 0), 2) as avg_score')
            )
        ->groupBy('app.id')
        ->orderBy('app.totalscore', 'desc')
        ->get();

        $funding = Funding::all();

        return view('ppt_scores.index', compact('allapplication', 'funding'));
    }

    public function pscoresearch(Request $request)
    {
        $key = $request->key;

        $allapplication = DB::table('tb_dhifund_applications as app')
        ->leftjoin('tbl_presentation_statuses as ps', 'app.id', '=', 'ps.appID')
        ->where('app.fundid', $key)
        ->where('app.presentation_status', 1)
        ->select(
            'app.*', 
            DB::raw('COALESCE(SUM(ps.score),0) as total_score'),
            DB::raw('ROUND(COALESCE(AVG(ps.score), 0), 2) as avg_score')
            )
        ->groupBy('app.id')
        ->orderBy('app.totalscore', 'desc')
        ->get();

        $funding = Funding::all();

        return view('ppt_scores.index', compact('allapplication', 'funding'));
        // return view('ppt_scores.index1', compact('allapplication', 'key', 'funding'));
    }

    public function pscoresearchid($key)
    {
        $key = '0';
        $allapplication = DB::table('tb_dhifund_applications')
        ->join('tbl_fundshortlist_statuses', 'tb_dhifund_applications.id', '=', 'tbl_fundshortlist_statuses.appid')
        ->where('tbl_fundshortlist_statuses.status', '1')
        ->where('tb_dhifund_applications.fundid', $key)
        ->select('tb_dhifund_applications.*')
        ->orderBy('tb_dhifund_applications.totalscore', 'desc')
        ->get();

        return view('ppt_scores.index1', compact('allapplication', 'key'));
    }

    public function pptscore_view($appid)
    {
        // $application =  FundingApplication::where('id', $appid)->get();
        $name =  FundingApplication::where('id', $appid)->value('name');
        $fundid =  FundingApplication::where('id', $appid)->value('fundid');
        // $pannels = Presentationpanel::where('fundid', $fundid)->get();
        // $ssdate = FundScreeningStatus::where('appid', $appid)->value('created_on');
        // $sldate = FundShortlistStatus::where('appid', $appid)->value('created_on');
        $application = DB::table('tb_dhifund_applications as app')
                        ->join('funding_application_documents as doc', 'doc.appid', 'app.id') 
                        ->join('tb_fund_annoucements as fund', 'app.fundid', 'fund.id')
                        ->leftjoin('tbl_presentation_dates as ppdate', 'ppdate.appID', 'app.id') 
                        ->select('app.*',
                        'doc.passport as passport',
                        'doc.cid as cid_attach',
                        'doc.sc as noc',
                        'doc.cv as cv',
                        'doc.cib as cib',
                        'doc.acc_statement as acc_statement',
                        'doc.business_proposal as business_proposal',
                        'doc.business_license as business_license',
                        'doc.tax_clearance as tax_clearance',
                        'doc.recomendation as recomendation',
                        'doc.doc_path as doc_path',
                        'fund.title as fund_name',
                        'ppdate.id as ppt_schedule_id',
                        )
                        ->where('app.id', $appid)->first();

        $pannels = DB::table('tbl_presentationpannels as pp')
                    ->leftjoin('tbl_presentation_statuses as ps', 'pp.id', 'ps.pannelID')
                    ->join('tbl_panelroles as pr', 'pr.id', 'pp.role')
                    ->where('pp.fundid', $fundid)
                    ->where('ps.appID', $appid)
                    ->select('pp.*',
                    'ps.score as score',
                    'ps.remarks as remark',
                    'ps.id as ppt_score_id',
                    'pr.rolename as rolename',
                    )->get();

        $avg_score = number_format(DB::table('tbl_presentation_statuses as ps')
                    ->where('ps.appID', $appid)
                    ->avg('score'), 2);
        
        return view('ppt_scores.view', compact(
            'appid',
            // 'sstatus',
            // 'slstatus',
            'application',
            'pannels',
            // 'ssdate',
            // 'sldate',
            'fundid',
            // 'name',
            'avg_score'
        ));
    }

    public function Selection(Request $request){
        $key = $request->key;
        $cohortopen = $request->cohortopen;
        $no = $request->cohortopenno;
        if($cohortopen == '' && $no == ''){
        $lic_rows = $request->rowss;
        for ($i = 0; $i < count($lic_rows['steps'][1]); $i++) {
             $rsu = FundingApplication::where('id', $lic_rows['steps'][1][$i])
            ->update([
                'selected' => $lic_rows['steps'][3][$i],
                'selected_by' => Auth::user()->id,
                'selected_on' => date('Y-m-d')
            ]);

        }
        // if($key == '0'){
        return redirect()->route('presentationscore')->with('success','Selection Status Updated Successfully');
        // }
        // else
        // {
        //     return redirect()->route('fpptscore_searchid', $key)->with('success','Selection Status Updated Successfully');
        // }
    }
    else{
        $allapplication = DB::table('tb_dhifund_applications')
                           ->where('cohortopen', $cohortopen)
                           ->where('cohortopenno', $no)
                          ->where('selected', '1')
                          ->orderBy('totalscore', 'desc')->get();

     return view('ppt_scores.selectedlist', compact('allapplication', 'cohortopen', 'no'));
    }

    }

    public function contractschedule(){
        $key = '0';

        $allapplication = DB::table('tb_dhifund_applications as app')
        ->leftjoin('tbl_presentation_statuses as ps', 'app.id', '=', 'ps.appID')
        ->where('app.presentation_status', 1)
        ->where('app.selected', 1)
        ->select(
            'app.*', 
            DB::raw('COALESCE(SUM(ps.score),0) as total_score'),
            DB::raw('ROUND(COALESCE(AVG(ps.score), 0), 2) as avg_score')
            )
        ->groupBy('app.id')
        ->orderBy('app.totalscore', 'desc')
        ->get();

        $funding = Funding::all();
        return view('contractschedule.index', compact('allapplication', 'funding'));
    }

    public function cssearch(Request $request)
    {
        $key = $request->key;

        $allapplication = DB::table('tb_dhifund_applications as app')
        ->leftjoin('tbl_presentation_statuses as ps', 'app.id', '=', 'ps.appID')
        ->where('app.presentation_status', 1)
        ->where('app.selected', 1)
        ->where('app.fundid', $key)
        ->select(
            'app.*', 
            DB::raw('COALESCE(SUM(ps.score),0) as total_score'),
            DB::raw('ROUND(COALESCE(AVG(ps.score), 0), 2) as avg_score')
            )
        ->groupBy('app.id')
        ->orderBy('app.totalscore', 'desc')
        ->get();

        $funding = Funding::all();
        return view('contractschedule.index', compact('allapplication', 'funding'));
        // return view('contractschedule.index1', compact('allapplication', 'key', 'funding'));
    }
    public function cssearchid($key)
    {
        $allapplication = FundingApplication::where('screening_status', '1')
        ->where('shortlist_status', '1')->where('presentation_status', '1')->where('selected', '1')
        ->where('fundid', $key)
        ->orderBy('totalscore', 'desc')
        ->get();
        return view('contractschedule.index1', compact('allapplication', 'key'));
    }

    public function addCT(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $info = FundingApplication::find($id);
            return response()->json($info);
        }
    }

    public function ContractDateTime(Request $request)
    {
        $key=$request->key;
        $FundID = FundingApplication::where('id', $request->appid)->value('fundid');
        $cid = FundingApplication::where('id', $request->appid)->value('cid');
        $user = new ContractDateTime;
        $user->appID = $request->appid;
        $user->FundID = $FundID;
        $user->cid = $cid;
        $user->sign_date = $request->ctdate;
        $user->sign_time = $request->cttime;
        $user->venue = $request->ctvenue;
        $user->instructions = $request->ctinstruction;
        $user->created_by = Auth::user()->id;
        $user->created_on = date('Y-m-d');
        $user->save();
        $date = $request->ctdate;
        $time = $request->cttime;
        $venue = $request->ctvenue;
        $instruction = $request->ctinstruction;
        $myEmail = FundingApplication::where('id', $request->appid)->value('email');
       // Mail::to($myEmail)->send(new SendContractDate($date, $time, $venue, $instruction));

        $password="pass@123";
        $name = FundingApplication::where('id', $request->appid)->value('name');
        $user = new User();
        $user->password = Hash::make($password);
        $user->email = $myEmail;
        $user->name = $name;
        $user->role_id = '2';
        $user->save();
        $userid=$user->id;

        $map = new ApplicationUserMap;
        $map->fundappid = $request->appid;
        $map->userid = $userid;
        $map->save();

	Mail::to($myEmail)->send(new SendUserDetail($myEmail, $password));
	Alert::success('Success', 'Email sent successfully along with user credentials');
    // if($key == '0'){
    return redirect()->route('contractschedule');
    // }
    // else
    // {
    //     return redirect()->route('cs_searchid', $key);
    // }
    }

    public function contractemail(Request $request)
    {
         $key = $request->key;
         $key = 0; //need to check this key
         $cohortopen = $request->cohortopen;
         $no = $request->cohortopenno;
         $fid = Funding::where('opencohort', $cohortopen)->where('opencohortno', $no)->value('id');
         $mailslist = ContractDateTime::where('FundID', $fid)->get();
         $appid = ContractDateTime::where('FundID', $fid)->value('appID');
         return view('contractschedule.maillist', compact('mailslist', 'appid', 'fid', 'cohortopen', 'no', 'key'));
    }

    public function CtEdit(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $info = ContractDateTime::find($id);
            return response()->json($info);
        }
    }

    public function updateCT(Request $request)
    {
        $id = $request->edit_id;
        $user = new ContractDateTime;
        $user::where('id', $id)
            ->update([
                'sign_date' => $request->ctdate,
                'sign_time' => $request->cttime,
                'venue' => $request->ctvenue,
                'instructions' => $request->ctinstruction,
                'updated_by' => Auth::user()->id,
                'updated_on' => date('Y-m-d')
            ]);
        return redirect()->route('contractschedule')->with('success','Contract Signing Date and Time Updated Successfully!');
    }

    public function contractsign()
    {
       $key = '0';

        $allapplication = DB::table('tb_dhifund_applications as app')
        ->join('tbl_contract_dates as contract', 'app.id', 'contract.appID')
        ->leftjoin('tbl_dhicontractapplication_docs as doc', 'app.id', '=', 'doc.appid')
        ->where('app.presentation_status', 1)
        ->where('app.selected', 1)
        ->select(
            'app.*', 
            'doc.id as contract_id',
            'doc.doc_path as doc_path',
            'doc.file_name as file_name',
            )
        ->orderBy('app.id', 'desc')
        ->get();

        $funding = Funding::all();

        return view('contractsign.index', compact('allapplication', 'funding'));
    }


    public function csignsearch(Request $request)
    {
        $key = $request->key;

        $allapplication = DB::table('tb_dhifund_applications as app')
        ->join('tbl_contract_dates as contract', 'app.id', 'contract.appID')
        ->leftjoin('tbl_dhicontractapplication_docs as doc', 'app.id', '=', 'doc.appid')
        ->where('app.presentation_status', 1)
        ->where('app.selected', 1)
        ->where('app.fundid', $key)
        ->select(
            'app.*', 
            'doc.id as contract_id',
            'doc.doc_path as doc_path',
            'doc.file_name as file_name',
            )
        ->orderBy('app.id', 'desc')
        ->get();

         $funding = Funding::all();
        return view('contractsign.index', compact('allapplication', 'funding'));
    }

    public function csignsearchid($key)
    {
        $allapplication = FundingApplication::where('screening_status', '1')->where('shortlist_status', '1')
        ->where('presentation_status', '1')
        ->where('selected', '1')
        ->where('fundid', $key)
        ->orderBy('id', 'desc')
        ->get();
        return view('contractsign.index', compact('allapplication', 'key'));
    }

    public function generatecontract($appid, $sstatus, $slstatus)
    {
        $application =  FundingApplication::where('id', $appid)->get();
        $name =  FundingApplication::where('id', $appid)->value('name');
        $cid =  FundingApplication::where('id', $appid)->value('cid');
        $business_name =  FundingApplication::where('id', $appid)->value('business_name');
        $business_licence_no =  FundingApplication::where('id', $appid)->value('business_licence_no');
        $business_location =  FundingApplication::where('id', $appid)->value('business_location');
        $mobileno =  FundingApplication::where('id', $appid)->value('mobileno');
        $bt =  FundingApplication::where('id', $appid)->value('business_type');
        $business_type =  BusinessType::where('id', $bt)->value('business_type');
        $effective_date =  ContractDateTime::where('appID', $appid)->value('effective_date');
        $total_disbursed =  FundingApplication::where('id', $appid)->value('total_disbursed');
        $total_disbursed_words =  FundRequest::where('fundid', $appid)->value('tranche');
        $ceo =  DHICEO::where('id', '1')->value('name');
        $fundid =  FundingApplication::where('id', $appid)->value('fundid');
        $pannels = Presentationpanel::where('fundid', $appid)->get();
        $ssdate = FundScreeningStatus::where('appid', $appid)->value('created_on');
        $sldate = FundShortlistStatus::where('appid', $appid)->value('created_on');
        return view('contractsign.view', compact(
            'name',
            'cid',
            'business_name',
            'effective_date',
            'business_licence_no',
            'business_location',
            'business_type',
            'total_disbursed',
            'mobileno',
            'total_disbursed_words',
            'ceo',
            'appid',
            'sstatus',
            'slstatus',
            'application',
            'pannels',
            'ssdate',
            'sldate',
            'fundid'
        ));
    }

   public function generateContractPDF($id)
    {
        $appid = $id;
        $application =  FundingApplication::where('id', $appid)->get();
        $name =  FundingApplication::where('id', $appid)->value('name');
        $cid =  FundingApplication::where('id', $appid)->value('cid');
        $business_name =  FundingApplication::where('id', $appid)->value('business_name');
        $business_licence_no =  FundingApplication::where('id', $appid)->value('business_licence_no');
        $business_location =  FundingApplication::where('id', $appid)->value('business_location');
        $mobileno =  FundingApplication::where('id', $appid)->value('mobileno');
        $bt =  FundingApplication::where('id', $appid)->value('business_type');
        $business_type =  BusinessType::where('id', $bt)->value('business_type');
        $effective_date =  ContractDateTime::where('appID', $appid)->value('effective_date');
        $total_disbursed =  FundingApplication::where('id', $appid)->value('total_disbursed');
        $total_disbursed_words =  FundRequest::where('fundid', $appid)->value('tranche');
        $ceo =  DHICEO::where('id', '1')->value('name');
        $pdf = PDF::loadView('contractsign.contract', compact(
            'appid',
            'application',
            'name',
            'cid',
            'business_name',
            'effective_date',
            'business_licence_no',
            'business_location',
            'business_type',
            'total_disbursed',
            'mobileno',
            'total_disbursed_words',
            'ceo',
            ));
        return $pdf->download('Contract.pdf');
    }

    public function ContractUpload(Request $request)
    {
        $key = $request->key;
        $app_id = $request->app_id;
        $cid =  FundingApplication::where('id', $app_id)->value('cid');
        if ($request->contract != 0) {
            foreach ($request->contract as $file) {
                $filename = $file->getClientOriginalName();
                $relative_path = '/uploads/contractdocs/'.$cid;
                $absolute_path = public_path().'/uploads/contractdocs/'.$cid ;
                $file->move($absolute_path,$filename);
                DhiFundingContractDocs::create([
                    'appid' => $app_id,
                    'cid' => $cid,
                    'file_name' => $filename,
                    'doc_path' => $relative_path,
                    'created_at' => date('Y-m-d'),
                    'created_by' => Auth::user()->id
                ]);
            }
            // echo $ed = $request->effectivedate;
            $id =  ContractDateTime::where('appID', $app_id)->value('id');
            $contract = new ContractDateTime;
            $contract::where('id', $id)
            ->update([
                'effective_date' => $request->effectivedate
            ]);

           $fund = new FundingApplication;
            $fund::where('id', $app_id)
            ->update([
                'contractupload' => 1
            ]);
        }
        // if($key == '0'){
        return redirect()->route('contractsign')->with('success','Contract Uploaded Successfully!');
        // }
        // else
        // {
        //  return redirect()->route('contractsignsearchid', $key)->with('success','Contract Uploaded Successfully!');
        // }

    }

    public function export($fundid)
    {
        return Excel::download(new FundScoreExport($fundid), 'FundScore.xlsx');
    }

    public function import(Request $request)
    {
         $appid = $request->appid;
         $sstatus = $request->sstatus;
         $slstatus = $request->slstatus;
         $validatedData = $request->validate(['file' => 'required',]);
         Excel::import(new FundScoreImport($appid),$request->file('file'));

         $totalscore = '0';
         $Scores = PresentationStatus::where('appID', $appid)->get();
         foreach($Scores as $score)
         {
            $totalscore = $totalscore + $score->score;
         }

        $tu = FundingApplication::findOrFail($appid);
        $tu->presentation_status = '1';
        $tu->totalscore = $totalscore;
        $tu->save();

         return redirect()->route('p_app_details', [$appid, $sstatus, $slstatus])->with('success', 'The file has been Excel Imported to Database');
    }

    public function sendshortlistmail($cohortopen, $no, $key)
      {
        $data["allapplication"] = DB::table('tb_dhifund_applications')
        ->join('tbl_fundshortlist_statuses', 'tb_dhifund_applications.id', '=', 'tbl_fundshortlist_statuses.appid')
        ->where('tb_dhifund_applications.cohortopen', $cohortopen)
        ->where('tb_dhifund_applications.cohortopenno', $no)
        ->where('tb_dhifund_applications.shortlist_status', '1')
        ->where('tbl_fundshortlist_statuses.status', '1')
        ->select('tb_dhifund_applications.*')
        ->get();

          $Emails = ICTemail::all();
            foreach ($Emails as $e)
            {
                $email=$e->email;
                Mail::to($email)->send(new FundShortListMail($cohortopen, $no));
            }

        Alert::success('Success', 'Email sent successfully');
        $allapplication = FundingApplication::where('screening_status', '1')->orderBy('id', 'desc')-> get();
           if($key == '0'){
            return redirect()->route('shortlistfund');
            }
            else
            {
                return redirect()->route('fsl_searchid', $key);
            }
 }

 public function sendselectedmail($cohortopen, $no){
        $data["allapplication"] = DB::table('tb_dhifund_applications')
            ->where('cohortopen', $cohortopen)
            ->where('cohortopenno', $no)
            ->where('selected', '1')
            ->orderBy('totalscore', 'desc')->get();

        $Emails = ICTemail::all();
            foreach ($Emails as $e)
            {
                $email=$e->email;
                Mail::to($email)->send(new FundSelectedListMail($cohortopen, $no));
            }
         Alert::success('Success', 'Email sent successfully');
        //  if($key == '0'){
        return redirect()->route('presentationscore');
        //  }
        //  else
        //  {
        //     return redirect()->route('fpptscore_searchid', $key);
        //  }
 }


 public function fundselectedlink($cohortopen, $no)
    {
        $allapplication = DB::table('tb_dhifund_applications')
        ->where('cohortopen', $cohortopen)
        ->where('cohortopenno', $no)
       ->where('selected', '1')
       ->orderBy('totalscore', 'desc')->get();
        return view('ppt_scores.selectedlist1', compact('allapplication', 'cohortopen', 'no'));
    }
}

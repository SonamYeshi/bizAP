<?php

namespace App\Http\Controllers\training;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Training;
use App\Mail\SendEmail;
use App\Mail\TrainingAppmail;
use App\Models\Softskills;
use App\Models\Hardskills;
use App\Models\User;
use App\Models\Jobstatus;
use App\Models\mst_dzongkhag;
use App\Models\Qualification;
use App\Models\tbl_gender;
use App\Models\TrainingApplication;
use App\Models\ApplicationDocs;
use App\Models\TrainingApplicationDocument;
use DB;
use Mail;
use Auth;
use Carbon\Carbon;

class TrainingApplicationController extends Controller
{
    public function index($id){
        $trainingid = $id;
        $gender = tbl_gender::all();
        $qualification = Qualification::all();
        $dzongkhag = mst_dzongkhag::all();
        $jobstatus = Jobstatus::all();
        return view('apply.applicationform', compact('gender', 'qualification', 'dzongkhag', 'jobstatus', 'trainingid'));
    }

    public function applicationlist(Request $request)
    {
        // $training = Training::all();
        $today = Carbon::today()->format('Y-m-d');
        $training = Training::whereDate('training_date', '>=', $today)->get();
        // dd($training);
        return view('apply.applist', compact('training'));
    }

    public function applytraining(Request $request)
    {
	$cid = $request->cidd;
        $count = count(TrainingApplication::where('cid', $cid)->get());
        if($count == '0')
        {    
        $trainingid = $request->trainingid;
        $cohortopen = Training::where('id', $trainingid)->value('opencohort');
        $cohortopenno = Training::where('id', $trainingid)->value('opencohortno');
        $business_name = Training::where('id', $trainingid)->value('training_title');
        $name = $request->name;

        $app = new TrainingApplication;
        $app->trainingid = $request->trainingid;
        $app->opencohort = $cohortopen;
        $app->opencohortno = $cohortopenno;
        $app->cid = $request->cidd;
        $app->name = $request->name;
        $app->email = $request->email;
        $app->mobileno = $request->mobileno;
        $app->dob = $request->dob;
        $app->gender = $request->gender;
        $app->qualification = $request->qualification;
        $app->dzongkhag = $request->dzongkhag;
        $app->job_status = $request->job_status;
        $app->commit_hr = $request->commit_hr;
        $app->commit_period = $request->commit_period;
        $app->challenge = $request->challenge;
        $app->youtubelink = $request->youtubelink;
        $app->rfname1 = $request->rfname1;
        $app->rfposition1 = $request->rfposition1;
        $app->rforg1 = $request->rforg1;
        $app->rfrelation1 = $request->rfrelation1;
        $app->rfmobileno1 = $request->rfmobileno1;
        $app->rfemail1 = $request->rfemail1;
        $app->rfname2 = $request->rfname2;
        $app->rfposition2 = $request->rfposition2;
        $app->rforg2 = $request->rforg2;
        $app->rfrelation2 = $request->rfrelation2;
        $app->rfmobileno2 = $request->rfmobileno2;
        $app->rfemail2 = $request->rfemail2;
        if($request->input('findprogram') != ''){
        $app->awareness = implode(',', $request->input('findprogram'));}
        $app->agree = $request->agree;
        $app->created_on = date('Y-m-d');
        $app->save();
        $appid = $app->id;

        $sc = new Softskills;
        $sc->appid = $appid;
        $sc->Communication = $request->communication;
        $sc->Negotiation = $request->negotiation;
        $sc->TimeManagement = $request->management;
        $sc->ProblemSolvingSkills = $request->roblem_solving_skills;
        $sc->Punctuality = $request->Punctuality;
        $sc->TeamWorkSkills = $request->Team_Work_Skills;
        $sc->Flexibility = $request->flexibility;
        $sc->Abilitytoacceptandlearnfromcriticism = $request->criticism;
        $sc->MarketingSkills = $request->marketingSkills;
        $sc->Passiontolearn = $request->passiontolearn;
        $sc->Persistency = $request->persistency;
        $sc->save();

        $hs = new Hardskills;
        $hs->appid = $appid;
        $hs->GraphicDesign = $request->GraphicDesign;
        $hs->WebsiteDesgn = $request->WebsiteDesgn;
        $hs->Photoshop = $request->Photoshop;
        $hs->MobileDevelopment = $request->MobileDevelopment;
        $hs->DataEntry = $request->DataEntry;
        $hs->DigitalMarketing = $request->DigitalMarketing;
        $hs->WritingandTranslation = $request->WritingandTranslation;
        $hs->VideoandAnimation = $request->VideoandAnimation;
        $hs->MusicandAudio = $request->MusicandAudio;
        $hs->Finance = $request->Finance;
        $hs->HealthandFitness = $request->HealthandFitness;
        $hs->Others = $request->Others;
        $hs->save();

        $training_app_docs = new TrainingApplicationDocument();
        $training_app_docs->appid = $appid;
        $relative_path = '/uploads/applicationdocs/'.$request->cidd;
        $training_app_docs->doc_path = $relative_path;
        $absolute_path = public_path().$relative_path ;

        $cat = 'passport';
        if ($request->passport != 0) {
            foreach ($request->passport as $file) {
                $filename = $file->getClientOriginalName();
                // $path = public_path().$relative_path ;
                $file->move($absolute_path,$filename);
                $training_app_docs->passport = $filename;
                // ApplicationDocs::create([
                //     'file_name' => $filename,
                //     'appid' => $appid,
                //     'filecat' => $cat,
                //     'doc_path' => $path,
                //     'created_at' => date('Y-m-d')
                // ]);
            }
        }

        $cat = 'cid';
        if ($request->cid != 0) {
            foreach ($request->cid as $file) {
                $filename = $file->getClientOriginalName();
                // $path = public_path().'/uploads/applicationdocs' ;
                $file->move($absolute_path,$filename);
                $training_app_docs->cid = $filename;
                // ApplicationDocs::create([
                //     'file_name' => $filename,
                //     'appid' => $appid,
                //     'filecat' => $cat,
                //     'doc_path' => $path,
                //     'created_at' => date('Y-m-d')
                // ]);
            }
        }

        $cat = 'noc';
        if ($request->noc != 0) {
            foreach ($request->noc as $file) {
                $filename = $file->getClientOriginalName();
                // $path = public_path().'/uploads/applicationdocs' ;
                $file->move($absolute_path,$filename);
                $training_app_docs->noc = $filename;
                // ApplicationDocs::create([
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
                // $path = public_path().'/uploads/applicationdocs' ;
                $file->move($absolute_path,$filename);
                $training_app_docs->cv = $filename;
            //     ApplicationDocs::create([
            //         'file_name' => $filename,
            //         'appid' => $appid,
            //         'filecat' => $cat,
            //         'doc_path' => $path,
            //         'created_at' => date('Y-m-d')
            //     ]);
            }
        }

        $cat = 'certificate';
        if ($request->certification != 0) {
            foreach ($request->certification as $file) {
                $filename = $file->getClientOriginalName();
                // $path = public_path().'/uploads/applicationdocs' ;
                $file->move($absolute_path,$filename);
                $training_app_docs->certificate = $filename;
                // ApplicationDocs::create([
                //     'file_name' => $filename,
                //     'appid' => $appid,
                //     'filecat' => $cat,
                //     'doc_path' => $path,
                //     'created_at' => date('Y-m-d')
                // ]);
            }
        }

        $cat = 'supporting';
        if ($request->otherdoc != 0) {
            foreach ($request->otherdoc as $file) {
                $filename = $file->getClientOriginalName();
                // $path = public_path().'/uploads/applicationdocs' ;
                $file->move($absolute_path,$filename);
                $training_app_docs->supporting = $filename;
                // ApplicationDocs::create([
                //     'file_name' => $filename,
                //     'appid' => $appid,
                //     'filecat' => $cat,
                //     'doc_path' => $path,
                //     'created_at' => date('Y-m-d')
                // ]);
            }
        }

        $cat = 'workexample';
        if ($request->workexample != 0) {
            foreach ($request->workexample as $file) {
                $filename = $file->getClientOriginalName();
                // $path = public_path().'/uploads/applicationdocs' ;
                $file->move($absolute_path,$filename);
                $training_app_docs->workexample = $filename;
                // ApplicationDocs::create([
                //     'file_name' => $filename,
                //     'appid' => $appid,
                //     'filecat' => $cat,
                //     'doc_path' => $path,
                //     'created_at' => date('Y-m-d')
                // ]);
            }
        }

        $cat = 'sample1';
        if ($request->sample1 != 0) {
            foreach ($request->sample1 as $file) {
                $filename = $file->getClientOriginalName();
                // $path = public_path().'/uploads/applicationdocs' ;
                $file->move($absolute_path,$filename);
                $training_app_docs->sample1 = $filename;
                // ApplicationDocs::create([
                //     'file_name' => $filename,
                //     'appid' => $appid,
                //     'filecat' => $cat,
                //     'doc_path' => $path,
                //     'created_at' => date('Y-m-d')
                // ]);
            }
        }

        $cat = 'sample2';
        if ($request->sample2 != 0) {
            foreach ($request->sample2 as $file) {
                $filename = $file->getClientOriginalName();
                // $path = public_path().'/uploads/applicationdocs' ;
                $file->move($absolute_path,$filename);
                $training_app_docs->sample2 = $filename;
                // ApplicationDocs::create([
                //     'file_name' => $filename,
                //     'appid' => $appid,
                //     'filecat' => $cat,
                //     'doc_path' => $path,
                //     'created_at' => date('Y-m-d')
                // ]);
            }
        }
        $training_app_docs->save();

        $Emails = User::where('role_id', '1')->get();
            foreach ($Emails as $e)
            {
               Mail::to($e->email)->send(new TrainingAppmail($business_name, $name));
	    }
	    Alert::success('Success', 'You\'ve successfully submitted the Application');
	    return redirect()->route('apply');
	    }
        else
        {
            Alert::success('Oops...', 'Application already Exists', "error");
             return redirect()->route('apply');
        }
    }


    public function updatetraining(Request $request)
    {
        $appid = $request->appid;
        $trainingid = $request->trainingid;
        $cohortopen = Training::where('id', $trainingid)->value('opencohort');
        $cohortopenno = Training::where('id', $trainingid)->value('opencohortno');


        $app = TrainingApplication::findOrFail($appid);
        $app->trainingid = $request->trainingid;
        $app->opencohort = $cohortopen;
        $app->opencohortno = $cohortopenno;
        $app->cid = $request->cidd;
        $app->name = $request->name;
        $app->email = $request->email;
        $app->mobileno = $request->mobileno;
        $app->dob = $request->dob;
        $app->gender = $request->gender;
        $app->qualification = $request->qualification;
        $app->dzongkhag = $request->dzongkhag;
	$app->job_status = $request->job_status;
	$app->job_status_other = $request->job_status_other;
        $app->commit_hr = $request->commit_hr;
	$app->commit_period = $request->commit_period;
	$app->laptop = $request->laptop;
        $app->challenge = $request->challenge;
        $app->youtubelink = $request->youtubelink;
        $app->rfname1 = $request->rfname1;
        $app->rfposition1 = $request->rfposition1;
        $app->rforg1 = $request->rforg1;
        $app->rfrelation1 = $request->rfrelation1;
        $app->rfmobileno1 = $request->rfmobileno1;
        $app->rfemail1 = $request->rfemail1;
        $app->rfname2 = $request->rfname2;
        $app->rfposition2 = $request->rfposition2;
        $app->rforg2 = $request->rforg2;
        $app->rfrelation2 = $request->rfrelation2;
        $app->rfmobileno2 = $request->rfmobileno2;
        $app->rfemail2 = $request->rfemail2;
        if($request->input('findprogram') != ''){
        $app->awareness = implode(',', $request->input('findprogram'));}
        $app->agree = $request->agree;
        $app->updated_on = date('Y-m-d');
        $app->save();
        $appid = $app->id;

        $ssid = Softskills::where('appid', $appid)->value('id');
        $sc = Softskills::findOrFail($ssid);
        $sc->appid = $appid;
        $sc->Communication = $request->communication;
        $sc->Negotiation = $request->negotiation;
        $sc->TimeManagement = $request->management;
        $sc->ProblemSolvingSkills = $request->roblem_solving_skills;
        $sc->Punctuality = $request->Punctuality;
        $sc->TeamWorkSkills = $request->Team_Work_Skills;
        $sc->Flexibility = $request->flexibility;
        $sc->Abilitytoacceptandlearnfromcriticism = $request->criticism;
        $sc->MarketingSkills = $request->marketingSkills;
        $sc->Passiontolearn = $request->passiontolearn;
        $sc->Persistency = $request->persistency;
        $sc->save();

        $hsid = Hardskills::where('appid', $appid)->value('id');
        $hs = Hardskills::findOrFail($hsid);;
        $hs->appid = $appid;
        $hs->GraphicDesign = $request->GraphicDesign;
        $hs->WebsiteDesgn = $request->WebsiteDesgn;
        $hs->Photoshop = $request->Photoshop;
        $hs->MobileDevelopment = $request->MobileDevelopment;
        $hs->DataEntry = $request->DataEntry;
        $hs->DigitalMarketing = $request->DigitalMarketing;
        $hs->WritingandTranslation = $request->WritingandTranslation;
        $hs->VideoandAnimation = $request->VideoandAnimation;
        $hs->MusicandAudio = $request->MusicandAudio;
        $hs->Finance = $request->Finance;
        $hs->HealthandFitness = $request->HealthandFitness;
        $hs->Others = $request->Others;
        $hs->save();

        $cat = 'passport';
        $count = count(ApplicationDocs::where('appid', $appid)->where('filecat', $cat)->get());
        if($count == '0')
        {
            if ($request->passport != 0) {
                foreach ($request->passport as $file) {
                    $filename = $file->getClientOriginalName();
                    $path = public_path().'/uploads/applicationdocs' ;
                    $file->move($path,$filename);
                    ApplicationDocs::create([
                        'file_name' => $filename,
                        'appid' => $appid,
                        'filecat' => $cat,
                        'doc_path' => $path,
                        'created_at' => date('Y-m-d')
                    ]);
                }
            }
        }
        else {
        if ($request->passport != 0) {
            foreach ($request->passport as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/applicationdocs' ;
                $file->move($path,$filename);
                $attach = new ApplicationDocs;
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

        $cat = 'cid';
        $count = count(ApplicationDocs::where('appid', $appid)->where('filecat', $cat)->get());
        if($count == '0')
        {
            if ($request->cid != 0) {
                foreach ($request->cid as $file) {
                    $filename = $file->getClientOriginalName();
                    $path = public_path().'/uploads/applicationdocs' ;
                    $file->move($path,$filename);
                    ApplicationDocs::create([
                        'file_name' => $filename,
                        'appid' => $appid,
                        'filecat' => $cat,
                        'doc_path' => $path,
                        'created_at' => date('Y-m-d')
                    ]);
                }
            }
        }
        else {
        if ($request->cid != 0) {
            foreach ($request->cid as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/applicationdocs' ;
                $file->move($path,$filename);
                $attach = new ApplicationDocs;
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

        $cat = 'noc';
        $count = count(ApplicationDocs::where('appid', $appid)->where('filecat', $cat)->get());
        if($count == '0')
        {
            if ($request->noc != 0) {
                foreach ($request->noc as $file) {
                    $filename = $file->getClientOriginalName();
                    $path = public_path().'/uploads/applicationdocs' ;
                    $file->move($path,$filename);
                    ApplicationDocs::create([
                        'file_name' => $filename,
                        'appid' => $appid,
                        'filecat' => $cat,
                        'doc_path' => $path,
                        'created_at' => date('Y-m-d')
                    ]);
                }
            }
        }
        else {
        if ($request->noc != 0) {
            foreach ($request->noc as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/applicationdocs' ;
                $file->move($path,$filename);
                $attach = new ApplicationDocs;
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
        $count = count(ApplicationDocs::where('appid', $appid)->where('filecat', $cat)->get());
        if($count == '0')
        {
            if ($request->cv != 0) {
                foreach ($request->cv as $file) {
                    $filename = $file->getClientOriginalName();
                    $path = public_path().'/uploads/applicationdocs' ;
                    $file->move($path,$filename);
                    ApplicationDocs::create([
                        'file_name' => $filename,
                        'appid' => $appid,
                        'filecat' => $cat,
                        'doc_path' => $path,
                        'created_at' => date('Y-m-d')
                    ]);
                }
            }
        }
        else {
        if ($request->cv != 0) {
            foreach ($request->cv as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/applicationdocs' ;
                $file->move($path,$filename);
                $attach = new ApplicationDocs;
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

        $cat = 'certificate';
        $count = count(ApplicationDocs::where('appid', $appid)->where('filecat', $cat)->get());
        if($count == '0')
        {
            if ($request->certification != 0) {
                foreach ($request->certification as $file) {
                    $filename = $file->getClientOriginalName();
                    $path = public_path().'/uploads/applicationdocs' ;
                    $file->move($path,$filename);
                    ApplicationDocs::create([
                        'file_name' => $filename,
                        'appid' => $appid,
                        'filecat' => $cat,
                        'doc_path' => $path,
                        'created_at' => date('Y-m-d')
                    ]);
                }
            }
        }
        else {
        if ($request->certification != 0) {
            foreach ($request->certification as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/applicationdocs' ;
                $file->move($path,$filename);
                $attach = new ApplicationDocs;
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

        $cat = 'supporting';
        $count = count(ApplicationDocs::where('appid', $appid)->where('filecat', $cat)->get());
        if($count == '0')
        {
            if ($request->otherdoc != 0) {
                foreach ($request->otherdoc as $file) {
                    $filename = $file->getClientOriginalName();
                    $path = public_path().'/uploads/applicationdocs' ;
                    $file->move($path,$filename);
                    ApplicationDocs::create([
                        'file_name' => $filename,
                        'appid' => $appid,
                        'filecat' => $cat,
                        'doc_path' => $path,
                        'created_at' => date('Y-m-d')
                    ]);
                }
            }
        }
        else {
        if ($request->otherdoc != 0) {
            foreach ($request->otherdoc as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/applicationdocs' ;
                $file->move($path,$filename);
                $attach = new ApplicationDocs;
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
        $cat = 'workexample';
        $count = count(ApplicationDocs::where('appid', $appid)->where('filecat', $cat)->get());
        if($count == '0')
        {
            if ($request->workexample != 0) {
                foreach ($request->workexample as $file) {
                    $filename = $file->getClientOriginalName();
                    $path = public_path().'/uploads/applicationdocs' ;
                    $file->move($path,$filename);
                    ApplicationDocs::create([
                        'file_name' => $filename,
                        'appid' => $appid,
                        'filecat' => $cat,
                        'doc_path' => $path,
                        'created_at' => date('Y-m-d')
                    ]);
                }
            }
        }
        else {
        if ($request->workexample != 0) {
            foreach ($request->workexample as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/applicationdocs' ;
                $file->move($path,$filename);
                $attach = new ApplicationDocs;
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

        $cat = 'sample1';
        $count = count(ApplicationDocs::where('appid', $appid)->where('filecat', $cat)->get());
        if($count == '0')
        {
            if ($request->sample1 != 0) {
                foreach ($request->sample1 as $file) {
                    $filename = $file->getClientOriginalName();
                    $path = public_path().'/uploads/applicationdocs' ;
                    $file->move($path,$filename);
                    ApplicationDocs::create([
                        'file_name' => $filename,
                        'appid' => $appid,
                        'filecat' => $cat,
                        'doc_path' => $path,
                        'created_at' => date('Y-m-d')
                    ]);
                }
            }
        }
        else {
        if ($request->sample1 != 0) {
            foreach ($request->sample1 as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/applicationdocs' ;
                $file->move($path,$filename);
                $attach = new ApplicationDocs;
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

        $cat = 'sample2';
        $count = count(ApplicationDocs::where('appid', $appid)->where('filecat', $cat)->get());
        if($count == '0')
        {
            if ($request->sample2 != 0) {
                foreach ($request->sample2 as $file) {
                    $filename = $file->getClientOriginalName();
                    $path = public_path().'/uploads/applicationdocs' ;
                    $file->move($path,$filename);
                    ApplicationDocs::create([
                        'file_name' => $filename,
                        'appid' => $appid,
                        'filecat' => $cat,
                        'doc_path' => $path,
                        'created_at' => date('Y-m-d')
                    ]);
                }
            }
        }
        else {
        if ($request->sample2 != 0) {
            foreach ($request->sample2 as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/applicationdocs' ;
                $file->move($path,$filename);
                $attach = new ApplicationDocs;
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
        return redirect()->route('screening')->with('success','Application Updated successfully!');
    }
}

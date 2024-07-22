<?php

namespace App\Http\Controllers\training;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Mail\SendInterviewDate;
use App\Mail\SendSelectedStatusTraining;
use App\Mail\TrainingShortListMail;
use App\Mail\TrainingSelectedListMail;
use App\Exports\TrainingScoreExport;
use App\Imports\TrainingScoreImport;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Training;
use App\Models\user;
use App\Models\TrainingProvider;
use App\Models\SLStatus;
use App\Models\Shortlistpanel;
use App\Models\Country;
use App\Models\Panelrole;
use App\Models\FundShortlistpanel;
use App\Models\Interviewpanel;
use App\Models\TrainingApplication;
use App\Models\Jobstatus;
use App\Models\mst_dzongkhag;
use App\Models\Qualification;
use App\Models\tbl_gender;
use App\Models\Softskills;
use App\Models\Hardskills;
use App\Models\ApplicationDocs;
use App\Models\ScreeningStatus;
use App\Models\ShortlistStatus;
use App\Models\InterviewStatus;
use App\Models\InterviewDateTime;
use App\Models\RankingStatus;
use App\Models\PosttrainingStatus;
use App\Models\Presentationpanel;
use App\Models\ICTemail;
use DB;
use Mail;
use PDF;

class TrainingController extends Controller
{
    public function index()
    {
        $training = Training::orderBy('id', 'desc')->get();
        return view('training.index', compact('training'));
    }

    public function addtrainingnotification(Request $request)
    {
        $user = new Training;
        $user->opencohort = $request->opencohort;
        $user->opencohortno = $request->opencohortno;
        $user->training_title = $request->training_title;
        $user->announcement_details = $request->announcement_details;
        $user->training_provider = $request->training_provider;
        $user->training_date = $request->training_date;
        $user->training_time = $request->training_time;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->created_by = Auth::user()->id;
        $user->created_on = date('Y-m-d');
        $user->save();
        return redirect()->route('training')->with('success','Training Posted successfully!');
    }

    public function updateTraining(Request $request)
    {
        $id = $request->edit_id;
        $user = new Training;
        $user::where('id', $id)
            ->update([
                'opencohort' => $request->opencohort,
                'opencohortno' => $request->opencohortno,
                'training_title' => $request->training_title,
                'announcement_details' => $request->announcement_details,
                'training_provider' => $request->training_provider,
                'training_date' => $request->training_date,
                'training_time' => $request->training_time,
                'email' => $request->email,
                'phone' => $request->phone,
                'updated_by' => Auth::user()->id,
                'updated_on' => date('Y-m-d')
            ]);
        return redirect()->route('training')->with('success','Training Updated successfully!');
    }

    public function deleteTraining($id)
    {
        $user = new Training;
        $user::where('id', $id)->delete();
        return redirect()->route('training')->with('success','Training Removed successfully!');
    }

    public function editview(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $info = Training::find($id);
            return response()->json($info);
        }
    }

    public function trainingprovider()
    {
        $provider = TrainingProvider::all();
        return view('training.trainingprovider', compact('provider'));
    }

    public function trainingprovideradd(Request $request)
    {
        $tp = new TrainingProvider;
        $tp->name = $request->name;
        $tp->country = $request->country;
        $tp->address = $request->address;
        $tp->contact_person = $request->contact_person;
        $tp->email = $request->email;
        $tp->phone = $request->phone;
        $tp->created_by = Auth::user()->id;
        $tp->created_on = date('Y-m-d');
        $tp->save();
        return redirect()->route('trainingprovider')->with('success','Training Provider Added Successfully!');
    }

    public function tpview(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $info = TrainingProvider::find($id);
            return response()->json($info);
        }
    }

    public function updateTrainingProvider(Request $request)
    {
        $id = $request->edit_id;
        $user = new TrainingProvider;
        $user::where('id', $id)
            ->update([
                'name' => $request->name,
                'country' => $request->country,
                'address' => $request->address,
                'contact_person' => $request->contact_person,
                'email' => $request->email,
                'phone' => $request->phone,
                'updated_by' => Auth::user()->id,
                'updated_on' => date('Y-m-d')
            ]);
        return redirect()->route('trainingprovider')->with('success','Training Provider Updated Successfully!');
    }

    public function deleteTrainingProvider($id)
    {
        $user = new TrainingProvider;
        $user::where('id', $id)->delete();
        return redirect()->route('trainingprovider')->with('success','Training Provider Removed Successfully!');
    }

    public function interviewpanels()
    {
        $interview = Interviewpanel::all();
        return view('training.interviewpanels', compact('interview'));
    }

    public function shortpanels(){
        $interview = Shortlistpanel::all();
        return view('training.shortlistpanels', compact('interview'));
    }

    public function fshortpanels()
    {
        $interview = FundShortlistpanel::all();
        return view('training.fshortlistpanels', compact('interview'));
    }

    public function pptpanels()
    {
        $panels = Presentationpanel::all();
        return view('presentation.panels', compact('panels'));
    }

    public function interviewpaneladd(Request $request)
    {
        $ip = new Interviewpanel;
        $ip->trainingid = $request->training;
        $ip->name = $request->name;
        $ip->designation = $request->designation;
        $ip->role = $request->role;
        $ip->created_by = Auth::user()->id;
        $ip->created_on = date('Y-m-d');
        $ip->save();
        return redirect()->route('interviewpanels')->with('success','Panel Member Added Successfully!');
    }

    public function shortlistpaneladd(Request $request)
    {
        $ip = new Shortlistpanel;
        $ip->trainingid = $request->training;
        $ip->name = $request->name;
        $ip->designation = $request->designation;
        $ip->role = $request->role;
        $ip->created_by = Auth::user()->id;
        $ip->created_on = date('Y-m-d');
        $ip->save();
        return redirect()->route('shortpanels')->with('success','Panel Member Added Successfully!');
    }

    public function fshortlistpaneladd(Request $request)
    {
        $ip = new FundShortlistpanel;
        $ip->fundid = $request->training;
        $ip->name = $request->name;
        $ip->designation = $request->designation;
        $ip->role = $request->role;
        $ip->created_by = Auth::user()->id;
        $ip->created_on = date('Y-m-d');
        $ip->save();
        return redirect()->route('fshortpanels')->with('success','Panel Member Added Successfully!');
    }

    public function pptpaneladd(Request $request)
    {
        $ip = new Presentationpanel;
        $ip->fundid = $request->fundname;
        $ip->name = $request->name;
        $ip->designation = $request->designation;
        $ip->role = $request->role;
        $ip->created_by = Auth::user()->id;
        $ip->created_on = date('Y-m-d');
        $ip->save();
        return redirect()->route('pptpanels')->with('success','Panel Member Added Successfully!');
    }
    public function interviewedit(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $info = Interviewpanel::find($id);
            return response()->json($info);
        }
    }

    public function sledit(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $info = Shortlistpanel::find($id);
            return response()->json($info);
        }
    }

    public function fsledit(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $info = FundShortlistpanel::find($id);
            return response()->json($info);
        }
    }

    public function pptedit(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $info = Presentationpanel::find($id);
            return response()->json($info);
        }
    }

    public function update_panelmember(Request $request)
    {
        $id = $request->edit_id;
        $user = new Interviewpanel;
        $user::where('id', $id)
            ->update([
                'trainingid' => $request->training,
                'name' => $request->name,
                'designation' => $request->designation,
                'role' => $request->role,
                'updated_by' => Auth::user()->id,
                'updated_on' => date('Y-m-d')
            ]);
        return redirect()->route('interviewpanels')->with('success','Panel Member Updated Successfully!');
    }

    public function update_slmember(Request $request)
    {
        $id = $request->edit_id;
        $user = new Shortlistpanel;
        $user::where('id', $id)
            ->update([
                'trainingid' => $request->training,
                'name' => $request->name,
                'designation' => $request->designation,
                'role' => $request->role,
                'updated_by' => Auth::user()->id,
                'updated_on' => date('Y-m-d')
            ]);
        return redirect()->route('shortpanels')->with('success','Panel Member Updated Successfully!');
    }

    public function fupdate_slmember(Request $request)
    {
        $id = $request->edit_id;
        $user = new FundShortlistpanel;
        $user::where('id', $id)
            ->update([
                'fundid' => $request->training,
                'name' => $request->name,
                'designation' => $request->designation,
                'role' => $request->role,
                'updated_by' => Auth::user()->id,
                'updated_on' => date('Y-m-d')
            ]);
        return redirect()->route('fshortpanels')->with('success','Panel Member Updated Successfully!');
    }

    public function update_pptpanelmember(Request $request)
    {
        $id = $request->edit_id;
        $user = new Presentationpanel;
        $user::where('id', $id)
            ->update([
                'fundid' => $request->fundname,
                'name' => $request->name,
                'designation' => $request->designation,
                'role' => $request->role,
                'updated_by' => Auth::user()->id,
                'updated_on' => date('Y-m-d')
            ]);
        return redirect()->route('pptpanels')->with('success','Panel Member Updated Successfully!');
    }

    public function deleteInterviewPanel($id)
    {
        $user = new Interviewpanel;
        $user::where('id', $id)->delete();
        return redirect()->route('interviewpanels')->with('success','Panel Member Removed Successfully!');
    }

    public function deleteSLPanel($id)
    {
        $user = new Shortlistpanel;
        $user::where('id', $id)->delete();
        return redirect()->route('shortpanels')->with('success','Panel Member Removed Successfully!');
    }

    public function deleteFSLPanel($id)
    {
        $user = new FundShortlistpanel;
        $user::where('id', $id)->delete();
        return redirect()->route('fshortpanels')->with('success','Panel Member Removed Successfully!');
    }

    public function deletePptPanel($id)
    {
        $user = new Presentationpanel;
        $user::where('id', $id)->delete();
        return redirect()->route('pptpanels')->with('success','Panel Member Removed Successfully!');
    }

    public function screening()
    {
        $allapplication = TrainingApplication::orderBy('id', 'desc')->get();
        return view('screening.index', compact('allapplication'));
    }

    public function screeningsearch(Request $request)
    {
        $key = $request->key;
        $allapplication = TrainingApplication::where('trainingid', $key)->orderBy('id', 'desc')->get();
        return view('screening.index1', compact('allapplication', 'key'));
    }

    public function screeningsearchid($key)
    {
        $allapplication = TrainingApplication::where('trainingid', $key)->orderBy('id', 'desc')->get();
        return view('screening.index1', compact('allapplication', 'key'));
    }

    public function appeditdhi($appid)
    {
        $gender = tbl_gender::all();
        $qualification = Qualification::all();
        $dzongkhag = mst_dzongkhag::all();
        $jobstatus = Jobstatus::all();
        $application =  TrainingApplication::where('id', $appid)->get();
        $softskill =  Softskills::where('appid', $appid)->get();
        $hardskill =  Hardskills::where('appid', $appid)->get();
        return view('screening.edit', compact(
            'appid',
            'application',
            'gender',
            'qualification',
            'dzongkhag',
            'jobstatus',
            'softskill',
            'hardskill'
        ));
    }

    public function view_application($id, $sid)
    {
        $appid = $id;
        $gender = tbl_gender::all();
        $qualification = Qualification::all();
        $dzongkhag = mst_dzongkhag::all();
        $jobstatus = Jobstatus::all();
	$application =  TrainingApplication::where('id', $appid)->get();
	$name =  TrainingApplication::where('id', $appid)->value('name');
        $softskill =  Softskills::where('appid', $appid)->get();
        $hardskill =  Hardskills::where('appid', $appid)->get();
        return view('screening.view', compact(
            'appid',
            'application',
            'gender',
            'qualification',
            'dzongkhag',
            'jobstatus',
            'softskill',
            'hardskill',
	    'sid',
	    'name'
        ));
    }


    public function generateApplicationPDF($id)
    {
        $appid = $id;
        // $gender = tbl_gender::all();
        // $qualification = Qualification::all();
        // $dzongkhag = mst_dzongkhag::all();
        // $jobstatus = Jobstatus::all();
        // $application =  TrainingApplication::where('id', $appid)->get();
        $application = DB::table('tb_training_applications as app')
                       ->join('tbl_soft_skills as ss', 'ss.appid', 'app.id')
                       ->join('tbl_hard_skills as hs', 'hs.appid', 'app.id')
                       ->join('tbl_training_app_docs as doc', 'doc.appid', 'app.id')
                       ->join('tbl_trainings as t', 'app.trainingid', 't.id')
                       ->join('mst_dzongkhags as dzo', 'dzo.dzongkhag_id', 'app.dzongkhag')
                       ->join('tbl_genders as g', 'g.id', 'app.gender')
                       ->join('tbl_qualifications as qua', 'qua.id', 'app.qualification')
                       ->join('tbl_job_statuses as job', 'job.id', 'app.job_status')  
                       ->select('app.*',
                       'ss.*',
                       'hs.*',
                       'doc.passport as passport',
                       'doc.cid as cid_attatch',
                       'doc.noc as noc',
                       'doc.cv as cv',
                       'doc.certificate as certificate',
                       'doc.supporting as supporting',
                       'doc.workexample as workexample',
                       'doc.sample1 as sample1',
                       'doc.sample2 as sample2',
                       'doc.doc_path as doc_path',
                       'g.gender as sex',
                       'dzo.dzongkhag_name as dzo',
                       'qua.qualification as quali',
                       'job.status as job',
                       't.training_title as training_name',
                       )
                       ->where('app.id', $appid)->first();

        // $softskill =  Softskills::where('appid', $appid)->get();
        // $hardskill =  Hardskills::where('appid', $appid)->get();
        $pdf = PDF::loadView('screening.app_pdf', compact(
            // 'appid',
            'application',
            // 'gender',
            // 'qualification',
            // 'dzongkhag',
            // 'jobstatus',
            // 'softskill',
            // 'hardskill'
        ));
        return $pdf->download('TrainingApplication.pdf');
    }

    public function ScreeningStatus(Request $request)
    {
        $sid = $request->sid;
        $count = count(ScreeningStatus::where('appid', $request->appid)->get());
        if($count == '0')
        {
        $ss = new ScreeningStatus;
        $ss->appid = $request->appid;
        $ss->status = $request->screeningstatus;
        $ss->reason = $request->sreeningreason;
        $ss->created_by = Auth::user()->id;
        $ss->created_on = date('Y-m-d');
        $ss->save();
        $tu = TrainingApplication::findOrFail($request->appid);
        $tu->screening_status = '1';
        $tu->save();
        }
        if($count == '1')
        {
            $id = ScreeningStatus::where('appid', $request->appid)->value('id');
             $rsu = new ScreeningStatus;
             $rsu::where('id', $id)
            ->update([
                'status' => $request->screeningstatus,
                'reason' => $request->sreeningreason,
                'updated_by' => Auth::user()->id,
                'updated_on' => date('Y-m-d')
            ]);
        }
        if($sid == '0'){
        return redirect()->route('screening')->with('success','Screening Status Updated Successfully!');
        }
        else
        {
            return redirect()->route('tscreensearchid', $sid)->with('success','Screening Status Updated Successfully!');
        }
    }

    public function ScreeningStatusFast(Request $request)
    {
        $sid = $request->sid;
        $lic_rows = $request->rowss;
        for ($i = 0; $i < count($lic_rows['steps'][1]); $i++) {
            $count = count(ScreeningStatus::where('appid', $lic_rows['steps'][1][$i])->get());
            if($count == '0')
            {
             $rs = new ScreeningStatus;
             $rs->appid = $lic_rows['steps'][1][$i];
             $rs->status = $lic_rows['steps'][2][$i];
             $rs->created_by = Auth::user()->id;
             $rs->created_on = date('Y-m-d');
             $rs->save();
            }
            if($count == '1')
            {
             $id = ScreeningStatus::where('appid', $lic_rows['steps'][1][$i])->value('id');
             $rsu = new ScreeningStatus;
             $rsu::where('id', $id)
            ->update([
                'status' => $lic_rows['steps'][2][$i],
                'updated_by' => Auth::user()->id,
                'updated_on' => date('Y-m-d')
            ]);
            }

            $tu = TrainingApplication::findOrFail($lic_rows['steps'][1][$i]);
            $tu->screening_status = '1';
            $tu->save();
        }
        if($sid == '0'){
            return redirect()->route('screening')->with('success','Screening Status Updated Successfully!');
            }
            else
            {
                return redirect()->route('tscreensearchid', $sid)->with('success','Screening Status Updated Successfully!');
            }
    }

    public function shortlist()
    {
        $allapplication = DB::table('tb_training_applications as app')
        ->leftjoin('tbl_sl_statuses as sl', 'app.id', '=', 'sl.appID')
        ->join('tbl_genders as g', 'g.id', 'app.gender')
        // ->where('tb_training_applications.screening_status', '1')
        // ->where('tbl_screening_statuses.status', '1')
        ->select(
            'app.*', 
            'g.gender as sex',
            DB::raw('COALESCE(SUM(sl.score),0) as total_score'),
            DB::raw('ROUND(COALESCE(AVG(sl.score), 0), 2) as avg_score')
            )
        ->groupBy('app.id')
        ->orderBy('app.id', 'desc')
        ->get();

        $training = Training::all();

        return view('shortlist.index', compact('allapplication', 'training'));
    }

    public function shortlistsearch(Request $request){
        $key = $request->key;

        $allapplication = DB::table('tb_training_applications as app')
        ->leftjoin('tbl_sl_statuses as sl', 'app.id', '=', 'sl.appID')
        ->join('tbl_genders as g', 'g.id', 'app.gender')
        ->where('app.trainingid', $key)
        ->select(
            'app.*', 
            'g.gender as sex',
            DB::raw('COALESCE(SUM(sl.score),0) as total_score'),
            DB::raw('ROUND(COALESCE(AVG(sl.score), 0), 2) as avg_score')
            )
        ->groupBy('app.id')
        ->orderBy('app.id', 'desc')
        ->get();

        $training = Training::all();

        return view('shortlist.index', compact('allapplication', 'training'));
        // return view('shortlist.index1', compact('allapplication', 'training'));
    }

    public function shortlistsearchid($key)
    {
        //$allapplication = TrainingApplication::where('screening_status', '1')->orderBy('id', 'desc')->get();
        $allapplication = DB::table('tb_training_applications')
        ->join('tbl_screening_statuses', 'tb_training_applications.id', '=', 'tbl_screening_statuses.appid')
        ->where('tb_training_applications.screening_status', '1')
        ->where('tbl_screening_statuses.status', '1')
        ->where('tb_training_applications.trainingid', $key)
        ->select('tb_training_applications.*')
        ->orderBy('tb_training_applications.id', 'desc')
        ->get();
         return view('shortlist.index1', compact('allapplication', 'key'));
    }

    public function SlStatusFast(Request $request){
        $sid = $request->sid;
        $cohortopen = $request->cohortopen;
        $no = $request->cohortopenno;
        if($cohortopen == '' && $no == ''){
            $lic_rows = $request->rowss;
            if($request->shortlist_score_exist > 0){ // allowing only if the shortlisting scores are provided prior to final shortlisting
                for ($i = 0; $i < count($lic_rows['steps'][1]); $i++) {
                    $application = TrainingApplication::find($lic_rows['steps'][1][$i]);
                    $application->shortlist_status = $lic_rows['steps'][2][$i];
                    $application->updated_on = date('Y-m-d');
                    $application->shortlist_on = date('Y-m-d');
                    $application->save();
                    // $count = count(ShortlistStatus::where('appid', $lic_rows['steps'][1][$i])->get());
                    // $shortlist_scores = ShortlistStatus::where('appid', $lic_rows['steps'][1][$i])->get();
                    // if(count($shortlist_scores) == 0){
                    //     $rs = new ShortlistStatus;
                    //     $rs->appid = $lic_rows['steps'][1][$i];
                    //     $rs->status = $lic_rows['steps'][2][$i];
                    //     $rs->created_by = Auth::user()->id;
                    //     $rs->created_on = date('Y-m-d');
                    //     $rs->save();
                    // }else{
                    //     $id = ShortlistStatus::where('appid', $lic_rows['steps'][1][$i])->value('id');
                    //     $rsu = new ShortlistStatus;
                    //     $rsu::where('id', $id)
                    //     ->update([
                    //         'status' => $lic_rows['steps'][2][$i],
                    //         'updated_by' => Auth::user()->id,
                    //         'updated_on' => date('Y-m-d')
                    //     ]);
                    // }
                }
            }
            if($sid == '0'){
                return redirect()->route('shortlist')->with('success','Shortlist status updated successfully.');
                }else{
                return redirect()->route('tshortsearchid', $sid)->with('success','Shortlist Status Updated Successfully.');
            }
        }else{
            $allapplication = DB::table('tb_training_applications as app')
                // ->join('tbl_shortlist_statuses', 'tb_training_applications.id', '=', 'tbl_shortlist_statuses.appid')
                ->where('app.opencohort', $cohortopen)
                ->where('app.opencohortno', $no)
                ->where('app.shortlist_status', 1)
                ->select('app.*')
                ->get();                

            return view('shortlist.shortlistedlist', compact('allapplication', 'cohortopen', 'no'));
        }
    }

    public function getShortlistScoreStatus($app_id){
        $info = SLStatus::find($id);
        return response()->json($info);
    }

    public function shortlistedlist($cohortopen, $no)
    {
        $allapplication = DB::table('tb_training_applications')
            ->join('tbl_shortlist_statuses', 'tb_training_applications.id', '=', 'tbl_shortlist_statuses.appid')
            ->where('tb_training_applications.opencohort', $cohortopen)
            ->where('tb_training_applications.opencohortno', $no)
            ->where('tb_training_applications.shortlist_status', '1')
            ->where('tbl_shortlist_statuses.status', '1')
            ->select('tb_training_applications.*')
            ->get();

     return view('shortlist.shortlistedlist1', compact('allapplication', 'cohortopen', 'no'));
    }

    public function view_application_short($appid){
    $application = DB::table('tb_training_applications as app')
                ->join('tbl_soft_skills as ss', 'ss.appid', 'app.id')
                ->join('tbl_hard_skills as hs', 'hs.appid', 'app.id')
                ->join('tbl_training_app_docs as doc', 'doc.appid', 'app.id')
                ->join('tbl_trainings as t', 'app.trainingid', 't.id')
                ->join('mst_dzongkhags as dzo', 'dzo.dzongkhag_id', 'app.dzongkhag')
                ->join('tbl_genders as g', 'g.id', 'app.gender')
                ->join('tbl_qualifications as qua', 'qua.id', 'app.qualification')
                ->join('tbl_job_statuses as job', 'job.id', 'app.job_status')  
                ->select('app.*',
                'ss.*',
                'hs.*',
                'doc.passport as passport',
                'doc.cid as cid_attatch',
                'doc.noc as noc',
                'doc.cv as cv',
                'doc.certificate as certificate',
                'doc.supporting as supporting',
                'doc.workexample as workexample',
                'doc.sample1 as sample1',
                'doc.sample2 as sample2',
                'doc.doc_path as doc_path',
                'g.gender as sex',
                'dzo.dzongkhag_name as dzo',
                'qua.qualification as quali',
                'job.status as job',
                't.training_title as training_name',
                )
                ->where('app.id', $appid)->first();

        $trainingid = TrainingApplication::where('id', $appid)->value('trainingid');

        $shortlist_score_exist = SLStatus::where('trainingID', $trainingid)
                                         ->where('appID', $appid)
                                         ->get();

        if($shortlist_score_exist->isEmpty()){
            $pannels = DB::table('tbl_shortlistpannels as sp')
                ->join('tbl_panelroles as pr', 'pr.id', 'sp.role')
                ->where('sp.trainingid', $trainingid)
                ->select('sp.*',
                'pr.rolename as rolename', 
                DB::raw('"" as score'), 
                DB::raw('"" as remark'),
                DB::raw('"" as score_id'),
                )->get();
        }else{
            $pannels = DB::table('tbl_shortlistpannels as sp')
                ->leftjoin('tbl_sl_statuses as ss', 'sp.id', 'ss.pannelID')
                ->join('tbl_panelroles as pr', 'pr.id', 'sp.role')
                ->where('sp.trainingid', $trainingid)
                ->where('ss.appID', $appid)
                ->select('sp.*', 
                'ss.score as score', 
                'ss.remarks as remark', 
                'pr.rolename as rolename',
                'ss.id as score_id'
                )->get();
        }

        $avg_score = number_format(DB::table('tbl_sl_statuses')
                    ->where('tbl_sl_statuses.appID', $appid)
                    ->avg('score'), 2);

        return view('shortlist.view', compact(
            'appid',
            'application',
            'pannels',
            'avg_score'
        ));
    }

    public function ShortlistStatus(Request $request){
        // $sid = $request->sid;
        $application = TrainingApplication::findOrFail($request->appid);

        $totalscore = 0;
        $lic_rows = $request->rowss;
        if($lic_rows != null){
            for ($i = 0; $i < count($lic_rows['steps'][1]); $i++) {
                $shortlist_scores = SLStatus::find($lic_rows['steps'][4][$i]);
                if($shortlist_scores != null){
                    $shortlist_scores->score = $lic_rows['steps'][1][$i];
                    $shortlist_scores->remarks = $lic_rows['steps'][2][$i];
                    $shortlist_scores->updated_by = Auth::user()->id;
                    $shortlist_scores->updated_at = date('Y-m-d');
                    $shortlist_scores->save();
                }else{
                    $shortlist_new = new SLStatus();
                    $shortlist_new->trainingID = $application->trainingid;
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
            $application->sltotalscore = $totalscore;
            $application->updated_on = date('Y-m-d');
            // $application->shortlist_status = '1';
            $application->save();
        }else{
            return redirect()->route('shortlist'); 
        }
        
        // if($sid == '0'){
        return redirect()->route('shortlist')->with('success','Interiew score added successfully.');
        // }
        // else
        // {
        //     return redirect()->route('tshortsearchid', $sid)->with('success','Interiew score added successfully.');
        // }
    }

    public function interview(){
        $allapplication = DB::table('tb_training_applications as app')
        ->leftjoin('tbl_interview_statuses as inv', 'inv.appID', '=', 'app.id')
        ->join('tbl_genders as g', 'g.id', 'app.gender')
        ->where('app.shortlist_status', 1)
        ->select(
            'app.*', 
            'g.gender as sex',
            DB::raw('COALESCE(SUM(inv.score),0) as total_score'),
            DB::raw('ROUND(COALESCE(AVG(inv.score), 0), 2) as avg_score')
            )
        ->groupBy('app.id')
        ->orderBy('app.id', 'desc')
        ->get();

        $training = Training::all();

        return view('interview.index', compact('allapplication', 'training'));
    }

    public function interviewsearch(Request $request)
    { 
        $key = $request->key;

        $allapplication = DB::table('tb_training_applications as app')
        ->leftjoin('tbl_interview_statuses as inv', 'inv.appid', '=', 'app.id')
        ->join('tbl_genders as g', 'g.id', 'app.gender')
        ->where('app.shortlist_status', '1')
        ->where('app.trainingid', $key)
        ->select(
            'app.*', 
            'g.gender as sex',
            DB::raw('COALESCE(SUM(inv.score),0) as total_score'),
            DB::raw('ROUND(COALESCE(AVG(inv.score), 0), 2) as avg_score')
            )
        ->groupBy('app.id')
        ->orderBy('app.id', 'desc')
        ->get();

        $training = Training::all();

        return view('interview.index', compact('allapplication', 'training'));
        // return view('interview.index1', compact('allapplication', 'key', 'training'));
    }

    public function interviewsearchid($key)
    {
        //$allapplication = TrainingApplication::where('screening_status', '1')->where('shortlist_status', '1')->where('interview_status', '0')->get();
        $allapplication = DB::table('tb_training_applications')
        ->join('tbl_shortlist_statuses', 'tb_training_applications.id', '=', 'tbl_shortlist_statuses.appid')
        ->where('tbl_shortlist_statuses.status', '1')
        ->where('tb_training_applications.trainingid', $key)
        ->select('tb_training_applications.*')
        ->orderBy('tb_training_applications.id', 'desc')
        ->get();
        return view('interview.index1', compact('allapplication', 'key'));
    }

    public function generateshortlist(Request $request)
    {
        $cohortopen = $request->cohortopen;
        $no = $request->cohortopenno;
        $allapplication = TrainingApplication::where('screening_status', '1')->where('shortlist_status', '1')->get();
        return view('shortlist.shortlist', compact('allapplication'));
    }

    public function view_application_interview($appid)
    {
        
        // $application =  TrainingApplication::where('id', $appid)->get();
        $trainingid =  TrainingApplication::where('id', $appid)->value('trainingid');
        // $softskill =  Softskills::where('appid', $appid)->get();
        // $hardskill =  Hardskills::where('appid', $appid)->get();

	// $pannels = Interviewpanel::where('trainingid', $trainingid)->get();
	// $pcount = count(Shortlistpanel::where('trainingid', $trainingid)->get());
    // dd($pcount);
    // $ssdate = ScreeningStatus::where('appid', $appid)->value('created_on');
	// $sldate = ShortlistStatus::where('appid', $appid)->value('created_on');
	// $name =  TrainingApplication::where('id', $appid)->value('name');

    $interview_score_exist = InterviewStatus::where('trainingID', $trainingid)
                                         ->where('appID', $appid)
                                         ->get();
        if($interview_score_exist->isEmpty()){
            $pannels = DB::table('tbl_interviewpannels as pannel')
                ->join('tbl_panelroles as pr', 'pr.id', 'pannel.role')
                ->where('pannel.trainingid', $trainingid)
                ->select('pannel.*',
                'pr.rolename as rolename', 
                DB::raw('"" as score'), 
                DB::raw('"" as remark'),
                DB::raw('"" as score_id'),
                )->get();
        }else{
            $pannels = DB::table('tbl_interviewpannels as pannel')
                ->leftjoin('tbl_interview_statuses as inv', 'pannel.id', 'inv.pannelID')
                ->join('tbl_panelroles as pr', 'pr.id', 'pannel.role')
                ->where('pannel.trainingid',$trainingid)
                ->where('inv.appID', $appid)
                ->select('pannel.*',
                'inv.score as score', 
                'inv.remarks as remark', 
                'pr.rolename as rolename',
                'inv.id as score_id'
                )->get();
        }
    

    $application = DB::table('tb_training_applications as app')
                ->join('tbl_soft_skills as ss', 'ss.appid', 'app.id')
                ->join('tbl_hard_skills as hs', 'hs.appid', 'app.id')
                ->join('tbl_training_app_docs as doc', 'doc.appid', 'app.id')
                ->join('tbl_trainings as t', 'app.trainingid', 't.id')
                ->join('mst_dzongkhags as dzo', 'dzo.dzongkhag_id', 'app.dzongkhag')
                ->join('tbl_genders as g', 'g.id', 'app.gender')
                ->join('tbl_qualifications as qua', 'qua.id', 'app.qualification')
                ->join('tbl_job_statuses as job', 'job.id', 'app.job_status')
                ->leftjoin('tbl_interview_dates as inv', 'app.id', 'inv.appID')  
                ->select('app.*',
                'ss.*',
                'hs.*',
                'doc.passport as passport',
                'doc.cid as cid_attatch',
                'doc.noc as noc',
                'doc.cv as cv',
                'doc.certificate as certificate',
                'doc.supporting as supporting',
                'doc.workexample as workexample',
                'doc.sample1 as sample1',
                'doc.sample2 as sample2',
                'doc.doc_path as doc_path',
                'g.gender as sex',
                'dzo.dzongkhag_name as dzo',
                'qua.qualification as quali',
                'job.status as job',
                't.training_title as training_name',
                'inv.id as interviewdate_id',
                )
                ->where('app.id', $appid)->first();

$sid = 0;
	return view('interview.view', compact(
		// 'name',
		// 'pcount',
            'appid',
            // 'sstatus',
            // 'slstatus',
            'application',
            // 'gender',
            // 'qualification',
            // 'dzongkhag',
            // 'jobstatus',
            // 'softskill',
            // 'hardskill',
            'pannels',
            // 'ssdate',
            // 'sldate',
            // 'trainingid',
            // 'sid'
        ));
    }

    public function interviewUpdatescore(Request $request)
    {
        $sid = $request->sid;
        // $request->appid;
        // $request->trainingid;
        $totalscore = 0;
        $lic_rows = $request->rowss;

        $application = TrainingApplication::findOrFail($request->appid);
        if($lic_rows != null){
            for ($i = 0; $i < count($lic_rows['steps'][1]); $i++) {
                $interview_scores = InterviewStatus::find($lic_rows['steps'][4][$i]);
                if($interview_scores != null){
                    $interview_scores->score = $lic_rows['steps'][1][$i];
                    $interview_scores->remarks = $remarks = $lic_rows['steps'][2][$i];
                    $interview_scores->updated_by = Auth::user()->id;
                    $interview_scores->updated_at = date('Y-m-d');
                    $interview_scores->save();   
                }else{
                    $interview_new = new InterviewStatus;
                    $interview_new->trainingID = $application->trainingid;
                    $interview_new->appID = $request->appid;
                    $interview_new->pannelID = $lic_rows['steps'][3][$i];
                    $interview_new->score = $lic_rows['steps'][1][$i];
                    $interview_new->remarks = $remarks = $lic_rows['steps'][2][$i];
                    $interview_new->created_by = Auth::user()->id;
                    $interview_new->created_at = date('Y-m-d');
                    $interview_new->save();
                }
                $totalscore = ($totalscore + $lic_rows['steps'][1][$i]);
            }
            $application->interview_status = 1;
            $application->totalscore = $totalscore;
            $application->save();
        }else{
            return redirect()->route('interview');  
        }
    
        // if($sid == '0'){
        return redirect()->route('interview')->with('success','Interiew Score Added Successfully!');
        // }
        // else
        // {
        //     return redirect()->route('tintsearchid', $sid)->with('success','Interiew Score Added Successfully!');
        // }
    }

    // public function addInterviewTime(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $id = $request->id;
    //         $info = TrainingApplication::find($id);
    //         return response()->json($info);
    //     }
    // }

    public function addInterviewDateTime(Request $request)
    {
        $sid = $request->sid;
        $trainingID = TrainingApplication::where('id', $request->appid)->value('trainingid');
        $user = new InterviewDateTime;
        $user->appID = $request->appid;
        $user->trainingID = $trainingID;
        $user->interview_date = $request->interviewdate;
        $user->interview_time = $request->interviewtime;
        $user->created_by = Auth::user()->id;
        $user->created_on = date('Y-m-d');
        $user->save();
        $date = $request->interviewdate;
        $time = $request->interviewtime;
        $myEmail = TrainingApplication::where('id', $request->appid)->value('email');
        //Mail::to($myEmail)->send(new SendInterviewDate($date, $time));
        // if($sid == '0'){
        return redirect()->route('interview')->with('success','Interiew Date and Time Scheduled Successfully!');
        // }
        // else
        // {
        //     return redirect()->route('tintsearchid', $sid)->with('success','Interiew Date and Time Scheduled Successfully!');
        // }
    }

    public function interviewmail(Request $request)
    {
        $tid = $request->tid;
        $mailslist = DB::table('tbl_interview_dates as inv')
                     ->join('tb_training_applications as app', 'app.id', 'inv.appID')
                     ->where('app.shortlist_status', 1)
                     ->where('inv.trainingID', $tid)
                     ->select('inv.*',
                     'app.cid',
                     'app.name',
                     'app.email',
                     )->get();

        return view('interview.maillist', compact('mailslist'));
    }

    public function sendmail_t($interview_id, $appid){
        $email = DB::table('tb_training_applications as app')
                        ->where('app.id', $appid)
                        ->select('app.email')->first();
                        
        $inv_schedule = InterviewDateTime::where('id', $interview_id)->first();

        Mail::to($email)->send(new SendInterviewDate($inv_schedule->interview_date, $inv_schedule->interview_time));

        $inv_schedule->sent = 1;
        $inv_schedule->senton = date('Y-m-d');
        $inv_schedule->save();

        $mailslist = DB::table('tbl_interview_dates as inv')
                     ->join('tb_training_applications as app', 'app.id', 'inv.appID')
                     ->where('app.shortlist_status', 1)
                     ->where('inv.trainingID', $inv_schedule->trainingID)
                     ->select('inv.*',
                     'app.cid',
                     'app.name',
                     'app.email',
                     )->get();

	    Alert::success('Success', 'Email sent successfully');
        return view('interview.maillist', compact('mailslist'));
    }

    public function sendmail_iselect(Request $request){    
        $input = $request->all();
        $pmail = $input['pmail'];
        $bulk_mail=$request->pmail;
        $training_id = 0;

        for ($i= 0; $i < count($bulk_mail); $i++ ){
           $appid = $pmail[$i];
           $app = TrainingApplication::select('email', 'opencohort', 'opencohortno')
           ->where('id', $appid)
           ->first();

           $interview = InterviewDateTime::where('appID', $appid)->first();
           Mail::to($app->email)->send(new SendInterviewDate($app->cohortopen, $app->no, $interview->interview_date, $interview->interview_time));

           $interview->sent = 1;
           $interview->senton = date('Y-m-d');
           $interview->save();

           $training_id = $interview->trainingID;
	    }

        $mailslist = DB::table('tbl_interview_dates as inv')
                     ->join('tb_training_applications as app', 'app.id', 'inv.appID')
                     ->where('app.shortlist_status', 1)
                     ->where('inv.trainingID', $training_id)
                     ->select('inv.*',
                     'app.cid',
                     'app.name',
                     'app.email',
                     )->get();

        Alert::success('Success', 'Email sent successfully');
        return view('interview.maillist', compact('mailslist'));
    }

    // public function addInterviewTimeEdit(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $id = $request->id;
    //         $info = InterviewDateTime::find($id);
    //         return response()->json($info);
    //     }
    // }

    public function updateInterviewDate(Request $request)
    {
        $id = $request->edit_id;
        $user = new InterviewDateTime;
        $user::where('id', $id)
            ->update([
                'interview_date' => $request->interviewdate,
                'interview_time' => $request->interviewtime,
                'updated_by' => Auth::user()->id,
                'updated_on' => date('Y-m-d')
            ]);
        return redirect()->route('interview')->with('success','Interiew Date and Time Updated Successfully !');
    }

    public function ranking(){   
        $key = '0';
        $allapplication = DB::table('tb_training_applications as app')
        ->join('tbl_interview_statuses as inv', 'inv.appID', '=', 'app.id')
        ->join('tbl_genders as g', 'g.id', 'app.gender')
        ->where('app.shortlist_status', 1)
        ->where('app.interview_status', 1)
        ->select(
            'app.*', 
            'g.gender as sex',
            DB::raw('COALESCE(SUM(inv.score),0) as total_score'),
            DB::raw('ROUND(COALESCE(AVG(inv.score), 0), 2) as avg_score')
            )
        ->groupBy('app.id')
        ->orderBy('app.totalscore', 'desc')
        ->get();

        $training = Training::all();

        return view('ranking.index', compact('allapplication', 'training'));
    }

    public function rankingsearch(Request $request)
    {
        $key = $request->key;

        $allapplication = DB::table('tb_training_applications as app')
        ->join('tbl_interview_statuses as inv', 'inv.appID', '=', 'app.id')
        ->join('tbl_genders as g', 'g.id', 'app.gender')
        ->where('app.shortlist_status', 1)
        ->where('app.interview_status', 1)
        ->where('app.trainingid', $key)
        ->select(
            'app.*', 
            'g.gender as sex',
            DB::raw('COALESCE(SUM(inv.score),0) as total_score'),
            DB::raw('ROUND(COALESCE(AVG(inv.score), 0), 2) as avg_score')
            )
        ->groupBy('app.id')
        ->orderBy('app.totalscore', 'desc')
        ->get();

        $training = Training::all();

        return view('ranking.index', compact('allapplication', 'training'));
        // return view('ranking.index1', compact('allapplication', 'key', 'training'));
    }

    public function rankingsearchid($key)
    {
        $allapplication = DB::table('tb_training_applications')
        ->join('tbl_shortlist_statuses', 'tb_training_applications.id', '=', 'tbl_shortlist_statuses.appid')
        ->where('tbl_shortlist_statuses.status', '1')
        ->where('tb_training_applications.trainingid', $key)
        ->select('tb_training_applications.*')
        ->orderBy('tb_training_applications.totalscore', 'desc')
        ->get();
        return view('ranking.index1', compact('allapplication', 'key'));
    }

    public function view_ranking_details($appid)
    {
        // $gender = tbl_gender::all();
        // $qualification = Qualification::all();
        // $dzongkhag = mst_dzongkhag::all();
        // $jobstatus = Jobstatus::all();
	// $application =  TrainingApplication::where('id', $appid)->get();
    $application = DB::table('tb_training_applications as app')
                ->join('tbl_soft_skills as ss', 'ss.appid', 'app.id')
                ->join('tbl_hard_skills as hs', 'hs.appid', 'app.id')
                ->join('tbl_training_app_docs as doc', 'doc.appid', 'app.id')
                ->join('tbl_trainings as t', 'app.trainingid', 't.id')
                ->join('mst_dzongkhags as dzo', 'dzo.dzongkhag_id', 'app.dzongkhag')
                ->join('tbl_genders as g', 'g.id', 'app.gender')
                ->join('tbl_qualifications as qua', 'qua.id', 'app.qualification')
                ->join('tbl_job_statuses as job', 'job.id', 'app.job_status')
                ->leftjoin('tbl_interview_dates as inv', 'app.id', 'inv.appID')  
                ->select('app.*',
                'ss.*',
                'hs.*',
                'doc.passport as passport',
                'doc.cid as cid_attatch',
                'doc.noc as noc',
                'doc.cv as cv',
                'doc.certificate as certificate',
                'doc.supporting as supporting',
                'doc.workexample as workexample',
                'doc.sample1 as sample1',
                'doc.sample2 as sample2',
                'doc.doc_path as doc_path',
                'g.gender as sex',
                'dzo.dzongkhag_name as dzo',
                'qua.qualification as quali',
                'job.status as job',
                't.training_title as training_name',
                'inv.id as interviewdate_id',
                )
                ->where('app.id', $appid)->first();

        $trainingid =  TrainingApplication::where('id', $appid)->value('trainingid');
        // $softskill =  Softskills::where('appid', $appid)->get();
        // $hardskill =  Hardskills::where('appid', $appid)->get();
        // $pannels = Interviewpanel::where('trainingid', $trainingid)->get();
        $pannels = DB::table('tbl_interviewpannels as ip')
                ->join('tbl_interview_statuses as inv', 'ip.id', 'inv.pannelID')
                ->join('tbl_panelroles as pr', 'pr.id', 'ip.role')
                ->where('ip.trainingid', $trainingid)
                ->where('inv.appID', $appid)
                ->select('ip.*', 
                'inv.score as score', 
                'inv.remarks as remark', 
                'pr.rolename as rolename',
                'inv.id as score_id'
                )->get();
        
        $avg_score = number_format(DB::table('tbl_interview_statuses')
                ->where('tbl_interview_statuses.appID', $appid)
                ->avg('score'), 2);
        // $ssdate = ScreeningStatus::where('appid', $appid)->value('created_on');
	// $sldate = ShortlistStatus::where('appid', $appid)->value('created_on');
	// $name =  TrainingApplication::where('id', $appid)->value('name');
	$jc =  count(Interviewpanel::where('trainingid', $trainingid)->get());
	return view('ranking.view', compact(
		'jc',
		//  'name',
            'appid',
            // 'sstatus',
            // 'slstatus',
            'application',
            // 'gender',
            // 'qualification',
            // 'dzongkhag',
            // 'jobstatus',
            // 'softskill',
            // 'hardskill',
            'pannels',
            // 'ssdate',
            // 'sldate',
            'trainingid',
            'avg_score'
        ));
    }

    public function RankingStatusFast(Request $request){
        $sid = $request->sid;
        $cohortopen = $request->cohortopen;
        $no = $request->cohortopenno;
        if($cohortopen == '' && $no == ''){
        $lic_rows = $request->rowss;
        for ($i = 0; $i < count($lic_rows['steps'][1]); $i++) {
            $count = count(RankingStatus::where('trainingID', $lic_rows['steps'][2][$i])->where('appID', $lic_rows['steps'][1][$i])->get());
            if($count == '0')
            {
             $rs = new RankingStatus;
             $rs->trainingID = $lic_rows['steps'][2][$i];
             $rs->appID = $lic_rows['steps'][1][$i];
             $rs->status = $lic_rows['steps'][3][$i];
             $rs->created_by = Auth::user()->id;
             $rs->created_at = date('Y-m-d');
             $rs->save();
             $myEmail = TrainingApplication::where('id', $lic_rows['steps'][1][$i])->value('email');
             $trainingid = TrainingApplication::where('id', $lic_rows['steps'][1][$i])->value('trainingid');
             $trainingname = Training::where('id', $trainingid)->value('training_title');
             $status = $lic_rows['steps'][3][$i];
             //Mail::to($myEmail)->send(new SendSelectedStatusTraining($trainingname, $status));

            }
            if($count == '1')
            {
             $id = RankingStatus::where('trainingID', $lic_rows['steps'][2][$i])->where('appID', $lic_rows['steps'][1][$i])->value('id');
             $rsu = new RankingStatus;
             $rsu::where('id', $id)
            ->update([
                'status' => $lic_rows['steps'][3][$i],
                'updated_by' => Auth::user()->id,
                'updated_at' => date('Y-m-d')
            ]);
            }
        }
        // if($sid == '0'){
        return redirect()->route('ranking')->with('success','Selection Status Updated Successfully');
        // }
        // else
        // {
        //     return redirect()->route('ranksearchid', $sid)->with('success','Selection Status Updated Successfully');
        // }
    }
    else
    {
        $key = $sid;
        $allapplication = DB::table('tb_training_applications')
            ->join('tbl_ranking_statuses', 'tb_training_applications.id', '=', 'tbl_ranking_statuses.appID')
            ->where('tb_training_applications.opencohort', $cohortopen)
            ->where('tb_training_applications.opencohortno', $no)
            ->where('tb_training_applications.interview_status', '1')
            ->where('tbl_ranking_statuses.status', '1')
            ->select('tb_training_applications.*')
            ->get();

     return view('ranking.selectedlist', compact('allapplication', 'cohortopen', 'no'));
    }

    }

    public function completion(){
        $key = '0';

    $allapplication = DB::table('tb_training_applications as app')
                        ->join('tbl_interview_statuses as inv', 'inv.appID', '=', 'app.id')
                        ->join('tbl_ranking_statuses as rank', 'rank.appID', 'app.id')
                        ->join('tbl_genders as g', 'g.id', 'app.gender')
                        ->where('app.interview_status', 1)
                        ->where('rank.status', 1)
                        ->select(
                            'app.*', 
                            'g.gender as sex',
                            DB::raw('COALESCE(SUM(inv.score),0) as total_score'),
                            DB::raw('ROUND(COALESCE(AVG(inv.score), 0), 2) as avg_score')
                            )
                        ->groupBy('app.id')
                        ->orderBy('app.totalscore', 'desc')
                        ->get();

    $training = Training::all();

    return view('posttraining.index', compact('allapplication', 'training'));
    }

    public function completionsearch(Request $request)
    {
        $key = $request->key;
        $allapplication = DB::table('tb_training_applications')
        ->join('tbl_ranking_statuses', 'tb_training_applications.id', '=', 'tbl_ranking_statuses.appID')
        ->where('tbl_ranking_statuses.status', '1')
        ->where('tb_training_applications.trainingid', $key)
        ->select('tb_training_applications.*')
        ->orderBy('tb_training_applications.totalscore', 'desc')
        ->get();

        return view('posttraining.index', compact('allapplication', 'key'));
        // return view('posttraining.index1', compact('allapplication', 'key'));
    }

    public function completionsearchid($key)
    {
        $allapplication = DB::table('tb_training_applications')
        ->join('tbl_ranking_statuses', 'tb_training_applications.id', '=', 'tbl_ranking_statuses.appID')
        ->where('tbl_ranking_statuses.status', '1')
        ->where('tb_training_applications.trainingid', $key)
        ->select('tb_training_applications.*')
        ->orderBy('tb_training_applications.totalscore', 'desc')
        ->get();
        return view('posttraining.index1', compact('allapplication', 'key'));
    }

    public function posttraining_update(Request $request)
    {
         $key = $request->key;
         $lic_rows = $request->rowss;
        for ($i = 0; $i < count($lic_rows['steps'][1]); $i++) {
            $count = count(PosttrainingStatus::where('appID', $lic_rows['steps'][1][$i])->get());
            if($count == '0')
            {
             $rs = new PosttrainingStatus;
             $rs->appid = $lic_rows['steps'][1][$i];
             $rs->status = $lic_rows['steps'][2][$i];
             $rs->created_by = Auth::user()->id;
             $rs->created_at = date('Y-m-d');
             $rs->save();
            }
            if($count == '1')
            {
             $id = PosttrainingStatus::where('appID', $lic_rows['steps'][1][$i])->value('id');
             $rsu = new PosttrainingStatus;
             $rsu::where('id', $id)
            ->update([
                'status' => $lic_rows['steps'][2][$i],
                'updated_at' => date('Y-m-d')
            ]);
            }
        }
        // if($key == '0'){
        return redirect()->route('completion')->with('success','Post Training Updated Successfully');
        // }
        // else
        // {
        //     return redirect()->route('completionsearchid', $key)->with('success','Post Training Updated Successfully');
        // }

    }

    public function export($trainingid)
    {
        return Excel::download(new TrainingScoreExport($trainingid), 'TrainingScore.xlsx');
    }

    public function import(Request $request)
    {
         $appid = $request->appid;
         $sstatus = $request->sstatus;
         $slstatus = $request->slstatus;
         $validatedData = $request->validate(['file' => 'required',]);
         Excel::import(new TrainingScoreImport($appid),$request->file('file'));

         $totalscore = '0';
         $Scores = InterviewStatus::where('appID', $appid)->get();
         foreach($Scores as $score)
         {
            $totalscore = $totalscore + $score->score;
         }

        $tu = TrainingApplication::findOrFail($appid);
        $tu->interview_status = '1';
        $tu->totalscore = $totalscore;
        $tu->save();
        return redirect()->route('interview_app_details', [$appid, $sstatus, $slstatus])->with('success', 'Excel Data Imported to Database');
    }

    public function sendshortlistmail($cohortopen, $no)
      {
        // $data["allapplication"] = DB::table('tb_training_applications')
        //     ->join('tbl_shortlist_statuses', 'tb_training_applications.id', '=', 'tbl_shortlist_statuses.appid')
        //     ->where('tb_training_applications.opencohort', $cohortopen)
        //     ->where('tb_training_applications.opencohortno', $no)
        //     ->where('tb_training_applications.shortlist_status', '1')
        //     ->where('tbl_shortlist_statuses.status', '1')
        //     ->select('tb_training_applications.*')
        //     ->get();

            $Emails = ICTemail::all();
            foreach ($Emails as $e)
            {
                $email=$e->email;
                Mail::to($email)->send(new TrainingShortListMail($cohortopen, $no));
            }

        Alert::success('Success', 'Email sent successfully');
        // $allapplication = TrainingApplication::where('screening_status', '1')->orderBy('id', 'desc')->get();

        $allapplication = DB::table('tb_training_applications as app')
        ->leftjoin('tbl_sl_statuses as sl', 'app.id', '=', 'sl.appID')
        ->join('tbl_genders as g', 'g.id', 'app.gender')
        ->select(
            'app.*', 
            'g.gender as sex',
            DB::raw('COALESCE(SUM(sl.score),0) as total_score'),
            DB::raw('ROUND(COALESCE(AVG(sl.score), 0), 2) as avg_score')
            )
        ->groupBy('app.id')
        ->orderBy('app.id', 'desc')
        ->get();

        $training = Training::all();
        
        return view('shortlist.index', compact('allapplication', 'training'))->with('success','Mail Sent!');
 }

 public function sendselectedmail($cohortopen, $no)
      {
        $data["allapplication"] = DB::table('tb_training_applications')
            ->join('tbl_ranking_statuses', 'tb_training_applications.id', '=', 'tbl_ranking_statuses.appID')
            ->where('tb_training_applications.opencohort', $cohortopen)
            ->where('tb_training_applications.opencohortno', $no)
            ->where('tb_training_applications.interview_status', '1')
            ->where('tbl_ranking_statuses.status', '1')
            ->select('tb_training_applications.*')
            ->get();

            $Emails = ICTemail::all();
            foreach ($Emails as $e)
            {
                $email=$e->email;
                Mail::to($email)->send(new TrainingSelectedListMail($cohortopen, $no));
            }
	 Alert::success('Success', 'Email sent successfully');
    //   if($sid == '0'){
        return redirect()->route('ranking');
    //   }
    //   else
    //   {
    //     return redirect()->route('ranksearchid', $sid);
    //   }
 }

 public function selectedlist($cohortopen, $no)
    {
        $allapplication = DB::table('tb_training_applications')
            ->join('tbl_ranking_statuses', 'tb_training_applications.id', '=', 'tbl_ranking_statuses.appID')
            ->where('tb_training_applications.opencohort', $cohortopen)
            ->where('tb_training_applications.opencohortno', $no)
            ->where('tb_training_applications.interview_status', '1')
            ->where('tbl_ranking_statuses.status', '1')
            ->select('tb_training_applications.*')
            ->get();

     return view('ranking.selectedlist1', compact('allapplication', 'cohortopen', 'no'));
    }


}

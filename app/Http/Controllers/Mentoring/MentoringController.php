<?php
namespace App\Http\Controllers\Mentoring;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Models\user;
use App\Models\FundingApplication;
use App\Models\TrainingApplication;
use App\Models\ApplicationUserMap;
use App\Models\Mentoring;
use App\Models\MentroingDocs;
use App\Models\Training;
use App\Models\Funding;
use App\Mail\SendMentoringDate;
use App\Mail\FundSelectedListMail;
use RealRashid\SweetAlert\Facades\Alert;
use DB;
use Mail;

class MentoringController extends Controller
{
    public function index()
    {
        $allapplication = Mentoring::orderBy('id', 'desc')->get();
        return view('mentroing.index', compact('allapplication'));
    }

    public function adnewmentoring()
    {
        return view('mentroing.add');
    }

    public function addmentoring(Request $request)
    {
        $Mentoring = new Mentoring;
        $Mentoring->SupportType = $request->SupportType;
        $Mentoring->StartDate = $request->StartDate;
        $Mentoring->EndDate = $request->EndDate;
        $Mentoring->Mentor = $request->Mentor;
        $Mentoring->NoofPartipants = $request->NoofPartipants;
        $Mentoring->Objective = $request->Objective;
        $Mentoring->Requirements = $request->Requirements;
        $Mentoring->EligibleCohorts = $request->EligibleCohorts;
        $Mentoring->created_by = Auth::user()->id;
        $Mentoring->created_on = date('Y-m-d');
        $Mentoring->save();
        $MentoringId = $Mentoring->id;

        if ($request->CVoftheMentor != 0) {
            foreach ($request->CVoftheMentor as $file) {
                $filename = $file->getClientOriginalName();
                $path = public_path().'/uploads/CVoftheMentor' ;
                $file->move($path,$filename);
                MentroingDocs::create([
                    'mentoringid' => $MentoringId,
                    'file_name' => $filename,
                    'doc_path' => $path,
                    'created_by'=>Auth::user()->id,
                    'created_at' => date('Y-m-d')
                ]);
            }
        }
        return redirect()->route('mentoring')->with('success','Mentroing Added Successfully!');
    }

    public function mentoringview($id)
    {
        $allapplication = Mentoring::where('id', $id)->orderBy('id', 'desc')->get();
        return view('mentroing.view', compact('allapplication', 'id'));
    }

    public function mentoringmail($id)
    {
 $torf = Mentoring::where('id', $id)->value('TrainingFunding');
        $sent = Mentoring::where('id', $id)->value('sent');
        if($torf == 't')
        {
        $tid =  Mentoring::where('id', $id)->value('EligibleCohorts');
        $allapplication = TrainingApplication::where('trainingid', $tid)->orderBy('id', 'desc')->get();
        }
        if($torf == 'f')
        {
        $fid =  Mentoring::where('id', $id)->value('EligibleCohorts');
        $allapplication = FundingApplication::where('fundid', $fid)->orderBy('id', 'desc')->get();
        }
        $mid = $id;
        return view('mentroing.maillist', compact('allapplication', 'id', 'sent', 'mid'));
    }

    public function sendmail($mid, $email)
    {
	    Mail::to($email)->send(new SendMentoringDate($mid));
	    Alert::success('Success', 'Email sent successfully');
        return redirect()->route('mentoringmail', $mid);
    }

    public function sendmail_select(Request $request)
    {
        $mid = $request->mid;
        $input = $request->all();
        $pmail = $input['pmail'];
        $input['pmail'] = implode(',', $pmail);
        $addmorepost=$request->pmail;
        for ($i= 0; $i < count($addmorepost); $i++ )
          {
           $appID = $pmail[$i];
           $torf = Mentoring::where('id', $mid)->value('TrainingFunding');
           if($torf == 'f'){
           $email = FundingApplication::where('id', $appID)->value('email');
           }
           if($torf == 't'){
            $email = TrainingApplication::where('id', $appID)->value('email');
            }
           Mail::to($email)->send(new SendMentoringDate($mid));

	     }
         Alert::success('Success', 'Emails sent successfully');
         return redirect()->route('mentoringmail', $mid);
    }


    public function mentoringviewent($id)
    {
        $allapplication = Mentoring::where('id', $id)->orderBy('id', 'desc')->get();
        return view('mentroing.viewent', compact('allapplication', 'id'));
    }

    public function updatementoring(Request $request)
    {
        $id = $request->edit_id;
        $Mentoring = new Mentoring;
        $Mentoring::where('id', $id)
            ->update([
                'SupportType' => $request->SupportType,
                'StartDate' => $request->StartDate,
                'EndDate' => $request->EndDate,
                'Mentor' => $request->Mentor,
                'NoofPartipants' => $request->NoofPartipants,
                'Objective' => $request->Objective,
                'Requirements' => $request->Requirements,
                'EligibleCohorts' => $request->EligibleCohorts,
                'updated_by' => Auth::user()->id,
                'updated_on' => date('Y-m-d')
            ]);
            return redirect()->route('mentoring')->with('success','Mentroing Updated Successfully!');

    }

    public function addmentorgrp(Request $request)
    {
        $id = $request->mid;
        $torf = $request->torf;
        $group = $request->group;
        $no = $request->no;
        if($torf == 't')
        {
            echo $groupid = Training::where('opencohort', $group)->where('opencohortno', $no)->value('id');
        }

        if($torf == 'f')
        {
            echo $groupid = Funding::where('opencohort', $group)->where('opencohortno', $no)->value('id');
        }
        $Mentoring = new Mentoring;
        $Mentoring::where('id', $id)
            ->update([
                'TrainingFunding' => $request->torf,
                'EligibleCohorts' =>$groupid,
                'updated_by' => Auth::user()->id,
                'updated_on' => date('Y-m-d')
            ]);
            return redirect()->route('mentoring')->with('success','Mentroing Updated Successfully!');

    }

    public function deletementor($id)
    {
        $fund = new Mentoring;
        $fund::where('id', $id)->delete();
        return redirect()->route('mentoring')->with('success','Mentoring Removed Successfully!');
    }


}

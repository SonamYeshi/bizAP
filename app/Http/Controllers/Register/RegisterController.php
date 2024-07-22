<?php

namespace App\Http\Controllers\Register;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

use App\Models\tbl_employment_type;
use App\Models\tbl_agency_category;
use App\Models\tbl_sub_agency;
use App\Models\tbl_service_category;
use App\Models\tbl_position_title;
use App\Models\tbl_position_level;
use App\Models\tbl_working_agency;
use App\Models\mst_dzongkhag;
use App\Models\mst_gewog;
use App\Models\mst_village;
use App\Models\tbl_declarant_category;
use App\Models\tbl_gender;
use App\Models\tbl_marital_status;
use App\Models\tbl_covered_people;

use App\Models\tbl_bhutaneseregistration;
use App\Models\user;
use Auth;
use DB;
use Mail;
use App\Mail\SendEmail;

class RegisterController extends Controller
{
    public function register_type()
    {
       return view('register.register_type');
    }
    public function bhutaneseregister(Request $request)
    {
      $cidno = $request->cidno;
      $emp_id = $request->emp_id;
        $employmenttype = tbl_employment_type::all();
        $agencycategory = tbl_agency_category::all(); 
        $subagency = tbl_sub_agency::all(); 
        $servicecategory = tbl_service_category::all();
        $positiontitle = tbl_position_title::all();
        $positionlevel = tbl_position_level::all();
        $workingagency = tbl_working_agency::all();
        $dzongkhag = mst_dzongkhag::all();  
        $maritalstatus = tbl_marital_status::all(); 
        $declarantcategory = tbl_declarant_category::all(); 
        $countries = DB::table("tbl_agency_categories")->pluck("agency_category","id");
        $covered_list = count(tbl_covered_people::where('cid', $cidno)->get());
        $bhtreg = count(tbl_bhutaneseregistration::where('cid', $cidno)->where('approval_status',1)->get());
        $approvalstatus = tbl_bhutaneseregistration::where('cid', $cidno)->limit(1)->value('approval_status');
      if($cidno != '')
        {  
        return view('register.registration_fetch', compact('cidno','emp_id','covered_list','maritalstatus','declarantcategory','dzongkhag','positionlevel','countries','employmenttype','agencycategory','subagency','servicecategory','positiontitle','workingagency','bhtreg','approvalstatus'));
        }
      else if($emp_id == '123')
        {     
        return view('registration_fetch');
        }     
        return redirect()->route('registration');
    }
    public function save_bhutaneseregistration(Request $request)  
    {
        $dob = $request->dob;
        $date = str_replace('/', '-', $dob );
        $newDatedob = date("Y-m-d", strtotime($date));
        $bht = new tbl_bhutaneseregistration;     
        $bht->cid=$request->cid;
        $bht->name=$request->name;
        $bht->dob=$newDatedob;
          $g = $request->gender;
          if($g == "M") {$gender = '1'; } else { $gender = '2'; }
          $gender = $gender;
        $bht->gender=$gender; 
        $bht->marital_status=$request->marital_status; 
        $bht->dzongkhag=$request->type1;      
        $bht->dungkhag=$request->dungkhag;        
        $bht->gewog=$request->gewog;
        $bht->village=$request->village;
        $bht->email=$request->email;
        $bht->mobile_no=$request->mobile_no;
        $bht->office_no=$request->office_no;
        $bht->emp_id=$request->emp_id;
        $bht->employee_type=$request->employee_type;
        $bht->agency_category=$request->category_id;
        $bht->workingagency=$request->workingagency;
        $bht->subagency=$request->subagency;
        $bht->service_category=$request->service_category;
        $bht->current_posting=$request->current_posting;
        $bht->position_title=$request->position_title;
        $bht->position_level=$request->position_level;
        $bht->declarant_category=$request->declarant_category;
        $dc = $request->declarant_category;
        if($dc == 1)
          $bht->approval_status=1;
        else
          $bht->approval_status=0;
        $bht->created_at=date('Y-m-d');
        $bht->save();

      /*$user = new user;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make('pass@123');
        $user->created_at=date('Y-m-d');
        $user->save();
        return view('register.registration_fetch')->with('success','Application Successfully Submitted, Your login credentials will be emailed after Review.');*/
        return redirect()->route('registration_type')->with('success','Application Successfully Submitted, Your login credentials will be Emailed to the Email Address Provided after Review.');     
    }
          public function ajaxRequestPost(Request $request)
          {
          $email = $request->email;
          $dup  = count(DB::table('tbl_bhutaneseregistrations')->where('email',$email)->get());       
          if( $dup > 0)
            { return json_encode(['success'=>1]); }
            else{return json_encode(['success'=>0]); }                    
          }

    public function registration_requests()
    {
       $dzongkhag = mst_dzongkhag::all();  
       $subagency = tbl_sub_agency::where('working_agency_id',Auth::User()->working_agency)->get();
       $reglist = tbl_bhutaneseregistration::where('workingagency',Auth::User()->working_agency)->where('approval_status',0)->orderby('id','desc')->get();
       return view('register.registration_requests', compact('dzongkhag','subagency','reglist'));
    }
    public function registration_request_review($reg_id)
    {
       $reg_id = $reg_id;
       $app =  tbl_bhutaneseregistration::where('id', $reg_id)->get();
       return view('register.registration_request_review', compact('reg_id','app'));
    }
    public function approve_registration_request(Request $request,$reg_id)
    {
        $reg_id = $reg_id;
        $cda = tbl_bhutaneseregistration::where('id', $reg_id)->value('id'); 
        $cda = tbl_bhutaneseregistration::where('id', $reg_id)->latest()->firstOrFail();
        $cda->approval_status=$request->approve;
        $cda->approval_remarks=$request->remarks;
        $cda->save();
        $user = new user;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->role_id=$request->role_id;
        $user->working_agency=$request->working_agency;
        $user->password=Hash::make('pass@123');
        $user->created_at=date('Y-m-d');
        $user->save();
        $password='pass@123';
        $myEmail = $request->email;
        Mail::to($myEmail)->send(new SendEmail($user, $password));
        $request->session()->flash('alert-info', 'Assessment Successful');
        return redirect()->route('registration_requests')->with('success','Registration Assessment Successful, an Email will be sent to the Applicant with his login Credentials if Approved.');
    }







    public function registration_fetch()
    {
       return view('register.registration_fetch');
    }




    public function registration()
    {
       $employmenttype = tbl_employment_type::all();
       $agencycategory = tbl_agency_category::all(); 
       $subagency = tbl_sub_agency::all(); 
       $servicecategory = tbl_service_category::all();
       $positiontitle = tbl_position_title::all();
       $positionlevel = tbl_position_level::all();
       $workingagency = tbl_working_agency::all();
       $dzongkhag = mst_dzongkhag::all(); 
       $gewog = mst_gewog::all();
       $village = mst_village::all();
       $gender = tbl_gender::all(); 
       $maritalstatus = tbl_marital_status::all(); 
       $declarantcategory = tbl_declarant_category::all(); 
       $countries = DB::table("tbl_agency_categories")->pluck("agency_category","id");
       $bhtreg = count(tbl_bhutaneseregistration::where('cid', $cidno)->where('approval_status',1)->get());
       $approvalstatus = tbl_bhutaneseregistration::where('cid', $cidno)->limit(1)->value('approval_status');
       return view('register.registration', compact('maritalstatus','gender','declarantcategory','dzongkhag','gewog','village','positionlevel','countries','employmenttype','agencycategory','subagency','servicecategory','positiontitle','workingagency','bhtreg','approvalstatus'));
    }
 public function index()
 {
 $countries = DB::table("tbl_agency_categories")->pluck("agency_category","id");
 return view('dropdown',compact('countries'));
 }
 
 public function getState(Request $request)
 {
 $states = DB::table("tbl_working_agencies")
 ->where("agency_id",$request->id)
 ->pluck("working_agency","id");
 return response()->json($states);
 }
 
 public function getCity(Request $request)
 {
 $cities = DB::table("tbl_sub_agencies")
 ->where("working_agency_id",$request->id)
 ->pluck("sub_agency","id");
 return response()->json($cities);
 }
 public function view(Request $request) 
    {
        if($request->ajax())
        {
            $id = $request->id;
            $info = mst_dzongkhag::where('dzongkhag_id', $id)->get();
            return response()->json($info);
        }
    }
public function view1(Request $request)
    {
        if($request->ajax())
        {
            $id = $request->id;
            $info = mst_gewog::where('dzongkhag_id', $id)->get();
            return response()->json($info);
        }
    }
public function view2(Request $request)
    {
        if($request->ajax())        
        {
            $id = $request->id;
            $info = mst_village::where('gewog_id', $id)->get();
            return response()->json($info);
        }
    } 




    public function registration_nonbht()
    {
        return view('register.registration_nonbht');
    }
    

}

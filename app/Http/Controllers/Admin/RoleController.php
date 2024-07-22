<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Auth;
use Session;
use App\Models\tbl_role;
use App\Models\user;
use App\Models\ICTemail;
use App\Models\DHICEO;
use App\Models\BankEmail;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\SendEmail;


class RoleController extends Controller
{

    public function index()
    {
      $roles = tbl_role::all();
      return view('admin.role.view', compact('roles'));
    }

    public function ictemail()
    {
      $ictemail = ICTemail::all();
      return view('admin.ictmail.view', compact('ictemail'));
    }

   public function ictview(Request $request)
    {
        if($request->ajax()){
            $id = $request->id;
            $info = ICTemail::find($id);
            return response()->json($info);
        }
    }

    public function update_ictmail(Request $request){

        $id = $request->edit_id;
        $name = $request->uname;
        $email = $request->email;
        $user = new ICTemail;
        $user::where('id',$id)
            ->update([
                'name'=> $name,
                'email'=> $email
                ]);
      return redirect()->route('view_ictemail');
    }

    public function dhiceo()
    {
      $dhiceo = DHICEO::all();
      return view('admin.dhiceo.view', compact('dhiceo'));
    }

    public function bank()
    {
      $dhiceo = BankEmail::all();
      return view('admin.bank.view', compact('dhiceo'));
    }

    public function ceoview(Request $request)
    {
        if($request->ajax()){
            $id = $request->id;
            $info = DHICEO::find($id);
            return response()->json($info);
        }
    }

    public function bankview(Request $request)
    {
        if($request->ajax()){
            $id = $request->id;
            $info = BankEmail::find($id);
            return response()->json($info);
        }
    }

    public function update_ceo(Request $request){

        $id = $request->edit_id;
        $name = $request->uname;
        $user = new DHICEO;
        $user::where('id',$id)
            ->update([
                'name'=> $name
                ]);
      return redirect()->route('view_dhiceo');
    }

    public function update_bank(Request $request){

        $id = $request->edit_id;
        $name = $request->name;
        $email = $request->email;
        $user = new BankEmail;
        $user::where('id',$id)
            ->update([
                'name'=> $name,
                'email'=> $email
                ]);
      return redirect()->route('view_bank');
    }

    public function postRole(Request $request){
        $role = new tbl_role;
        $role->role_name = $request->role_name;
        $role->description =$request->description;
        $role->save();
        return redirect()->route('view_role');
      }

    public function destroy_role($id)
    {
        $section = new tbl_role;
        $section::where('id', $id)->delete();
        return redirect()->route('view_role')->with('success', 'Role has been deleted successfully');
    }

    public function destroy_ictmail($id)
    {
        $section = new ICTemail;
        $section::where('id', $id)->delete();
        return redirect()->route('view_ictemail');
    }

}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Models\tbl_role;
use App\Mail\SendUserDetail;
use App\Models\user;
use DB;
use Mail;
use Auth;


class UserController extends Controller
{
public function loginpage()
{
    $logo = "";
return view('auth.login', compact('logo'));
}
    public function index()
    {
        $users = user::orderby('id', 'desc')->get();
        return view('admin.user.index', compact('users'));
    }
    public function postUser(Request $request)
    {

        $user = new user;
        $user->name = $request->uname;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $password = 'pass@123';
        $user->password = Hash::make($password);
        $user->save();
        $userid = $request->email;
        $password = 'pass@123';
        $myEmail = $request->email;
        Mail::to($myEmail)->send(new SendUserDetail($userid, $password));
        return redirect()->route('view_user')->with('success','User Created, Email Successfully Sent with Credentials!');


    }
    public function view(Request $request)
    {
        if($request->ajax()){
            $id = $request->id;
            $info = user::find($id);
            return response()->json($info);
        }
    }
    public function updateUser(Request $request)
     {

        $id = $request->edit_id;
        $name = $request->uname;
        $email = $request->email;
        $working_agency=$request->working_agency;
        $role_id =  $request->role_id;
        $user = new user;
        $user::where('id',$id)
            ->update([
                'name'=> $name,
                'email'=> $email,
                'role_id' =>$role_id
                ]);
        $users = user::orderby('id', 'desc')->get();

        return view('admin.user.index', compact('users'));

    }
    public function deleteUser($id)
    {
        $user = new user;
        $user::where('id', $id)->delete();
        return redirect()->route('view_user');
    }
    public function SendMail(Request $request)
    {
        //$email =  tbl_user::where('id', $id)->value('email');
        $myEmail = 'tobgyalsonam44@gmail.com';
        Mail::to($myEmail)->send(new MyTestMail());
        dd("Mail Send Successfully");
    }







}

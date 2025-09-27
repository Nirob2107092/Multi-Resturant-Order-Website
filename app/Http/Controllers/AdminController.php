<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\Websitemail;
use App\Models\Admin;
class AdminController extends Controller
{  public function AdminLogin(){
    return view('admin.login');
}
public function AdminDashboard(){
    return view('admin.index');
}
public function AdminLoginSubmit(Request $request){
    $request->validate([
        'email'=>'required|email',
        'password'=>'required',
    ]);
    $check = $request->all();
    $data = [
        'email' => $check['email'],
        'password' => $check['password'],
    ];
    if(Auth::guard('admin')->attempt($data)){
        return redirect()->route('admin.dashboard')->with('success', 'Login Successfully');
}else{
    return redirect()->route('admin.login')->with('error', 'Invalid Credentials');
}
   
}
public function AdminLogout(){
    Auth::guard('admin')->logout();
    return redirect()->route('admin.login')->with('success', 'Logout Successfully');
}

public function AdminForgetPassword(){
    return view('admin.forget_password');
}
public function AdminPasswordSubmit(Request $request){
$request->validate([
    'email' => 'required|email'
]);
$admin_data=Admin :: where('email',$request->email)->first();
if(!$admin_data)
{
    return redirect()->back()->with('error','Email not found');
}
$token = hash('sha256',time());
$admin_data->token=$token;
$admin_data->update();
$reset_link = url('admin/reset-password/'.$token.'/'.$request->email);
$subject= "Reset Password";
$message= "Please click on below link to reset password <br>" ;
$message .= "a href='".$reset_link."' target='_blank'>Click Here</a>";

Mail::to($request->email)->send(new Websitemail($subject,$message));
return redirect()->back()->with('success','We have emailed your password reset link');
}
public function AdminResetPassword($token,$email)
{
    $admin_data= Admin :: where('email',$email)->where('token',$token)->first();
    if(!$admin_data)
    {
        return redirect()->route('admin.login')->with('error','Invalid Token or Email');

    }
    return view('admin.reset_password',compact('token','email'));
}
public function AdminProfile(){
    $id=Auth::guard('admin')->id();
    $profileData=Admin::find($id);
    return view('admin.admin_profile',compact('profileData'));
}


}
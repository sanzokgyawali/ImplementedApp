<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
class AdminController extends Controller
{
  public function index()
  {
    if(Session::get('admin_name'))
    {
      return Redirect::to('admin/dashboard');
    }
    else{
  //  echo "Camein";
    return view('admin.admin_login');
  }
  }
  public function dashboard(Request $request)
  {
    $validatedData = $request->validate([
     'admin_email' => 'required|email',
     'admin_password' => 'required',


 ]);
    $admin_email=$request->admin_email;
    $admin_password=md5($request->admin_password);
    $result=DB::table('tbl_admin')->where('admin_email',$admin_email)->first();
    if($result){
    if($result->admin_password==$admin_password)
    {
      Session::put('admin_name',$result->admin_name);
      Session::put('admin_id',$result->admin_id);
      Session::put('admin_role',$result->admin_role);
      Session::put('admin_email',$result->admin_email);
      return Redirect::to('admin/dashboard');
    }
    else {
      Session::put('Message','Password is Invalid');
      return Redirect::to('/admin');
    }
  }else {
    {
      Session::put('Message','Email is Invalid');
      return Redirect::to('/admin');
    }
  }
  }
  public function show_dashboard()
  {
    $login=Session::get('admin_name');
    if($login){
    return view('admin.dashboard');
  }else {
    return Redirect::to('/admin');
  }
  }

}

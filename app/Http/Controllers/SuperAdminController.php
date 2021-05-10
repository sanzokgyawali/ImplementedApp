<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
session_start();
class SuperAdminController extends Controller
{
  public function logout()
  {
    Session::put('admin_name',null);
    Session::put('admin_id',null);
    return Redirect::to('/admin');
  }
}

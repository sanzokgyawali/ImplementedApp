<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;

class HomeController extends Controller
{
    public function index()
    {
      $rescat=DB::select('select * from tbl_category where publication_status=1');
      $res=DB::select('select * from tbl_manufacture where publication_status=1');
      return view('pages.home_content',['rescat'=>$rescat,'res'=>$res]);
    }
}

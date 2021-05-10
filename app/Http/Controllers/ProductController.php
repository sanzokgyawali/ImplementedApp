<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductController extends Controller
{
    public function add_product()
    {
      $res=DB::select("select * from tbl_category where publication_status=1");
      return view('admin.add_product',['res'=>$res]);
    }
    public function ajax(Request $request)
    {

      $value=$request->get('value');
    
      $res=DB::table('tbl_manufacture')->where('category_id',$value)->get();
      $output='';
       foreach($res as $r)
       {
         $output.='<option value="'.$r->manufacture_id.'">'.$r->manufacture_name.'</option>';

       }
      return response()->json(['data'=>$output]);

    }
}

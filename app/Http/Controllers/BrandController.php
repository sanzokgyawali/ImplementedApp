<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;

class BrandController extends Controller
{
  function init()
 {
   $login=Session::get('admin_name');
   if(!$login)
   {
   echo "<script>window.location='/admin'</script>";
   }
 }
    public function index()
    {
      $this->init();
      $rescat=DB::select("select * from tbl_category");
      return view('admin.add_brand',['rescat'=>$rescat]);
    }
    public function add_brand(Request $request)
    {
      $validatedData = $request->validate([
       'brand_name' => 'required|max:255',
       'brand_description' => 'required',


   ]);
      $cat=$request->brand_category;
      $manufacture_name=$request->brand_name;
      $manufacture_description=$request->brand_description;
        $publication_status=$request->publication_status;
      if($publication_status==1)
      {
        $publication_status=$request->publication_status;
      }
      else {
        $publication_status=0;
      }
      $created_by=Session::get('admin_email');
      $created_at=date('Y-m-d H:i:s');
      DB::insert('insert into tbl_manufacture(manufacture_name,manufacture_description,category_id,publication_status,created_by,created_at) values(?,?,?,?,?,?)',[$manufacture_name,$manufacture_description,$cat,$publication_status,$created_by,$created_at]);
      Session::put('Message','Brand Name inserted Successfully');
      return Redirect::to('admin/brand/add_brand');
    }
    public function show_brand()
    {
      $this->init();
      $res=DB::select('select * from tbl_manufacture');
      $ress=DB::select('select * from tbl_category');

      return view('admin.show_brand',['res'=>$res,'ress'=>$ress]);
    }
    public function inactive($manufacture_id)
    {
      $this->init();
      DB::table('tbl_manufacture')->where('manufacture_id',$manufacture_id)->update(['publication_status'=>0]);
      return Redirect::to('admin/brand/show_brand');
    }
    public function active($manufacture_id)
    {
      $this->init();
      DB::table('tbl_manufacture')->where('manufacture_id',$manufacture_id)->update(['publication_status'=>1]);
      return Redirect::to('admin/brand/show_brand');
    }
    public function edit($manufacture_id)
    {
     $this->init();
     $res=DB::table('tbl_manufacture')->where('manufacture_id',$manufacture_id)->first();
       $rescat=DB::select("select * from tbl_category");

     return view('admin.update_brand',['res'=>$res,'rescat'=>$rescat]);
    }
    public function update_brand($manufacture_id, Request $request)
    {
      $this->init();
      $validatedData = $request->validate([
       'brand_name' => 'required|max:255',
       'brand_description' => 'required',


   ]);
      $cat=$request->brand_category;
      $manufacture_name=$request->brand_name;
      $manufacture_description=$request->brand_description;
        $publication_status=$request->publication_status;
      if($publication_status==1)
      {
        $publication_status=$request->publication_status;
      }
      else {
        $publication_status=0;
      }
      $modified_by=Session::get('admin_email');
      $modified_at=date('Y-m-d H:i:s');
      DB::update('update tbl_manufacture set manufacture_name=?,manufacture_description=?,publication_status=?,modified_by=?,updated_at=? where manufacture_id=?',[$manufacture_name,$manufacture_description,$publication_status,$modified_by,$modified_at,$manufacture_id]);
      Session::put('Message','Brand updated Successfully');
      return Redirect::to('admin/brand/edit/'.$manufacture_id);
    }
    public function delete($manufacture_id)
    {
      DB::delete('delete from tbl_manufacture where manufacture_id=?',[$manufacture_id]);
      return Redirect::to('admin/brand/show_brand');
    }
}

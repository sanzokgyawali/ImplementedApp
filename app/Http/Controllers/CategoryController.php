<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
session_start();
class CategoryController extends Controller
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
        return view('admin.add_category');
    }
    public function showcategory()
    {
      $this->init();
      $res=DB::select('select * from tbl_category');
      //var_dump($res);
      //$res=['a','b'];
      return view('admin.show_category',['res'=>$res]);
    }
    public function add(Request $request)
    {
      $validatedData = $request->validate([
       'category_name' => 'required|max:255',
       'category_description' => 'required',


   ]);
      $this->init();
      $created_by=Session::get('admin_email');
      $modified_by=Session::get('admin_email');
      $category_name=$request->category_name;
      $category_description=$request->category_description;
      if(isset($request->publication_status)){
      $publication_status=$request->publication_status;
    }else {
      $publication_status=0;
    }
      $created_at=date('Y-m-d H:i:s');
      DB::insert('insert into tbl_category(category_name,category_description,publication_status,created_by,created_at) values(?,?,?,?,?)',[$category_name,$category_description,$publication_status,$created_by,$created_at]);
      Session::put('Message','Category Inserted Successfully');
      return Redirect::to('admin/addcategory');

    }
    public function inactive($category_id)
    {
      $this->init();
      DB::table('tbl_category')->where('category_id',$category_id)->update(['publication_status'=>0]);
      return Redirect::to('admin/allcategory');
    }
    public function active($category_id)
    {
      $this->init();
      DB::table('tbl_category')->where('category_id',$category_id)->update(['publication_status'=>1]);
      return Redirect::to('admin/allcategory');
    }
    public function edit($category_id)
    {
      $this->init();
      $category_edit=DB::table('tbl_category')->where('category_id',$category_id)->first();
      return view('admin.edit_category',['category_edit'=>$category_edit]);
    }
    public function edit_category($category_id, Request $request)
    {
      $this->init();
      $validatedData = $request->validate([
       'category_name' => 'required|max:255',
       'category_description' => 'required',


   ]);
      $modified_by=Session::get('admin_email');
      $category_name=$request->category_name;
      $category_description=$request->category_description;
      if(isset($request->publication_status)){
      $publication_status=$request->publication_status;
    }else {
      $publication_status=0;
    }
      $modified_at=date('Y-m-d H:i:s');
      DB::update("update tbl_category set category_name=?,category_description=?,publication_status=?,modified_by=?,updated_at=? where category_id=?",[$category_name,$category_description,$publication_status,$modified_by,$modified_at,$category_id]);
      Session::put('Message','Category Updated Successfully');
      return Redirect::to('/admin/category/edit/'.$category_id);
    }
    public function delete($category_id)
    {
      DB::delete('delete from tbl_category where category_id=?',[$category_id]);
    //  Session::put('Message','Category deleted Successfully');
      echo "<script>alert('Category Deleted Successfully')</script>";
      return Redirect::to('/admin/allcategory');
    }

}

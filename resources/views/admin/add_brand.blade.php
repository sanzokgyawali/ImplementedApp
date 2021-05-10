@extends('admin.layout.admin_layout')
@section('admin_content')



			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a>
					<i class="icon-angle-right"></i>
				</li>
				<li>
					<i class="icon-edit"></i>
					<a href="#">Forms</a>
				</li>
			</ul>

			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Form Elements</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<p class="alert-success">
						<?php
						$Message=Session::get('Message');
						if($Message)
						{
							echo $Message;
							Session::put('Message',null);
						}

						 ?>
					</p>
					<p class="alert-danger">
						<?php if($errors->any())
						{
							foreach ($errors->all() as $error) {
								echo $error."<br>";
							}
						}?>
					</p>
					<div class="box-content">
						<form class="form-horizontal" id="formvalidate" method="post" action="{{url('/admin/brand/add-brand')}}">
						  <fieldset>
								{{csrf_field()}}
							<div class="control-group">
							  <label class="control-label" for="date01">Brand Name</label>
							  <div class="controls">
								<input type="text" class="" name="brand_name" required>
							  </div>
							</div>
              <div class="control-group">
							  <label class="control-label" for="date01">Category Name</label>
							  <div class="controls">
                  <select name="brand_category">
							@foreach($rescat as $r)
              <option value="{{$r->category_id}}">{{$r->category_name}}</option>
              @endforeach
            </select>
							  </div>
							</div>


							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Brand Description</label>
							  <div class="controls">
								<textarea class="cleditor" name="brand_description" rows="3" required></textarea>
							  </div>
							</div>
              <div class="control-group hidden-phone">
                <label class="control-label" for="textarea2">Publication Status</label>
                <div class="controls">
                <input type="checkbox" name="publication_status" value="1">
                </div>
              </div>
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Add Brand</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>

					</div>
				</div><!--/span-->

				<script src="{{asset('backend/js/jquery-1.9.1.min.js')}}"></script>
				<script src="{{asset('backend/js/jquery.validate.min.js')}}"></script>

			</div><!--/row-->

			<script>
			$(function(){
				$("#formvalidate").validate({
					rules:{
						brand_name:{
							required:true,
							minlength:7,
						},
						brand_description:{
							required:true,
							minlength:10,
						}
					},
					messages:{
						brand_name:{
							required:"this field is required",
							minlength:"minimum seven character is required",
						},
						brand_description:{
							required:"this description field is required",
							minlength:"minimum ten character is required",
						},
					},
				});
			});
			</script>
@endsection

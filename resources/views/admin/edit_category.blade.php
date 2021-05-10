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
					<div class="box-content">
						<form class="form-horizontal" method="post" action="{{url('/admin/category/edit-category/'.$category_edit->category_id)}}">
						  <fieldset>
								{{csrf_field()}}

							<div class="control-group">
							  <label class="control-label" for="date01">Category Name</label>
							  <div class="controls">
								<input type="text" class="" name="category_name" value="{{$category_edit->category_name}}">
							  </div>
							</div>


							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Category Description</label>
							  <div class="controls">
								<textarea class="cleditor" name="category_description" rows="3">{{$category_edit->category_description}}</textarea>
							  </div>
							</div>
              <div class="control-group hidden-phone">
                <label class="control-label" for="textarea2">Publication Status</label>
                <div class="controls">
                  @if($category_edit->publication_status==1)
                <input type="checkbox" name="publication_status" value="1" checked>
                @else
                  <input type="checkbox" name="publication_status" value="1">
                @endif
                </div>
              </div>
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Edit Category</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>

					</div>
				</div><!--/span-->

			</div><!--/row-->
@endsection

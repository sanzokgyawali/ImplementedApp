@extends('admin.layout.admin_layout')
@section('admin_content')
<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a>
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Tables</a></li>
			</ul>

			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Members</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Brand Id</th>
								  <th>Brand Name</th>
								  <th>Brand description</th>
                  <th>Category Name</th>
								  <th>Status</th>
									<?php
									if(Session::get('admin_role')=='super'){
										?>
										<th>Created By</th>
										<th>Modified By</th>
									<?php }
									 ?>
								  <th>Actions</th>
							  </tr>
						  </thead>
						<?php
						$sno=0;
						foreach($res as $r){

							$sno++;
						?>
						  <tbody>
							<tr>
								<td><?php echo $sno; ?></td>
								<td class="center"><?php echo $r->manufacture_name; ?></td>
								<td class="center"><?php echo $r->manufacture_description; ?></td>
                <td class="center">
                  <?php
                  foreach ($ress as $k) {
                    // code...

                  if($r->category_id==$k->category_id)
                  {
                    echo $k->category_name;
                  }
                }
                   ?>
                </td>
								<td class="center">
									@if($r->publication_status==1)
									<span class="label label-success">Active</span>
								@else
									<span class="label label-danger">Inactive</span>
									@endif
									<?php
									if(Session::get('admin_role')=='super'){
										?>
								</td>
									<td class="center"><?php echo $r->created_by; ?></td>
										<td class="center"><?php echo $r->modified_by; ?></td>
									<?php }
									 ?>
								<td class="center">
										@if($r->publication_status==1)
									<a class="btn btn-success" href="{{url('admin/brand/inactive/'.$r->manufacture_id)}}">

										<i class="halflings-icon white thumbs-up"></i>
										@else
										<a class="btn btn-danger" href="{{url('admin/brand/active/'.$r->manufacture_id)}}">
											<i class="halflings-icon white thumbs-down"></i>
										@endif
									</a>
									<a class="btn btn-info" href="{{url('admin/brand/edit/'.$r->manufacture_id)}}">
										<i class="halflings-icon white edit"></i>
									</a>
									<a class="btn btn-danger" onclick="return confirm('Are you sure want to delete this category')" href="{{url('admin/brand/delete/'.$r->manufacture_id)}}">
										<i class="halflings-icon white trash"></i>
									</a>
								</td>
							</tr>

						  </tbody>
						<?php } ?>
					  </table>
					</div>
				</div><!--/span-->

			</div><!--/row-->
@endsection

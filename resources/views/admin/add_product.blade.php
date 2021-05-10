@extends('admin.layout.admin_layout')
@section('admin_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>



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
						<form class="form-horizontal" method="post" action="{{url('/admin/add-category')}}">
						  <fieldset>
								{{ csrf_field() }}
							<div class="control-group">
							  <label class="control-label" for="date01">Product Name</label>
							  <div class="controls">
								<input type="text" class="" name="product_name" id="yes">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="date01">Catrgory Name</label>
							  <div class="controls">
							<select name="category_id" id="qns" data-depandent="ans">
								<option value="toselect">Please select category </option>
								@foreach($res as $r)
								<option value="{{$r->category_id}}">{{$r->category_name}}</option>
								@endforeach
							</select>
							<select id="ans" name="brand_id">
									<option>Please select above category</option>
							</select>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="date01">Product Short Description</label>
							  <div class="controls">
								<textarea class="cleditor" name="product_short_description" rows="3"></textarea>
							  </div>
							</div>
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Product Description</label>
							  <div class="controls">
								<textarea class="cleditor" name="product_description" rows="3"></textarea>
							  </div>
							</div>
              <div class="control-group">
                <label class="control-label" for="fileInput">Image input</label>
                <div class="filediv" style="display:block">
              <input name="file[]" type="file" id="files" class="file">
              First picture will be most priortize and it will be seen in frontpage.<br>
              <div id="blahs" style="display:none;">
                <img id="blah" src="#" height="100px" width="100px" alt="your image" />
                <p id="p">Delete</p>
              </div>
            </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="fileInput"></label>
                <div class="controls">
                <input class="btn btn-danger" id="add_more" class="upload" type="button" value="Add Pictures">
              </div>

              </div>



              <div class="control-group hidden-phone">
                <label class="control-label" for="textarea2">Publication Status</label>
                <div class="controls">
                <input type="checkbox" name="publication_status" value="1">
                </div>
              </div>
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Add Category</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>

					</div>
				</div><!--/span-->

			</div><!--/row-->
			<script>
		$("#qns").change(function(){
			if($(this).val()!='')
			{

				var value= $(this).val();
				alert(value);

				var _token = $('input[name="_token"]').val();
				console.log(_token);
				$.ajaxSetup({
							 headers: {
									 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							 }
					 });
				$.ajax({
					url: {{url('admin/product/ajaxfile')}},
					method: "POST",
					data: { value:value, _token:_token},
					success:function(result)
					{
						console.log(result.data);
						$('#ans').html(result);
					}
				});
			}
		});
			</script>
      <script>
      function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                $('#blahs').show();
                  $('#blah').attr('src', e.target.result);
              }

              reader.readAsDataURL(input.files[0]);
          }
      }

      $("#files").change(function(){
          readURL(this);
      });
      $("#p").click(function(){

				$('#blahs').hide();


      });
      </script>

      <script type="text/javascript">
	var abc = 0;      // Declaring and defining global increment variable.
$(document).ready(function() {
//  To add new input file field dynamically, on click of "Add More Files" button below function will be executed.
$('#add_more').click(function() {
$(this).before($("<div/>", {
id: 'filediv'
}).fadeIn('slow').append($("<input/>", {
name: 'file[]',
type: 'file',
id: 'file',

}), $("<br/><br/>")));
});
// Following function will executes on change event of file input to select different file.
$('body').on('change', '#file', function() {
if (this.files && this.files[0]) {
abc += 1; // Incrementing global variable by 1.
var z = abc - 1;
var x = $(this).parent().find('#previewimg' + z).remove();
$(this).before("<div id='abcd" + abc + "' class='abcd'><img id='previewimg" + abc + "' src='' height='100px' width='100px'/></div>");
var reader = new FileReader();
reader.onload = imageIsLoaded;
reader.readAsDataURL(this.files[0]);
$(this).hide();
$("#abcd" + abc).append($("<img/>", {
id: 'img',
src: 'x.png',
alt: 'delete'
}).click(function() {
$(this).parent().parent().remove();
}));
}
});
// To Preview Image
function imageIsLoaded(e) {
$('#previewimg' + abc).attr('src', e.target.result);
};
$('#upload').click(function(e) {
var name = $(":file").val();
if (!name) {
alert("First Image Must Be Selected");
e.preventDefault();
}
});
});
</script>
@endsection

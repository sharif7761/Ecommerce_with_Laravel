@extends('admin_layout')
@section('admin_content')


<ul class="breadcrumb">
	<li>
		<i class="icon-home"></i>
		<a href="index.html">Home</a>
		<i class="icon-angle-right"></i> 
	</li>
	<li>
		<i class="icon-edit"></i>
		<a href="#">Add Category</a>
	</li>
</ul>

@if (session('message'))
						
<p class="alert-danger">

	<h3 class="alert alert-dismissible alert-danger">{{session('message')}}</h3>

</p>
@endif

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon edit"></i><span class="break"></span>Add Manufacturer</h2>
			<div class="box-icon">
				<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
				<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
			</div>
		</div>
		<div class="box-content">
		<form class="form-horizontal" action="{{url('/save-manufacture')}}" method="post">
			  @csrf

				<fieldset>
				
				<div class="control-group">
				  <label class="control-label" for="date01">Manufacturer Name</label>
				  <div class="controls">
					<input type="text" class="input-xlarge" name="manufacture_name" >
				  </div>
				</div>

				          
				<div class="control-group hidden-phone">
				  <label class="control-label" for="textarea2">Manufacturer Description</label>
				  <div class="controls">
					<textarea class="cleditor" name="manufacture_description" rows="3"></textarea>
				  </div>
				</div>

				<div class="control-group">
					<label class="control-label" for="date01">Publication Status</label>
					<div class="controls">
					  <input type="checkbox" class="input-xlarge" name="publication_status" value="1">
					</div>
				  </div>


				<div class="form-actions">
				  <button type="submit" class="btn btn-primary">Add Manufacturer</button>
				  <a href="{{URL::to('/add-manufature')}}"><i class="btn">Cancel</i></a> 
				 </div>
			  </fieldset>
			</form>   

		</div>
	</div><!--/span-->

</div><!--/row-->

@endsection
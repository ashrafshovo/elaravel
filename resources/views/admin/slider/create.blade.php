@extends('admin.dashboard')

@section('title', 'Add Slider || E-Shopper')

@section('content')

<ul class="breadcrumb">
	<li>
		<i class="icon-home"></i>
		<a href="{{ route('dashboard') }}">Home</a> 
		<i class="icon-angle-right"></i>
	</li>
	<li>
		<a href="{{ route('slider.index') }}">Slider</a>
		<i class="icon-angle-right"></i>
	</li>
	<li><a href="{{ route('slider.create') }}">Add Slider</a></li>
</ul>

	@include('layouts.include.msg')

	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header" data-original-title>
				<h2><i class="halflings-icon edit"></i><span class="break"></span>Add Slider</h2>
			</div>
			<div class="box-content">
				<form class="form-horizontal" action="{{ route('slider.store') }}" method="post" enctype="multipart/form-data">
					@csrf
					<fieldset>
						<div class="control-group">
							<label class="control-label" for="date01">Slider Name</label>
							<div class="controls">
								<input type="text" class="input-xlarge" name="slider_name" required>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="date01">Slider Image</label>
							<div class="controls">
								<input type="file" name="slider_image" >
							</div>
						</div>

						<div class="control-group hidden-phone">
							<label class="control-label" for="textarea2">Slider Description</label>
							<div class="controls">
								<textarea class="cleditor" name="slider_description" id="textarea1" rows="0" required></textarea>
							</div>
						</div>

						<div class="form-actions">
							<button type="submit" class="btn btn-primary">Add Slider</button>
							<button type="reset" class="btn">Cancel</button>
						</div>
				 	</fieldset>
				</form>
			</div>
		</div><!--/span-->
	</div><!--/row-->
@endsection
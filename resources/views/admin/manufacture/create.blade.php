@extends('admin.dashboard')

@section('title', 'Add Manufacture || E-Shopper')

@section('content')

<ul class="breadcrumb">
	<li>
		<i class="icon-home"></i>
		<a href="{{ route('dashboard') }}">Home</a> 
		<i class="icon-angle-right"></i>
	</li>
	<li>
		<a href="{{ route('manufacture.index') }}">Manufacture</a>
		<i class="icon-angle-right"></i>
	</li>
	<li><a href="{{ route('manufacture.create') }}">Add Manufacture</a></li>
</ul>

	@include('layouts.include.msg')

	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header" data-original-title>
				<h2><i class="halflings-icon edit"></i><span class="break"></span>Add Manufacture</h2>
			</div>
			<div class="box-content">
				<form class="form-horizontal" action="{{ route('manufacture.store') }}" method="post">
					@csrf
					<fieldset>
						<div class="control-group">
							<label class="control-label" for="date01">Manufacture Name</label>
							<div class="controls">
								<input type="text" class="input-xlarge" name="manufacture_name" required>
							</div>
						</div>
						<div class="control-group hidden-phone">
							<label class="control-label" for="textarea2">Manufacture Description</label>
							<div class="controls">
								<textarea class="cleditor" name="manufacture_description" id="textarea2" rows="0" required></textarea>
							</div>
						</div>
						<div class="form-actions">
							<button type="submit" class="btn btn-primary">Add Manufacture</button>
							<button type="reset" class="btn">Cancel</button>
						</div>
				 	</fieldset>
				</form>
			</div>
		</div><!--/span-->
	</div><!--/row-->
@endsection
@extends('admin.dashboard')

@section('title', 'Edit Manufacture || E-Shopper')

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
	<li><a href="#">Edit Manufacture</a></li>
</ul>

	@include('layouts.include.msg')

	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header" data-original-title>
				<h2><i class="halflings-icon edit"></i><span class="break"></span>Edit Manufacture</h2>
			</div>
			<div class="box-content">
				<form class="form-horizontal" action="{{ route('manufacture.update', $manufacture->manufacture_id) }}" method="post">
					@csrf
					@method('put')
					<fieldset>
						<div class="control-group">
							<label class="control-label" for="date01">Manufacture Name</label>
								<div class="controls">
									<input type="text" class="input-xlarge" name="manufacture_name" value="{{ $manufacture->manufacture_name }}" required>
							 	</div>
						</div>
						<div class="control-group hidden-phone">
							<label class="control-label" for="textarea2">Manufacture Description</label>
							<div class="controls">
								<textarea class="cleditor" name="manufacture_description" id="textarea2" rows="0" required>{{ $manufacture->manufacture_description }}</textarea>
							</div>
						</div>

						<div class="form-actions">
							<button type="submit" class="btn btn-primary">Update Manufacture</button>
							<a href="{{ URL::previous() }}" class="btn">Cancel</a>
						</div>
					</fieldset>
				</form>
			</div>
		</div><!--/span-->
	</div><!--/row-->
@endsection

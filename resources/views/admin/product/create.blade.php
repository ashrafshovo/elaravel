@extends('admin.dashboard')

@section('title', 'Add Product || E-Shopper')

@section('content')

<ul class="breadcrumb">
	<li>
		<i class="icon-home"></i>
		<a href="{{ route('dashboard') }}">Home</a> 
		<i class="icon-angle-right"></i>
	</li>
	<li>
		<a href="{{ route('product.index') }}">Product</a>
		<i class="icon-angle-right"></i>
	</li>
	<li><a href="{{ route('product.create') }}">Add Product</a></li>
</ul>

	@include('layouts.include.msg')

	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header" data-original-title>
				<h2><i class="halflings-icon edit"></i><span class="break"></span>Add Product</h2>
			</div>
			<div class="box-content">
				<form class="form-horizontal" action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
					@csrf
					<fieldset>
						<div class="control-group">
							<label class="control-label" for="date01">Product Name</label>
							<div class="controls">
								<input type="text" class="input-xlarge" name="product_name" required>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="selectError">Product Category</label>
							<div class="controls">
								<select id="selectError3" name="category_id">
									<option>Select Category</option>
									@foreach($categories as $category)
										<option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="selectError">Manufacture Name</label>
							<div class="controls">
								<select id="selectError3" name="manufacture_id">
									<option>Select Manufacture</option>
									@foreach($manufactures as $manufacture)
										<option value="{{ $manufacture->manufacture_id }}" >{{ $manufacture->manufacture_name }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="control-group hidden-phone">
							<label class="control-label" for="textarea2">Product Short Description</label>
							<div class="controls">
								<textarea class="cleditor" name="product_short_description" id="textarea1" rows="0" required></textarea>
							</div>
						</div>

						<div class="control-group hidden-phone">
							<label class="control-label" for="textarea2">Product Long Description</label>
							<div class="controls">
								<textarea class="cleditor" name="product_long_description" id="textarea2" rows="0" required></textarea>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="appendedPrependedInput">Product Price</label>
							<div class="controls">
								<div class="input-prepend">
									<span class="add-on">৳</span><input id="appendedPrependedInput" size="16" type="text" name="product_price" required>
								</div>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="date01">Product Image</label>
							<div class="controls">
								<input type="file" name="product_image" >
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="date01">Product Size</label>
							<div class="controls">
								<input type="text" class="input-xlarge" name="product_size">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="date01">Product Color</label>
							<div class="controls">
								<input type="text" class="input-xlarge" name="product_color" required>
							</div>
						</div>

						<div class="form-actions">
							<button type="submit" class="btn btn-primary">Add Product</button>
							<button type="reset" class="btn">Cancel</button>
						</div>
				 	</fieldset>
				</form>
			</div>
		</div><!--/span-->
	</div><!--/row-->
@endsection
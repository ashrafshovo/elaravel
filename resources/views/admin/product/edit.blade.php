@extends('admin.dashboard')

@section('title', 'Edit Product || E-Shopper')

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
	<li><a href="#">Edit Product</a></li>
</ul>

	@include('layouts.include.msg')

	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header" data-original-title>
				<h2><i class="halflings-icon edit"></i><span class="break"></span>Edit Product</h2>
			</div>
			<div class="box-content">
				<form class="form-horizontal" action="{{ route('product.update', $product->product_id) }}" method="post" enctype="multipart/form-data">
					@csrf
					@method('put')
					<fieldset>
						<div class="control-group">
							<label class="control-label" for="date01">Product Name</label>
							<div class="controls">
								<input type="text" class="input-xlarge" name="product_name" value="{{ $product->product_name }}" required>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="selectError">Product Category</label>
							<div class="controls">
								<select id="selectError3" name="category_id">
									<option value="{{ $product->category_id }}">{{ $product->category_name }}</option>
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
									<option value="{{ $product->manufacture_id }}" >{{ $product->manufacture_name }}</option>
									@foreach($manufactures as $manufacture)
										<option value="{{ $manufacture->manufacture_id }}" >{{ $manufacture->manufacture_name }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="control-group hidden-phone">
							<label class="control-label" for="textarea2">Product Short Description</label>
							<div class="controls">
								<textarea class="cleditor" name="product_short_description" id="textarea1" rows="0" required>{{ $product->product_short_description }}</textarea>
							</div>
						</div>

						<div class="control-group hidden-phone">
							<label class="control-label" for="textarea2">Product Long Description</label>
							<div class="controls">
								<textarea class="cleditor" name="product_long_description" id="textarea2" rows="0" required>{{ $product->product_long_description }}</textarea>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="appendedPrependedInput">Product Price</label>
							<div class="controls">
								<div class="input-prepend">
									<span class="add-on">৳</span><input id="appendedPrependedInput" size="16" type="text" value="{{ $product->product_price }}" name="product_price" required>
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
								<input type="text" class="input-xlarge" name="product_size" value="{{ $product->product_size }}" >
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="date01">Product Color</label>
							<div class="controls">
								<input type="text" class="input-xlarge" name="product_color" value="{{ $product->product_color }}" required>
							</div>
						</div>

						<div class="form-actions">
							<button type="submit" class="btn btn-primary">Update Product</button>
							<button type="reset" class="btn">Cancel</button>
						</div>
				 	</fieldset>
				</form>
			</div>
		</div><!--/span-->
	</div><!--/row-->
@endsection

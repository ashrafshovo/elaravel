
@extends('admin.dashboard')

@section('title', 'Categories || E-Shopper')

@section('content')

<ul class="breadcrumb">
	<li>
		<i class="icon-home"></i>
		<a href="{{ route('dashboard') }}">Home</a> 
		<i class="icon-angle-right"></i>
	</li>
	<li><a href="{{ route('category.index') }}">Category</a></li>
</ul>

<style>
	.mar {
		margin: 15px 30px;
	}
</style>

<div class="row-fluid sortable">

	<div class="mar">
		
		@include('layouts.include.msg')

		<a href="{{ route('category.create') }}" class="btn btn-primary">Add Category</a>
	</div>

	<div class="box span12">
		<div class="box-header">
			<h2><i class="halflings-icon user"></i><span class="break"></span>Categories</h2>
		</div>
		<div class="box-content">
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
				<thead>
					<tr>
						<th>Category ID</th>
						<th>Category Name</th>
						<th>Category Description</th>
						<th>Status</th>
						<th>Actions</th>
					</tr>
				</thead>   
				<tbody>
					@foreach($categories as $key=>$category)
					<tr>
						<td>{{ $key+1 }}</td>
						<td>{{ $category->category_name }}</td>
						<td>{{ $category->category_description }}</td>
						<td class="center">
							@if($category->publication_status == true)
								<span class="label label-success">Published</span>
							@else 
								<span class="label label-danger">Unpublished</span>
							@endif
						</td>
						<td class="center">
							@if($category->publication_status == 1)
								<a class="btn btn-success" href="{{ route('unpublish', $category->category_id) }}">
									<i class="halflings-icon white thumbs-down"></i>  
								</a>
							@else
								<a class="btn btn-success" href="{{ route('publish', $category->category_id) }}">
									<i class="halflings-icon white thumbs-up"></i>  
								</a>
							@endif
							<a class="btn btn-info" href="{{ route('category.edit', $category->category_id) }}">
								<i class="halflings-icon white edit"></i>  
							</a>
							<a class="btn btn-danger" href="#">
								<i class="halflings-icon white trash"></i> 
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>            
		</div>
	</div><!--/span-->
</div><!--/row-->

@endsection

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
		margin: 15px 0px;
	}

	.table th {
		text-align: center;
	}

	.table td {
		text-align: center;
	}

</style>

<div class="row-fluid sortable">

	<div class="mar">
		
		@include('layouts.include.msg')

		<a href="{{ route('category.create') }}" class="btn btn-primary">Add Category</a>
	</div>

	<div class="box span12" style="margin-left: 0px;">
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
						<td>{!! $category->category_description !!}</td>
						<td class="center">
							@if($category->publication_status == true)
								<span class="label label-success">Published</span>
							@else 
								<span class="label label-danger">Unpublished</span>
							@endif
						</td>
						<td class="center">
							@if($category->publication_status == 1)
								<a class="btn btn-default" href="{{ route('unpublish', $category->category_id) }}">
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

							{{-- <form id="delete-from-{{ $category->category_id }}" action="{{ route('category.destroy', $category->category_id) }}" style="display:none;" method="post">
								@csrf
								@method('delete')
							</form>

							<button class="btn btn-danger" type="button" onclick="if(confirm('Are you sure? You want to delete this.')){
								event.preventDefault();
								document.getElementById('delete-from-{{ $category->category_id }}').submit();
							} else {
								event.preventDefault();
							}">
								<i class="halflings-icon white trash"></i>
							</button> --}}

							
 							<!-- Button trigger modal -->
							<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete">
  								<i class="halflings-icon white trash"></i>
							</button>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>            
		</div>
	</div><!--/span-->
</div><!--/row-->


<!-- Modal -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
    	<div class="modal-content">
	     	<div class="modal-header">
	      		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button>
	        	<h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
	        </div>
	      	<form action="{{ route('category.destroy', $category->category_id) }}" method="post">
	      		@csrf
	      		@method('delete')
		    	<div class="modal-body">
		        	Are You Want to delete this?
		      	</div>
		      	<div class="modal-footer">
		        	<button type="submit" class="btn btn-primary">Delete</button>
		        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		      	</div>
	 		</form>
    	</div>
  	</div>
</div>

@endsection
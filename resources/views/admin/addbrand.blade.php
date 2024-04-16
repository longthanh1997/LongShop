@extends('admin.adminhome')
@section('content')

<div class="container">






	<div class="row justify-content-center">
		<div class="col-xs-12 col-md-6 mb-2 mt-5 bg-gradient-light text-gray-800">
			<h2 class="text-center">Add Category Type</h2>
			<x-alert/>
			<!-- brand_name, brand_sku, brand_status -->
			<form id="form_add_brand_single" class="p-4" action="{{URL::to('/admin/product-brand/addbrandsingle')}}" method="post">
			@csrf
			  <div class="form-group">
			    <label for="brand_name">Category type name:</label>
			    <input type="text" class="form-control" placeholder="Category type name" name="brand_name" id="brand_name" required>
			  </div>

			  <div class="form-group">
				  <label for="brand_status">Status:</label>
				  <select class="form-control" id="brand_status" name="brand_status">
				    <option value="1">Show</option>
				    <option value="0">Hide</option>

				  </select>
				</div>
				<div class="form-group">
			    <label for="brand_sku">Category type ID:</label>
			    <input type="text" class="form-control" placeholder="Category type ID" id="brand_sku" name="brand_sku">
			  </div>
			  <button type="submit" class="btn btn-primary" name="add_brand" id="add_brand">Add</button>
			</form>
		</div>
	</div>


</div>


@endsection




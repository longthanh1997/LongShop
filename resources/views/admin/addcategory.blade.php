@extends('admin.adminhome')
@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-xs-12 col-md-6 mb-2 mt-5 bg-gradient-light text-gray-800">
			<h2 class="text-center">Add categories</h2>
			<x-alert/>
			<form id="form_add_category_single" class="p-4" action="{{URL::to('/admin/product-category/addcategorysingle')}}" method="post">
			@csrf
			  <div class="form-group">
			    <label for="category_name">Name of category:</label>
			    <input type="text" class="form-control" placeholder="Name of category" name="category_name" id="category_name" required>
			  </div>

			  <div class="form-group">
				  <label for="category_status">Status:</label>
				  <select class="form-control" id="category_status" name="category_status">
				    <option value="1">Show</option>
				    <option value="0">Hide</option>

				  </select>
				</div>
				<div class="form-group">
		          <label for="category_type">Category type:</label>
		          <select class="form-control" id="category_type" name="category_type">
		            <option value="0">Empty</option>
		            @foreach($product_brand as $value)
		            <option value="{{$value->id}}">{{$value->brand_name}}</option>

		            @endforeach
		          </select>
		        </div>
				<div class="form-group">
			    <label for="category_sku">Category ID:</label>
			    <input type="text" class="form-control" placeholder="Category ID" id="category_sku" name="category_sku">
			  </div>
			  <div class="form-group">
		          <label for="category_parent">Parent category:</label>
		          <select class="form-control" id="category_parent" name="category_parent">
		            <option value="0">Empty</option>
		            {!! $product_category !!}
		          </select>
		        </div>
			  <button type="submit" class="btn btn-primary" name="add_category" id="add_category">Add</button>
			</form>
		</div>
	</div>


</div>


@endsection

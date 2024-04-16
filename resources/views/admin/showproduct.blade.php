<?php
//use Illuminate\Support\Str;
?>
<!--  product_category, product_name, product_sku, product_quantity, product_avatar, product_gallery, product_brand, product_variation_status, product_variation, product_status, product_shortdsc, product_longdsc, product_info, product_product_price -->

<!-- category_sku, category_name, category_status -->
<!-- brand_name, brand_sku, brand_status -->
<!-- price_regular, price_promotion, price_installment -->
<!-- variation_oftype, variation_sku, variation_name, variation_price -->
<!-- variation_type_sku, variation_type_name -->
@extends('admin.adminhome')
@section('content')
<!-- Begin Page Content -->
<x-alert/>
<style>
#show_search_all_product{
position: absolute;
position: absolute;
width: 430px;
right: 10px;
top: 40px;
z-index: 9999999;
}
#show_search_all_product li a img{
float: left;width: 60px;
}
#show_search_all_product li a span{
float: right; width: 300px;margin-top: 10px;
}

</style>
<!-- <div class="container-fluid">


	<div class="row">

		<div class="col-xs-12 col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="d-flex justify-content-between" style="align-items: center;">
						<div>
							<a href="{{URL::to('admin/product/export-excel')}}" class="btn btn-success">Xuất excel</a>
						</div>

						<form action="{{URL::to('/admin/product/import-excel')}}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="input-group">
                            <input type="file" class="form-control" name="in_import_excel" required>
  <div class="input-group-append">
    <button class="btn btn-success" type="submit">Nhập Excel</button>
  </div>
</div>
						</form>
					</div>
				</div>
			</div> -->
		<!-- DataTales Example -->
		<div class="card shadow mb-4">
		<div class="card-header align-items-start">
		<!-- <h6 class="m-0 font-weight-bold text-primary">Tất cả sản phẩm</h6> -->

		<div class="row">

			<div class="col-xs-4 col-sm-2">
				<div class="form-group">
					<select class="form-control" id="edit_list_product_for" name="edit_list_product_for">
						<option value="0">Actions</option>
						<option value="1">Hide</option>
						<option value="2">Show</option>
						<option value="3">Delete</option>
					</select>
				</div>
			</div>
			<div class="col-xs-3 col-sm-2">
				<div class="form-group">
					<button type="button" class="btn btn-info" id="submit_form_product_edit_list">Apply</button>
				</div>
			</div>


			<div class="col-xs-12 col-sm-4"><!--
				<form id="form_product_filter" action="{{URL::to('/admin/product/filterproduct')}}" method="get">
				@csrf
					<div class="row">
						<div class="col-xs-12 col-sm-9">
							<select class="form-control" id="filter_category" name="filter_category">
								<option value="0">Tất cả Danh mục</option>
								@foreach($product_category as $value)
								<option @if($filter_choose_category == $value->id) selected="selected" @endif value="{{$value->id}}">{{$value->category_name}}</option>
								@endforeach
							</select>

						</div>
						<div class="col-xs-12 col-sm-5">

							<select class="form-control" id="filter_brand" name="filter_brand">
								<option value="0">Tất cả Thương hiệu</option>
								@foreach($product_brand as $value)
								<option @if($filter_choose_brand == $value->id) selected="selected" @endif  value="{{$value->id}}">{{$value->brand_name}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-xs-12 col-sm-3">
							<button type="submit" class="btn btn-info">Lọc</button>
						</div>
					</div>

				</form> -->
			</div>
                        <div class="col-xs-12 col-sm-4" style="position: relative;">
				<input id="in_search_all_product" type="text" class="form-control" placeholder="Search product">
				<ul id="show_search_all_product" class="list-group" >

				</ul>
			</div>


		</div>

		</div>
		<form id="form_product_edit_list" action="{{URL::to('/admin/product/editproductlist')}}" method="post">
		@csrf
		<input type="hidden" id="edit_list_product" name="edit_list_product" value="0">
		<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="product_table" width="100%" cellspacing="0">
			<thead>
			<tr>
			<th><input type="checkbox" class="check_all"></th>
			<th>Product's name</th>
			<th>Image product</th>
			<th>Product price</th>
			<th>Category</th>
			<th>Brand</th>
			<th>Product ID</th>
			<th>Quantity</th>
			<th>Status</th>
			<th width="70px"><a class="btn btn-success" href="{{URL::to('admin/product/addproduct')}}"><i class="fas fa-plus"></i></a></th>
			</tr>
			</thead>

			<tfoot>
				<tr>
					<th><input type="checkbox" class="check_all"></th>
                    <th>Product's name</th>
                    <th>Image product</th>
                    <th>Product price</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Product ID</th>
                    <th>Quantity</th>
                    <th>Status</th>
					<th width="70px"></th>
				</tr>
			</tfoot>
			<tbody>

			@foreach($product_filter1 as $value_product_filter1)

			@foreach($product as $value_product)
			@if($value_product_filter1 == $value_product->id)
				<tr class="post{{$value_product->id}}">
					<td><input type="checkbox" class="check_list" value="{{$value_product->id}}" name="check_list_product[]"></td>
					<td>{{$value_product->product_name}}</td>
					<td width="100px">
					<?php
					$result = Str::of($value_product->product_avatar)->trim()->isNotEmpty();
					?>
					@if($result)

					@foreach($product_image as $value)
						@if($value_product->product_avatar == $value->id)
						<img src="{{asset($value->product_image)}}" alt="" width="100%">

						@endif
					@endforeach



					@else


					<img src="{{asset('public/upload/product/product_default.png')}}" alt="" width="100%">
					@endif

					</td>
					<td>
					@foreach($product_price as $value_product_price)
						@if($value_product->product_price == $value_product_price->id)
						{{$value_product_price->price_regular}} $
						@endif
					@endforeach
					</td>

					<td>
					@foreach($product_to_category as $value_product_to_category)
						@if($value_product->id == $value_product_to_category->id_product)
							@foreach($product_category as $value_product_category)

								@if($value_product_category->id == $value_product_to_category->id_category)
								{{$value_product_category->category_name}}<br/>
								@endif
							@endforeach
						@endif
					@endforeach
					</td>
					<td><?php
					$collection = Str::of($value_product->product_brand)->explode(',');
					?>
					@foreach($collection as $value_collection)
						@foreach($product_brand as $value_product_brand)

							@if($value_collection == $value_product_brand->id)
							{{$value_product_brand->brand_name}}<br/>
							@endif
						@endforeach
					@endforeach
					</td>
					<td>{{$value_product->product_sku}}</td>
					<td>{{$value_product->product_quantity}}</td>
					<td>@if($value_product->product_status == 1) <span class="btn btn-success">Show</span> @else <span class="btn btn-secondary">Hide</span> @endif</td>
					<td><a href="{{URL::to('/admin/product/editproduct/'.$value_product->id)}}" class="mb-1 btn btn-warning btn-icon-split">
					<span class="icon text-white-50">
					<i class="fas fa-tools"></i>
					</span>
					<span class="text">Edit</span>
					</a> <button data-id="{{$value_product->id}}" data-title="{{$value_product->product_name}}" type="button" class="delete_modal_product btn btn-danger btn-icon-split">
					<span class="icon text-white-50">
					<i class="fas fa-trash"></i>
					</span>
					<span class="text">Delete</span>
					</button></td>

				</tr>
			@endif
			@endforeach
			@endforeach
			</tbody>
			</table>

		</div>
		</div>
		</div>

		</div>
                <div class="col-12">
                {{ $product->links() }}
                </div>
	</div>
<!-- Page Heading -->
</div>
<!-- /.container-fluid -->



<!-- xóa Modal-->
<div class="modal fade" id="delete_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Delete ?</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<p id="content_delete"></p>
				<input type="hidden" id="id_delete" />
			</div>
			<div class="modal-footer">
				<button type="button" id="click_delete_product" class="btn btn-danger">Delete</button>
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>

@endsection

@extends('admin.adminhome')
@section('content')

<div class="container">
	<x-alert/>
<form id="form_product" class="p-4" action="{{URL::to('/admin/product/addproduct')}}" method="post" enctype="multipart/form-data">
			@csrf
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<h2 class="text-center">Add products</h2>
		</div>
		<div class="col-xs-12 col-sm-8 mb-2 mt-5 bg-gradient-light text-gray-800">


			<!-- product_category, product_name, product_sku, product_quantity, product_avatar, product_gallery, product_brand, product_variation_status, product_variation, product_status, product_shortdsc, product_longdsc, product_info, product_product_price -->
			<!-- category_sku, category_name, category_status -->
           <!-- brand_name, brand_sku, brand_status -->
           <!-- price_regular, price_promotion, price_installment -->
           <!-- variation_oftype, variation_sku, variation_name, variation_price -->
           <!-- variation_type_sku, variation_type_name -->

			<div class="row">
				<div class="col-xs-12 col-sm-12 form-group">

				    <label for="product_name">Product's name:</label>
				    <input type="text" class="form-control" placeholder="Product's name" name="product_name" id="product_name" value="{{old('product_name')}}" required>

				</div>
				<div class="col-xs-2 col-sm-2 form-group">

				</div>

			</div>

			  <div class="row">
			  	<div class="col-xs-12 col-sm-6 form-group">
				  <label for="product_status">Status:</label>
				  <select class="form-control" id="product_status" name="product_status">
				    <option value="1">Show</option>
				    <option value="0">Hide</option>
				  </select>
				</div>
				<!--<div class="col-xs-12 col-sm-4 form-group">-->
    <!--			    <label for="product_quantity">Số lượng sản phẩm:</label>-->
    <!--			    <input type="number" class="form-control" placeholder="Số lượng" id="product_quantity" name="product_quantity" value="{{old('product_quantity')}}1">-->
    <!--			  </div>-->
				<div class="col-xs-12 col-sm-6 form-group">
			    <label for="product_sku">Product ID:</label>
			    <input type="text" class="form-control" placeholder="Product ID" id="product_sku" name="product_sku" value="{{old('product_sku')}}">
			  </div>
			  </div>

			  <div class="form-group">
			    <select class="form-control" id="product_variation_status" name="product_variation_status">
			    	<option value="0">Product has no variations</option>
			    	<option value="1">Product has variations</option>


				  </select>
			  </div>

			<div class="row">
				<div class="col-xs-12 col-sm-4 form-group">
				    <label for="price_regular">Product price:</label>
				    <input type="number" class="form-control" placeholder="Product price" name="price_regular" id="price_regular" value="{{old('price_regular')}}">
				</div>
				<div class="col-xs-12 col-sm-4 form-group">
				    <label for="price_online">Online Price:</label>
				    <input type="number" class="form-control" placeholder="Online Price" name="price_online" id="price_online" value="{{old('price_online')}}">
				</div>
				<div class="col-xs-12 col-sm-4 form-group">
				    <label for="price_promotion">Discount</label>
				    <input type="number" class="form-control" placeholder="Discounted Price" name="price_promotion" id="price_promotion" value="{{old('price_promotion')}}">
				</div>



			</div>
			<div id="yes_variation" class="row" style="display: none;">
				<div class="form-group">

				    <label for="product_group_name">Product Group Name:</label>
				    <input type="text" class="form-control" placeholder="Product Group Name" name="product_group_name" id="product_group_name" value="{{old('product_group_name')}}">

				</div>
				<div class="form-group">
					<label for="add_product_search">Search product:</label>
				<input id="add_product_search" name="add_product_search" type="text" class="form-control" placeholder="Enter Product...">
				</div>

				<div id="result_search" class="list-group">

				</div>
				<div class="mt-3">Group Product:</div>
				<div id="show_result_search" class="list-group">
					<p class="text-center text-gray-500">No product group</p>


				</div>
			</div>

			  <div class="form-group">
			    <label for="product_shortdsc">Short description:</label>
			    <textarea class="form-control" rows="10" id="product_shortdsc" name="product_shortdsc">{{old('product_shortdsc')}}</textarea>
			    <script type="text/javascript">
				var editor = CKEDITOR.replace( 'product_shortdsc', {
				    filebrowserBrowseUrl : '../../ckfinder/ckfinder.html',
				    filebrowserImageBrowseUrl : '../../public/admin/ckfinder/ckfinder.html?type=Images',
				    filebrowserFlashBrowseUrl : '../../ckfinder/ckfinder.html?type=Flash',
				    filebrowserUploadUrl : '../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
				    filebrowserImageUploadUrl : '../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
				    filebrowserFlashUploadUrl : '../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
				});
				//CKFinder.setupCKEditor( editor, '/' );
				</script>
			    </div>

			    <div class="form-group">
			        <div class="row">
			            <div class="col-4"><label for="product_offer">Promotion:</label></div>
			            <div class="col mb-3"><input type="number" name="total_offer" class="form-control" placeholder="Promotion"/></div>
			        </div>


			    <textarea class="form-control" rows="10" id="product_offer" name="product_offer">{{old('product_offer')}}</textarea>
			    <script type="text/javascript">
				var editor = CKEDITOR.replace( 'product_offer', {
				    filebrowserBrowseUrl : '../../ckfinder/ckfinder.html',
				    filebrowserImageBrowseUrl : '../../public/admin/ckfinder/ckfinder.html?type=Images',
				    filebrowserFlashBrowseUrl : '../../ckfinder/ckfinder.html?type=Flash',
				    filebrowserUploadUrl : '../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
				    filebrowserImageUploadUrl : '../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
				    filebrowserFlashUploadUrl : '../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
				});
				//CKFinder.setupCKEditor( editor, '/' );
				</script>
			    </div>

			  <div class="form-group">
			    <label for="product_info">Technical Specifications:</label>
			    <textarea class="form-control" rows="10" id="product_info" name="product_info">{{old('product_info')}}</textarea>
			    <script type="text/javascript">
				var editor = CKEDITOR.replace( 'product_info', {
				    filebrowserBrowseUrl : '../../ckfinder/ckfinder.html',
				    filebrowserImageBrowseUrl : '../../public/admin/ckfinder/ckfinder.html?type=Images',
				    filebrowserFlashBrowseUrl : '../../ckfinder/ckfinder.html?type=Flash',
				    filebrowserUploadUrl : '../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
				    filebrowserImageUploadUrl : '../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
				    filebrowserFlashUploadUrl : '../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
				});
				//CKFinder.setupCKEditor( editor, '/' );
				</script>
			  </div>
			  <div class="form-group">
			    <label for="product_longdsc">Long description:</label>
			    <textarea class="form-control" rows="20" id="product_longdsc" name="product_longdsc">{{old('product_longdsc')}}</textarea>
			    <script type="text/javascript">
				var editor = CKEDITOR.replace( 'product_longdsc', {
				    filebrowserBrowseUrl : '../../ckfinder/ckfinder.html',
				    filebrowserImageBrowseUrl : '../../public/admin/ckfinder/ckfinder.html?type=Images',
				    filebrowserFlashBrowseUrl : '../../ckfinder/ckfinder.html?type=Flash',
				    filebrowserUploadUrl : '../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
				    filebrowserImageUploadUrl : '../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
				    filebrowserFlashUploadUrl : '../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
				});
				//CKFinder.setupCKEditor( editor, '/' );
				</script>
			  </div>

			  <button type="submit" class="btn btn-primary" name="add_product" id="add_product">Add</button>

		</div>
		<div class="col-xs-12 col-sm-4">
			<div class="row">
				<div class="col-xs-12 col-sm-12 text-right form-group">
					<input type="hidden" id="id_product" name="id_product" value="0">
					<input type="submit" class="form-control btn btn-primary" name="add_product" id="add_product_1" value="Add">
				</div>
				<div class="col-xs-12 col-sm-12 form-group">
				    <label>Category:</label>
				    <div class="category_scroll bg-white">
				    		{!! $product_category !!}


				    </div>

			  	</div>
			  	<div class="col-xs-12 col-sm-12 form-group ">
					<div class="col-xs-12">
					    <label>Status:</label>
					</div>
					<div class="form-check-inline">
				      <label class="form-check-label">
				        <input type="radio" class="form-check-input" name="product_quantity" value="1" checked>Stocking
				      </label>

				    </div>
					<div class="form-check-inline">

				      <label class="form-check-label">
				        <input type="radio" class="form-check-input" name="product_quantity" value="0" >Out of stock
				      </label>
				    </div>

				</div>
			  	<div class="col-xs-12 col-sm-12 form-group ">
					<div class="col-xs-12">
					    <label>Installment:</label>
					</div>
					<div class="form-check-inline">
				      <label class="form-check-label">
				        <input type="radio" class="form-check-input" name="price_installment" value="1">Yes
				      </label>

				    </div>
					<div class="form-check-inline">

				      <label class="form-check-label">
				        <input type="radio" class="form-check-input" name="price_installment" value="0" checked>No
				      </label>
				    </div>

				</div>




				<div class="col-xs-12 col-sm-12 form-group">
					<label for="product_avatar">Main Image:</label>
					<input type="file" class="form-control" id="product_avatar" name="product_avatar" data-browse-on-zone-click="true">
					<img id="add_avatar" src="{{asset('public/upload/product/product_default.png')}}" alt="" style="width: 100%">
				</div>
				<div class="col-xs-12 col-sm-12 form-group">

			    	<p for="product_number">Photo library:</p>
			    	<div id="show_product_gallery" class="row">

			    	</div>
			    	<input type="file" class="form-control" id="product_gallery" name="product_gallery[]" multiple>
			    <span id="add_product_gallery" class="btn btn-primary">Add image gallery</span>

				</div>
			</div>

		</div>
	</div>
</form>

</div>


@endsection

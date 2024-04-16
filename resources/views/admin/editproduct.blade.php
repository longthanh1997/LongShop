@extends('admin.adminhome')
@section('content')

<div class="container">
	<x-alert/>
<form id="form_product" class="p-4" action="{{URL::to('/admin/product/editproduct')}}" method="post" enctype="multipart/form-data">
			@csrf
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<h2 class="text-center">Editing Product</h2>
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

				    <label for="product_name">Product's Name</label>
				    <input type="text" class="form-control" placeholder="Product's Name" name="product_name" id="product_name" value="{{$product->product_name}}" required>

				</div>
				<div class="col-xs-2 col-sm-2 form-group">

				</div>

			</div>

			  <div class="row">
			  	<div class="col-xs-12 col-sm-6 form-group">
				  	<label for="product_status">Status:</label>

				  	<select class="form-control" id="product_status" name="product_status">
				    	<option @if($product->product_status == 1) selected="selected" @endif  value="1">Show</option>
				    	<option @if($product->product_status == 0) selected="selected" @endif value="0">Hide</option>
				  	</select>
				</div>
				<!--<div class="col-xs-12 col-sm-4 form-group">-->
				<!--    <label for="product_quantity">Số lượng sản phẩm:</label>-->
				<!--    <input type="number" class="form-control" placeholder="Số lượng" id="product_quantity" name="product_quantity" value="{{$product->product_quantity}}">-->
			 <!-- 	</div>-->
				<div class="col-xs-12 col-sm-6 form-group">
			    	<label for="product_sku">Product ID:</label>
			    	<input type="text" class="form-control" placeholder="Product ID" id="product_sku" name="product_sku" value="{{$product->product_sku}}">
			  </div>
			  </div>

			  <?php
				$result = Str::of($product->product_group)->trim()->isNotEmpty();
				$result_empty = Str::of($product->product_group)->trim()->isEmpty();
				if($result){
					$product_group = Str::of($product->product_group)->explode(',');
				}

			?>
			  <div class="form-group">
			    <select class="form-control" id="product_variation_status" name="product_variation_status">
			    	<option @if($result_empty) selected="selected" @endif value="0">Product has no variations</option>
			    	<option @if($result) selected="selected" @endif value="1">Product has variations</option>


				  </select>
			  </div>
			<div class="row">

				<div class="col-xs-12 col-sm-4 form-group">
				    <label for="price_regular">Product Price:</label>
				    <input type="number" class="form-control" placeholder="Product Price" name="price_regular" id="price_regular" value="{{$product_price_one->price_regular}}">
				</div>
				<div class="col-xs-12 col-sm-4 form-group">
				    <label for="price_online">Online Price:</label>
				    <input type="number" class="form-control" placeholder="Online Price" name="price_online" id="price_online" value="{{$product_price_one->price_online}}">
				</div>
				<div class="col-xs-12 col-sm-4 form-group">
				    <label for="price_promotion">Discount</label>
				    <input type="number" class="form-control" placeholder="Discounted price" name="price_promotion" id="price_promotion" value="{{$product_price_one->price_promotion}}">
				</div>


			</div>

			<div id="yes_variation" @if($result_empty) style="display: none;" @endif>

				<div class="form-group">

				    <label for="product_group_name">Product Group Name:</label>
				    <input type="text" class="form-control" placeholder="Product Group Name" name="product_group_name" id="product_group_name" value="{{$product->product_group_name}}">

				</div>

				<div class="form-group">
					<label for="add_product_search">Search product:</label>
					<input id="add_product_search" name="add_product_search" type="text" class="form-control" placeholder="Enter Product...">
				</div>

				<div id="result_search" class="list-group">

				</div>
				<div class="mt-3">Group Product:</div>
				<div id="show_result_search" class="list-group">
					@if($result_empty)
					<p class="text-center text-gray-500">No product group</p>
					@elseif($result)
					@foreach($product_group as $value)
						@if($value != $product->id)
						@foreach($product_all as $value1)
						@if($value == $value1->id)
							<li class="list-group-item list-group-item-action">
								<span class="name_product"><a href="{{URL::to('admin/product/editproduct/'.$value1->id)}}">{{$value1->product_name}}</a></span>
								<span class="name_variation">{{$value1->product_group_name}}</span>
								<input type="hidden" class="product_group" name="product_group[]" value="{{$value1->id}}">
							</li>
						@endif
						@endforeach
						@endif
					@endforeach
					@endif
				</div>
			</div>


			  <div class="form-group">
			    <label for="product_shortdsc">Short Decription:</label>
			    <textarea class="form-control" rows="10" id="product_shortdsc" name="product_shortdsc">{{$product->product_shortdsc}}</textarea>
			    <script type="text/javascript">
				var editor = CKEDITOR.replace( 'product_shortdsc', {
				    filebrowserBrowseUrl : '../../../ckfinder/ckfinder.html',
				    filebrowserImageBrowseUrl : '../../../public/admin/ckfinder/ckfinder.html?type=Images',
				    filebrowserFlashBrowseUrl : '../../../ckfinder/ckfinder.html?type=Flash',
				    filebrowserUploadUrl : '../../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
				    filebrowserImageUploadUrl : '../../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
				    filebrowserFlashUploadUrl : '../../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
				});
				//CKFinder.setupCKEditor( editor, '/' );
				</script>
			  </div>

			  <div class="form-group">
			      <div class="row">
			            <div class="col-4"><label for="product_offer">Promotion:</label></div>
			            <div class="col mb-3"><input type="number" name="total_offer" class="form-control" placeholder="Promotion" value="{{$product->total_offer}}" /></div>
			        </div>
			    <label for="product_offer">Promotion:</label>
			    <textarea class="form-control" rows="10" id="product_offer" name="product_offer">{{$product->product_offer}}</textarea>
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
			    <label for="product_info">Techical Specifications:</label>
			    <textarea class="form-control" rows="10" id="product_info" name="product_info">{{$product->product_info}}</textarea>
			    <script type="text/javascript">
				var editor = CKEDITOR.replace( 'product_info', {
				    filebrowserBrowseUrl : '../../../ckfinder/ckfinder.html',
				    filebrowserImageBrowseUrl : '../../../public/admin/ckfinder/ckfinder.html?type=Images',
				    filebrowserFlashBrowseUrl : '../../../ckfinder/ckfinder.html?type=Flash',
				    filebrowserUploadUrl : '../../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
				    filebrowserImageUploadUrl : '../../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
				    filebrowserFlashUploadUrl : '../../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
				});
				//CKFinder.setupCKEditor( editor, '/' );
				</script>

			  </div>
			  <div class="form-group">
			    <label for="product_longdsc">Detailed Product Description:</label>
			    <textarea class="form-control" rows="20" id="product_longdsc" name="product_longdsc">{{$product->product_longdsc}}</textarea>
			    <script type="text/javascript">
				var editor = CKEDITOR.replace( 'product_longdsc', {
				    filebrowserBrowseUrl : '../../../ckfinder/ckfinder.html',
				    filebrowserImageBrowseUrl : '../../../public/admin/ckfinder/ckfinder.html?type=Images',
				    filebrowserFlashBrowseUrl : '../../../ckfinder/ckfinder.html?type=Flash',
				    filebrowserUploadUrl : '../../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
				    filebrowserImageUploadUrl : '../../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
				    filebrowserFlashUploadUrl : '../../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
				});
				//CKFinder.setupCKEditor( editor, '/' );
				</script>
			  </div>
				<button type="submit" name="add_product" id="add_product" class="delete_modal_product btn btn-warning btn-icon-split">
					<span class="icon text-white-50">
						<i class="fas fa-tools"></i>
					</span>
					<span class="text">Edit Product</span>
				</button>


		</div>
		<div class="col-xs-12 col-sm-4 mt-5">
			<div class="row">
				<div class="col-xs-12 col-sm-12 d-flex form-group justify-content-center">

					<input type="hidden" id="id_product" name="id_product" value="{{$product->id}}">

					<button type="submit" name="add_product" id="add_product_1" class="delete_modal_product btn btn-warning btn-icon-split mr-1">
						<span class="icon text-white-50">
							<i class="fas fa-tools"></i>
						</span>
						<span class="text">Sửa</span>
					</button>
					<a href="{{URL::to('admin/product/deleteproductsingle/'.$product->id)}}" class="delete_modal_product btn btn-danger btn-icon-split" onclick="return confirm('Are you sure you want to delete it?');">
						<span class="icon text-white-50">
							<i class="fas fa-trash"></i>
						</span>
						<span class="text">Xóa</span>
					</a>

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
				        <input type="radio" class="form-check-input" name="product_quantity" value="1" @if($product->product_quantity == 1) checked @endif>Stocking
				      </label>

				    </div>
					<div class="form-check-inline">

				      <label class="form-check-label">
				        <input type="radio" class="form-check-input" name="product_quantity" value="0"@if($product->product_quantity == 0) checked @endif >Out of Stock
				      </label>
				    </div>

				</div>
			  	<div class="col-xs-12 col-sm-12 form-group ">
					<div class="col-xs-12">
					    <label>Installment:</label>
					</div>
					<div class="form-check-inline">
				      <label class="form-check-label">
				        <input type="radio" class="form-check-input" name="price_installment" value="1" @if($product_price_one->price_installment == 1) checked @endif>Yes
				      </label>

				    </div>
					<div class="form-check-inline">

				      <label class="form-check-label">
				        <input type="radio" class="form-check-input" name="price_installment" value="0" @if($product_price_one->price_installment == 0) checked @endif>No
				      </label>
				    </div>

				</div>


				<div class="col-xs-12 col-sm-12 form-group">
					<label for="product_avatar">Main Image:</label>
					<input type="file" class="form-control" id="product_avatar" name="product_avatar" data-browse-on-zone-click="true">
					<?php
						$result = Str::of($product->product_avatar)->trim()->isNotEmpty();
						if($result){
					?>
					@foreach($product_image as $value)
							@if($product->product_avatar == $value->id)
							<img id="add_avatar" src="{{asset($value->product_image)}}" alt="" style="width: 100%">
							@endif
							@endforeach

					<?php }
						else{

							?>
								<img id="add_avatar" src="{{asset('/public/upload/product/product_default.png')}}" alt="" style="width: 100%">
							<?php
						}
					 ?>
				</div>
				<div class="col-xs-12 col-sm-12 form-group">

			    	<p for="product_number">Photo library:</p>
			    	<div id="show_product_gallery_have" class="row">
			    		<?php
			    			$result = Str::of($product->product_gallery)->trim()->isNotEmpty();
			    			if($result){
			    				$collection = Str::of($product->product_gallery)->explode(',');


			    		?>
			    		@foreach($collection as $value)
			    		@foreach($product_image as $value1)
			    		@if($value == $value1->id)
			    		<div class="edit_product_gallery{{$value1->id}} col-xs-12 col-sm-4 mb-4">
			    			<span data-id="{{$value1->id}}" class="edit_product_delete_gallery"><i class="fas fa-times"></i></span>
			    			<img src="{{asset($value1->product_image)}}" height="100%" width="100%" />
			    		</div>
			    		@endif
			    		@endforeach
			    		@endforeach
			    		<?php } ?>
			    	</div>
			    	<div id="show_product_gallery" class="row">

			    	</div>
			    	<input type="file" class="form-control" id="product_gallery" name="product_gallery[]" multiple>
			    <span id="add_product_gallery" class="btn btn-primary">Add Image</span>

				</div>
			</div>

		</div>
	</div>
</form>

</div>


<div class="modal fade" id="delete_group_variation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        	<p>Are you sure you want to delete the variation?</p>
        	<input type="hidden" id="product_id" />
        	<input type="hidden" id="groupvariation_id" />

        </div>
        <div class="modal-footer">
          <button type="button" id="click_delete_group_variation" class="btn btn-danger">Delete</button>
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>





  <div class="modal fade" id="edit_product_delete_variationtype" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        	<p>Are you sure you want to delete ?</p>
        	<input type="hidden" id="id_edit_product_variationtype" />

        	<input type="hidden" id="id_edit_product" />

        </div>
        <div class="modal-footer">
          <button type="button" id="click_edit_product_delete_variationtype" class="btn btn-danger">Delete</button>
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

@endsection

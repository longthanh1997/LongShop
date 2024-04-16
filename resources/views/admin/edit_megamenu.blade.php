@extends('admin.adminhome')
@section('content')
<style>
	#preview-main-menu-table tr td:first-child{
		display: none;
	}
</style>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-xs-12 col-md-12 mb-2 mt-5 bg-gradient-light text-gray-800">
			<h2 class="text-center">Edit Category</h2>
			<x-alert/>
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="table-responsive">
						<h3 class="text-center">Select Category</h3>
						<table class="table table-bordered" id="edit-main-menu-table" width="100%" cellspacing="0">
							<thead>
								<th>Select||Deselect</th>
								<th>Category Name</th>
							</thead>
							<tbody>
								@foreach($parent_categories as $val)
									<tr id="danhmuc-{{$val->id}}">
										<td> <input type="checkbox" @if(in_array($val->id,$preview_menu_id))checked @endif name="danhmuccheckbox" onclick="chondanhmuc(this)" id="chon-danhmuc" data-id="{{$val->id}}"/></td>
										<td> {{$val->category_name}}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="table-responsive">
						<h3 class="text-center">Preview</h3>
						<table class="table table-bordered" id="preview-main-menu-table" width="100%" cellspacing="0">
							<thead>
								<th>Category Name</th>
							</thead>
							<tbody>
								@foreach($preview_menu as $val)
									@if(DB::table('product_category')->where('id',$val->id_cate)->first() != null)
										<tr id="danhmuc-{{$val->id_cate}}">
											<td> <input type="checkbox" checked name="danhmuccheckbox" onclick="chondanhmuc(this)" id="chon-danhmuc" data-id="{{$val->id_cate}}"/></td>
											<td> {{DB::table('product_category')->where('id',$val->id_cate)->value('category_name')}}</td>
										</tr>
									@endif
								@endforeach

							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="text-center">
				<div class="notice"></div>
				<button onclick="updatemainmenu()" class="btn btn-primary">Update</button>
			</div>
			<script>


				function chondanhmuc(e){
					id = $(e).data('id');
					if($(e).is(":checked")){
						$( "#danhmuc-"+id ).clone().appendTo( "#preview-main-menu-table tbody" );
					}else{
						$("#preview-main-menu-table tbody #danhmuc-"+id).remove();
					}
				}

				function bochondanhmuc(e)	{
					id = $(e).data('id');
						$("#preview-main-menu-table tbody #danhmuc-"+id).remove();

				}
				function updatemainmenu(){
					var arr_id_cate = [];
					$("#preview-main-menu-table input:checkbox[name=danhmuccheckbox]:checked").each(function () {
						arr_id_cate.push($(this).data('id'));
					});

					if(arr_id_cate == null){
						alert('Please select the category to display');
					}else if(arr_id_cate.length >11){
						alert('You can only select a maximum of 11 categories');
					}
					console.log(arr_id_cate);
					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
					$.ajax({
						type: "POST",
						url: '{{URL::to("admin/posteditmainmenu")}}',
						data: {arr_id_cate:arr_id_cate}, // serializes the form's elements.
						error: function(data){
							console.log(data);
						},
						success: function(data)
						{
							$('.notice').text('Update successful');
							console.log(data); // show response from the php script.
						}
					});
				}
					// $("#preview-main-menu-table input:checkbox[name=danhmuccheckbox]:checked").each(function () {
					// 	alert('sss');
					// });;

			</script>

		</div>
	</div>


</div>


@endsection

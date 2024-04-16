@extends('admin.adminhome')
@section('content')
<?php
use Illuminate\Support\Facades\DB;

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<link  href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
<style>
	#table-comment td, #table-comment .btn{
		font-size: 14px !important;
	}
	.duyet, .huy, .xoa{
		padding: 10px;
		color: #fff;
		background: #000000ad;
		border-radius: 10px;
		position: absolute;
		margin: -50px 0 0 0;
		visibility: hidden;
	}
	.btn-duyet:hover .duyet{
		visibility: visible !important;
		}
		.btn-xoa:hover .xoa{
		visibility: visible !important;
		}
		.btn-huy:hover .huy{
		visibility: visible !important;
		}
</style>
<div class="container">
	<x-alert/>
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<h2 class="text-center">Duyệt bình luận của sản phẩm</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<table class="table table-hover table-bordered table-striped" id="table-comment">
				<thead>
				  <tr>
					<th>Tên</th>
					<th>Số điện thoại</th>
					<th>Email</th>
					<th>Đánh giá</th>
					<th>Hình ảnh</th>
					<th>Nội dung</th>
					<th>Trạng thái</th>
					<th>Hành động</th>
				  </tr>
				</thead>
				<tbody>
					@foreach($comments as $value)
						<tr class="row-{{$value->id}}">
							<td>{{$value->cmt_name}}</td>
							<td>{{$value->cmt_phone}}</td>
							<td>{{$value->cmt_email}}</td>
							<td>{{$value->cmt_rate}}</td>
							<td>
								<div class="fotorama" data-nav="false" data-width="200" data-height="50">
									@foreach(explode(',', $value->cmt_image) as $img)
									<img src="{{asset(DB::table('comment_image')->where('id', $img)->value('cmt_img_url'))}}"/>
									@endforeach

								</div>
							</td>
							<td>{{$value->cmt_content}}</td>
							<td class="status">
								@if($value->cmt_status == 0)
								<button class="btn btn-dark">Not approved yet</button>
								@else
								<button class="btn btn-success">Approved</button>
								@endif
							</td>
							<td>
								@if($value->cmt_status == 0)
								<button class="btn btn-success btn-duyet" data-id="{{$value->id}}" onclick="duyetcomment(this)">✔<span class="duyet">Approve</span></button>
								@else
								<button class="btn btn-warning btn-huy" data-id="{{$value->id}}" onclick="huycomment(this)">⟳<span class="huy">Cancel</span></button>
								@endif
								<button class="btn btn-danger btn-xoa" data-id="{{$value->id}}" onclick="xoacomment(this)">✘<span class="xoa">Delete</span></button>

							</td>
						</tr>
					@endforeach
				</tbody>
			  </table>
			  <script>
				  function duyetcomment(e){
					  	var id = $(e).attr('data-id');
						$.ajax({
							type: "get",
							url: "{{URL::to('/duyet-comment')}}",
							data: {id:id},
							error: function(data){
								console.log(data);
							},
							success: function(data){
								$(e).replaceWith('<button class="btn btn-warning btn-huy" data-id="{{$value->id}}" onclick="huycomment(this)">⟳<span class="huy">Huỷ</span></button>');
								$('.row-'+id +' .status').empty().append('<button class="btn btn-success">Đã duyệt</button>');
								console.log(data);

							}
						});
				  }
				  function xoacomment(e){
					  	var id = $(e).attr('data-id');
						  $.ajax
							({
							type: "get",
							url: "{{URL::to('/xoa-comment')}}",
							data: {id:id},
							error: function(data){
								console.log(data);
							},
							success: function(response)
							{
								$('.row-'+id ).remove();
								console.log(response);

							}
						});
				  }
				  function huycomment(e){
					  	var id = $(e).attr('data-id');
						  $.ajax
							({
							type: "get",
							url: "{{URL::to('/huy-comment')}}",
							data: {id:id},
							error: function(data){
								console.log(data);
							},
							success: function(response)
							{
								$(e).replaceWith('<button class="btn btn-success btn-duyet" data-id="{{$value->id}}" onclick="duyetcomment(this)">✔<span class="duyet">Duyệt</span></button>');
								$('.row-'+id +' .status').empty().append('<button class="btn btn-dark">Chưa duyệt</button>');
								console.log(response);

							}
						});
				  }
			  </script>
		</div>
	</div>

</div>

@endsection

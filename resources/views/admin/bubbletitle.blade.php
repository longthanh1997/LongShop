@extends('admin.adminhome')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">



	<div class="row">
		<x-alert/>
		<div class="col-xs-12 col-md-4 bg-gradient-light text-gray-800">
			<h2 class="text-center">Add Highlights title</h2>
     <!--  variation_sku, variation_name -->
			<form id="form_add_bubble_title" class="p-4" data-route="{{URL::to('/admin/product/addbubbletitle')}}" method="post">
			@csrf
			  <div class="form-group">
			    <label for="bubble_title_name">Title:</label>
			    <input type="text" class="form-control" placeholder="Title" name="bubble_title_name" id="bubble_title_name" required>
			  </div>


			  <button type="submit" class="btn btn-primary" name="add_bubble_title" id="add_bubble_title">Add</button>
			</form>
		</div>


		<div class="col-xs-12 col-md-8">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Highlights title</h6>
            </div>
            <div class="card-body">
              <form action="{{URL::to('/admin/product/editlistbubbletitle')}}" method="post">
                    @csrf
              <div class="row">
                <div class="col-xs-4 col-sm-4">

                  <div class="form-group">
                    <select class="form-control" id="edit_list_bubble_title" name="edit_list_bubble_title">
                      <option value="0">Action</option>
                      <option value="1">Delete</option>
                    </select>
                  </div>
                </div>
                <div class="col-xs-3 col-sm-3">
                  <div class="form-group">
                    <button type="submit" class="btn btn-info">Apply</button>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered" id="bubble_title_table" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th><input type="checkbox" class="check_all"></th>
                      <th>Title</th>
                      <th>Actions</th>

                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th><input type="checkbox" class="check_all"></th>
                      <th>Title</th>
                      <th>Actions</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <!--  brand_name, brand_sku, brand_status -->
                  	@foreach($bubble as $value)
                    <tr class="post{{$value->id}}">
                      <td><input type="checkbox" class="check_list" value="{{$value->id}}" name="check_list_bubble[]"></td>
                      <td>{{$value->name}}</td>

                      <td><button type="button" class="edit_bubble_title btn btn-warning btn-icon-split" data-id="{{$value->id}}" data-title="{{$value->name}}">
                    		<span class="icon text-white-50">
                      			<i class="fas fa-tools"></i>
                    		</span>
                    		<span class="text">Edit</span>
                  		</button> <button type="button" class="delete_bubble_title btn btn-danger btn-icon-split" data-id="{{$value->id}}" data-title="{{$value->name}}">
                    		<span class="icon text-white-50">
                      			<i class="fas fa-trash"></i>
                    		</span>
                    		<span class="text">Delete</span>
                  		</button></td>

                    </tr>

                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </form>
		</div>
	</div>
  <!-- Page Heading -->

</div>
<!-- /.container-fluid -->

<div class="modal fade" id="modal_edit_bubble_title" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Highlights title</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        	<h2 class="text-center">Edit</h2>
          <!--  variation_name_edit, variation_sku_edit, id_edit -->
			<form id="form_edit_bubble_title" class="p-4" data-route="{{URL::to('/admin/product/editbubbletitle')}}" method="post">
			@csrf
			  <div class="form-group">
			    <label for="bubble_title_name_edit">Title</label>
			    <input type="text" class="form-control" placeholder="Title" name="bubble_title_name_edit" id="bubble_title_name_edit" value="" required>
			  </div>

			  <input type="hidden" id="id_edit" name="id_edit">
			  <button type="submit" class="btn btn-primary" name="edit_bubble_title_sub" id="edit_bubble_title_sub">Edit</button>
			</form>
        </div>
        <div class="modal-footer justify-content-center">

          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>



<!-- xóa Modal-->
  <div class="modal fade" id="modal_delete_bubble_title" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <button type="button" id="click_delete_bubble_title" class="btn btn-danger">Delete</button>
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

@endsection

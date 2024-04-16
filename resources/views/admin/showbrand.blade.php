@extends('admin.adminhome')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="row">
    <x-alert/>
    <div class="col-xs-12 col-md-4 bg-gradient-light text-gray-800">
      <h2 class="text-center">Add Category Type</h2>
     <!--  brand_name, brand_sku, brand_status -->
      <form id="form_add_brand" class="p-4" data-route="{{URL::to('/admin/product-brand/addbrand')}}" method="post">
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


    <div class="col-xs-12 col-md-8">


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">All types of categories</h6>
            </div>
            <div class="card-body">
              <form action="{{URL::to('/admin/product-brand/editbrandlist')}}" method="post">
                    @csrf
              <div class="row">
                <div class="col-xs-4 col-sm-4">

                  <div class="form-group">
                    <select class="form-control" id="edit_list_brand" name="edit_list_brand">
                      <option value="0">Action</option>
                      <option value="1">Hide</option>
                      <option value="2">Show</option>
                      <option value="3">Delete</option>
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
                <table class="table table-bordered" id="brand_table" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th><input type="checkbox" class="check_all"></th>
                      <th>Category type Name</th>
                      <th>Status</th>
                      <th>Category type ID</th>
                      <th>Action</th>

                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th><input type="checkbox" class="check_all"></th>
                      <th>Category type Name</th>
                      <th>Status</th>
                      <th>Category type ID</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <!--  brand_name, brand_sku, brand_status -->
                    @foreach($product_brand as $value)
                    <tr class="post{{$value->id}}">
                      <td><input type="checkbox" class="check_list" value="{{$value->id}}" name="check_list_brand[]"></td>
                      <td>{{$value->brand_name}}</td>
                      <td>@if($value->brand_status == 1) <span class="btn btn-success">Show</span> @else <span class="btn btn-secondary">Hide</span> @endif</td>
                      <td>{{$value->brand_sku}}</td>
                      <td><button type="button" class="edit_modal_brand btn btn-warning btn-icon-split" data-id="{{$value->id}}" data-title="{{$value->brand_name}}" data-status="{{$value->brand_status}}" data-code="{{$value->brand_sku}}">
                        <span class="icon text-white-50">
                            <i class="fas fa-tools"></i>
                        </span>
                        <span class="text">Edit</span>
                      </button> <button type="button" class="delete_modal_brand btn btn-danger btn-icon-split" data-id="{{$value->id}}" data-title="{{$value->brand_name}}" data-status="{{$value->brand_status}}" data-code="{{$value->brand_sku}}">
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

<div class="modal fade" id="edit_brand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Brand</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <h2 class="text-center">Edit Brand</h2>
          <!--  brand_name_edit, brand_sku_edit, brand_status_edit, id_edit -->
      <form id="form_edit_brand" class="p-4" data-route="{{URL::to('/admin/product-brand/editbrand')}}" method="post">
      @csrf
        <div class="form-group">
          <label for="brand_name_edit">Brand Name</label>
          <input type="text" class="form-control" placeholder="Brand Name" name="brand_name_edit" id="brand_name_edit" value="" required>
        </div>

        <div class="form-group">
          <label for="brand_status_edit">Status:</label>
          <select class="form-control" id="brand_status_edit" name="brand_status_edit">
            <option value="1">Show</option>
            <option value="0">Hide</option>

          </select>
        </div>
        <div class="form-group">
          <label for="brand_sku_edit">Brand ID:</label>
          <input type="text" class="form-control" placeholder="Brand ID" id="brand_sku_edit" name="brand_sku_edit" value="">

        </div>
        <input type="hidden" id="id_edit" name="id_edit">
        <button type="submit" class="btn btn-primary" name="edit_brand_sub" id="edit_brand_sub">Edit</button>
      </form>
        </div>
        <div class="modal-footer justify-content-center">

          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>



<!-- xóa Modal-->
  <div class="modal fade" id="delete_brand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <button type="button" id="click_delete_brand" class="btn btn-danger">Delete</button>
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
@endsection

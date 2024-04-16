@extends('admin.adminhome')
@section('content')
<!-- Begin Page Content -->

<div class="container-fluid">
  <div class="row">
    <x-alert/>
    <div class="col-xs-12 col-md-4 bg-gradient-light text-gray-800">
      <h2 class="text-center">Add categories</h2>
      <form id="form_add_category" class="p-4" data-route="{{URL::to('/admin/product-category/addcategory')}}" method="post">
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
          <label for="category_parent">Parent category:</label>
          <select class="form-control" id="category_parent" name="category_parent">
            <option value="0">Empty</option>
            {!! $product_category !!}
          </select>
        </div>
        <div class="form-group">
          <label for="category_sku">Category ID:</label>
          <input type="text" class="form-control" placeholder="Category ID" id="category_sku" name="category_sku">
        </div>
        <button type="submit" class="btn btn-primary" name="add_category" id="add_category">Add</button>
      </form>
    </div>


    <div class="col-xs-12 col-md-8">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">

            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">All Categories</h6>
            </div>


            <div class="card-body">
              <!-- <input class="form-control" id="search_category" type="text" placeholder="Search.."> -->
              <form action="{{URL::to('/admin/product-category/editcategorylist')}}" method="post">
                    @csrf
              <div class="row">
                <div class="col-xs-4 col-sm-4">

                  <div class="form-group">
                    <select class="form-control" id="edit_list_category" name="edit_list_category">
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
                <table class="table table-bordered" id="category_table" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th><input type="checkbox" class="check_all"></th>
                      <th>Category Name</th>
                      <th>Status</th>
                      <th>Category ID</th>
                      <th>Action</th>

                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th><input type="checkbox" class="check_all"></th>
                      <th>Category Name</th>
                      <th>Status</th>
                      <th>Category ID</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <!-- category_sku, category_name, category_status -->
                      {!! $product_category1 !!}
                  </tbody>
                </table>
              </div>
            </div>
          </div>

    </div>
  </div>
  <!-- Page Heading -->
  </form>
</div>
<!-- /.container-fluid -->
<!-- category_sku, category_name, category_status -->
<div class="modal fade" id="edit_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Category</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <h2 class="text-center">Edit Category</h2>
          <!-- category_sku, category_name, category_status -->
      <form id="form_edit_category" class="p-4" data-route="{{URL::to('/admin/product-category/editcategory')}}" method="post">
      @csrf
        <div class="form-group">
          <label for="category_name_edit">Category Name:</label>
          <input type="text" class="form-control" placeholder="Category Name" name="category_name_edit" id="category_name_edit" value="" required>
        </div>

        <div class="form-group">
          <label for="category_status_edit">Status:</label>
          <select class="form-control" id="category_status_edit" name="category_status_edit">
            <option value="1">Show</option>
            <option value="0">Hide</option>

          </select>
        </div>
        <div class="form-group">
          <label for="category_slug_edit">Path:</label>
          <input type="text" class="form-control" placeholder="Category Path" id="category_slug_edit" name="category_slug_edit" value="" required>

        </div>
        <div class="form-group">
          <label for="category_sku_edit">Category ID:</label>
          <input type="text" class="form-control" placeholder="Category ID" id="category_sku_edit" name="category_sku_edit" value="">

        </div>
        <div class="form-group">
          <label for="category_type_edit">Category type:</label>
          <select class="form-control" id="category_type_edit" name="category_type_edit">
            <option value="0">Empty</option>
            @foreach($product_brand as $value)
            <option value="{{$value->id}}">{{$value->brand_name}}</option>

            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="category_parent_edit">Parent Category:</label>
          <select class="form-control" id="category_parent_edit" name="category_parent_edit">
            <option value="0">Empty</option>
            {!! $product_category !!}
          </select>
        </div>

        <input type="hidden" id="id_edit" name="id_edit">
        <button type="submit" class="btn btn-primary" name="edit_category_sub" id="edit_category_sub">Edit</button>
      </form>
        </div>
        <div class="modal-footer justify-content-center">

          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

<!-- xóa Modal-->
  <div class="modal fade" id="delete_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <button type="button" id="click_delete_category" class="btn btn-danger">Delete</button>
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>







@endsection

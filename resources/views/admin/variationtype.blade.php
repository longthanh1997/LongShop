@extends('admin.adminhome')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

<form id="form_add_variation" class="p-4" data-route="{{URL::to('/admin/product/addvariation')}}" method="post">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6">
      <h2>Thông tin đặt hàng</h2>
      <div class="form-group">
          <label for="variation_name">Họ tên:</label>
          <input type="text" class="form-control" placeholder="Tên biến thể" name="variation_name" id="variation_name" required>
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 form-group">
          <label for="variation_name">Email:</label>
          <input type="text" class="form-control" placeholder="Tên biến thể" name="variation_name" id="variation_name" required>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 form-group">
          <label for="variation_name">Số điện thoại:</label>
          <input type="text" class="form-control" placeholder="Tên biến thể" name="variation_name" id="variation_name" required>
        </div>
      </div>
      <div class="form-group">
          <label for="variation_name">Họ tên:</label>
          <input type="text" class="form-control" placeholder="Tên biến thể" name="variation_name" id="variation_name" required>
      </div>
      <div class="form-group">
        <label for="product_status">Tỉnh thành:</label>

        <select class="form-control" id="product_status" name="product_status">
          <option value="1">Hồ Chí Minh</option>
          <option value="1">Show</option>
          <option value="0">Hide</option>
        </select>
      </div>
      <div class="form-group">
        <label for="product_shortdsc">Note:</label>
        <textarea class="form-control" rows="10" id="product_shortdsc" name="product_shortdsc"></textarea>
      </div>

      </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
      <h2 class="mb-4">Orders</h2>
      <table class="table">
        <thead>
          <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>John</td>
            <td>Doe</td>
            <td>john@example.com</td>
          </tr>
          <tr>
            <td>Mary</td>
            <td>Moe</td>
            <td>mary@example.com</td>
          </tr>
          <tr>
            <td>July</td>
            <td>Dooley</td>
            <td>july@example.com</td>
          </tr>
        </tbody>
      </table>
      <table class="table mt-5">
        <tbody>
          <tr>
            <td>John</td>
            <td>Doe</td>

          </tr>
          <tr>
            <td>Mary</td>
            <td>Moe</td>

          </tr>
          <tr>
            <td>July</td>
            <td>Dooley</td>

          </tr>
        </tbody>
      </table>
      <div class="text-right"><input type="submit" class="btn btn-info" name="" value="Đặt hàng"></div>
    </div>

  </div>
</form>


  <div class="row">
    <x-alert/>
    <div class="col-xs-12 col-md-4 bg-gradient-light text-gray-800">
      <h2 class="text-center">Add variant type</h2>
     <!--  variation_type_sku, variation_type_name -->
      <form id="form_add_variation_type" class="p-4" data-route="{{URL::to('/admin/product/addvariationtype')}}" method="post">
      @csrf
        <div class="form-group">
          <label for="variation_type_name">Variant type name:</label>
          <input type="text" class="form-control" placeholder="Variant type name" name="variation_type_name" id="variation_type_name" required>
        </div>

        <div class="form-group">
          <label for="variation_type_sku">Variant type code:</label>
          <input type="text" class="form-control" placeholder="Variant type code" id="variation_type_sku" name="variation_type_sku">
        </div>
        <button type="submit" class="btn btn-primary" name="add_variation_type_sub" id="add_variation_type_sub">Add</button>
      </form>
    </div>


    <div class="col-xs-12 col-md-8">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">All Variant Types</h6>
            </div>
            <div class="card-body">
              <form action="{{URL::to('/admin/product/editvariationtypelist')}}" method="post">
                    @csrf
              <div class="row">
                <div class="col-xs-4 col-sm-4">

                  <div class="form-group">
                    <select class="form-control" id="edit_list_variationtype" name="edit_list_variationtype">
                      <option value="0">Actions</option>

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
                <table class="table table-bordered" id="variation_type_table" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th><input type="checkbox" class="check_all"></th>
                      <th>Variant type name</th>
                      <th>Variant type code</th>
                      <th>Action</th>

                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th><input type="checkbox" class="check_all"></th>
                      <th>Variant type name</th>
                      <th>Variant type code</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <!--  brand_name, brand_sku, brand_status -->
                    @foreach($variationtype as $value)
                    <tr class="post{{$value->id}}">
                      <td><input type="checkbox" class="check_list" value="{{$value->id}}" name="check_list_variationtype[]"></td>
                      <td>{{$value->variation_type_name}}</td>

                      <td>{{$value->variation_type_sku}}</td>
                      <td width="350px">
                        <a href="{{URL::to('/admin/product/variation/'.$value->id)}}" class="btn btn-primary btn-icon-split">
                          <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
                          <span  class="text">Variant</span></a>

                        <button type="button" class="edit_modal_variation_type btn btn-warning btn-icon-split" data-id="{{$value->id}}" data-title="{{$value->variation_type_name}}" data-code="{{$value->variation_type_sku}}">
                        <span class="icon text-white-50">
                            <i class="fas fa-tools"></i>
                        </span>
                        <span class="text">Edit</span>
                      </button>

                      <button type="button" class="delete_modal_variation_type btn btn-danger btn-icon-split" data-id="{{$value->id}}" data-title="{{$value->variation_type_name}}" data-code="{{$value->variation_type_sku}}">
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

<div class="modal fade" id="edit_variation_type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Variant Type</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <h2 class="text-center">edit variant type </h2>
          <!--  variation_type_name_edit, variation_type_sku_edit, id_edit -->
      <form id="form_edit_variation_type" class="p-4" data-route="{{URL::to('/admin/product/editvariationtype')}}" method="post">
      @csrf
        <div class="form-group">
          <label for="variation_type_name_edit">Variant name</label>
          <input type="text" class="form-control" placeholder="Variant name" name="variation_type_name_edit" id="variation_type_name_edit" value="" required>
        </div>

        <div class="form-group">
          <label for="variation_type_sku_edit">Variant type code:</label>
          <input type="text" class="form-control" placeholder="Variant type code" id="variation_type_sku_edit" name="variation_type_sku_edit" value="">

        </div>
        <input type="hidden" id="id_edit" name="id_edit">
        <button type="submit" class="btn btn-primary" name="edit_variation_type_sub" id="edit_variation_type_sub">Edit</button>
      </form>
        </div>
        <div class="modal-footer justify-content-center">

          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>



<!-- xóa Modal-->
  <div class="modal fade" id="delete_variation_type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <p id="content_delete"></p>
          <input type="hidden" id="id_delete" />
        </div>
        <div class="modal-footer">
          <button type="button" id="click_delete_variation_type" class="btn btn-danger">Delete</button>
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

@endsection

@extends('admin.adminhome')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="row">
    <x-alert/>
    <div class="col-xs-12 col-md-12">


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Banner</h6>
            </div>
            <div class="card-body">
              <form action="{{URL::to('/admin/product-brand/editbrandlist')}}" method="post">
                    @csrf
              <div class="row">
                <div class="col-xs-4 col-sm-4">

                  <div class="form-group">
                    <select class="form-control" id="edit_list_brand" name="edit_list_brand">
                      <option value="0">Actions</option>
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
                <table class="table table-bordered" id="banner_table" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th><input type="checkbox" class="check_all"></th>
                      <th>Note</th>
                      <th>Image</th>
                      <th>Order</th>
                      <th>Position</th>
                      <th><button type="button" class="add_modal_banner btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-tools"></i>
                        </span>
                        <span class="text">Add</span>
                      </button></th>

                    </tr>
                  </thead>
                  <tfoot>
                    <tr>

                      <th><input type="checkbox" class="check_all"></th>
                      <th>Notes</th>
                      <th>Image</th>
                      <th>Image sequence</th>
                      <th>Position</th>
                      <th><button type="button" class="add_modal_banner btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-tools"></i>
                        </span>
                        <span class="text">Add</span>
                      </button></th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <!--  brand_name, brand_sku, brand_status -->
                    @foreach($banner as $value)
                    <tr class="post{{$value->id}}">
                      <td><input type="checkbox" class="check_list" value="{{$value->id}}" name="check_list_banner[]"></td>
                      <td>{{$value->note}}</td>
                      <td><img style="width: 200px" src="{{asset(DB::table('product_image')->where('id', $value->image)->value('product_image'))}}" alt=""></td>
                      <td>{{$value->number_order}}</td>
                      <td>{{$value->location}}</td>
                      <td><button type="button" class="click_edit_banner btn btn-warning btn-icon-split" data-id="{{$value->id}}" data-note="{{$value->note}}" data-number_order="{{$value->number_order}}" data-id_image="{{$value->image}}" data-location="{{$value->location}}" data-image="{{asset(DB::table('product_image')->where('id', $value->image)->value('product_image'))}}">
                        <span class="icon text-white-50">
                            <i class="fas fa-tools"></i>
                        </span>
                        <span class="text">Edit</span>
                      </button> <a onclick="return confirm('Có chắc bạn muốn xóa?');" href="{{URL::to('admin/delete-banner/'.$value->id)}}" class="delete_modal_banner btn btn-danger btn-icon-split" data-id="{{$value->id}}" data-note="{{$value->note}}">
                        <span class="icon text-white-50">
                            <i class="fas fa-trash"></i>
                        </span>
                        <span class="text">Delete</span>
                      </a></td>

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

<div class="modal fade" id="add_banner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Banner</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <h2 class="text-center">Add banner</h2>
          <!--  brand_name_edit, brand_sku_edit, brand_status_edit, id_edit -->
      <form id="" class="p-4" action="{{route('post.addBanner')}}" method="post" enctype="multipart/form-data">
      @csrf
        <div class="form-group">
          <label for="note">Notes</label>
          <input type="text" class="form-control" placeholder="Note Name" name="note" id="note" value="" required>
        </div>

        <div class="form-group">
          <label for="number_order">Order:</label>
          <input type="number" class="form-control" placeholder="Order" name="number_order" id="number_order" min=1 value="" required>
        </div>
        <div class="form-group">
          <label for="location">Position:</label>
          <input type="munber" class="form-control" placeholder="Vị trí" id="location" name="location" min=1 value="">

        </div>
        <div class="form-group">
          <label for="image">Image:</label>
          <img width="100%" class="click_add_img" src="{{asset('public/upload/product/product_default.png')}}" alt="">
          <input style="opacity: 0" type="file" id="image" name="image" />

        </div>
        <button type="submit" class="btn btn-primary" name="edit_brand_sub" id="edit_brand_sub">Add</button>
      </form>
        </div>
        <div class="modal-footer justify-content-center">

          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

<div class="modal fade" id="edit_banner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Banner</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <h2 class="text-center">Edit banner</h2>
          <!--  brand_name_edit, brand_sku_edit, brand_status_edit, id_edit -->
      <form id="" class="p-4" action="{{route('post.editBanner')}}" method="post" enctype="multipart/form-data">
      @csrf
        <div class="form-group">
          <label for="edit_note">Notes</label>
          <input type="text" class="form-control" placeholder="Note Name" name="edit_note" id="edit_note" value="" required>
        </div>

        <div class="form-group">
          <label for="edit_number_order">Order:</label>
          <input type="number" class="form-control" placeholder="order" name="edit_number_order" id="edit_number_order" min=1 value="" required>
        </div>
        <div class="form-group">
          <label for="edit_location">Position:</label>
          <input type="munber" class="form-control" placeholder="Position" id="edit_location" name="edit_location" min=1 value="">

        </div>
        <div class="form-group">
          <label for="edit_image">Image:</label>
          <img width="100%" class="click_edit_img" src="" alt="">
          <input style="opacity: 0" type="file" id="edit_image" name="edit_image" />
          <input type="hidden" id="edit_id_image" name="edit_id_image" />
        </div>
        <input type="hidden" id="id_edit_banner" name="id_edit_banner">
        <button type="submit" class="btn btn-primary" name="edit_banner_sub" id="edit_banner_sub">Edit</button>
      </form>
        </div>
        <div class="modal-footer justify-content-center">

          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>



<!-- xóa Modal-->
  <div class="modal fade" id="delete_banner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <a href="{{URL::to('')}}" class="btn btn-danger">Delete</a>
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
@endsection

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
          <option value="1">Hiện</option>
          <option value="0">Ẩn</option>
        </select>
      </div>
      <div class="form-group">
        <label for="product_shortdsc">Ghi chú:</label>
        <textarea class="form-control" rows="10" id="product_shortdsc" name="product_shortdsc"></textarea>
      </div>

      </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
      <h2 class="mb-4">Đơn hàng</h2>         
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

@csrf
<div class="row">
  <x-alert/>
  <div class="col-xs-12 col-md-12 bg-gradient-light text-gray-800">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">File Manager</h6>
      </div>
      <div class="card-body">
        <div id="folder_table" class="table-responsive">
            
        </div>
      </div>
    </div>
  </div>
  <!-- Page Heading -->
</div>
<!-- /.container-fluid -->

@endsection
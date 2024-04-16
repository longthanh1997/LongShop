@extends('admin.adminhome')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 mb-2 mt-5 bg-gradient-light text-gray-800">
            <h2 class="text-center">Add more coupon code</h2>
            <x-alert />
            <form id="ThemMaUuDai" class="p-4" action="{{URL::to('/admin/don-hang/postthemmauudai')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="coupon_type">Loại coupon: </label>
                    <select class="form-control" id="coupon_type" name="coupon_type">
                        <option value="1">Giảm giá theo phần trăm</option>
                        <option value="2">Giảm giá sản phẩm cố định</option>

                    </select>
                    <div class="form-group">
                        <label for="coupon_code">Mã ưu đãi</label>
                        <input type="text" pattern=".{6,20}" class="form-control" placeholder="Mã ưu đãi" name="coupon_code" id="coupon_code" required>
                        <button type="button" id="createCouponCode" class="btn btn-primary">Tạo mã ngẫu nhiên</button>
                    </div>
                    <div class="form-group">
                        <label for="coupon_description">Mô tả</label>
                        <input type="text" class="form-control" placeholder="Mô tả mã ưu đãi" name="coupon_description" id="coupon_description" required>
                    </div>
                    <div class="form-group">
                        <label for="coupon_value" id="lblUuDai">Leveling of Discount (%)</label>
                        <input type="number" class="form-control" placeholder="Mức ưu đãi" name="coupon_value" id="coupon_value" required>
                    </div>


                </div>
                <div class="form-group" id="sanphamuudai" style="display:none">
                    <label for="coupon_sanpham">Sản phẩm ưu đãi</label>
                    <select class="form-control" id="coupon_sanpham" name="coupon_sanpham">
                        @foreach($products as $product)
                        <option value="{{$product->id}}">{{$product->product_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" id="danhmucuudai">
                    <label for="coupon_danhmucsanpham">Danh mục ưu đãi</label>
                    <select class="form-control" id="coupon_danhmucsanpham" name="coupon_danhmucsanpham">
                        @foreach($product_categories as $product_category)
                        <option value="{{$product_category->id}}">{{$product_category->category_name}}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group" id="ngayhethan">
                    <label for="coupon_date">the date it expires</label>
                    <input type="date" class="form-control" name="coupon_date" id="coupon_date" required>
                </div>
                <button type="submit" class="btn btn-primary" name="themdanhmuc" id="themdanhmuc">Add</button>
                <button type="button" class="btn btn-danger" name="cancel" id="cancel">
                <a href="mauudai" class="btn btn-icon-split" style="color:white">Cancel</a>
                </button>
            </form>
        </div>
    </div>


</div>


@endsection

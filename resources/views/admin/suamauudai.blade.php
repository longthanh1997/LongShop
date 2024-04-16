@extends('admin.adminhome')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 mb-2 mt-5 bg-gradient-light text-gray-800">
            <h2 class="text-center">Editing</h2>
            <x-alert />
            <form id="SuaMaUuDai" class="p-4" action="{{URL::to('/admin/don-hang/postsuamauudai')}}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$coupon->id}}" >
                <div class="form-group">
                    <label for="coupon_type">Coupon type: </label>
                    <select class="form-control" id="coupon_type" name="coupon_type">
                        <option value="1" @if($coupon->coupon_type == 1) selected @endif >Discount by percentage</option>
                        <option value="2" @if($coupon->coupon_type == 2) selected @endif >Fixed product discounts</option>

                    </select>
                    <div class="form-group">
                        <label for="coupon_code">Promotion code</label>
                        <input type="text" pattern=".{6,20}" class="form-control" placeholder="Promotion code" name="coupon_code" id="coupon_code" value="{{$coupon->coupon_code}}" required>
                        <button type="button" id="createCouponCode" class="btn btn-primary">randomize</button>
                    </div>
                    <div class="form-group">
                        <label for="coupon_description">Description</label>
                        <input type="text" class="form-control" placeholder="Description of coupon" name="coupon_description" id="coupon_description" value="{{$coupon->coupon_description}}" required>
                    </div>
                    <div class="form-group">
                        <label for="coupon_value" id="lblUuDai">Level of discount @if($coupon->coupon_type == 1) (%) @else() ($) @endif</label>
                        <input type="number" class="form-control" placeholder="Level of discount" name="coupon_value" id="coupon_value" value="{{$coupon->coupon_value}}" required>
                    </div>


                </div>
                <div class="form-group" id="sanphamuudai" @if($coupon->coupon_type == 1) style="display:none" @endif>
                    <label for="coupon_sanpham">Discounted PRODUCT</label>
                    <select class="form-control" id="coupon_sanpham" name="coupon_sanpham">
                        @foreach($products as $product)
                        <option value="{{$product->id}}">{{$product->product_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" id="danhmucuudai" @if($coupon->coupon_type == 2) style="display:none" @endif>
                    <label for="coupon_danhmucsanpham">Categories</label>
                    <select class="form-control" id="coupon_danhmucsanpham" name="coupon_danhmucsanpham">
                        @foreach($product_categories as $product_category)
                        <option value="{{$product_category->id}}">{{$product_category->category_name}}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group" id="ngayhethan">
                    <label for="coupon_date">Expiration date</label>
                    <input type="date" class="form-control" name="coupon_date" id="coupon_date" value="{{$coupon->coupon_date}}" required>
                </div>
                <button type="submit" class="btn btn-primary" name="themdanhmuc" id="themdanhmuc">Edit</button>
                <button type="button" class="btn btn-danger" name="cancel" id="cancel">
                <a href="/dienmayxanh/admin/don-hang/mauudai" class="btn btn-icon-split" style="color:white">Cancel</a>
                </button>
            </form>
        </div>
    </div>


</div>


@endsection

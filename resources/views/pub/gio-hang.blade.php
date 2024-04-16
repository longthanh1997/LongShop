<?php
    $cities = DB::table('province')->get();
    use App\Http\Controllers\SanphamController;
    $sanphamController = new SanphamController();
?>
@extends('layouts.master')
@section('content')

    <section id="cart-form">
        @if (session()->has('success_msg'))
            <p>{{ session('success_msg') }}</p>
        @endif

        <div class="bar-top">
            <a href="{{URL::to('/')}}" class="buymore">Buy more products</a>
            <div class="yourcart">Your Cart</div>

        </div>
        <div class="pickmorecolor__warning top-alert">The service carries additional colors and products for reference only
            Used when ordering only 1 product.</div>
        <div class="wrap_cart">
            <div class="for-newhome hide">
            </div>
            <ul class="listorder" id="product-list">
                @foreach (Cart::content() as $item)

                <li class="item-{{$item->id}}" data-quantity="{{$item->options->available_qty}}">
                    <div class="colimg"><a href="{{$sanphamController->getLinkProduct($item->id)}}" target="_blank"><img width="55"
                                height="55"
                                src="{{asset($item->options->img_feature)}}"
                                alt="{{$item->name}}"></a>
                        {{-- <form action="{{route('cart.delete', $item->rowId)}}" method="post">
                            @csrf
                            @method('delete')
                            <button class="del" type="submit">
                                <span></span>Xóa
                            </button>
                        </form> --}}
                        <button class="del">
                            <span></span>Delete
                        </button>
                    </div>
                    <div class="colinfo">
                        <!-- check if has promo price -->
                        @if ($item->options->price_regular)
                            <strong class="price-color">
                                <span>{{number_format($item->options->price_regular, "0", ",", ".")}}$</span>
                                {{number_format($item->price, "0", ",", ".")}}$
                            </strong>
                        @else
                            <strong class="price-color">
                                {{number_format($item->price, "0", ",", ".")}}$
                            </strong>
                        @endif
                        <a href="{{$sanphamController->getLinkProduct($item->id)}}" target="_blank">{{$item->name}}</a>
                        <div class="promotion newpro many">
                            <div class="title">
                                <label>Detail</label>
                            </div>
                            @php
                                $offer = DB::table('product')->where('id', $item->id)->value('product_offer');
                            @endphp
                            {!!$offer!!}
                        </div>
                        <div class="clr"></div>
                        <div class="onecolor"><span>Color:</span> Silver</div>

                        <div class="choosenumber">
                            @if ($item->qty > 1)
                                <div class="abate active downCart" style="pointer-events: all;">
                                    <i></i>
                                    <i></i>
                                </div>
                            @else
                                <div class="abate disable downCart" style="pointer-events: all;">
                                    <i></i>
                                    <i></i>
                                </div>
                            @endif

                            <input type="hidden" name="rowID" id="rowID-{{$item->rowId}}" value="{{$item->rowId}}">

                            <div class="number">
                                <input
                                style="text-align: center;
                                border: 0;
                                vertical-align: middle;"
                                type="number" name="qty" readonly value="{{$item->qty}}" step="1" min="1" max="10">
                            </div>
                            @if ($item->qty < 11)
                                <div class="augment active upCart" style="pointer-events: all;">
                                    <i></i>
                                    <i></i>
                                </div>
                            @else
                                <div class="augment disable upCart" style="pointer-events: all;">
                                    <i></i>
                                    <i></i>
                                </div>
                            @endif
                    </div>

                    <div class="clr"></div>
                    </div>
                    <div class="clr"></div>
                </li>
                @endforeach
            </ul>
            {{-- TONG TIEN --}}
            <div class="area_total">
                <div class="total cfg">
                    <b>Total Price ({{Cart::count()}} Products):</b>
                    <strong id="totalOr">{{Cart::subtotal()}}$</strong>
                </div>
                <div id="cod" class="hide">
                    <span>Delivery Price:</span>
                    <span class="price-color"></span>
                </div>
                {{-- <div id="promotiondiscount" class="">
                    <span>Giảm:</span>
                    <span class="price-color">-60$</span>
                </div> --}}


                @if (session()->has('coupon') && $discount != 0)
                    <div id="newhomediscount">
                        <span>
                            Discount code {{session('coupon')['name']}}:
                            <form action="{{route('coupon.delete')}}" method="post" style="display: inline-block;">
                                @csrf
                                @method('delete')
                                <button class="del" type="submit">
                                    <span></span>Delete
                                </button>
                            </form>
                        </span>
                        <span class="price-color">-{{number_format($discount, "0", ",", ".")}}$</span>
                    </div>
                @elseif(session()->has('coupon') && $discount == 0)
                    <div id="newhomediscount">
                        <span>
                            Discount code {{session('coupon')['name']}}:
                            <form action="{{route('coupon.delete')}}" method="post" style="display: inline-block;">
                                @csrf
                                @method('delete')
                                <button class="del" type="submit">
                                    <span></span>Delete
                                </button>
                            </form>
                        </span>
                        <span class="price-color">Coupon Does not apply to this product</span>
                    </div>
                @endif

                <div id="totalSum" class="total">
                    <b>Payment required:</b>
                    <strong id="sum">{{number_format($newTotal, "0", ".", ".")}}$</strong>
                </div>
                <div class="clr"></div>
                    <div class="freeship hide">
                        <i class="iconcart-check"></i> Orders are delivered <b>Free</b> Fee
                    </div>
                    @if (!session()->has('coupon'))
                    <div id="areaCoupon" class="">
                        <div class="textcode">
                            Use discount code
                        </div>
                        <div class="inputcode">
                            <form action="{{route('coupon.store')}}" method="post">
                                @csrf
                                @php
                                    $products_id = array();
                                    $categories_id = array();
                                @endphp
                                @foreach (Cart::content() as $item)
                                    @php
                                        array_push($products_id, $item->id);
                                        array_push($categories_id, $item->options['category']);
                                    @endphp
                                @endforeach
                                <input type="hidden" name="proID" value="{{implode(',', $products_id)}}">
                                <input type="hidden" name="catID" value="{{implode(',', $categories_id)}}">

                                <button type="submit" id="btnCoupon">Áp dụng</button>
                                <input autocomplete="none" id="Coupon" maxlength="20" name="Coupon" placeholder="Nhập mã giảm giá" type="text" value="">
                            </form>
                        </div>
                    </div>
                    @endif
            </div>
        <form action="{{route('cart.moveToCheckOut')}}" method="post" id="form-checkout">
            @csrf
        <div class="hduser">Customer information</div>


        {{-- LƯU THÔNG TIN USER VÀO SESSION --}}
        @if (session('user'))
            <div class="infoold">
                @if (session()->has('coupon') && $discount != 0)
                <input type="hidden" name="bill_promo" value="{{$discount}}">
                <input type="hidden" name="bill_coupon" value="{{session('coupon')['name']}}">
                @endif
                <input type="hidden" name="totalSum" value="{{$newTotal}}">
                <i class="iconcart-check"></i> {{session('user')['sex']}}: <strong>{{session('user')['name']}}</strong> - {{session('user')['phone']}}
                <span class="change">Edit</span>
            </div>

            <div class="infouser">

            <div class="malefemale">
                <span class="radio-ctnr active mr10" id="radctnr-Male">
                    <input id="Male" name="Customer_Sex" type="radio" value="Anh"
                    @if (session('user')['sex'] == "Anh")
                        checked
                    @endif
                    >
                    <label class="radio" for="Male">
                        <span class="box"></span>
                        <span class="text">Mr</span>
                    </label>
                </span>


                <span class="radio-ctnr  " id="radctnr-Female">
                    <input id="Female" name="Customer_Sex" type="radio" value="Chị"
                    @if (session('user')['sex'] == "Chị")
                        checked
                    @endif
                    >
                    <label class="radio"
                        for="Female">
                        <span class="box"></span>
                        <span class="text">Mrs</span>
                    </label>
                </span>
                <label id="sex-error" class="texterror"></label>
            </div>
            <div class="areainfo">
                <div class="left">
                    <input autocomplete="name" id="Customer_Name" name="Customer_Name" placeholder="Họ và tên"
                        type="text" value="{{session('user')['name']}}">
                </div>
                <div class="right">
                    <input autocomplete="tel" id="Customer_Phone" name="Customer_Phone" placeholder="Số điện thoại"
                        type="tel" value="{{session('user')['phone']}}">
                </div>
                <input class="homenumber" id="Customer_Email" name="Customer_Email" required placeholder="Email" type="email" value="{{session('user')['email']}}">

                <input class="homenumber" id="Note" name="Note" placeholder="Note more if you want" type="text" value="">
            </div>
            </div>
        @else
            <div class="infouser">
                @if (session()->has('coupon') && $discount != 0)
                <input type="hidden" name="bill_promo" value="{{$discount}}">
                <input type="hidden" name="bill_coupon" value="{{session('coupon')['name']}}">
                @endif
                <input type="hidden" name="totalSum" value="{{$newTotal}}">

            <div class="malefemale">
                <span class="radio-ctnr active mr10" id="radctnr-Male">
                    <input id="Male" name="Customer_Sex" type="radio" value="Anh" checked>
                    <label class="radio" for="Male">
                        <span class="box"></span>
                        <span class="text">Mr</span>
                    </label>
                </span>


                <span class="radio-ctnr  " id="radctnr-Female">
                    <input id="Female" name="Customer_Sex" type="radio" value="Chị">
                    <label class="radio"
                        for="Female">
                        <span class="box"></span>
                        <span class="text">Mrs</span>
                    </label>
                </span>
                <label id="sex-error" class="texterror"></label>
            </div>
            <div class="areainfo">
                <div class="left">
                    <input autocomplete="name" id="Customer_Name" name="Customer_Name" placeholder="Fullname"
                        type="text" value="">
                </div>
                <div class="right">
                    <input autocomplete="tel" id="Customer_Phone" name="Customer_Phone" placeholder="Phone Number"
                        type="tel" value="">
                </div>

                <input class="homenumber" id="Customer_Email" name="Customer_Email" required placeholder="Email" type="email" value="">

                <input class="homenumber" id="Note" name="Note" placeholder="Additional notes if any" type="text" value="">
            </div>
            </div>
        @endif

        <div class="area_other receipt-methods">
            <div class="textnote"><b>CHOOSE ADDRESS</b></div>
            <div class="address hide" style="display: none;">


                <span class="radio-ctnr  active" id="radctnr-Delivery">
                    <input checked="" data-recalc="" id="Delivery" name="ReceiptMethod" type="radio" value="Delivery">
                    <label class="radio" for="Delivery">
                        <span class="box"></span>
                        <span class="text">Giao hàng tận nơi</span>
                    </label>
                </span>
            </div>

            <div class="area_address " style="">
                <div>
                    @if (session('user'))
                        <ul class="listmarket">
                            <li class="choosemarket " data-pro="3" data-dis="16" data-ward="10109" data-ad="test">
                                    <i class="iconcart-check"></i>
                                {{session('user')['address']}}, {{session('user')['prefix_ward']}} {{session('user')['ward']}}, {{session('user')['prefix_district']}} {{session('user')['district']}}, {{session('user')['city']}}
                                    <span class="default">Defaul</span>
                            </li>
                        </ul>
                        <div class="othermore">
                            <span class="otheradd" style="cursor: pointer;">Add new address</span>
                            <label id="addr-chon-error" class="texterror"></label>
                        </div>

                        <div class="firstaddress hide">
                            <div class="citydis">
                                <span class="customer-prov pdr w50 none">
                                    <select style="width: 100%;" class="js-location" id="selectCity" data-type="city" name="Customer_City">
                                        <option value="{{session('user')['city_id']}}" selected>{{session('user')['city']}}</option>
                                        <option value="default">Mời bạn chọn Tỉnh/Thành</option>
                                        @foreach ($cities as $item)
                                            <option value="{{$item->id}}">{{$item->_name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('Customer_City'))
                                        <label id="city-error" class="texterror">{{ $errors->first('Customer_City') }}</label>
                                    @endif
                                    <label id="city-error" class="texterror"></label>
                                </span>
                                <span class="customer-dis w50 none">
                                    <select style="width: 100%;" id="selectDistrict" class="js-location" data-type="district" name="Customer_District">
                                        <option value="{{session('user')['district_id']}}" selected>{{session('user')['prefix_district']}} {{session('user')['district']}}</option>
                                        <option value="default">Mời bạn chọn Quận/Huyện</option>
                                    </select>
                                    @if ($errors->has('Customer_District'))
                                        <label id="district-error" class="texterror">{{ $errors->first('Customer_District') }}</label>
                                    @endif
                                    <label id="district-error" class="texterror"></label>
                                </span>
                                <div class="cod-ward">
                                    <span class="customer-ward pdr w50 none">
                                        <select style="width: 100%;" id="selectWard" data-type="ward" name="Customer_Ward">
                                            <option value="{{session('user')['ward_id']}}" selected>{{session('user')['prefix_ward']}} {{session('user')['ward']}}</option>
                                            <option value="default">Mời bạn chọn Phường/Xã</option>
                                        </select>
                                        @if ($errors->has('Customer_Ward'))
                                        <label id="ward-error" class="texterror">{{ $errors->first('Customer_Ward') }}</label>
                                        @endif
                                        <label id="ward-error" class="texterror"></label>
                                    </span>
                                    <span class="w50">
                                        <input class="homenumber" id="add-cod" name="Customer_Address"
                                            placeholder="Số nhà, tên đường" type="text" required value="{{session('user')['address']}}">
                                        @if ($errors->has('Customer_Address'))
                                            <label id="addr-error" class="texterror">{{ $errors->first('Customer_Address') }}</label>
                                        @endif
                                        <label id="addr-error" class="texterror"></label>
                                    </span>

                                </div>
                                <div class="clr"></div>
                            </div>

                        </div>
                    @else
                    <div class="firstaddress">
                        <div class="citydis">
                            <span class="customer-prov pdr w50 none">
                                <select style="width: 100%;" class="js-location" id="selectCity" data-type="city" name="Customer_City">
                                    <option value="default" selected>Mời bạn chọn Tỉnh/Thành</option>
                                    @foreach ($cities as $item)
                                        <option value="{{$item->id}}">{{$item->_name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('Customer_City'))
                                    <label id="city-error" class="texterror">{{ $errors->first('Customer_City') }}</label>
                                @endif
                                <label id="city-error" class="texterror"></label>
                            </span>
                            <span class="customer-dis w50 none">
                                <select style="width: 100%;" id="selectDistrict" class="js-location" data-type="district" name="Customer_District">
                                    <option value="default" selected>Mời bạn chọn Quận/Huyện</option>
                                </select>
                                @if ($errors->has('Customer_District'))
                                    <label id="district-error" class="texterror">{{ $errors->first('Customer_District') }}</label>
                                @endif
                                <label id="district-error" class="texterror"></label>
                            </span>
                            <div class="cod-ward">
                                <span class="customer-ward pdr w50 none">
                                    <select style="width: 100%;" id="selectWard" data-type="ward" name="Customer_Ward">
                                        <option value="default" selected>Mời bạn chọn Phường/Xã</option>
                                    </select>
                                    @if ($errors->has('Customer_Ward'))
                                    <label id="ward-error" class="texterror">{{ $errors->first('Customer_Ward') }}</label>
                                    @endif
                                    <label id="ward-error" class="texterror"></label>
                                </span>
                                <span class="w50">
                                    <input class="homenumber" id="add-cod" name="Customer_Address"
                                        placeholder="Số nhà, tên đường" type="text" required>
                                    @if ($errors->has('Customer_Address'))
                                        <label id="addr-error" class="texterror">{{ $errors->first('Customer_Address') }}</label>
                                    @endif
                                    <label id="addr-error" class="texterror"></label>
                                </span>

                            </div>
                            <div class="clr"></div>
                        </div>

                    </div>
                    @endif



                    <div class="codnote hide"></div>
                    <div class="cod-area">

                    </div>
                    <div class="delivery-time">
                        <div class="timeship">SELECT A PAYMENT METHOD</div>
                        <div class="timeblock onegroup" data-idx="0" data-val="True" data-is2002="False" data-store="50"
                            data-vehicle="2">
                            <div class="citydis">
                                <span class="radio-ctnr mr10 w50" id="radctnr-shipCOD">
                                    <input id="shipCOD" name="paymentMethod" type="radio" value="COD" checked>
                                    <label class="radio" for="shipCOD">
                                            <div class="method">
                                                <span class="text">Payment on delivery</span>
                                                <span class="box"></span>
                                            </div>
                                        </label>
                                    </span>

                                    <span class="radio-ctnr w50" id="radctnr-banking">
                                    <input id="banking" name="paymentMethod" type="radio" value="Banking">
                                    <label class="radio" for="banking">
                                        <div class="method method-banking">
                                            <span class="text">VIB Transfer</span>
                                            <span class="box"></span>
                                        </div>
                                            <div class="info-banking">
                                                <p>Account number: 333636939</p>
                                                <p>Account name: VO HOANG THANH LONG</p>
                                                <p>Note : Product name and your phone number</p>
                                            </div>
                                            {{-- <div>
                                                <form action={{ url('/vnpay_payment') }} method="POST">
                                                    <button type="submit" name="redirect" class="primary-btn checkout-btn" style="width:100%">Payment method by VNPAY </button>
                                                </form>
                                            </div> --}}
                                    </label>
                                    </span>
                            </div>
                        </div>
                    </div>

                    <div class="customer-receive">
                        <label class="receiver-button"><i class="iconnoti iconcheckbox"></i> Call someone else to receive it
                            products (if any)</label>
                        <div class="infouser">
                            <input id="IsCustomerReveice" name="IsCustomerReveice" type="hidden" value="false">
                            <div class="malefemale">
                                <span class="radio-ctnr hide " id="radctnr-GenderUndefined">
                                    <input id="GenderUndefined" name="CustomerReceive_Sex" type="radio" value="GenderUndefined" checked>
                                    <label class="radio" for="GenderUndefined">
                                            <span class="box"></span>
                                            <span class="text">You</span>
                                    </label>
                                </span>


                                <span class="radio-ctnr mr10 " id="radctnr-GenderMale">
                                <input id="GenderMale" name="CustomerReceive_Sex" type="radio" value="Anh">
                                <label class="radio" for="GenderMale">
                                        <span class="box"></span>
                                        <span class="text">Mr</span>
                                    </label>
                                </span>

                                <span class="radio-ctnr  " id="radctnr-GenderFemale">
                                <input id="GenderFemale" name="CustomerReceive_Sex" type="radio" value="Chị">
                                <label class="radio" for="GenderFemale">
                                        <span class="box"></span>
                                        <span class="text">Mrs</span>
                                    </label>
                                </span>
                                            <label id="receiver-sex-error" class="texterror"></label>
                                        </div>
                            <div class="areainfo">
                                <div class="left">
                                    <input autocomplete="name" id="CustomerReceive_Name" name="CustomerReceive_Name"
                                        placeholder="Fullname" type="text" required>
                                    <label id="receiver-name-error" class="texterror"></label>
                                </div>
                                <div class="right">
                                    <input autocomplete="tel" id="CustomerReceive_Phone" name="CustomerReceive_Phone"
                                        placeholder="Phone number" type="tel" required>
                                    <label id="receiver-phone-error" class="texterror"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="needstaffsp hide"></div>

                    <div class="notebyclient hide"></div>


                </div>
            </div>
            <div class="billvat ">
                <label class="vat"><i class="iconnoti iconcheckbox"></i> Maintaining</label>
                <div class="infocompany">
                    <input id="Customer_CompanyName" maxlength="255" name="Customer_CompanyName"
                        placeholder="test1" type="text" value="">
                    <label id="comname-error" class="texterror">{{ $errors->first('Customer_CompanyName') }}</label>
                    <input id="Customer_CompanyAddress" maxlength="255" name="Customer_CompanyAddress"
                        placeholder="test2" type="text" value="">
                    <label id="comaddress-error" class="texterror">{{ $errors->first('Customer_CompanyAddress') }}</label>
                    <input id="Customer_CompanyTax" name="Customer_CompanyTax" placeholder="test3" type="text"
                        value="">
                    <label id="comtax-error" class="texterror">{{ $errors->first('Customer_CompanyTax') }}</label>
                </div>
            </div>
            <div class="clr"></div>
            <div class="loading-zone">
                <span class="cswrap">
                    <span class="csdot"></span>
                    <span class="csdot"></span>
                    <span class="csdot"></span>
                </span>
            </div>
        </div>
        <div class="paycod hide"></div>

        <div class="cod-order normal">
            <button style="border: 0; cursor: pointer;" type="submit" id="btnOrder" class="payoffline choosepayment">
                Order
            </button>
        </div>

        <div class="clr"></div>

        <div class="clr"></div>
        <div class="loading-cart">
            <span class="cswrap">
                <span class="csdot"></span>
                <span class="csdot"></span>
                <span class="csdot"></span>
            </span>
        </div>
        <div class="ovl"></div>
        {{-- <div class="alert">
            <div class="notify">
                <i class="iconnoti iconclose"></i>
                <div class="content"></div>
            </div>
            <div class="clr"></div>
        </div>
        <div class="popup-vat">
            <div class="head-vat">Thông tin xuất hóa đơn công ty
                <a href="javascript:void(0);">×</a>
            </div>
            <div class="vat-info">
                <div id="vatname">Tên công ty: <b></b></div>
                <div id="vatadd">Địa chỉ: <b></b></div>
                <div id="vattax">Mã số thuế: <b></b></div>
                <div class="msg">Thông tin hóa đơn sẽ không thể thay đổi sau khi hoàn tất đơn hàng.</div>
                <div class="button">
                    <a href="javascript:void(0);" class="cancel">Thay đổi</a>
                    <a href="javascript:void(0);" class="confirm">Xác nhận</a>
                </div>
            </div>
        </div> --}}
        </div>
        <p class="provision">By placing an order, you agree to the <a href="/dieu-khoan-su-dung" target="_blank">Rules use</a> of LONGSHOP</p>
        </form>
    </section>

<script>
    $(document).ready(function() {
        $('.js-location').change(function(e) {
            $('.loading-cart').css('display', 'block');
            e.preventDefault();
            let route = '{{route('getLocation')}}';
            let type = $(this).attr('data-type');
            let parentId = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: route,
                data: {
                    type: type,
                    parent: parentId
                },
                success: function(response) {
                    if(response.data){
                        let html = '';
                        let element = '';
                        if(type == 'city'){
                            html = "<option>Mời bạn chọn Quận/Huyện</option>";
                            element = '#selectDistrict';
                        }
                        else {
                            html = "<option>Mời bạn chọn Phường/Xã</option>";
                            element = '#selectWard';
                        }

                        $.each(response.data, function(idx, val){
                            html += "<option value='"+val.id+"'>"+val._prefix+" "+val._name+"</option>";
                        });

                        $(element).html('').append(html);
                        $('.loading-cart').css('display', 'none');
                    }
                }
            });
        });

        // $.datepicker.regional["vi-VN"] =
        // {
        //     closeText: "Đóng",
        //     prevText: "Trước",
        //     nextText: "Sau",
        //     currentText: "Hôm nay",
        //     monthNames: ["Tháng một", "Tháng hai", "Tháng ba", "Tháng tư", "Tháng năm", "Tháng sáu", "Tháng bảy", "Tháng tám", "Tháng chín", "Tháng mười", "Tháng mười một", "Tháng mười hai"],
        //     monthNamesShort: ["Một", "Hai", "Ba", "Bốn", "Năm", "Sáu", "Bảy", "Tám", "Chín", "Mười", "Mười một", "Mười hai"],
        //     dayNames: ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"],
        //     dayNamesShort: ["CN", "Hai", "Ba", "Tư", "Năm", "Sáu", "Bảy"],
        //     dayNamesMin: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
        //     weekHeader: "Tuần",
        //     firstDay: 1,
        //     isRTL: false,
        //     showMonthAfterYear: false,
        //     yearSuffix: ""
        // };

        // $.datepicker.setDefaults($.datepicker.regional["vi-VN"]);

        // $('.deli-date input').datepicker({
        //     dateFormat: "DD, dd MM",
        //     minDate : 0,
        // });

        // var day = "<?php echo $day ?>";
        // var hour = "<?php echo $hour ?>"

        // $('.deli-date input').change(function () {
        //     var a = $('.deli-date input').val();
        //     if(a.indexOf(day) >= 0){
        //         if(hour >= 12) {
        //             $("#timeblock0 option[value='12']").remove();
        //         }
        //         if(hour >= 14) {
        //             $("#timeblock0 option[value='14']").remove();
        //         }
        //         if(hour >= 16) {
        //             $("#timeblock0 option[value='16']").remove();
        //         }
        //         if(hour >= 22) {
        //             $("#timeblock0 option[value='22']").remove();
        //             $("#timeblock0").append("<option value='0'>Quý khách lòng chọn ngày khác</option>");
        //         }
        //     } else {
        //         $('#timeblock0  option').each(function(){
        //             $(this).remove();
        //         });

        //         $('#timeblock0').append("<option value='12'>10h00 - 12h00</option>");
        //         $('#timeblock0').append("<option value='14'>12h00 - 14h00</option>");
        //         $('#timeblock0').append("<option value='16'>14h00 - 16h00</option>");
        //         $('#timeblock0').append("<option value='22'>20h00 - 22h00</option>");

        //     }
        // })

        // var today = new Date();
        // var tomorrow = new Date(today);
        // var thedayafter = new Date(tomorrow);
        // var dd = String(today.getDate()).padStart(2, '0');
        // var dd1 = String(tomorrow.getDate()+1).padStart(2, '0');
        // var dd2 = String(thedayafter.getDate()+2).padStart(2, '0');

        // var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        // var mm1 = String(tomorrow.getMonth() + 1).padStart(2, '0'); //January is 0!
        // var mm2 = String(thedayafter.getMonth() + 1).padStart(2, '0'); //January is 0!

        // var dateOption = "<option value='"+dd+"'>Hôm nay "+(dd + '/' + mm)+"</option>"+
        //                  "<option value='"+dd1+"'>Hôm nay "+(dd1 + '/' + mm1)+"</option>"+
        //                  "<option value='"+dd2+"'>Hôm nay "+(dd2 + '/' + mm2)+"</option>";
        // $("#dateblock0").html('').append(dateOption);
    })

</script>

@endsection




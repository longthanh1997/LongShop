<?php
    use App\Http\Controllers\SanphamController;
?>

@extends('layouts.master')
@section('meta')
<link href="{{asset('/public/admin/img/logo/logo.jpg')}}" type="image/png" />
    <title>Lịch sử đặt hàng - LONGSHOP</title>
    <meta NAME="ROBOTS" CONTENT="index,follow" />
    <meta name="title" content="LONGSHOP" />
    <meta name="description" content="LONGSHOP" />
    <meta property="og:image" content="{{asset('/public/admin/img/logo/logo.jpg')}}" />
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1024">
    <meta property="og:image:height" content="1024">
@endsection
@section('content')

    <section class="wrapper">
        <div class="container">
            <div class="right">


                <div class="user" data-customer="1019761405">
                    Chào
                    <b>{{$infoUser->name}}</b> - <b>{{$infoUser->phone}}</b>
                    <a href="/lich-su-mua-hang/dang-xuat" class="logout-h">Log out of your account</a>
                </div>
                <div id="overbackgroud"></div>

                <div class="result"></div>

                <div class="detail" id="detail_order">


                    <div class="title">
                        <span>
                            Status:
                            <i>Confirmed</i>
                        </span>
                        <p>Order details #{{$bill->id}}</p>
                        <small>Buy at LONGSHOP</small>
                    </div>
                    {{-- LAY TEN SAN PHAM --}}
                    @foreach ($billDetails as $detail)
                    @php
                        $product = DB::table('product')->where('id',$detail->id_ofproduct)->first();
                        $product_img = DB::table('product_image')->where('id',$product->product_avatar)->value('product_image');
                        $product_price = DB::table('product_price')->where('id',$product->product_price)->first();
                        $sanphamController = new SanphamController();
                    @endphp
                    <div class="item">
                        <a href="{{$sanphamController->getLinkProduct($detail->id_ofproduct)}}" class="fl">
                            <img src="{{asset($product_img)}}">
                        </a>
                        <div class="fl" data-apply="">
                            <a href="{{$sanphamController->getLinkProduct($detail->id_ofproduct)}}">{{$product->product_name}}</a>
                            <i>Color: <b>Silver</b></i>
                            <i>Quantity: <b>{{$detail->SL}}</b></i>
                        </div>
                        <div class="fr">
                            <b>{{number_format($product_price->price_regular, "0", ",", ".")}}$</b>
                            @if($product_price->price_promotion)
                            @php
                                $price_discount = $product_price->price_regular - $product_price->price_promotion;
                            @endphp
                            <em>{{number_format($product_price->price_promotion, "0", ",", ".")}}$</em>
                            @endif
                        </div>
                    </div>

                    @endforeach
                    <div class="sum">
                        <span><label>Total:</label> <i>{{number_format($bill->bill_total, "0", ",", ".")}}$</i></span>
                        @if($price_discount)
                        @php
                            $price_pay = $bill->bill_total - $price_discount;
                        @endphp
                            <span><label>Discounted:</label> <i>-{{number_format($price_discount, "0", ",", ".")}}$</i></span>
                            <span><strong>You need to pay:</strong> <b>{{number_format($price_pay, "0", ",", ".")}}$</b></span>
                        @else
                            <span><strong>You need to pay:</strong> <b>{{number_format($bill->bill_total, "0", ",", ".")}}$</b></span>
                        @endif
                    </div>


                    <div class="info type0">
                        <b>Địa chỉ và thông tin người nhận hàng:</b>
                        @if ($infoUser->nguoinhan_name != NULL && $infoUser->nguoinhan_phone)
                            <span class="receiver">{{$infoUser->nguoinhan_name}} - {{$infoUser->nguoinhan_phone}}</span>
                        @else
                            <span class="receiver">{{$infoUser->name}} - {{$infoUser->phone}}</span>
                        @endif
                        <a style="cursor:pointer;" class="contact">Thay đổi người nhận hàng</a>
                        <form id="frmContact" action="{{route('history.update')}}" method="POST" style="display: none;">
                            @csrf
                            <span data-val="1"><i></i>Anh</span>
                            <span data-val="0"><i></i>Chị</span>
                            <div class="texterror" id="sex_error"></div>
                            <br>
                            <div class="name_field">
                                <input type="text" name="txtFullName" placeholder="Tên người nhận">
                            </div>
                            <div class="phone_field">
                                <input type="tel" name="txtPhoneNumber" placeholder="Số điện thoại" maxlength="10">
                            </div>
                            <input type="hidden" name="hdGender" value="-1">
                            <input type="hidden" name="orderId" value="{{$bill->id}}">
                            <button type="submit">Cập nhật</button>
                        </form>
                        <span>Địa chỉ nhận hàng: {{$infoUser->address}}</span>

                        <span>Thời gian nhận hàng: {{$infoUser->time_nhan_hang}}</span>
                    </div>
                    <div class="pay">

                        <a style="cursor:pointer;" class="cancel">Hủy đơn hàng</a>

                        <a href="{{route('history.index')}}" class="back">Quay lại danh sách đơn hàng</a>
                    </div>


                </div>
            </div>
        </div>
    </section>


    <div id="dlding" style="display: none;">
        <div>
            <span class="csdot"></span>
            <span class="csdot"></span>
            <span class="csdot"></span>
        </div>
    </div>

    <div class="pop-delete order" style="display: none;">
        <div class="reason-cancel">
            <i class="icon-close" onclick="PopupClose()"></i>
            <b>HỦY ĐƠN HÀNG</b>
            <p>Dienmaynhanngoc.com mong nhận được sự góp ý của anh để phục vụ được tốt hơn.</p>
            <div class="note-reason">
                <label class="cancel">
                    <a href="javascript:;" onclick="ChooseReasonCancel()"><i class="iconcheck"></i>Đổi ý, không mua nữa</a>
                </label><br><br>

                <label class="findanother">
                    <a href="javascript:;" onclick="ChooseReasonCancel()"><i class="iconcheck"></i>Tìm thấy giá rẻ hơn ở chỗ khác</a>
                </label><br><br>

                <label class="changeproduct">
                    <a href="javascript:;" onclick="ChooseReasonCancel()"><i class="iconcheck"></i>Muốn thay đổi sản phẩm trong đơn hàng (màu sắc, số lượng,...)</a>
                </label><br><br>

                <label class="other">
                    <a href="javascript:;" onclick="ChooseReasonCancel()"><i class="iconcheck"></i>Lý do khác</a>
                </label>

            </div>
            <div class="content-reason hide">
                <textarea id="txtEditorReason" class="txtEditor" placeholder="Nhập lý do khác..."></textarea>
            </div>
            <a href="javascript:;" onclick="PopupClose()" class="fl">ĐÓNG</a>
            <a href="javascript:;" onclick="AddressDelete(-1)" class="fr">XÁC NHẬN HỦY</a>
            <em>Lưu ý: Quà khuyến mãi có thể thay đổi theo thời điểm đặt hàng</em>
        </div>
    </div>

    <script>
        $("a.contact").click(function(){
            $("#frmContact").slideToggle()
        });

        $('#frmContact span').first().click(function(){
            $(this).addClass('active');
            $("#frmContact span:eq(1)").removeClass('active');
            $("input[name='hdGender']").val($(this).data('val'));
        })

        $("#frmContact span:eq(1)").click(function(){
            $(this).addClass('active');
            $('#frmContact span').first().removeClass('active');
            $("input[name='hdGender']").val($(this).data('val'));
        })

        $('a.cancel').click(function(){
            $('.pop-delete.order').css('display','block');
        });

        function PopupClose(){
            $('.pop-delete.order').css('display','none');
        }

        function ChooseReasonCancel(){
            $(".note-reason label").click(function(){
                if($(this).hasClass("check"))
                return!1;
                $("#txtEditorReason").val("");
                $(".note-reason label.check").removeClass("check");
                $(this).addClass("check");
                $(this).hasClass("other")?($(".content-reason.hide").removeClass("hide"),$(".reason-cancel").addClass("otherReason")):($(".content-reason").addClass("hide"),$(".reason-cancel").removeClass("otherReason")
            )}
        )}

    </script>
@endsection

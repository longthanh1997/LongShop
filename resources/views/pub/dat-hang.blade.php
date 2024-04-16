<?php
    use App\Http\Controllers\SanphamController;
?>

@extends('layouts.master')
@section('meta')
<link href="{{asset('/public/admin/img/logo/logo.jpg')}}" type="image/png" />
    <title>Ordering - LONGSHOP</title>
    <meta NAME="ROBOTS" CONTENT="index,follow" />
    <meta name="title" content="LONGSHOP" />
    <meta name="description" content="LONGSHOP" />
    <meta property="og:image" content="{{asset('/public/admin/img/logo/logo.jpg')}}" />
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1024">
    <meta property="og:image:height" content="1024">
@endsection
@section('content')

<style>
    .main-navigation-left.hidden-xs.hidden-sm.hidden-md, .main-navigation-right.hidden-xs.hidden-sm.hidden-md, ul.megamenu {
        display: none;
    }
</style>
<section class="done  ">
    <div class="container">

        <div class="order-result">
            <div class="picsuccess   ">

                <div class="notistatus notistatus2" id="titleFirstSuccess"><i
                        class="iconnoti iconsuccess"></i><span>Order success</span></div>
            </div>

            <div class="clr"></div>
            <div class="clr"></div>

            <div class="thank">
                thanks <b>{{ $infoUser->name }}</b> gave Longshop the opportunity to serve.

                <span>In 15 minutes, Longshop staff will<b>call directly or message to confirm delivery of item(s)</b> for <span
                        style="text-transform: lowercase;">
                        @if (substr($infoUser->name, 0, 3) == "Anh")
                            Mr.
                        @else
                            Mrs.
                        @endif
                    </span>
                </span>
            </div>
            <div class="infoorder">
                <div class="redirect-lsmh">
                    <span>ORDER #{{ $bill->id }}</span>
                    <a href="{{route('history.login')}}">Quản lý đơn hàng</a>
                </div>
                <p class="infoorderNote">THÔNG TIN ĐẶT HÀNG</p>
                @if (!$infoUser->nguoinhan_name && !$infoUser->nguoinhan_phone)
                    <div>
                        <b>Người nhận hàng:</b> {{$infoUser->name}},
                        {{$infoUser->phone}}</div>
                @else
                    <div>
                        <b>Người đặt hàng:</b> {{ $infoUser->name }},
                        {{ $infoUser->phone }}</div>
                    <div>
                        <b>Người nhận:</b> {{$infoUser->nguoinhan_name}}, {{$infoUser->nguoinhan_phone}}</div>
                @endif
                    <div>
                    <b>Giao đến:</b> {{ $infoUser->address }}.
                    <span>(Staff will call to confirm before delivery)</span>
                </div>
                <div>
                    <b>Total :</b>
                    <strong>{{ number_format($bill->bill_total, '0', ',', '.') }}$</strong> <b>(Shipping fee not included)</b>
                </div>
                {{-- <div><b>Cần thanh toán trước phí chuyển hàng:</b>
                    <strong>40$</strong> trước <b>14:27 ngày
                        08/10</b> <span>(Không hoàn phí chuyển hàng)</span></div> --}}
                @if ($infoUser->note != null)
                    <div><b>Yêu cầu khác:</b> {{ $infoUser->note }}</div>
                @endif
                <aside class="group_delivery">
                    <div>
                        <b>Phương thức thanh toán:</b>
                    </div>
                    @if ($infoUser->payment_method == 'COD')
                        <p class="turn_delivery" style="color: #288ad6; font-size: 1.3em;"><b> Thanh toán khi nhận hàng.</b></p>
                    @else
                        <p class="turn_delivery" style="color: #288ad6; font-size: 1.3em;"><b> VIB ONLINE TRANSFER.</b></p>
                    @endif
                </aside>

            </div>
            @if ($infoUser->hoadondo_company)
                <div class="cty">
                    <div><b>Thông tin xuất hóa đơn:</b></div>
                        <div>Công ty {{ $infoUser->hoadondo_company }}</div>
                    <div>Địa chỉ: {{ $infoUser->hoadondo_address }}</div>
                    <div>Mã số thuế: {{ $infoUser->hoadondo_mst }}</div>
                </div>
            @endif

            <div id="paymentMethodResult" class="paymentMethodResult">
                <div class="paymentMethodResultContainer">
                    <p></p>
                </div>
            </div>

            <div id="paymentMethod" class="paymentMethod">
                {{-- <p class="paymentMethodTitle">Chọn hình thức thanh toán phí chuyển hàng:</p>
                <div class="paymentMethodContainer">
                    <button class="paymentMethodButton blue haft">Thanh toán tại siêu thị <br /> gần nhất</button>
                    <button class="paymentMethodButton blue haft">
                        <div class="paymentMethodButtonContainer">
                            <span>Thanh toán thẻ</span><i class="paymentMethodIcon paymentMethodIconATM"></i>
                            <p class="paymentMethodNoteATM">(Có Internet Banking)</p>
                        </div>
                    </button>
                    <button class="paymentMethodButton blue haft">
                        Thanh toán thẻ
                        <p><i class="paymentMethodIcon paymentMethodIconCredit"></i></p>
                    </button>
                    <button class="paymentMethodButton blue haft">
                        <span>
                            Thanh toán qua <b>QR Code</b>
                            <i class="paymentMethodIcon paymentMethodIconQRCode"></i>
                        </span>
                    </button>
                </div> --}}
                <div class="paymentMethodButton link full cancel">
                    <a style="color: #288ad6;" data-toggle="modal" data-target="#alertPaymentMethodDelete">Hủy đơn hàng</a>
                    <!-- Modal -->
                    <div class="modal fade" style="opacity: 1;" id="alertPaymentMethodDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document" style="justify-content: center; top: 40vh;">
                        <div class="modal-content" style="width: 320px; margin: 0 auto;">
                            <main>
                                <h3>HỦY ĐƠN HÀNG</h3>
                                <p>Bạn có chắc muốn hủy đơn hàng này?</p>
                                <p class="noteLuuY">Lưu ý: Giá và khuyến mãi có thể thay đổi tùy theo thời gian đặt hàng</p>
                                <div>
                                    <a data-dismiss="modal">ĐÓNG</a>
                                    <a class="btnConfirm" href="{{route('checkout.destroy')}}">XÁC NHẬN<br>HỦY ĐƠN HÀNG</a>
                                </div>
                            </main>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="alertPaymentMethod">
                <main>
                    <h3></h3>
                    <p></p>
                    <a href="javascript:void(0)" onclick="toggleAlertPaymentMethod()">CLOSE</a>
                    <span style="display: none">Tự động đóng trong <b>5</b> giây</span>
                </main>
            </div>

            <div class="callship">

                <span>Khi cần trợ giúp vui lòng gọi <a href="tel:1900633940">0934768904</a> (7h30 - 22h)</span>
                <div class="block">
                    <a href="javascript:void(0)" onclick="togglePopupChinhSachOnline()" id="chinhsachOL">Xem chính
                        sách hoàn tiền Online</a>
                </div>
                <div id="popupChinhSachOnline">
                    <div class="popupChinhSachOnlineContainer">
                        <div class="popupChinhSachOnlineHeader">
                            <p><strong>Chính sách hoàn tiền khi thanh toán Online</strong></p>
                            <a href="javascript:void(0)" onclick="togglePopupChinhSachOnline()">✖ Đóng</a>
                        </div>
                        <div>
                            <p>Trong trường hợp quý khách hàng đã mua hàng & thanh toán trực tuyến thành công nhưng
                                dư tiền, hoặc trả sản phẩm, LONGSHOP sẽ hoàn tiền vào thẻ quý khách đã dùng để
                                thanh toán, theo thời hạn như sau:</p>
                            <p>
                                - Đối với thẻ ATM: Thời gian khách hàng nhận được tiền hoàn từ 7-10 ngày (trừ thứ 7,
                                chủ nhật và ngày lễ). Nếu qua thời gian trên không nhận được tiền, LONGSHOP sẽ
                                hỗ trợ liên hệ ngân hàng của khách hàng để giải quyết.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <img height="1" width="1" alt="" style="display: none"
                src="https://www.googleadservices.com/pagead/conversion/1003365737/?value=499000.00&amp;currency_code=USD&amp;label=S4dsCO_34wIQ6cq43gM&amp;guid=ON&amp;script=0" />
            <img height="1" width="1" alt="" style="display: none"
                src="https://www.facebook.com/tr?ev=6029848414282&amp;cd[value]=499000.00&amp;cd[currency]=USD&amp;noscript=1" />
        </div>

        <div class="loading-cart" style="display: none;">
            <span class="cswrap">
                <span class="csdot"></span>
                <span class="csdot"></span>
                <span class="csdot"></span>
            </span>
        </div>
        <div class="titlebill">Sản phẩm đã mua:</div>
        <h2 class="title_head_product">Danh sách sản phẩm</h2>
        <ul class="listorder" id="product-list">
            @foreach ($billDetails as $item)
                @php
                    $product = DB::table('product')
                                ->where('id', $item->id_ofproduct)
                                ->first();
                    $product_price = DB::table('product_price')->where('id', $product->product_price)->first();
                    $product_img = DB::table('product_image')->where('id',$product->product_avatar)->value('product_image');
                    $sanphamController = new SanphamController();
                @endphp
                <li>
                    <div class="colimg">
                        <a href="{{$sanphamController->getLinkProduct($item->id_ofproduct)}}" target="_blank">
                            <img width="55"
                                height="55" src="{{ asset($product_img) }}"
                                alt="{{$product->product_name}}">
                        </a>
                    </div>
                    <div class="colinfo">
                        @if ($product_price->price_promotion)
                            <strong class="price-color">
                                <span>{{ number_format($product_price->price_regular, '0', ',', '.') }}$</span>
                                {{ number_format($product_price->price_promotion, '0', ',', '.') }}$
                            </strong>
                        @else
                            <strong class="price-color">
                                {{ number_format($product_price->price_regular, '0', ',', '.') }}$
                            </strong>
                        @endif

                        <a href="{{$sanphamController->getLinkProduct($item->id_ofproduct)}}" target="_blank">{{$product->product_name}}</a>
                        <div class="promotion newpro many">
                            <div class="title">
                                <label>Detail </label>
                            </div>
                            {!!$product->product_offer!!}
                        </div>
                        <div class="clr"></div>
                        <div class="onecolor"><span>Color:</span> Silver</div>

                        <div class="quan">
                            <span>Quantity:</span> {{ $item->SL }}
                        </div>

                        <div class="clr"></div>
                    </div>
                    <div class="clr"></div>
                </li>
            @endforeach
        </ul>

        <div class="clr"></div>
        {{-- <div class="cod-result">
            <p><span>Phí chuyển hàng:</span><b>+39$</b></p>
            <br />
            <p class="total-cod"><span>Tổng tiền:</span><b>{{ number_format($bill->bill_total, '0', ',', '.') }}$</b></p>
        </div> --}}
        <div class="clr"></div>
        <div class="clr"></div>

        <div class="buymoresuccinst">
            <a href="{{route('checkout.muaThem')}}"><span>❮</span>Buy more products</a>
        </div>

        <div class="clr"></div>
    </div>
    <div class="clr"></div>

    <p class="provision">By placing an order, you agree to the <a href="/dieu-khoan-su-dung" target="_blank">Rules use</a> of LONGSHOP</p>
</section>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        $('.promotion').click(function () {
            $(".title",this).css('display', 'none');
            $(".promo",this).css('display', 'block');
        });
    });
</script>
@endsection

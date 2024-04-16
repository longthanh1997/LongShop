<?php
use App\Http\Controllers\SanphamController;
$sanphamController = new SanphamController();

?>
@extends('layouts.master')
@section('meta')
<link href="{{asset('/public/admin/img/logo/logo.jpg')}}" type="image/png" />
    <title>Homepage - LONGSHOP</title>
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
    .no-pad{
        padding-left: 5px !important;
        padding-right: 5px !important;
    }

    .row.row-product {
        background: #f3f5f7;
    }

    .paddacbiet .block-cate {
        padding-top: 27px !important;
    }

    div#wrapper {
    background-image: url({{URL::to('/public/upload/BACKGROUND-VANGF.png')}});
    background-repeat: no-repeat;
    background-position: bottom;
    background-attachment: fixed;
        background-color: #fff8c9;
}

.menu-mobile .block-menu-cate .block-cate {
    background: url({{URL::to('public/upload/KHONGHOT.png')}});
    text-align: center;
    color: #fff;
    font-weight: 700;
    border-radius: 5px;
    background-size: cover;
    height: 77px;
}

.menu-mobile .block-menu-cate .veryhot {
    background: url({{URL::to('public/upload/HOT.png')}});
    text-align: center;
    color: #fff;
    font-weight: 700;
    border-radius: 5px;
    background-size: cover;
    height: 77px;
}

@media only screen and (max-width: 350px) {
    .block-cate.veryhot, .block-cate {
        min-height: 50px !important;
        height: 63px !important;
        margin: 1px !important;
        padding-top: 15px !important;
        font-size: 10px;
    }
}
    @media only screen and (min-width: 769px){
        .product-box {
            min-height: 385px;
            height: 385px;
        }

        .giasocvl .product-box {
            min-height: 450px;
        }

        .product-box .giaonline {
            padding: 0px 8px 0px 0px;
        }

        .product-grid6.product-box:hover {
            box-shadow: 0 4px 10px 0 rgba(196,196,196,.2);
            transform: translateY(-14px)!important;
        }
    }

    @media only screen and (max-width: 769px) {
        .product-box .giaonline {
            height: 35px;
            font-size: unset;
            padding: 2px 8px 0px 0px !important;
        }

        .product-grid6 .product-content {
            padding: 5px 5px 0px 5px;
        }

        .product-grid6 {
            margin-bottom: 3px;
            min-height: 300px;
            height: 300px;
        }

        .giasocvl .product-grid6 {
            height: 335px;
        }

        .giamthem {
            padding-left: 5px;
        }
    }
</style>




  <?php
                    $popup = DB::table('banner')->where('location', 12)->first();
            ?>

            @if($popup != null)
<div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content1">
        {{-- <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Thông báo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> --}}
        <div class="modal-body">

<img src="{{asset(DB::table('product_image')->where('id',$popup->image)->value('product_image'))}}" />

        </div>
        <!--<div class="modal-footer">-->
        <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>-->
        <!--</div>-->
      </div>
    </div>
  </div>
@endif
<div id="content" class="home">
    <div class="content-top-w row">
        <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12 main-left no-pad">
                <div class="module col1 hidden-sm hidden-xs"></div>
            </div>
        <div class="main-mid col-lg-10 col-md-12 col-sm-12 col-xs-12 col2 no-pad">
            <div class="fotorama" data-minwidth="100%" data-maxwidth="100%" data-nav="false" data-autoplay="true">
                @foreach($banner_chinh as $val)
                    <img src="{{asset(DB::table('product_image')->where('id',$val->image)->value('product_image'))}}"/>
                @endforeach
            </div>
        </div>
    </div>
    <div class="row menu-mobile hidden-lg hidden-md">
        <div class="col-md-12 col-xs-12 col-sm-12" style="padding: 1px; padding-top: 15px;">
            <div class="row-cate">
                <div class="block-menu-cate col-cus-5 paddacbiet">
                    <div class="block-cate veryhot" onclick="location.href='{{URL::to('/tivi')}}'" style="padding-top: 27px !important;">
                         <span>
                            Tivi
                        </span>
                    </div>
                </div>
                <div class="block-menu-cate col-cus-5 paddacbiet">
                    <div class="block-cate veryhot" onclick="location.href='{{URL::to('/tu-lanh')}}'" style="padding-top: 27px !important;">

                        <span>
                            Tủ lạnh
                        </span>
                    </div>
                </div>
                <div class="block-menu-cate col-cus-5 paddacbiet">
                    <div class="block-cate veryhot" onclick="location.href='{{URL::to('/may-giat')}}'" style="padding-top: 27px !important;">

                        <span>
                            Máy giặt
                        </span>
                    </div>
                </div>
                <div class="block-menu-cate col-cus-5 paddacbiet">
                    <div class="block-cate" onclick="location.href='{{URL::to('/do-dung-gia-dinh')}}'">
                        <span>
                            Gia dụng
                        </span>
                    </div>
                </div>
                <div class="block-menu-cate col-cus-5 paddacbiet">
                    <div class="block-cate" onclick="location.href='{{URL::to('/dien-thoai-laptop-tablet')}}'">
                        <span>
                            Điện thoại
                        </span>
                    </div>
                </div>

            </div>
            <div class="row-cate">
                <div class="block-menu-cate col-cus-5">
                    <div class="block-cate" onclick="location.href='{{URL::to('/tu-dong-tu-mat')}}'">
                        <span>
                            Tủ đông<br/>tủ mát
                        </span>

                    </div>
                </div>
                <div class="block-menu-cate col-cus-5">
                    <div class="block-cate" onclick="location.href='{{URL::to('/may-lanh-quat-dieu-hoa')}}'">
                        <span style="font-size: 8px;">
                            Máy lạnh<br/>quạt điều hoà
                        </span>
                    </div>
                </div>


                <div class="block-menu-cate col-cus-5">
                    <div class="block-cate" onclick="location.href='{{URL::to('/loc-nuoc-cay-nuoc-nong-lanh')}}'">
                        <span>
                            Máy lọc nước
                        </span>
                    </div>
                </div>
                <div class="block-menu-cate col-cus-5">
                    <div class="block-cate" onclick="location.href='{{URL::to('/loa-am-thanh')}}'">
                        <span style="">
                            Loa<br/>Âm thanh
                        </span>
                    </div>
                </div>
                <div class="block-menu-cate col-cus-5">
                    <div class="block-cate" onclick="location.href='{{URL::to('/bai-viet')}}'">
                        <span>
                            Bài viết</br>Tin Tức
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row content-main-w">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            {{-- sale --}}
            <div class="block-product">
                <div class="banner-product row">
                    <div class="col-md-12 col-sm-12 col-xs-12 col-banner-product">

                        <img src="{{asset(DB::table('product_image')->where('id',$banner_sale->image)->value('product_image'))}}"/>
                    </div>
                </div>
                <div class="row row-product">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            @foreach($product_sale as $val)
                            <?php
                                $product_price_temp = DB::table('product_price')->where('id', $val->product_price)->first();
                                $banner_sale_child  = DB::table('banner')->where('location', 14)->first();

                            ?>
                            <div class="col-md-3 col-sm-6 col-xs-6 col-pr giasocvl">
                                <div class="product-grid6 product-box ">
                                    <img src="{{asset(DB::table('product_image')->where('id',$banner_sale_child->image)->value('product_image'))}}"/>
                                    <div class="product-image6 product-image">
                                        <a href="{{URL::to($sanphamController->getLinkProduct($val->id))}}">
                                            <img class="product-avatar-{{$val->id}}" src="{{asset(DB::table('product_image')->where('id', $val->product_avatar)->value('product_image'))}}">
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="title"><a href="{{URL::to($sanphamController->getLinkProduct($val->id))}}">{{$val->product_name}}</a></h3>
                                        <div class="price-new text-left">
                                            @if($product_price_temp->price_promotion != null)
                                                {{number_format($product_price_temp->price_promotion,0,",",".")}}
                                            @else
                                                {{number_format($product_price_temp->price_regular,0,",",".")}}
                                            @endif
                                            </div>
                                        <div class="price text-center">
                                            @if($product_price_temp->price_promotion != null)
                                              <div class="price-old">{{number_format($product_price_temp->price_regular,0,",",".")}}</div>
                                              <div class="price-diff">-{{number_format((100 - ($product_price_temp->price_promotion/$product_price_temp->price_regular*100)),0,",",".")}}%</div>
                                            @endif
                                            @if($product_price_temp->price_installment ==1)
                                                <div class="tag-ins">0% installment payment</div>
                                            @endif
                                        </div>

                                    </div>
                                    @if($product_price_temp->price_online !=null)
                                        <div class="giamthem"><span class="title-giam">Buy online get an additional discount </span><p class="price-giamthem">{{number_format(($product_price_temp->price_promotion - $product_price_temp->price_online),0,",",".")}}  $</p></div>
                                        <div class="giaonline text-right" style='background: url("{{asset('/public/admin/img/img_icon/giaonline.png')}}")'>
                                            <span class="price-online">{{number_format($product_price_temp->price_online,0,",",".")}} $</span>
                                        </div>
                                    @endif

                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div style="width: 100%; text-align: right"><a class="view-all" href="{{URL::to('/sale-soc-trong-ngay')}}">More...</a></div>
                    </div>

                </div>
            </div>
{{-- tivi --}}
            <div class="block-product">
                <div class="banner-product row">
                    <div class="col-md-12 col-sm-12 col-xs-12 col-banner-product">

                        <img src="{{asset(DB::table('product_image')->where('id',$banner_tivi->image)->value('product_image'))}}"/>
                    </div>
                </div>
                <div class="row row-product">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            @foreach($product_tivi as $val)
                            <?php
                                $product_price_temp = DB::table('product_price')->where('id', $val->product_price)->first();
                            ?>
                            <div class="col-md-3 col-sm-6 col-xs-6 col-pr">
                                <div class="product-grid6 product-box ">
                                    <div class="product-image6 product-image">
                                        <a href="{{URL::to($sanphamController->getLinkProduct($val->id))}}">
                                            <img class="product-avatar-{{$val->id}}" src="{{asset(DB::table('product_image')->where('id', $val->product_avatar)->value('product_image'))}}">
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="title"><a href="{{URL::to($sanphamController->getLinkProduct($val->id))}}">{{$val->product_name}}</a></h3>
                                        <div class="price-new text-left">
                                            @if($product_price_temp->price_promotion != null)
                                                {{number_format($product_price_temp->price_promotion,0,",",".")}}
                                            @else
                                                {{number_format($product_price_temp->price_regular,0,",",".")}}
                                            @endif
                                            </div>
                                        <div class="price text-center">
                                            @if($product_price_temp->price_promotion != null)
                                              <div class="price-old">{{number_format($product_price_temp->price_regular,0,",",".")}}</div>
                                              <div class="price-diff">-{{number_format((100 - ($product_price_temp->price_promotion/$product_price_temp->price_regular*100)),0,",",".")}}%</div>
                                            @endif
                                            @if($product_price_temp->price_installment ==1)
                                                <div class="tag-ins">0% installment payment</div>
                                            @endif
                                        </div>
                                    @if($product_price_temp->price_online !=null)
                                        <div class="giamthem"><span class="title-giam">Buy online get an additional discount  </span><p class="price-giamthem">{{number_format(($product_price_temp->price_promotion - $product_price_temp->price_online),0,",",".")}}  $</p></div>
                                        <div class="giaonline text-right" style='background: url("{{asset('/public/admin/img/img_icon/giaonline.png')}}")'>
                                            <span class="price-online">{{number_format($product_price_temp->price_online,0,",",".")}} $</span>
                                        </div>
                                    @endif
                                    </div>

                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div style="width: 100%; text-align: right"><a class="view-all" href="{{URL::to('/tivi')}}">More...</a></div>
                    </div>

                </div>
            </div>
            {{-- maygiat --}}
            <div class="block-product">
                <div class="banner-product row">
                    <div class="col-md-12 col-sm-12 col-xs-12 col-banner-product">

                        <img src="{{asset(DB::table('product_image')->where('id',$banner_maygiat->image)->value('product_image'))}}"/>
                    </div>
                </div>
                <div class="row row-product">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            @foreach($product_maygiat as $val)
                            <?php
                                $product_price_temp = DB::table('product_price')->where('id', $val->product_price)->first();
                            ?>
                            <div class="col-md-3 col-sm-6 col-xs-6 col-pr">
                                <div class="product-grid6 product-box ">
                                    <div class="product-image6 product-image">
                                        <a href="{{URL::to($sanphamController->getLinkProduct($val->id))}}">
                                            <img class="product-avatar-{{$val->id}}" src="{{asset(DB::table('product_image')->where('id', $val->product_avatar)->value('product_image'))}}">
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="title"><a href="{{URL::to($sanphamController->getLinkProduct($val->id))}}">{{$val->product_name}}</a></h3>
                                        <div class="price-new text-left">
                                            @if($product_price_temp->price_promotion != null)
                                                {{number_format($product_price_temp->price_promotion,0,",",".")}}
                                            @else
                                                {{number_format($product_price_temp->price_regular,0,",",".")}}
                                            @endif
                                            </div>
                                        <div class="price text-center">
                                            @if($product_price_temp->price_promotion != null)
                                              <div class="price-old">{{number_format($product_price_temp->price_regular,0,",",".")}}</div>
                                              <div class="price-diff">-{{number_format((100 - ($product_price_temp->price_promotion/$product_price_temp->price_regular*100)),0,",",".")}}%</div>
                                            @endif
                                            @if($product_price_temp->price_installment ==1)
                                                <div class="tag-ins">0% installment payment</div>
                                            @endif
                                        </div>
                                    @if($product_price_temp->price_online !=null)
                                        <div class="giamthem"><span class="title-giam">Buy online get an additional discount  </span><p class="price-giamthem">{{number_format(($product_price_temp->price_promotion - $product_price_temp->price_online),0,",",".")}}  $</p></div>
                                        <div class="giaonline text-right" style='background: url("{{asset('/public/admin/img/img_icon/giaonline.png')}}")'>
                                            <span class="price-online">{{number_format($product_price_temp->price_online,0,",",".")}} $</span>
                                        </div>
                                    @endif
                                    </div>

                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div style="width: 100%; text-align: right"><a class="view-all" href="{{URL::to('/may-giat')}}">More...</a></div>
                    </div>

                </div>
            </div>
{{-- tulanh --}}
            <div class="block-product">
                <div class="banner-product row">
                    <div class="col-md-12 col-sm-12 col-xs-12 col-banner-product">

                        <img src="{{asset(DB::table('product_image')->where('id',$banner_tulanh->image)->value('product_image'))}}"/>
                    </div>
                </div>
                <div class="row row-product">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            @foreach($product_tulanh as $val)
                            <?php
                                $product_price_temp = DB::table('product_price')->where('id', $val->product_price)->first();
                            ?>
                            <div class="col-md-3 col-sm-6 col-xs-6 col-pr">
                                <div class="product-grid6 product-box ">
                                    <div class="product-image6 product-image">
                                        <a href="{{URL::to($sanphamController->getLinkProduct($val->id))}}">
                                            <img class="product-avatar-{{$val->id}}" src="{{asset(DB::table('product_image')->where('id', $val->product_avatar)->value('product_image'))}}">
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="title"><a href="{{URL::to($sanphamController->getLinkProduct($val->id))}}">{{$val->product_name}}</a></h3>
                                        <div class="price-new text-left">
                                            @if($product_price_temp->price_promotion != null)
                                                {{number_format($product_price_temp->price_promotion,0,",",".")}}
                                            @else
                                                {{number_format($product_price_temp->price_regular,0,",",".")}}
                                            @endif
                                            </div>
                                        <div class="price text-center">
                                            @if($product_price_temp->price_promotion != null)
                                              <div class="price-old">{{number_format($product_price_temp->price_regular,0,",",".")}}</div>
                                              <div class="price-diff">-{{number_format((100 - ($product_price_temp->price_promotion/$product_price_temp->price_regular*100)),0,",",".")}}%</div>
                                            @endif
                                            @if($product_price_temp->price_installment ==1)
                                                <div class="tag-ins">0% installment payment</div>
                                            @endif
                                        </div>
                                    @if($product_price_temp->price_online !=null)
                                        <div class="giamthem"><span class="title-giam">Buy online get an additional discount  </span><p class="price-giamthem">{{number_format(($product_price_temp->price_promotion - $product_price_temp->price_online),0,",",".")}}  $</p></div>
                                        <div class="giaonline text-right" style='background: url("{{asset('/public/admin/img/img_icon/giaonline.png')}}")'>
                                            <span class="price-online">{{number_format($product_price_temp->price_online,0,",",".")}} $</span>
                                        </div>
                                    @endif
                                    </div>

                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div style="width: 100%; text-align: right"><a class="view-all" href="{{URL::to('/tu-lanh')}}">More...</a></div>
                    </div>

                </div>
            </div>
{{-- tudong --}}
            <div class="block-product">
                <div class="banner-product row">
                    <div class="col-md-12 col-sm-12 col-xs-12 col-banner-product">

                        <img src="{{asset(DB::table('product_image')->where('id',$banner_tudong->image)->value('product_image'))}}"/>
                    </div>
                </div>
                <div class="row row-product">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            @foreach($product_tudong as $val)
                            <?php
                                $product_price_temp = DB::table('product_price')->where('id', $val->product_price)->first();
                            ?>
                            <div class="col-md-3 col-sm-6 col-xs-6 col-pr">
                                <div class="product-grid6 product-box ">
                                    <div class="product-image6 product-image">
                                        <a href="{{URL::to($sanphamController->getLinkProduct($val->id))}}">
                                            <img class="product-avatar-{{$val->id}}" src="{{asset(DB::table('product_image')->where('id', $val->product_avatar)->value('product_image'))}}">
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="title"><a href="{{URL::to($sanphamController->getLinkProduct($val->id))}}">{{$val->product_name}}</a></h3>
                                        <div class="price-new text-left">
                                            @if($product_price_temp->price_promotion != null)
                                                {{number_format($product_price_temp->price_promotion,0,",",".")}}
                                            @else
                                                {{number_format($product_price_temp->price_regular,0,",",".")}}
                                            @endif
                                            </div>
                                        <div class="price text-center">
                                            @if($product_price_temp->price_promotion != null)
                                              <div class="price-old">{{number_format($product_price_temp->price_regular,0,",",".")}}</div>
                                              <div class="price-diff">-{{number_format((100 - ($product_price_temp->price_promotion/$product_price_temp->price_regular*100)),0,",",".")}}%</div>
                                            @endif
                                            @if($product_price_temp->price_installment ==1)
                                                <div class="tag-ins">0% installment payment</div>
                                            @endif
                                        </div>
                                    @if($product_price_temp->price_online !=null)
                                        <div class="giamthem"><span class="title-giam">Buy online get an additional discount  </span><p class="price-giamthem">{{number_format(($product_price_temp->price_promotion - $product_price_temp->price_online),0,",",".")}}  $</p></div>
                                        <div class="giaonline text-right" style='background: url("{{asset('/public/admin/img/img_icon/giaonline.png')}}")'>
                                            <span class="price-online">{{number_format($product_price_temp->price_online,0,",",".")}} $</span>
                                        </div>
                                    @endif
                                    </div>

                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div style="width: 100%; text-align: right"><a class="view-all" href="{{URL::to('/tu-dong-tu-mat')}}">More...</a></div>
                    </div>

                </div>
            </div>
    {{-- manhlanh --}}
            <div class="block-product">
                <div class="banner-product row">
                    <div class="col-md-12 col-sm-12 col-xs-12 col-banner-product">

                        <img src="{{asset(DB::table('product_image')->where('id',$banner_maylanh->image)->value('product_image'))}}"/>
                    </div>
                </div>
                <div class="row row-product">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            @foreach($product_maylanh as $val)
                            <?php
                                $product_price_temp = DB::table('product_price')->where('id', $val->product_price)->first();
                            ?>
                            <div class="col-md-3 col-sm-6 col-xs-6 col-pr">
                                <div class="product-grid6 product-box ">
                                    <div class="product-image6 product-image">
                                        <a href="{{URL::to($sanphamController->getLinkProduct($val->id))}}">
                                            <img class="product-avatar-{{$val->id}}" src="{{asset(DB::table('product_image')->where('id', $val->product_avatar)->value('product_image'))}}">
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="title"><a href="{{URL::to($sanphamController->getLinkProduct($val->id))}}">{{$val->product_name}}</a></h3>
                                        <div class="price-new text-left">
                                            @if($product_price_temp->price_promotion != null)
                                                {{number_format($product_price_temp->price_promotion,0,",",".")}}
                                            @else
                                                {{number_format($product_price_temp->price_regular,0,",",".")}}
                                            @endif
                                            </div>
                                        <div class="price text-center">
                                            @if($product_price_temp->price_promotion != null)
                                              <div class="price-old">{{number_format($product_price_temp->price_regular,0,",",".")}}</div>
                                              <div class="price-diff">-{{number_format((100 - ($product_price_temp->price_promotion/$product_price_temp->price_regular*100)),0,",",".")}}%</div>
                                            @endif
                                            @if($product_price_temp->price_installment ==1)
                                                <div class="tag-ins">0% installment payment</div>
                                            @endif
                                        </div>
                                    @if($product_price_temp->price_online !=null)
                                        <div class="giamthem"><span class="title-giam">Buy online get an additional discount  </span><p class="price-giamthem">{{number_format(($product_price_temp->price_promotion - $product_price_temp->price_online),0,",",".")}}  $</p></div>
                                        <div class="giaonline text-right" style='background: url("{{asset('/public/admin/img/img_icon/giaonline.png')}}")'>
                                            <span class="price-online">{{number_format($product_price_temp->price_online,0,",",".")}} $</span>
                                        </div>
                                    @endif
                                    </div>

                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div style="width: 100%; text-align: right"><a class="view-all" href="{{URL::to('/may-lanh-quat-dieu-hoa')}}">More...</a></div>
                    </div>

                </div>
            </div>
            {{-- gia dụng --}}
            <div class="block-product">
                <div class="banner-product row">
                    <div class="col-md-12 col-sm-12 col-xs-12 col-banner-product">

                        <img src="{{asset(DB::table('product_image')->where('id',$banner_giadung->image)->value('product_image'))}}"/>
                    </div>
                </div>
                <div class="row row-product">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            @foreach($product_giadung as $val)
                            <?php
                                $product_price_temp = DB::table('product_price')->where('id', $val->product_price)->first();
                            ?>
                            <div class="col-md-3 col-sm-6 col-xs-6 col-pr">
                                <div class="product-grid6 product-box ">
                                    <div class="product-image6 product-image">
                                        <a href="{{URL::to($sanphamController->getLinkProduct($val->id))}}">
                                            <img class="product-avatar-{{$val->id}}" src="{{asset(DB::table('product_image')->where('id', $val->product_avatar)->value('product_image'))}}">
                                        </a>
                                    </div>
                                   <div class="product-content">
                                        <h3 class="title"><a href="{{URL::to($sanphamController->getLinkProduct($val->id))}}">{{$val->product_name}}</a></h3>
                                        <div class="price-new text-left">
                                            @if($product_price_temp->price_promotion != null)
                                                {{number_format($product_price_temp->price_promotion,0,",",".")}}
                                            @else
                                                {{number_format($product_price_temp->price_regular,0,",",".")}}
                                            @endif
                                            </div>
                                        <div class="price text-center">
                                            @if($product_price_temp->price_promotion != null)
                                              <div class="price-old">{{number_format($product_price_temp->price_regular,0,",",".")}}</div>
                                              <div class="price-diff">-{{number_format((100 - ($product_price_temp->price_promotion/$product_price_temp->price_regular*100)),0,",",".")}}%</div>
                                            @endif
                                            @if($product_price_temp->price_installment ==1)
                                                <div class="tag-ins">0% installment payment</div>
                                            @endif
                                        </div>
                                    @if($product_price_temp->price_online !=null)
                                        <div class="giamthem"><span class="title-giam">Buy online get an additional discount  </span><p class="price-giamthem">{{number_format(($product_price_temp->price_promotion - $product_price_temp->price_online),0,",",".")}}  $</p></div>
                                        <div class="giaonline text-right" style='background: url("{{asset('/public/admin/img/img_icon/giaonline.png')}}")'>
                                            <span class="price-online">{{number_format($product_price_temp->price_online,0,",",".")}} $</span>
                                        </div>
                                    @endif
                                    </div>

                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div style="width: 100%; text-align: right"><a class="view-all" href="{{URL::to('/do-dung-gia-dinh')}}">More...</a></div>
                    </div>

                </div>
            </div>
             {{-- lọc nước --}}
            <div class="block-product">
                <div class="banner-product row">
                    <div class="col-md-12 col-sm-12 col-xs-12 col-banner-product">

                        <img src="{{asset(DB::table('product_image')->where('id',$banner_locnuoc->image)->value('product_image'))}}"/>
                    </div>
                </div>
                <div class="row row-product">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            @foreach($product_locnuoc as $val)
                            <?php
                                $product_price_temp = DB::table('product_price')->where('id', $val->product_price)->first();
                            ?>
                            <div class="col-md-3 col-sm-6 col-xs-6 col-pr">
                                <div class="product-grid6 product-box ">
                                    <div class="product-image6 product-image">
                                        <a href="{{URL::to($sanphamController->getLinkProduct($val->id))}}">
                                            <img class="product-avatar-{{$val->id}}" src="{{asset(DB::table('product_image')->where('id', $val->product_avatar)->value('product_image'))}}">
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="title"><a href="{{URL::to($sanphamController->getLinkProduct($val->id))}}">{{$val->product_name}}</a></h3>
                                        <div class="price-new text-left">
                                            @if($product_price_temp->price_promotion != null)
                                                {{number_format($product_price_temp->price_promotion,0,",",".")}}
                                            @else
                                                {{number_format($product_price_temp->price_regular,0,",",".")}}
                                            @endif
                                            </div>
                                        <div class="price text-center">
                                            @if($product_price_temp->price_promotion != null)
                                              <div class="price-old">{{number_format($product_price_temp->price_regular,0,",",".")}}</div>
                                              <div class="price-diff">-{{number_format((100 - ($product_price_temp->price_promotion/$product_price_temp->price_regular*100)),0,",",".")}}%</div>
                                            @endif
                                            @if($product_price_temp->price_installment ==1)
                                                <div class="tag-ins">0% installment payment</div>
                                            @endif
                                        </div>
                                    @if($product_price_temp->price_online !=null)
                                        <div class="giamthem"><span class="title-giam">Buy online get an additional discount  </span><p class="price-giamthem">{{number_format(($product_price_temp->price_promotion - $product_price_temp->price_online),0,",",".")}}  $</p></div>
                                        <div class="giaonline text-right" style='background: url("{{asset('/public/admin/img/img_icon/giaonline.png')}}")'>
                                            <span class="price-online">{{number_format($product_price_temp->price_online,0,",",".")}} $</span>
                                        </div>
                                    @endif
                                    </div>

                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div style="width: 100%; text-align: right"><a class="view-all" href="{{URL::to('/loc-nuoc-cay-nuoc-nong-lanh')}}">More...</a></div>
                    </div>

                </div>
            </div>
             {{-- loa --}}
            <div class="block-product">
                <div class="banner-product row">
                    <div class="col-md-12 col-sm-12 col-xs-12 col-banner-product">

                        <img src="{{asset(DB::table('product_image')->where('id',$banner_loa->image)->value('product_image'))}}"/>
                    </div>
                </div>
                <div class="row row-product">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            @foreach($product_loa as $val)
                            <?php
                                $product_price_temp = DB::table('product_price')->where('id', $val->product_price)->first();
                            ?>
                            <div class="col-md-3 col-sm-6 col-xs-6 col-pr">
                                <div class="product-grid6 product-box ">
                                    <div class="product-image6 product-image">
                                        <a href="{{URL::to($sanphamController->getLinkProduct($val->id))}}">
                                            <img class="product-avatar-{{$val->id}}" src="{{asset(DB::table('product_image')->where('id', $val->product_avatar)->value('product_image'))}}">
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="title"><a href="{{URL::to($sanphamController->getLinkProduct($val->id))}}">{{$val->product_name}}</a></h3>
                                        <div class="price-new text-left">
                                            @if($product_price_temp->price_promotion != null)
                                                {{number_format($product_price_temp->price_promotion,0,",",".")}}
                                            @else
                                                {{number_format($product_price_temp->price_regular,0,",",".")}}
                                            @endif
                                            </div>
                                        <div class="price text-center">
                                            @if($product_price_temp->price_promotion != null)
                                              <div class="price-old">{{number_format($product_price_temp->price_regular,0,",",".")}}</div>
                                              <div class="price-diff">-{{number_format((100 - ($product_price_temp->price_promotion/$product_price_temp->price_regular*100)),0,",",".")}}%</div>
                                            @endif
                                            @if($product_price_temp->price_installment ==1)
                                                <div class="tag-ins">0% installment payment</div>
                                            @endif
                                        </div>
                                    @if($product_price_temp->price_online !=null)
                                        <div class="giamthem"><span class="title-giam">Buy online get an additional discount  </span><p class="price-giamthem">{{number_format(($product_price_temp->price_promotion - $product_price_temp->price_online),0,",",".")}}  $</p></div>
                                        <div class="giaonline text-right" style='background: url("{{asset('/public/admin/img/img_icon/giaonline.png')}}")'>
                                            <span class="price-online">{{number_format($product_price_temp->price_online,0,",",".")}} $</span>
                                        </div>
                                    @endif
                                    </div>

                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div style="width: 100%; text-align: right"><a class="view-all" href="{{URL::to('/loa-am-thanh')}}">More...</a></div>
                    </div>

                </div>
            </div>
             {{-- laptop --}}
            <div class="block-product">
                <div class="banner-product row">
                    <div class="col-md-12 col-sm-12 col-xs-12 col-banner-product">

                        <img src="{{asset(DB::table('product_image')->where('id',$banner_laptop->image)->value('product_image'))}}"/>
                    </div>
                </div>
                <div class="row row-product">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            @foreach($product_laptop as $val)
                            <?php
                                $product_price_temp = DB::table('product_price')->where('id', $val->product_price)->first();
                            ?>
                            <div class="col-md-3 col-sm-6 col-xs-6 col-pr">
                                <div class="product-grid6 product-box ">
                                    <div class="product-image6 product-image">
                                        <a href="{{URL::to($sanphamController->getLinkProduct($val->id))}}">
                                            <img class="product-avatar-{{$val->id}}" src="{{asset(DB::table('product_image')->where('id', $val->product_avatar)->value('product_image'))}}">
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="title"><a href="{{URL::to($sanphamController->getLinkProduct($val->id))}}">{{$val->product_name}}</a></h3>
                                        <div class="price-new text-left">
                                            @if($product_price_temp->price_promotion != null)
                                                {{number_format($product_price_temp->price_promotion,0,",",".")}}
                                            @else
                                                {{number_format($product_price_temp->price_regular,0,",",".")}}
                                            @endif
                                            </div>
                                        <div class="price text-center">
                                            @if($product_price_temp->price_promotion != null)
                                              <div class="price-old">{{number_format($product_price_temp->price_regular,0,",",".")}}</div>
                                              <div class="price-diff">-{{number_format((100 - ($product_price_temp->price_promotion/$product_price_temp->price_regular*100)),0,",",".")}}%</div>
                                            @endif
                                            @if($product_price_temp->price_installment ==1)
                                                <div class="tag-ins">0% installment payment</div>
                                            @endif
                                        </div>
                                    @if($product_price_temp->price_online !=null)
                                        <div class="giamthem"><span class="title-giam">Buy online get an additional discount  </span><p class="price-giamthem">{{number_format(($product_price_temp->price_promotion - $product_price_temp->price_online),0,",",".")}}  $</p></div>
                                        <div class="giaonline text-right" style='background: url("{{asset('/public/admin/img/img_icon/giaonline.png')}}")'>
                                            <span class="price-online">{{number_format($product_price_temp->price_online,0,",",".")}} $</span>
                                        </div>
                                    @endif
                                    </div>

                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div style="width: 100%; text-align: right"><a class="view-all" href="{{URL::to('/dien-thoai-laptop-tablet')}}">More...</a></div>
                    </div>

                </div>
            </div>
        </div>
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <div class="block-blog">
                        <div class="banner-blog row">
                            <div class="col-md-12 col-sm-12 col-xs-12 col-banner-blog">
                                <img src="{{asset(DB::table('product_image')->where('id',$banner_baiviet->image)->value('product_image'))}}"/>
                            </div>
                        </div>
                        <div class="row row-2light row-blog">
                            <div class="col-md-6 col-xs-12 pt-15">
                                <div class="main-banner-wrap">
                                    <div class="sub-banner-wrap ">
                                        <div class="blog-thumbnail">
                                        <a class="" href="{{URL::to('/bai-viet/'.$blogs[0]->blog_slug)}}">
                                            <img src="{{asset('public/blog_img/'.$blogs[0]->blog_avatar)}}" alt="Chia sẻ cách nướng xúc xích bằng nồi chiên không dầu">
                                        </a>
                                        </div>
                                        <a  href="{{URL::to('/bai-viet/'.$blogs[0]->blog_slug)}}">
                                            <h3 class="h2light-title">{{$blogs[0]->blog_name}}    </h3>
                                        </a>
                                        <p class="short-des-main">{{$blogs[0]->blog_note}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-4 relate-new pt-15">
                                <ul class="right-focus-wrap clearfix">
                                    @for($i = 1; $i < 4; $i++)

                                    <li class="multi-posts clearfix row">
                                        <div class="post-thumbnail blog-thumbnail col-md-4">
                                            <span class="hot-news ">HOT</span>
                                            <a href="{{URL::to('/bai-viet/'.$blogs[$i]->blog_slug)}}" rel="nofollow">
                                                <img src="{{asset('public/blog_img/'.$blogs[$i]->blog_avatar)}}" alt="Những điều cần biết khi cho trẻ xem tivi">
                                            </a>
                                        </div>
                                        <div class="post-entry col-md-8">
                                            <a href="{{URL::to('/bai-viet/'.$blogs[$i]->blog_slug)}}" rel="nofollow">
                                                <h3 class="post-box-title">
                                                    {{$blogs[$i]->blog_name}}
                                                </h3>
                                            </a>
                                            <p class="short-des">{{$blogs[$i]->blog_note}}</p>
                                        </div>
                                    </li>
                                    @endfor

                                </ul>
                                <div style="text-align: right"><a class="view-all" href="{{URL::to('/bai-viet')}}">More...</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  <body>

    <p><div class="jquery-script-ads">
        <script type="text/javascript">
            google_ad_client = "ca-pub-2783044520727903";
            google_ad_slot = "2780937993";
            google_ad_width = 728;
            google_ad_height = 90;
        </script>

    <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
    </div></p>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="{{URL::to('/resources/js/jquery-sakura.min.js')}}"></script>

    <script>
    $(window).load(function () {
        $('body').sakura();
    });
    </script>

</body>
@endsection




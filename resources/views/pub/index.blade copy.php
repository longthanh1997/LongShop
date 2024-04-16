<?php
use App\Http\Controllers\SanphamController;
$sanphamController = new SanphamController();

?>
@extends('layouts.master')
@section('content')
<style>
    .no-pad{
        padding-left: 5px !important;
        padding-right: 5px !important;
    }
</style>
<div id="content" class="home">
    <div class="content-top-w row">
                <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12 main-left no-pad">
                        <div class="module col1 hidden-sm hidden-xs"></div>
                    </div>
                <div class="main-mid col-lg-10 col-md-12 col-sm-12 col-xs-12 col2 no-pad">
                    <div class="fotorama" data-minwidth="100%" data-maxwidth="100%" data-nav="false">
                        <img src="{{asset('/public/admin/img/banner/home1.jpg')}}">
                        <img src="{{asset('/public/admin/img/banner/home2.png')}}">
                    </div>
                </div>


                {{-- <div class="main-right col-lg-3 col-md-12 col-sm-12 col-xs-12 col3 hc-best-selling  hidden-sm hidden-xs  no-pad">
                    <div id="best_selling" class="module product-simple extra-layout1">
                        <h3 class="modtitle">
                            <span><a href="g--SALE-SAP-SAN.html">SALES SẬP SÀN</a></span>
                        </h3>
                        <div class="modcontent">
                            <div id="so_extra_slider_1" class="so-extraslider">
                                <!-- Begin extraslider-inner -->
                                <div class="yt-content-slider extraslider-inner" data-rtl="yes" data-pagination="yes" data-autoplay="no" data-delay="4" data-speed="0.6" data-margin="0" data-items_column00="1" data-items_column0="1" data-items_column1="1" data-items_column2="2" data-items_column3="1"
                                    data-items_column4="2" data-arrows="no" data-lazyload="yes" data-loop="no" data-buttonpage="top">
                                    <div class="item ">
                                        <?php $count = 4; ?>

                                        @foreach($products as $val)
                                            @if($count > 0)
                                                <?php $count = $count-1;?>
                                                <?php
                                                    $product_price_temp = DB::table('product_price')->where('id', $val->product_price)->first();
                                                ?>
                                                    <div class="product-layout item-inner style1 ">

                                                        <div class="item-image">
                                                            <div class="item-img-info">
                                                                <a href="{{URL::to($sanphamController->getLinkProduct($val->id))}}" target="_self" title="{{$val->product_name}}">
                                    <img data-src="{{asset(DB::table('product_image')->where('id', $val->product_avatar)->value('product_image'))}}" alt="Smart Tivi Samsung 4K 55 inch UA55TU8500" class="lazyload">
                                    </a>
                                                            </div>
                                                        </div>

                                                        <div class="item-info">
                                                            <div class="item-title hc-best-selling-desc">

                                                                <a href="{{URL::to($sanphamController->getLinkProduct($val->id))}}" target="_self" title="{{$val->product_name}}">{{$val->product_name}}</a>
                                                            </div>
                                                            <div class="content_price price hc-best-selling-price">
                                                                <span class="price product-price">{{number_format($product_price_temp->price_promotion,0,",",".")}}$</span>
                                                            </div>
                                                        </div>

                                                    </div>
                                        
                                            @endif
                                        @endforeach
                                        
                                        
                                        
                                    </div>
                                    <div class="item ">
                                        <?php $count = 4; ?>

                                        @foreach($products as $val)
                                            @if($count > 0)
                                                <?php $count = $count-1;?>
                                                <?php
                                                    $product_price_temp = DB::table('product_price')->where('id', $val->product_price)->first();
                                                ?>
                                                    <div class="product-layout item-inner style1 ">

                                                        <div class="item-image">
                                                            <div class="item-img-info">
                                                                <a href="{{URL::to($sanphamController->getLinkProduct($val->id))}}" target="_self" title="{{$val->product_name}}">
                                        <img data-src="{{asset(DB::table('product_image')->where('id', $val->product_avatar)->value('product_image'))}}" alt="Smart Tivi Samsung 4K 55 inch UA55TU8500" class="lazyload">
                                        </a>
                                                                                </div>
                                                        </div>

                                                        <div class="item-info">
                                                            <div class="item-title hc-best-selling-desc">

                                                                <a href="{{URL::to($sanphamController->getLinkProduct($val->id))}}" target="_self" title="{{$val->product_name}}">{{$val->product_name}}</a>
                                                            </div>
                                                            <div class="content_price price hc-best-selling-price">
                                                                <span class="price product-price">{{number_format($product_price_temp->price_promotion,0,",",".")}}$</span>
                                                            </div>
                                                        </div>

                                                    </div>
                                        
                                            @endif
                                        @endforeach
                                        
                                        
                                        
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


        </div> --}}
        <div class="row content-main-w">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div id="PRODUCT_GROUP_0" class="so-category-slider related-pro container-slider module cateslider1">
                    <div class="modcontent">
                        <div class="page-top">
                            <h2 class="page-title-categoryslider"><a href="#">MOST SEARCHED</a></h2>

                        </div>
                        <div class="categoryslider-content">
                            <div id="OWL_0" class="slider category-slider-inner products-list yt-content-slider so-category-slider-nobanner hc-no-banner " data-rtl="yes" data-autoplay="no" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="30" data-items_column00="4"
                                data-items_column0="5" data-items_column1="3" data-items_column2="2" data-items_column3="2" data-items_column4="2" data-arrows="yes" data-pagination="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
                            @foreach($products as $val)
                            <?php
                                $product_price_temp = DB::table('product_price')->where('id', $val->product_price)->first();
                            ?>
                                <div class="item">
                                    <div class="item-inner product-layout transition product-grid">

                                        <div class="product-item-container">
                                            <div class="hc-installment-label">
                                            0% installment payment
                                            </div>
                                            <div class="left-block left-b">

                                                

                                                <div class="product-image-container second_img">
                                                    <a id="ITEM_IMG_HOME_{{$val->id}}" href="{{URL::to($sanphamController->getLinkProduct($val->id))}}" target="_self" title=" Smart Tivi LG NanoCell 4K 55 inch 55NANO81TNA">
        <img id="ITEM_IMG_HOME_1_{{$val->id}}" data-src="{{asset(DB::table('product_image')->where('id', $val->product_avatar)->value('product_image'))}}" class="img-1 lazyload img-responsive" alt=" Smart Tivi LG NanoCell 4K 55 inch 55NANO81TNA">
        <img id="ITEM_IMG_HOME_2_{{$val->id}}" data-src="{{asset(DB::table('product_image')->where('id', $val->product_avatar)->value('product_image'))}}" class="img-2 lazyload img-responsive" alt=" Smart Tivi LG NanoCell 4K 55 inch 55NANO81TNA">
    </a>
                                                </div>
                                            </div>
                                            <div class="right-block">
                                                <div class="prdLblCampaignThumb prdLblCampaignNew">
                                                    <span style="background: linear-gradient(270deg,#FFC300 4.6%,#DD220D 94.58%)">
                                                        <img src="https://cdn.tgdd.vn/2020/10/content/icon5-50x50.png">
                                                        <small>12.12 SIÊU SALE</small>
                                                    </span>
                                                </div>
                                                <div class="prdLblCampaignThumb prdLbldDiscountShock">
                                                    <span>
                                                        <img src="{{asset('/public/admin/img/icon/icon_labelgiamsoc.png')}}">
                                                        <small>GIẢM SỐC</small>
                                                    </span>
                                                </div>
                                                
                                                <div>
                                                 <h3 id="ITEM_DESC_{{$val->id}}"><a href="{{URL::to($sanphamController->getLinkProduct($val->id))}}" title="" target="_self"> {{$val->product_name}}</a></h3>
                                                </div>
                                                <div id="product-{{$val->id}}" class="caption  hc-promotion-info">
                                                    <i class="fa fa-gift" aria-hidden="true"></i> Tặng quà khủng
                                                </div> 
                                                <p class="price"><span class="price-new">{{number_format($product_price_temp->price_promotion,0,",",".")}}$</span>
                                                    <span class="price-old">{{number_format($product_price_temp->price_regular,0,",",".")}}$</span>
                                                    <span class="price_diff">-{{number_format((100 - ($product_price_temp->price_promotion/$product_price_temp->price_regular*100)),2,",",".")}}%</span>
                                                    <p class="sold-out-label"></p>
                                                </p>
                                            </div>
                                            <?php 
                                                $comments = DB::table('comment')->where('cmt_ofproduct', $val->id)->where('cmt_status', 1)->get();
                                                $rate5= $rate4= $rate3= $rate2= $rate1 = 0;

                                                if(count($comments) ==0){
                                                    $rating_star = null;
                                                    $pkg_rate_percent = array(0,0,0,0,0);

                                                }else{
                                                    foreach($comments as $value){
                                                        $rate = $value->cmt_rate;
                                                        switch ($rate) {
                                                            case 1:
                                                                $rate1+=1;
                                                                break;
                                                            case 2:
                                                                $rate2+=1;
                                                            break;
                                                            case 3:
                                                                $rate3+=1;
                                                            break;
                                                            case 4:
                                                                $rate4+=1;
                                                                break;
                                                            case 5:
                                                                $rate5+=1;
                                                                break;
                                                        }
                                                    }
                                                    $rating_star = ($rate1*1 + $rate2*2 + $rate3*3 + $rate4*4 + $rate5*5)/(count($comments)*5) *100;
                                                }
                                            ?>
                                            @if(count($comments) >0)
                                            <div class="block-ratings">
                                                <div class="ratings">
                                                    <div class="empty-stars"></div>
                                                    <span class="full-stars" style="width:{{$rating_star}}%"></span>
                                                </div>
                                                <div class="rating-text">{{count($comments)}} đánh giá</div>
                                            </div>
                                            @else
                                            <div class="block-ratings">
                                                <div class="ratings">
                                                <div class="empty-stars" style="display:none"></div>
                                                <span class="full-stars" style="width:{{$rating_star}}%; display:none"></span>
                                                </div>
                                                <div class="rating-text" style="display:none">'.count($comments).' đánh giá</div>
                                                </div>
                                            @endif
                                        </div>
                                        
                                    </div>
                                </div>

                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>
                <!-- end Category Slider 1 -->

                <div class="banners4 banners">
                    <div class="row">

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <a href="l--tivi-samsung.html"><img data-src="{{asset('/public/admin/img/banner/banner-1.png')}}" alt="Samsung av" class="lazyload"></a>
                        </div>


                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <a href="g--tivi-samsung-8k.html"><img data-src="{{asset('/public/admin/img/banner/banner-2.png')}}" alt="tivi samsung 8k" class="lazyload"></a>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <a href="g--tivi-samsung-8k.html"><img data-src="{{asset('/public/admin/img/banner/banner-3.png')}}" alt="tivi samsung 8k" class="lazyload"></a>
                        </div>
                    </div>
                </div>
                <div class="rowGS row nopadding-xs  hidden-xs">
                    <div class="col-md-12 col-xs-12 nopadding-xs nopadding-md">
                        <div class="box-tab">
                            <div class="flex">
                                @foreach($tab_cate as $value)
                                    <a class="a-tab" id="{{$value->id}}" href="javascript:void(0);" onclick="loadFeatureProducts(this)"><span>{{$value->category_name}}</span></a>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                <script>
                        $( ".box-tab a:first-child" ).trigger( "click" );
                        function loadFeatureProducts(element){
                            $.ajax({
                                url: "{{URL::to('/loadfeatureproducts')}}",
                                type: 'get',
                                data: {"id": element.id},
                                error: function(data) {
                                },
                                success: function(response) {
                                    console.log(response);
                                    $("#pr-load-more").css('display','inline-block');
                                    if(response[0] != ""){
                                        $('.feature-product').html(response[0]);
                                    }else{
                                        $('.feature-product').html('<h3 class="text-center">There are no products in this category</h3>');
                                    }
                                    $('.rowGS .box-tab a').removeClass('active');
                                    $('.rowGS .box-tab #'+ element.id).addClass('active');
                                    if(response[1] >0){
                                            $("#pr-load-more").text("More "+response[1] +" Product(s)");
                                        }else{
                                            $("#pr-load-more").css('display','none');
                                        }
                                }

                            });
                        }
                </script>
                <div class="products-list row nopadding-xs so-filter-gird grid">
                        <div id="report_15158345236776503_catch" class="feature-product col-md-12 col-xs-12">





                        </div>
                        <script>
                            function loadmoreProducts(){
                                var id_cate = $('.rowGS .box-tab a.active').attr('id');
                                var id_lastproduct = $('.feature-product .item:last-child').attr('id');
                                $.ajax({
                                    url: "{{URL::to('/loadmoreproducts')}}",
                                    type: 'get',
                                    data: {"id_cate": id_cate, "id_lastproduct": id_lastproduct, 'area': 'home'},
                                    beforeSend:function(){
                                        $("#pr-load-more").text("Loading...");
                                    },
                                    error: function(data) {
                                    },
                                    success: function(response) {
                                        console.log(response);
                                        $('.feature-product').append(response[0]);
                                        if(response[1] >0){
                                            $("#pr-load-more").text("More "+response[1] +" Products");
                                        }else{
                                            $("#pr-load-more").css('display','none');
                                        }

                                    }
                                });
                            }
                        </script>
                        <div class="text-center col-12"><a class="btn btn-primary" id="pr-load-more" href="javascript:void(0);" onclick="loadmoreProducts()">More</a> </div>
                        <div class="col-md-12">
                        <div class="row row-2light blog-block">
                            <div class="col-md-6 col-xs-8 pt-15">
                                <div class="main-banner-wrap">
                              
                                    <div class="sub-banner-wrap">
                                        <a href="/ords/ni--nuong-xuc-xich-bang-noi-chien-khong-dau">
                                            <img src="{{asset('/public/upload/product/ss-rs59.png')}}" alt="Chia sẻ cách nướng xúc xích bằng nồi chiên không dầu">
                                        </a>
                                        <a href="/ords/ni--nuong-xuc-xich-bang-noi-chien-khong-dau">
                                            <h3 class="h2light-title">Nướng xúc xích bằng nồi chiên không dầu cực dễ, thơm ngon</h3>
                                        </a>
                                    </div>
                                </div>
                                {{-- <div class="sub-2light ">
                                    <div class="row">
                                        <div class="sub-banner-wrap col-sm-6">
                                            <a href="/ords/ni--huong-dan-su-dung-may-loc-nuoc-karofi"><img src="{{asset('/public/upload/product/ss-rs59.png')}}" alt="Hướng dẫn sử dụng máy lọc nước Karofi cho người mới"></a>
                                            <a href="/ords/ni--huong-dan-su-dung-may-loc-nuoc-karofi">
                                                <h3 class="sub-2light-title">Hướng dẫn sử dụng máy lọc nước Karofi chuẩn, đúng cách</h3>
                                            </a>
                                        </div>
                                        <div class="sub-banner-wrap col-sm-6">
                                            <a href="/ords/ni--cach-su-dung-lo-nuong-electrolux"><img src="{{asset('/public/upload/product/ss-rs59.png')}}" alt="Cách sử dụng lò nướng Electrolux rất đơn giản"></a>
                                            <a href="/ords/ni--cach-su-dung-lo-nuong-electrolux">
                                                <h3 class="sub-2light-title">Cách sử dụng lò nướng Electrolux đúng cách ngay từ lần đầu tiên</h3>
                                            </a>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="col-md-6 col-sm-4 relate-new pt-15">
                                <ul class="right-focus-wrap clearfix">
                               
                        
                                    <li class="multi-posts clearfix row">
                                        <div class="post-thumbnail col-md-4">
                                            <span class="hot-news ">HOT</span>
                                            <a href="/ords/ni--cho-tre-em-xem-tivi-nhu-the-nao-la-dung-cach" rel="nofollow">
                                                <img src="{{asset('/public/upload/product/ss-rs59.png')}}" alt="Những điều cần biết khi cho trẻ xem tivi">
                                            </a>
                                        </div>
                                        <div class="post-entry col-md-8">
                        
                                            <a href="/ords/ni--cho-tre-em-xem-tivi-nhu-the-nao-la-dung-cach" rel="nofollow">
                                                <h3 class="post-box-title">Cho trẻ em xem tivi như thế nào là đúng cách?
                        
                                                </h3>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="multi-posts clearfix row">
                                        <div class="post-thumbnail col-md-4">
                                            <span class="hot-news ">HOT</span>
                                            <a href="/ords/ni--cho-tre-em-xem-tivi-nhu-the-nao-la-dung-cach" rel="nofollow">
                                                <img src="{{asset('/public/upload/product/ss-rs59.png')}}" alt="Những điều cần biết khi cho trẻ xem tivi">
                                            </a>
                                        </div>
                                        <div class="post-entry col-md-8">
                        
                                            <a href="/ords/ni--cho-tre-em-xem-tivi-nhu-the-nao-la-dung-cach" rel="nofollow">
                                                <h3 class="post-box-title">Cho trẻ em xem tivi như thế nào là đúng cách?
                        
                                                </h3>
                                            </a>
                                        </div>
                                    </li>
                        
                                    <li class="multi-posts clearfix row">
                                        <div class="post-thumbnail col-md-4">
                                            <span class="hot-news ">HOT</span>
                                            <a href="/ords/ni--cho-tre-em-xem-tivi-nhu-the-nao-la-dung-cach" rel="nofollow">
                                                <img src="{{asset('/public/upload/product/ss-rs59.png')}}" alt="Những điều cần biết khi cho trẻ xem tivi">
                                            </a>
                                        </div>
                                        <div class="post-entry col-md-8">
                        
                                            <a href="/ords/ni--cho-tre-em-xem-tivi-nhu-the-nao-la-dung-cach" rel="nofollow">
                                                <h3 class="post-box-title">Cho trẻ em xem tivi như thế nào là đúng cách?
                        
                                                </h3>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                                <div style="float: right"><h3>More...</h3></div>
                            </div>
                    </div>
                        </div>
                </div>
              
        </div>
        
    </div>


    </div>
</div>
@endsection




<?php
use App\Http\Controllers\SanphamController;
$sanphamController = new SanphamController();

?>

@extends('layouts.master')
@section('meta')
<link rel="image_src" href="{{asset(DB::table('product_image')->where('id', $product->product_avatar)->value('product_image'))}}" />
    <title>{{$product->product_name }}</title>
    <meta NAME="ROBOTS" CONTENT="index,follow" />
    <meta name="title" content="{{$product->product_name }}" />
    <meta name="description" content="LONGSHOP" />
    <meta property="og:image" content="{{URL::to(DB::table('product_image')->where('id', $product->product_avatar)->value('product_image'))}}" />
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="512">
    <meta property="og:image:height" content="1024">

@endsection
@section('content')
<script>
    $( document ).ready(function() {
        $('html').addClass('page category-archive product-page');
    });
</script>
<style>
div.text-container {
    margin: 0 auto;
    width: 75%;
}

a.item.i1.active.nopromo.col-sm-3 {
    height: 60px;
    margin-bottom: 5px;
}

.hideContent {
    overflow: hidden;
    line-height: 1em;
    height: 2em;
}

.showContent {
    line-height: 1em;
    height: auto;
}
.showContent{
    height: auto;
}

.show-more {
    padding: 10px 0;
    text-align: center;
}

.producttab {
    margin: 0;
}

.common-home .typefooter-1 {
    margin-top: 10px;
}
/*@media only screen and (max-width: 769px){*/
/*    .khuyenmai_type2 h3 {*/
/*        position: absolute;*/
/*            top: 0%;*/
/*        left: 67%;*/
/*        font-size: 16px;*/
/*        font-family: Gotham-Medium;*/
/*        color: white;*/
/*        font-weight: 600;*/
/*    }*/
/*    .khuyenmai_type1 h3 {*/
/*        position: absolute;*/
/*        top: 39%;*/
/*        left: 67%;*/
/*        font-size: 16px;*/
/*        font-family: Gotham-Medium;*/
/*        color: white;*/
/*        font-weight: 600;*/
/*    }*/
/*}*/

@media only screen and (max-width: 330px){
    .iphone5s{
        padding: 0px !important;
    }

    .iphone5s span.price-online {
        font-size: 19px !important;
        padding: 11px !important;
    }
}

/*.khuyenmai_type2 h3 {*/
    /*display: none;*/
/*}*/
</style>
    <ul class="breadcrumb">
        <li><a id="MENU_HOME" href="home"><i class="fa fa-home"></i></a></li>
        @foreach($breadscrumb as $value)
            <li><a id="{{$value->category_slug}}" href="{{URL::to('/'.$value->category_slug)}}">{{$value->category_name}}</a></li>
        @endforeach
            <li>{{$product->product_name }}</li>
    </ul>
    <div class="row">
        <!--Left Part Start -->

        <!--Left Part End -->
        <!--Middle Part Start-->
        <div id="content" class="col-md-9 col-sm-8 hidden-xs hidden-sm">
            <div class="product-view row">
                <div class="left-content-product">
                    <div class="content-product-left class-honizol col-md-5 col-sm-12 col-xs-12">
                        <div class="gal-product">
                            <div class="fotorama" data-nav="thumbs" data-allowfullscreen="true" data-transition="crossfade" width="100%" height="100%">
                                <img src="{{asset(DB::table('product_image')->where('id', $product->product_avatar)->value('product_image'))}}" width="100%" height="100%">
                                @foreach(explode(',',$product->product_gallery) as $image_id)
                                    <img src="{{asset(DB::table('product_image')->where('id', $image_id)->value('product_image'))}}"  width="100%" height="100%">
                                @endforeach
                            </div>
                        </div>
                        <h4 class="ddnb">Highlights features</h4>
                        <div class="text-container">
                            <div style="text-align: justify">
                                <div class="content hideContent">
                                    <?php
                                        echo $product->product_shortdsc;

                                    ?>
                                </div>

                            <div class="show-more">
                                <a>Show Highlights features</a>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="content-product-right col-md-7 col-sm-12 col-xs-12">
                        <div class="title-product">
                            <h1>{{$product->product_name }}</h1>
                        </div>
                        <div class="product-label form-group">
                            <div class="product_page_price price">
                                @if($product_price->price_promotion !=null)
                                    <span class="price-new" itemprop="price">{{number_format($product_price->price_promotion,0,",",".")}}$</span>
                                @else
                                    <span class="price-new" itemprop="price">{{number_format($product_price->price_regular,0,",",".")}}$</span>
                                @endif
                                @if($product_price->price_promotion !=null)
                                    <span class="price-old">{{number_format($product_price->price_regular,0,",",".")}}$</span>
                                    <span class="price_diff">-{{number_format((100 - ($product_price->price_promotion/$product_price->price_regular*100)),0,",",".")}}%</span>
                                @endif
                                @if($product_price->price_installment ==1)
                                    <span class="tag-ins">0% installment payment</span>
                                @endif
                            </div>
                            <div class="stock"><span>Status:</span>
                                @if($product->product_quantity >0)
                                    <span class="status-stock">Stocking</span>
                                @else
                                    <span class="status-stock">Out of Stock</span>
                                @endif

                                </div>
                        </div>

                         @if($product_price->price_online !=null)
                         <div class="giamthem">
                            <span class="title-giam">Buy online get an additional discount  </span><span class="price-giamthem">{{number_format(($product_price->price_promotion - $product_price->price_online),0,",",".")}}  $</span></div>
                            <div class="giaonline text-right" style='background: url("{{asset('/public/admin/img/img_icon/giaonline.png')}}")'>
                                <span class="price-online" >{{number_format($product_price->price_online,0,",",".")}} $</span>
                            </div>
                        @endif
                        <div class="memory memory4 others" style="border-top-left-radius: 5px; border-top-right-radius: 5px;">
                            @if($product->product_group != null)
                            <div class="m_default">
                                <?php
                                    $count= 0;
                                    foreach(explode(',',$product->product_group) as $value){
                                        $count = $count +1;
                                    }
                                ?>
                                There are <b>{{$count}} Product type.</b> You are selecting <b class="bMeasureInfo normal">{{$product->product_group_name}} </b>
                            </div>

                                <div class="reprelst normal lesspro flex-1 row">
                                    <?php
                                        $price_ids = array();
                                        foreach(explode(',',$product->product_group) as $value){
                                            $product_temp = DB::table('product')->where('id', $value)->first();
                                            array_push($price_ids,$product_temp->product_price);
                                        }

                                        $prices = DB::table('product_price')->whereIn('id',$price_ids)->orderBy('price_promotion','asc')->get();
                                    ?>


                                    @foreach($prices as $product_price_temp)
                                      <?php
                                            $product_temp = DB::table('product')->where('product_price', $product_price_temp->id)->first();
                                        ?>
                                                <a class="item i1 active nopromo col-sm-3" href="{{URL::to($sanphamController->getLinkProduct($product_temp->id))}}">
                                                        <span>
                                                            @if($product->id == $product_temp->id)
                                                                <sub class="icondetail-check"></sub>
                                                            @else
                                                                <i class=icon-opt></i>
                                                            @endif
                                                            <label class="rname"> {{$product_temp->product_group_name}}
                                                            </label>
                                                        </span>
                                                        <strong class="rprice">{{number_format($product_price_temp->price_promotion,0,",",".")}} $</strong>
                                                </a>
                                    @endforeach
                                </div>
                            @endif

                        </div>

                            <div class="giaonline text-right" style='margin-bottom: -19px;background: url("{{asset('/public/admin/img/img_icon/KHUYENMAI.png')}}")'>
                                <span class="price-online" style="font-size: 26px;">{{number_format($product->total_offer,0,",",".")}}$</span>
                            </div>
                            <div class="alert alert-info hc-promotion-detail khuyenmai_type2" style="position: relative;border-top-left-radius: 5px; border-top-right-radius: 5px;">
                                <div>
                                    <?php
                                        echo $product->product_offer;

                                    ?>
                                </div>
                            </div>


                        <div id="product">
                            <div class="form-group box-info-product hc_cutom_box_infor">
                                @if($product->product_quantity >0)

                                <form action="{{URL::to('/add-to-cart')}}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="option quantity">
                                        <div class="input-group quantity-control" unselectable="on" style="-webkit-user-select: none;"><label>Quantity</label>
                                            <input id="quantity-pr-lt" class="form-control" type="text" name="quantity" value="1">
                                            <input type="hidden" class="input-proId" name="productid" value="{{$product->id}}">
                                            <span id="quantity_down-lt" class="input-group-addon product_quantity_down">−</span>
                                            <span id="quantity_up-lt"class="input-group-addon product_quantity_up">+</span>
                                        </div>
                                    </div>
                                    <div class="cart">
                                        <!--<input type="submit" data-toggle="tooltip" title="" value="Mua hàng">-->
                                        <button type="submit" class="btn btn-buynow">
                                            <span>BUY NOW</span>
                                            <br>
                                            <span>Delivery</span>
                                        </button>
                                        <button type="button" class="btn btn-buyalot">
                                            <span>ADD TO CART</span>
                                            <br>
                                            <span>Buy multiple products</span>
                                        </button>
                                    </div>
                                </form>
                                @endif
                                <script>
                                    // $('#quantity_down').click(function{
                                    //     var q = $('#quantity-pr').val();
                                    //     if(q > 2){
                                    //         q = q -1;
                                    //     }
                                    //     $('#quantity-pr').val(q);
                                    // });
                                    // $('#quantity_up').click(function{
                                    //     var q = $('#quantity-pr').val();

                                    //         q = q +1;

                                    //     $('#quantity-pr').val(q);
                                    // });
                                    $('.box-info-product .cart .btn-buyalot').click(function () {
                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            }
                                        });
                                        $.ajax({
                                            type: "POST",
                                            url: "{{route('cart.addAjax')}}",
                                            data: {
                                                productid : $('.input-proId').val(),
                                                quantity : $('#quantity-pr-lt').val()
                                            },
                                            dataType: "json",
                                            success: function (response) {
                                                console.log(response);
                                                console.log(response[0]);
                                                $('body').append(
                                                        '<div class="container alert alert-success alert-block custom" style="position: fixed;top: 20%;right: 20%;width: max-content;margin: 0; z-index: 999999999;">'+
                                                        '<strong style="display: block; padding: 20px;">YOU HAVE SUCCESSFULLY ADDED TO YOUR CART</strong></div>'
                                                );
                                                // DISPLAY CART DROPDOWN
                                                $('.dropdown-menu.cart-drop').addClass('cart-menu-active')
                                                setTimeout(function () {
                                                    $('body>.container.alert.alert-success.alert-block.custom').remove();
                                                    $('.dropdown-menu.cart-drop').removeClass('cart-menu-active');
                                                }, 2000);

                                                // update cart on menu bar
                                                $('.total-item-card').text(response[2]);
                                                $('.dropdown-menu.cart-drop .total-cart').text(response[1]+'$');

                                                // HIEN THI SP TRONG GIO HANG
                                                $('ul.dropdown-menu.cart-drop>div').remove();
                                                $.each(response[0], function(key, value){
                                                    $('ul.dropdown-menu.cart-drop').prepend(
                                                        '<div class="cart_sub cart-sub-'+value.id+'">'+
                                                            '<div class="cart-sub-avatar" style="padding-right: 5px;">'+
                                                                '<a href="'+value.options.slug+'">'+
                                                                    '<img style="" src="'+ value.options.img_feature + '">'+
                                                            '</a></div>'+
                                                            '<div class="cart-sub-content">' +
                                                                '<a href="'+value.options.slug+'">'+
                                                                    '<span class="name_cur">'+ value.name +'</span>' +
                                                                '</a><br>'+
                                                            '<b>Price: </b><span class="price_cur">'+ new Intl.NumberFormat('vn-VN').format(value.price)+'$</span>'+
                                                            '<br>' +
                                                            '<b>Quantity: </b><span class="qty_cur">'+ value.qty + '</span>'+
                                                            '</div>'

                                                    );

                                                })
                                                // HIEN THI GIA TIEN TAM TINH
                                                $('ul.dropdown-menu.cart-drop li.menu-cart-subtotal span').text(response[1]+'$');
                                            }
                                        });
                                    })
                                </script>

                            </div>
                            {{-- <div class="hc_installment_btns">
                                <a href="i--00033806--Android-Tivi-Sony-4K-43-inch-KD-43X8000G--0" class="hc_installment_btn"> 0% installment payment
                                               <span>Thủ tục online đơn giản</span>
                                     </a>
                            </div> --}}
                        </div>
                        <!-- end box info product -->
                        <div class="hc_call_center_new">
                            <p>Offer only available at <span class="hc_color_blue">Longshop</span>, call now<a href="tel:0934768904"><span class="hc_color_red">0934768904</span></a> for ordering</p>
                        </div>

                    </div>

                </div>
            </div>
        </div>

<!-- Giao dien mobi -->
        <div id="content" class="col-md-9 col-sm-8 hidden-lg hidden-md">
            <div class="product-view row" style="margin-bottom: -80px;">
                <div class="left-content-product">
                    <div class="content-product-left class-honizol col-md-5 col-sm-12 col-xs-12">
                        <div class="gal-product">
                            <div class="fotorama"  data-nav="thumbs" data-allowfullscreen="true" data-transition="crossfade" width="100%" height="100%">
                                <img src="{{asset(DB::table('product_image')->where('id', $product->product_avatar)->value('product_image'))}}" width="100%" height="100%">
                                @foreach(explode(',',$product->product_gallery) as $image_id)
                                    <img src="{{asset(DB::table('product_image')->where('id', $image_id)->value('product_image'))}}" width="100%" height="100%">
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="content-product-right col-md-7 col-sm-12 col-xs-12">
                        <div class="title-product">
                            <h1>{{$product->product_name }}</h1>
                        </div>
                        <div class="product-label form-group">
                            <div class="product_page_price price">
                                <span class="price-new" itemprop="price">{{number_format($product_price->price_promotion,0,",",".")}}$</span>
                                <span class="price-old">{{number_format($product_price->price_regular,0,",",".")}}$</span>
                                <span class="price_diff">-{{number_format((100 - ($product_price->price_promotion/$product_price->price_regular*100)),0,",",".")}}%</span>
                                @if($product_price->price_installment ==1)
                                    <span class="tag-ins">0% installment payment</span>
                                @endif                            </div>
                            <div class="stock"><span>Status:</span>
                                @if($product->product_quantity >0)
                                    <span class="status-stock">Stocking</span>
                                @else
                                    <span class="status-stock">Out of stock</span>
                                @endif

                                </div>
                        </div>
                        @if($product_price->price_online !=null)
                         <div class="giamthem">
                            <span class="title-giam">Buy online get an additional discount  </span><span class="price-giamthem">{{number_format(($product_price->price_promotion - $product_price->price_online),0,",",".")}}  $</span></div>
                            <div class="giaonline text-right iphone5s" style='background: url("{{asset('/public/admin/img/img_icon/giaonline.png')}}")'>
                                <span class="price-online" >{{number_format($product_price->price_online,0,",",".")}} $</span>
                            </div>
                        @endif


                        <div class="memory memory4 others">
                            @if($product->product_group != null)
                            <div class="m_default">
                                <?php
                                    $count= 0;
                                    foreach(explode(',',$product->product_group) as $value){
                                        $count = $count +1;
                                    }
                                ?>
                                There are <b>{{$count}} product type.</b> you are selecting <b class="bMeasureInfo normal">{{$product->product_group_name}} </b>
                            </div>

                                <div class="reprelst normal lesspro flex-1">
                                    <?php
                                        $price_ids = array();
                                        foreach(explode(',',$product->product_group) as $value){
                                            $product_temp = DB::table('product')->where('id', $value)->first();
                                            array_push($price_ids,$product_temp->product_price);
                                        }

                                        $prices = DB::table('product_price')->whereIn('id',$price_ids)->orderBy('price_promotion','asc')->get();
                                    ?>


                                    @foreach($prices as $product_price_temp)
                                      <?php
                                            $product_temp = DB::table('product')->where('product_price', $product_price_temp->id)->first();
                                        ?>
                                                <a class="item i1 active nopromo" href="{{URL::to($sanphamController->getLinkProduct($product_temp->id))}}">
                                                        <span>
                                                            @if($product->id == $product_temp->id)
                                                                <sub class="icondetail-check"></sub>
                                                            @else
                                                                <i class=icon-opt></i>
                                                            @endif
                                                            <label class="rname"> {{$product_temp->product_group_name}}
                                                            </label>
                                                        </span>
                                                        <strong class="rprice">{{number_format($product_price_temp->price_promotion,0,",",".")}} $</strong>
                                                </a>
                                    @endforeach
                                </div>
                            @endif

                        </div>
                            <div class="giaonline text-right" style='margin-bottom: -38px;background: url("{{asset('/public/admin/img/img_icon/KHUYENMAI.png')}}")'>
                                <span class="price-online" style="font-size: 16px;">{{number_format($product->total_offer,0,",",".")}}$</span>
                            </div>
                            <div class="alert alert-info hc-promotion-detail khuyenmai_type2" style="position: relative;border-top-left-radius: 5px; border-top-right-radius: 5px;">
                                <div>
                                    <?php
                                        echo $product->product_offer;

                                    ?>
                                </div>
                            </div>

                        <div id="product">
                            <div class="form-group box-info-product hc_cutom_box_infor">
                                <form action="{{URL::to('/add-to-cart')}}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="option quantity">
                                        <div class="input-group quantity-control" unselectable="on" style="-webkit-user-select: none;"><label>Quantity</label>
                                            <input id="quantity-pr" class="form-control" type="text" name="quantity" value="1">
                                            <input type="hidden" class="input-proId" name="productid" value="{{$product->id}}">
                                            <span id="quantity_down" class="input-group-addon product_quantity_down">−</span>
                                            <span id="quantity_up"class="input-group-addon product_quantity_up">+</span>
                                        </div>
                                    </div>
                                    <div class="cart">
                                        <!--<input type="submit" data-toggle="tooltip" title="" value="Mua hàng">-->
                                        <button type="submit" class="btn btn-buynow btn-on-mobile" >
                                            <span>BUY NOW</span>
                                            <br>
                                            <span>Delivery</span>
                                        </button>
                                        <button type="button" class="btn btn-buyalot btn-on-mobile">
                                            <span>ADD TO CART</span>
                                            <br>
                                            <span>Buy multiple products</span>
                                        </button>
                                    </div>
                                </form>
                                <script>
                                    // $('#quantity_down').click(function{
                                    //     var q = $('#quantity-pr').val();
                                    //     if(q > 2){
                                    //         q = q -1;
                                    //     }
                                    //     $('#quantity-pr').val(q);
                                    // });
                                    // $('#quantity_up').click(function{
                                    //     var q = $('#quantity-pr').val();

                                    //         q = q +1;

                                    //     $('#quantity-pr').val(q);
                                    // });
                                    $('.box-info-product .cart .btn-buyalot.btn-on-mobile').click(function () {
                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            }
                                        });
                                        $.ajax({
                                            type: "POST",
                                            url: "{{route('cart.addAjax')}}",
                                            data: {
                                                productid : $('.input-proId').val(),
                                                quantity : $('#quantity-pr-lt').val()
                                            },
                                            dataType: "json",
                                            success: function (response) {
                                                console.log(response);
                                                console.log(response[0]);
                                                $('body').append(
                                                        '<div class="container alert alert-success alert-block custom" style="position: fixed;top: 10%;right: 0;width: max-content;margin: 0; z-index: 999999999;">'+
                                                        '<strong style="display: block;">YOU HAVE SUCCESSFULLY ADDED TO YOUR CART</strong></div>'
                                                );
                                                // DISPLAY CART DROPDOWN
                                                setTimeout(function () {
                                                    $('body>.container.alert.alert-success.alert-block.custom').remove();
                                                }, 2000);

                                                // update cart on menu bar
                                                $('.total-item-card').text(response[2]);
                                                $('.dropdown-menu.cart-drop .total-cart').text(response[1]+'$');

                                            }
                                        });
                                    })
                                </script>

                            </div>
                            {{-- <div class="hc_installment_btns">
                                <a href="i--00033806--Android-Tivi-Sony-4K-43-inch-KD-43X8000G--0" class="hc_installment_btn">0% installment payment
                                               <span>Thủ tục online đơn giản</span>
                                     </a>
                            </div> --}}
                        </div>
                        <!-- end box info product -->
                        <div class="hc_call_center_new">
                            <p>Offer only available at <span class="hc_color_blue">LONGSHOP</span>, callnow<a href="tel:0934768904"><span class="hc_color_red">0934768904</span></a> for ordering</p>
                        </div>
                                                <h4 class="ddnb">Outstanding features</h4>
                            <div style="text-align: justify">
                                <div class="content hideContent">
                                    <?php
                                        echo $product->product_shortdsc;

                                    ?>
                                </div>

                            <div class="show-more">
                                <a>Show Outstanding features</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
<!-- End giao dien mobi -->

        <aside class="col-sm-4 col-md-3 content-aside" id="column-left">
            <div class="module category-style hidden-xs">
                <h3 class="modtitle">BUY LIKE A KING - CARE LIKE A VIP</h3>
                <div class="modcontent">
                    <div class="box-category">
                        <ul class="policy_new">
                            <li><span><i class="icondetailV3-ld-new"></i></span>
                                <p><b>FREE</b> installation work</p>
                            </li>
                            <li><span><i class="icondetailV3-1d1-new"></i></span>
                                <p>Error is innovation in <b>1 months</b> at your door</p>
                            </li>
                            <li><span><i class="icondetailV3-dt-new"></i></span>
                                <p>Returns and warranties are extremely easy<b>only need phone number</b></p>
                            </li>
                            <li><span><i class="icondetailV3-bh-new"></i></span>
                                <p>Guarantee <b>Genuine TV for 2 years</b>, Someone came to pick it up at home</p>
                            </li>
                            <li><span> <i class="icondetailV3-question-new"></i> </span>
                                <p>Instructions for searching channels, connecting to the network, and downloading applications &amp; Troubleshooting.</p>
                            </li>
                            <li><span> <i class="icondetailV3-hotline-new"></i> </span>
                                <p>Technical switchboard <a href="tel:0934768904">0934768904</a> Free support throughout the period of use.</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>




        </aside>


    </div>
    <div class="row hidden-xs">
        <div class="section-view-more col-sm-12">
            <div class="module deals-layout1">
                <div class="head-title-border">
                    <div class="title-border-under">
                        <span><a href="">Most Searched</a></span>
                    </div>
                </div>

                <div class="modcontent row related_products">
                    <div class="so-deal style1 col-sm-12">
                        <div id="OWL_0" class="slider category-slider-inner products-list yt-content-slider so-category-slider-nobanner hc-no-banner  owl2-responsive-1200 owl2-carousel owl2-theme owl2-loaded" data-autoplay="no" data-autoheight="no" data-delay="4" data-speed="0.6"
                            data-margin="30" data-items_column00="4" data-items_column0="5" data-items_column1="3" data-items_column2="2" data-items_column3="2" data-items_column4="2" data-arrows="yes" data-pagination="no" data-lazyload="yes" data-loop="yes"
                            data-hoverpause="yes">
                            @foreach($related_products as $val)
                            <?php
                                $product_price_temp = DB::table('product_price')->where('id', $val->product_price)->first();
                            ?>
                                <div class="item">
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
                                            </div>

                                        </div>
                                </div>

                                @endforeach

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Product Tabs -->
    <div class="producttab ">
        <div class="tabsslider">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab-1">Product Description</a></li>
                <li class="item_nonactive"><a data-toggle="tab" href="#tab-999">Technical Specifications</a></li>
            </ul>
            <div class="tab-content col-xs-12">
                <div id="tab-1" class="tab-pane fade active in">
                     {!!$product->product_longdsc!!}
                </div>
                <div id="tab-999" class="tab-pane fade">

                    <?php echo $product->product_info; ?>

                </div>

            </div>
            <div class="hc_box_btn-viewmore">
                <p class="text-center" style="padding:10px"><i>Note: Images and specifications are for reference only and are subject to change by the manufacturer without notice. Please check the product carefully before receiving.</i></p>
                <span class="hc_btn-viewmore">More</span>
            </div>
        </div>
    </div>
    <!-- //Product Tabs -->

    <div class="row ">
        <div class="section-view-more col-sm-12">
            <div class="module deals-layout1">
                <div class="head-title-border">
                    <div class="title-border-under">
                        <span><a href="">Related products</a></span>
                    </div>
                </div>

                <div class="modcontent row related_products">
                    <div class="so-deal style1 col-sm-12">
                        <div id="OWL_0" class="slider category-slider-inner products-list yt-content-slider so-category-slider-nobanner hc-no-banner  owl2-responsive-1200 owl2-carousel owl2-theme owl2-loaded" data-autoplay="no" data-autoheight="no" data-delay="4" data-speed="0.6"
                            data-margin="30" data-items_column00="4" data-items_column0="5" data-items_column1="3" data-items_column2="2" data-items_column3="2" data-items_column4="2" data-arrows="yes" data-pagination="no" data-lazyload="yes" data-loop="yes"
                            data-hoverpause="yes">
                            @foreach($related_products as $val)
                            <?php
                                $product_price_temp = DB::table('product_price')->where('id', $val->product_price)->first();
                            ?>
                                <div class="item">
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

                                            </div>

                                        </div>
                                </div>

                                @endforeach

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="seciton-comment">
                <div class="modtitle">
                    <span>Reviews</span>
                </div>
                <div class="well well-sm">
                    <div class="row">
                        <div class="col-xs-12 col-md-4 text-center">
                            <div class="rating-block">
                                @if($rating_star != null)
                                    <h1 class="bold padding-bottom-7 rate-ting">

                                    {{ number_format($rating_star, 1, '.', '')}}
                                    <span class="fa fa-star checked"></span></h1>
                                @else
                                    <h1 class="bold padding-bottom-7 rate-ting" style="font-size: 25px">
                                        There are no reviews yet
                                    </h1>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4" style="padding-left: 25px; border-left: 1px solid #ccc;border-right: 1px solid #ccc;">
                            <div class="pull-left" style="width:100%">
                                <div class="pull-left" style="width:10%; line-height:1;">
                                    <div style="height:9px; margin:5px 0;">5 <span class="glyphicon glyphicon-star"></span></div>
                                </div>
                                <div class="pull-left" style="width:70%;">
                                    <div class="progress" style="height:9px; margin:8px 0;">
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width: {{$pkg_rate_percent[4]}}%">
                                        <span class="sr-only">80% Complete (danger)</span>
                                    </div>
                                    </div>
                                </div>
                                <div class="pull-right" style="width:20%">{{$pkg_rate_count[4]}} reviews</div>
                            </div>
                            <div class="pull-left" style="width:100%">
                                <div class="pull-left" style="width:10%; line-height:1;">
                                    <div style="height:9px; margin:5px 0;">4 <span class="glyphicon glyphicon-star"></span></div>
                                </div>
                                <div class="pull-left" style="width:70%;">
                                    <div class="progress" style="height:9px; margin:8px 0;">
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="5" style="width: {{$pkg_rate_percent[3]}}%">
                                        <span class="sr-only">80% Complete (danger)</span>
                                    </div>
                                    </div>
                                </div>
                                <div class="pull-right" style="width:20%">{{$pkg_rate_count[3]}} reviews</div>
                            </div>
                            <div class="pull-left" style="width:100%">
                                <div class="pull-left" style="width:10%; line-height:1;">
                                    <div style="height:9px; margin:5px 0;">3 <span class="glyphicon glyphicon-star"></span></div>
                                </div>
                                <div class="pull-left" style="width:70%;">
                                    <div class="progress" style="height:9px; margin:8px 0;">
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="5" style="width: {{$pkg_rate_percent[2]}}%">
                                        <span class="sr-only">80% Complete (danger)</span>
                                    </div>
                                    </div>
                                </div>
                                <div class="pull-right" style="width:20%">{{$pkg_rate_count[2]}} reviews</div>
                            </div>
                            <div class="pull-left" style="width:100%">
                                <div class="pull-left" style="width:10%; line-height:1;">
                                    <div style="height:9px; margin:5px 0;">2 <span class="glyphicon glyphicon-star"></span></div>
                                </div>
                                <div class="pull-left" style="width:70%;">
                                    <div class="progress" style="height:9px; margin:8px 0;">
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="5" style="width: {{$pkg_rate_percent[1]}}%">
                                        <span class="sr-only">80% Complete (danger)</span>
                                    </div>
                                    </div>
                                </div>
                                <div class="pull-right" style="width:20%">{{$pkg_rate_count[1]}} reviews</div>
                            </div>
                            <div class="pull-left" style="width:100%">
                                <div class="pull-left" style="width:10%; line-height:1;">
                                    <div style="height:9px; margin:5px 0;">1 <span class="glyphicon glyphicon-star"></span></div>
                                </div>
                                <div class="pull-left" style="width:70%;">
                                    <div class="progress" style="height:9px; margin:8px 0;">
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="5" style="width: {{$pkg_rate_percent[0]}}%">
                                        <span class="sr-only">80% Complete (danger)</span>
                                    </div>
                                    </div>
                                </div>
                                <div class="pull-right" style="width:20%">{{$pkg_rate_count[0]}} reviews</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4" style="padding-left: 25px;">
                            <div class="text-center" style="margin: 10% 4%;">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">reviews</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade bd-example-modal-lg" tabindex="-1" id="cmt-area" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">

                      <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">review {{$product->product_name}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <script type="text/javascript">
                                function uploadImgCmt(){
                                    $('#uploadimg').trigger( "click" );
                                }
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $(document).ready(function(){
                                    $("#uploadimg").on('change',function(){
                                        var formData = new FormData($('#form-cmt')[0]);
                                        var file = $('#uploadimg')[0].files[0];
                                        var d = new Date();
                                        var n = d.getTime();
                                        var newFileName = "comment" + String(n) + ".jpg";
                                        formData.append('file', file, newFileName );
                                        $.ajax({
                                            url: '{{URL::to('/uploadimgcmt')}}',
                                            type: 'POST',
                                            data: formData,
                                            processData: false,
                                            contentType: false,
                                            error: function(data081) {
                                            },
                                            success : function(response) {
                                                console.log(response);
                                                $("#rateimage").val($("#rateimage").val()+"," + response[0]);
                                                $(".img-up").append("<li class='img-cmt'><img src='"+response[1]+"' />");
                                            }
                                        });
                                    });
                                });
                            </script>
                            <form action="{{URL::to('/uploadimgcmt')}}" method="POST" id="form-img" enctype="multipart/form-data">
                                <input type="file" id="uploadimg" style="display: none;"  name="imgcmt"  accept="image/x-png,image/gif,image/jpeg"/>
                            </form>
                            <form action="{{URL::to('/postcomment')}}" id="form-cmt" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="comment-box">
                                    <div class="form-comment-wrap no-border-textarea">
                                        <div class="row">
                                            <div class="col-md-12 col-xs-12">
                                                <div class="customer-rate text-center">
                                                    <p>How do you feel about the product? (choose stars):</p>
                                                    <input type="hidden" id="productid" name="productid" value="{{$product->id}}"/>
                                                    <input type="hidden" id="ratestar" name="ratestar" />
                                                    <input type="hidden" id="rateimage" name="rateimage"/>
                                                    <script type="text/javascript">
                                                        function rate(identifier){
                                                            id = $(identifier).data('id');

                                                                $('.star-rating label').removeClass('check-lable');


                                                                $('.star-rating .fa').removeClass('checked');

                                                            for(i=1; i<=id; i++){
                                                                $('#rate'+i).addClass('checked');
                                                            }
                                                                $('#rate'+id +' label').addClass('check-lable');
                                                                $('#ratestar').val(id);
                                                        }
                                                    </script>
                                                    <div class="star-rating">
                                                        <span class="fa fa-star" onclick="rate(this)" id="rate1" data-id="1">
                                                            <br/>
                                                            <label>Very bad</label>
                                                        </span>
                                                        <span class="fa fa-star" onclick="rate(this)" id="rate2" data-id="2">
                                                            <br/>
                                                            <label>Bad</label>
                                                        </span>
                                                        <span class="fa fa-star" onclick="rate(this)" id="rate3" data-id="3">
                                                            <br/>
                                                            <label>Normal</label>
                                                        </span>
                                                        <span class="fa fa-star" onclick="rate(this)" id="rate4" data-id="4">
                                                            <br/>
                                                            <label>Good</label>
                                                        </span>
                                                        <span class="fa fa-star" onclick="rate(this)" id="rate5" data-id="5">
                                                            <br/>
                                                            <label>Excellent</label>
                                                        </span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="row">
                                            <div class="col-md-4 col-xs-12">
                                                <div class="form-group">
                                                    <input id="rate-name" name="ratename" type="text" class="form-control" placeholder="Name*" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-xs-12">
                                                <div class="form-group">
                                                    <input id="rate-phone" name="ratephone" type="number" class="form-control" placeholder="Phone Number*" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-xs-12">
                                                <div class="form-group">
                                                    <input id="rate-email" name="rateemail" type="text" class="form-control" placeholder="Email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-12">
                                                <ul class="img-up">
                                                    <li>
                                                        <img src="{{asset('/public/admin/img/icon/camera.png')}}" class="btn" onclick="uploadImgCmt()"/>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="not-area">

                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" name="ratecontent" id="rate-content" rows="5" minlength="20" placeholder=" Enter the text comment"></textarea>
                                            <button id="rate-submit" class="btn btn-send-comment">Gửi đi <i class="fa fa-paper-plane"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <script>

                                $("#form-cmt").submit(function(e) {

                                    e.preventDefault(); // avoid to execute the actual submit of the form.

                                    if( $('#ratestar').val() == ""){
                                        $('.not-area').html('<div class="alert alert-danger  text-center" role="alert">Please rate the product five stars!</div>');
                                    }else{

                                        var formData = $('#form-cmt').serialize();

                                        $.ajax({
                                            type: "POST",
                                            url: "{{URL::to('/postcomment')}}",
                                            data: formData,
                                            error: function(data) {
                                                console.log(data);

                                            },
                                            success: function(response) {
                                                console.log(response);
                                                if(response == false){
                                                    $('.not-area').html('<div class="alert alert-danger text-center" role="alert">You can only rate once!</div>');
                                                }else{

                                                    $('#form-cmt').trigger("reset");
                                                    $('.star-rating .fa').removeClass('checked');
                                                    $('.img-cmt').remove();
                                                    $("#ratestar").removeAttr("value");
                                                    $("#rateimage").removeAttr("value");
                                                    $('#cmt-area').modal('hide');

                                                }

                                            }
                                        });
                                    }
                                });

                            </script>
                        </div>
                      </div>
                    </div>
                  </div>


                <div class="comment-box-wrap" style="padding-bottom:0px">

                    @foreach($comments as $value)
                        <div class="comment-box" id="cmt-{{$value->id}}">
                            <div class="rep-comment-line nm-user">
                                <div class="reply-wrap">
                                    <div class="user-line">
                                        <img class="avatar-comment" src="{{asset('/public/admin/img/img_icon/avt_default.png')}}"/><span class="name-of-comment">{{$value->cmt_name}}</span>
                                    </div>
                                    <div class="comment-info">
                                        <h5 class="comment-content">{{$value->cmt_content}}</h5>
                                        <div class="rating-comment">
                                            <?php $width_star = $value->cmt_rate/5 *100; ?>
                                            <span class="score"><span style="width: {{$width_star}}%"></span></span>
                                        </div>
                                        <ul class="comment-react clearfix">
                                            <li class="time-post">
                                                <span id="btn-reply" onclick="openboxrep(this)" data-id="{{$value->id}}">Trả lời</span>
                                                <span id="btn-like" onclick="reactcmt(this)" data-id="{{$value->id}}"><i class="fas fa-thumbs-up"></i> Thích <span class="count-react"></span></span>
                                                <span>{{date("H:m:s d/m/Y",strtotime($value->created_at)) }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="comment-box-reply" id="box-reply" style="display: none;">
                                        <form action="{{URL::to('/post-reply-comment')}}" id="reply-cmt-{{$value->id}}" method="POST">
                                            {{ csrf_field() }}
                                            <div class="row">
                                                <div class="col-md-4 col-xs-12">
                                                    <div class="form-group">
                                                        <input type="hidden" name="commentid" value="{{$value->id}}"/>
                                                        <input class="form-control" id="replyname" type="text" name="replyname" placeholder="Tên của bạn*" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-xs-12">
                                                    <div class="form-group">
                                                        <input class="form-control" id="replyphone" type="number" name="replyphone" placeholder="Số điện thoại*" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-xs-12">
                                                    <div class="form-group">
                                                        <input class="form-control" id="replyemail" type="text" name="replyemail" placeholder="Email"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-xs-12">
                                                    <div class="form-group">
                                                        <textarea class="form-control" name="replycontent" id="replycontent" rows="5" placeholder=" Nhập nội dung bình luận"></textarea>
                                                        <a id="reply-submit" onclick="postreplycomment(this)" class="btn btn-primary btn-send-reply" data-id="{{$value->id}}">Gửi đi <i class="fa fa-paper-plane"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>


                                </div>
                                <?php $reply_comments = DB::table('comment_reply')->where('cmt_rep_ofcmt', $value->id)->get();?>
                                @if(count($reply_comments)>0)
                                    <div class="reply-cmt-box rep-comment-line">
                                        <i class="arrow_box"></i>
                                        @foreach($reply_comments as $value)

                                            <div class=" d-flex">
                                                <div class="comment-info ">
                                                    <h4 class="name-of-comment">
                                                        <b class="author">{{$value->cmt_rep_name}}</b>
                                                    </h4>
                                                    <h5 class="comment-content">{{$value->cmt_rep_content}} </h5>

                                                    <ul class="comment-react clearfix">
                                                        <li class="time-post">
                                                            <span id="btn-like"><i class="fas fa-thumbs-up"></i> Like <span class="count-react"></span></span>
                                                            <span class="time-post">{{date("H:m:s d/m/Y",strtotime($value->created_at))}}</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>


                                        @endforeach
                                    </div>
                                    @else
                                    <div class="reply-cmt-box ">
                                    </div>
                                    @endif
                            </div>
                        </div>
                    @endforeach
                    <script type="text/javascript">

                        function openboxrep(element){
                            id = $(element).data('id');
                            $("#cmt-"+id+" #box-reply").toggle();

                        }
                        function postreplycomment(element){
                            id = $(element).data('id');
                            var formData = $('#reply-cmt-'+id).serialize();

                            $.ajax({
                                type: "POST",
                                url: "{{URL::to('/post-reply-comment')}}",
                                data: formData,
                                error: function(data) {
                                    alert('false');
                                    console.log(data);
                                },
                                success: function(response) {
                                    console.log(response);
                                    $("#cmt-"+id+" .reply-cmt-box").append(response);
                                    $("#cmt-"+id+" .reply-cmt-box").addClass('rep-comment-line');
                                    id = $(element).data('id');
                                    $("#cmt-"+id+" #box-reply").toggle();


                                }
                            });
                        }

                    </script>
                    <script type="text/javascript">
                        $(".show-more a").on("click", function() {
                            var $this = $(this);
                            var $content = $this.parent().prev("div.content");
                            var linkText = $this.text().toUpperCase();

                            if(linkText === "XEM ĐẶC ĐIỂM NỔI BẬT"){
                                linkText = "Ẩn bớt đặc điểm nổi bật";
                                $content.switchClass("hideContent", "showContent", 400);
                            } else {
                                linkText = "Xem đặc điểm nổi bật";
                                $content.switchClass("showContent", "hideContent", 400);
                            };

                            $this.text(linkText);
                        });
                    </script>
                </div>
            </div>

@endsection

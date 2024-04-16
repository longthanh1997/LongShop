
<?php
use App\Http\Controllers\SanphamController;
$sanphamController = new SanphamController();

?>
@extends('layouts.master')
@section('meta')
<link href="{{asset('/public/admin/img/logo/logo.jpg')}}" type="image/png" />
    <title>SEARCHING - LONGSHOP</title>
    <meta NAME="ROBOTS" CONTENT="index,follow" />
    <meta name="title" content="LONGSHOP" />
    <meta name="description" content="LONGSHOP" />
    <meta property="og:image" content="{{asset('/public/admin/img/logo/logo.jpg')}}" />
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1024">
    <meta property="og:image:height" content="1024">
@endsection
@section('content')
<script>
    $( document ).ready(function() {
        $('html').addClass('page category-archive');
    });

</script>

<style>
    .product-content {
        padding-left: 2px !important;
        padding-right: 2px!important;
        padding-bottom: 0px!important;
        padding-top: 0px!important;
    }

    @media only screen and (min-width: 769px){
        .product-box .price-online {
            line-height: 14px;
            font-size: 12px;
        }

        .row-category .product-box {
            height: 340px;
        }

        .col-lg-3.col-md-3.col-sm-3.col-xs-6.item, .col-lg-3.col-md-3.col-sm-3.col-xs-6.item.col-pr {
            padding: 5px;
        }


    }

    @media only screen and (max-width: 990px){
        .row-category .product-box {
            min-height: 250px;
            height: 285px;
        }

        .col-lg-3.col-md-3.col-sm-3.col-xs-6.item.col-pr {
            padding: 5px;
        }

        .giamthem {
            padding-left: 2px;
        }

        .layout-1 .banners4 .col-xs-12 {
            margin-bottom: 5px;
            padding-right: 0;
        }

        .col-lg-3.col-md-3.col-sm-3.col-xs-6.item {
            padding: 5px;
        }
    }
</style>
<div class=" category">

    <div class="row" >
        <ul class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-home"></i></a></li>

        </ul>
    </div>

    <div class="row" >
        <div id="content" class="col-md-9 col-sm-12 col-xs-12">
            <div class="products-category">

                <div class="products-list row nopadding-xs so-filter-gird">
                    <div class="banners4 banners cat-banner-top">
                        <div class="row">

                            <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
                                <a><img class="img-responsive" src="{{asset(DB::table('product_image')->where('id', DB::table('banner')->where('location', 19)->value('image'))->value('product_image'))}}" alt="SSAV"><br></a>
                            </div>


        <!--                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">-->
        <!--                        <a href="-->
        <!--        g--tivi-sony                       -->
        <!--"><img class="img-responsive" src="{{asset('/public/admin/img/banner/cate2.jpg')}}" alt="tivi sony"><br></a>-->
        <!--                    </div>-->

                        </div>
                    </div>


                </div>

                <div id="{{$keyword}}" class="feature-product col-md-12 col-xs-12">

                    <div class="row-category row">
                        <h1  class="title-category">There are {{$count_product}} products for keywords "<span id="keyword">{{$keyword}}</span>" </h1>


                        @if($product_showonload != null)
                            @for($i=0;$i < count($product_showonload); $i++)
                            <?php
                            $val = $product_showonload[$i];
                            $product_price_temp = DB::table('product_price')->where('id', $val->product_price)->first();
                        ?>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 item col-pr" data-position="{{$i}}">
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
                        @endfor
                        @else
                                <h5>There are no products for this category</h5>
                        @endif
                    </div>
                </div>



                @if($count_product- count($product_showonload) > 0 )
                    <div class="text-center col-12"><a class="btn btn-primary" id="pr-load-more" href="javascript:void(0);" onclick="loadmoreProducts()">More </a> </div>
                @endif
            </div>
    </div>
    <script>
        function loadmoreProducts(){
            var position = $('.feature-product .item:last-child').data('position');
            var keyword = $('#keyword').text();
            $.ajax({
                url: "{{URL::to('/loadmoresearchproducts')}}",
                type: 'get',
                data: { "position": position, "area": 'category', "keyword":keyword},
                beforeSend:function(){
                    $("#pr-load-more").text("Loading...");
                },
                error: function(data) {
                    console.log(data);

                },
                success: function(response) {
                    console.log(response);
                    $('.row-category').append(response[0]);
                    if(response[1] >0){
                        $("#pr-load-more").text("More "+response[1] +" Product(S)");
                    }else{
                        $("#pr-load-more").css('display','none');
                    }

                }
            });
        }
    </script>

        <!--Right Part Start haile-->
        <aside class="col-md-3 hidden-xs hidden-sm content-aside" id="column-left">
            <div id="R15130976150000229" aria-live="polite">
                <div id="report_15130976150000229_catch">



                    <div class="module">
                        <h3 class="modtitle hidden-sm hidden-xs">Product sorting </h3>
                        <div class="modcontent ">
                            <div class="table_layout filter-shopby">
                                <div class="table_row">
                                    <!-- - - - - - - - - - - - - - Category filter - - - - - - - - - - - - - - - - -->


                                    <div id="FILTER_BY_SUBCAT" class="table_cell">
                                        <fieldset>
                                            <legend>Related Group</legend>
                                            <?php
                                                // $cate_parent = $category;
                                                // while($cate_parent->category_parent != 0){
                                                //     $cate_parent =DB::table('product_category')->where('id', $cate_parent->category_parent)->first();
                                                // }
                                                $related_category = DB::table('product_category')->where('category_parent', 0)->get();

                                            ?>
                                            <ul class="radio_list">
                                                @foreach($related_category as $val)
                                                <li><a id="MENU_{{$val->id}}_SUBCAT" href="{{URL::to('/'.$val->category_slug)}}" class="main-menu">{{$val->category_name}}</a>
                                                </li>

                                                @endforeach
                                            </ul>
                                        </fieldset>
                                    </div>




                                </div>
                                <!--/ .table_row -->
                            </div>
                            <!--/ .table_layout -->
                        </div>
                    </div>



                </div>

            </div>

        </aside>


    </div>
</div>
@endsection

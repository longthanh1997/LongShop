</head>
<script>
        $('.carousel.carousel-multi-item.v-2 .carousel-item').each(function(){
  var next = $(this).next();
  if (!next.length) {
    next = $(this).siblings(':first');
  }
  next.children(':first-child').clone().appendTo($(this));

  for (var i=0;i<3;i++) {
    next=next.next();
    if (!next.length) {
      next = $(this).siblings(':first');
    }
    next.children(':first-child').clone().appendTo($(this));
  }
});
    </script>

<body class="common-home res layout-1">




    <span id="APEX_SUCCESS_MESSAGE" data-template-id="28714389761362763_S" class="apex-page-success u-hidden"></span><span id="APEX_ERROR_MESSAGE" data-template-id="28714389761362763_E" class="apex-page-error u-hidden"></span>
<?php
        $banner_top = DB::table('banner')->where('location', 9)->first();
        $banner_top_m = DB::table('banner')->where('location', 13)->first();

?>
    <div class="banner-top hidden-xs hidden-sm">
        <img src="{{asset(DB::table('product_image')->where('id',$banner_top->image)->value('product_image'))}}"/>
    </div>

    <div class="banner-top hidden-md hidden-lg">
                <img src="{{asset(DB::table('product_image')->where('id',$banner_top_m->image)->value('product_image'))}}"/>

    </div>
    <div id="wrapper" class="wrapper-fluid banners-effect-5">
        <div class="ssm-overlay ssm-toggle-nav"></div>

        <header id="header" class=" typeheader-1">



            <!--start of middle-->

            <nav class="navbar navbar-default">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header logo col-lg-2 col-md-3 col-sm-3 bottom1">

                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menudt" aria-expanded="false">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                        </button>
                        <a href="{{URL::to('/')}}"><img width="200px" height="50px" src="{{asset('/public/admin/img/logo/logo.png')}}" title="LONGSHOP" alt="LONGVO'S TECH" /></a>

                        <div class="dropdown cart-pro card-mobile hidden-lg hidden-md" onclick="location.href='{{URL::to('/gio-hang')}}'">
                            <a href="{{URL::to('/gio-hang')}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="icon-c"><i class="fa fa-shopping-cart"></i></span>
                                <span class="total-item-card">{{Cart::count()}}</span>
                            </a>
                        </div>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse " id="bs-example-navbar-collapse-1 ">
                        <ul class="nav navbar-nav">

                        </ul>


                        <form action="{{url('/search')}}" method="GET" class="navbar-form navbar-left form-search-pr dropdown">
                                <!--{{ csrf_field() }}-->

                            <div class="search-header-w">
                                <div class="icon-search hidden-lg hidden-md hidden-sm hidden-xs"><i class="fa fa-search"></i></div>
                                <div id="sosearchpro" class="sosearchpro-wrapper so-search ">
                                    <div class="search input-group form-group">

                                        <input id="searchproduct" class="autosearch-input form-control" type="search" value="" size="50" autocomplete="off" placeholder="Search ..." name="keyword">
                                        <button id="SEARCH_BUTTON" class="button-search btn" onclick="void(0);"><i class="fa fa-search"></i>
                                        </button>
                                    </div>

                                </div>
                            </div>
                            <div class="search-area">
                                <ul class="search-drop">

                                </ul>
                            </div>
                        </form>
                        <script>
                            $('#searchproduct').on('keyup',function(){
                                    var key = $(this).val();
                                    if(key.length > 1){
                                        $('.search-drop').css('display', 'block');
                                        $.ajax({
                                            url: "{{URL::to('/searchproduct')}}",
                                            type: 'get',
                                            data: {"key": key},
                                            error: function(data) {
                                                console.log(data);

                                            },
                                            success: function(response) {
                                                console.log(response);
                                                $('.search-drop').html(response);
                                            }
                                        });
                                    }else{
                                        $('.search-drop').empty();
                                    }
                                    $('html').on('click',function() {
                                        $('.search-drop').css('display', 'none');
                                    });

                                });
                        </script>

                        <ul class="nav navbar-nav navbar-right">
                            <li >
                                <a href="tel:1900633940" class="hotline"><img width="210px" src="{{asset('public/admin/img/img_icon/ICONHOTLINE.png')}}"/></a>
                            </li>
                            <li class="dropdown cart-pro" onclick="location.href='{{URL::to('/gio-hang')}}'">
                                <a href="{{URL::to('/gio-hang')}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <span class="icon-c"><i class="fa fa-shopping-cart"></i></span>
                                    Cart
                                    <span class="total-item-card">{{Cart::count()}}</span>
                                </a>
                                <ul class="dropdown-menu cart-drop">
                                    <?php
                                use App\Http\Controllers\SanphamController;
                                $sanphamController = new SanphamController();
                            ?>
                                        @foreach (Cart::content() as $item)
                                        <div class="cart_sub cart-sub-{{$item->id}}">
                                            <div class="cart-sub-avatar" style="padding-right: 5px;">
                                                <a href="{{$sanphamController->getLinkProduct($item->id)}}">
                                            <img style="" src="{{asset($item->options->img_feature)}}" >
                                        </a>
                                            </div>
                                            <div class="cart-sub-content">
                                                <a href="{{$sanphamController->getLinkProduct($item->id)}}"><span class=name_cur>{{$item->name}}</span></a><br/>
                                                <b>Price: </b><span class="price_cur">
                                            {{number_format($item->price, "0", ",", ".")}}$
                                        </span><br />
                                                <b>Quantity: </b><span class="qty_cur">{{$item->qty}}</span>
                                            </div>
                                        </div>
                                        @endforeach

                                        <hr />
                                        <li class="menu-cart-subtotal"><b>Total:</b><span style="float: right;" class="total-cart">{{Cart::subtotal()}}$</span></li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                    <div class="collapse navbar-collapse hidden-lg" id="menudt">

                        <ul class="nav navbar-nav">
                            <?php
                                $main_menu = DB::table('main_menu')->get();
                                $main_category = [];
                                foreach($main_menu as $val){
                                    array_push($main_category, DB::table('product_category')->where('id', $val->id_cate)->first());
                                }
                            ?>
                                @foreach($main_category as $category_parent)
                                    <li><a href="{{URL::to('/'.$category_parent->category_slug)}}">{{$category_parent->category_name}}</a></li>
                                @endforeach
                        </ul>

                    </div>
                </div>
                <!-- /.container-fluid -->
            </nav>
            <nav class="container-fluid nav-mobile hidden-lg hidden-md hidden-sm ">
                <ul class="nav navbar-nav">


                    <div class="search form-group">
                                                        <form action="{{url('/search')}}" method="GET">

                        <div class="row">
                            <div class="col-sm-7 col-xs-7">
                                <input id="searchproduct1" class="autosearch-input form-control" type="search" value="" size="50" autocomplete="off" placeholder="Search product..." name="keyword">
                            </div>
                            <div class="col-sm-5 col-xs-5">
                                <img width="190px" src="{{asset('public/admin/img/img_icon/iconhotlinemobie.png')}}"/>
                            </div>
                        </div>
                        <div class="search-area">
                            <ul class="search-drop search-drop1" >

                            </ul>
                        </div>
                                                        </form>

                    </div>

                </ul>
                <script>
                    $('#searchproduct1').on('keyup',function(){

                            var key = $(this).val();
                            if(key.length > 2){
                                $('.search-drop1').css('display', 'block');
                                $.ajax({
                                    url: "{{URL::to('/searchproduct')}}",
                                    type: 'get',
                                    data: {"key": key},
                                    error: function(data) {
                                        console.log(data);

                                    },
                                    success: function(response) {
                                        console.log(response);
                                        $('.search-drop1').html(response);
                                    }
                                });
                            }else{
                                $('.search-drop1').empty();
                            }
                            $('html').on('click',function() {
                                $('.search-drop1').css('display', 'none');
                            });

                        });
                </script>
            </nav>




            {{--
            <div id="R14970198913747612">
                <div id="report_14970198913747612_catch">

                    <!--start middle-->


                    <div class="header-middle">
                        <div class="container">
                            <div class="row">
                                <div class="navbar-logo col-lg-2 col-md-2 col-sm-2 col-xs-12 hidden-xs">
                                    <div class="logo" style="text-align: center"><a href="{{URL::to('/')}}"><img width="100%" src="{{asset('/public/admin/img/logo/logo.png')}}" title="Hệ Thống Siêu Thị Điện Máy HC" alt="Công ty VHC" /></a></div>
                                </div>



                                <div class="col-lg-4 col-md-6 col-sm-5 col-xs-6 " style="padding-top: 15px;">
                                    <div class="search-header-w">
                                        <div class="icon-search hidden-lg hidden-md hidden-sm hidden-xs"><i class="fa fa-search"></i></div>
                                        <div id="sosearchpro" class="sosearchpro-wrapper so-search ">
                                            <div class="search input-group form-group">

                                                <input id="SEARCH_STRING" class="autosearch-input form-control" type="search" value="" size="50" autocomplete="off" placeholder="Tìm ..." name="search">
                                                <a id="SEARCH_BUTTON" class="button-search btn btn-primary" onclick="void(0);"><i class="fa fa-search"></i>
                                                    </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="middle-left col-lg-3 col-md-2 col-sm-2 col-xs-3 hidden-xs" style="padding-top: 15px;">
                                    <div class="shopping_cart">
                                        <div id="cart" class="btn-shopping-cart">
                                            <h2 class="hotline"><span>Hotline</span><b><a href="tel:1900633940">1900 633 940</a></b></h2>
                                        </div>
                                    </div>
                                </div>


                                <div class="middle-right col-lg-3 col-md-2 col-sm-3 col-xs-3" style="padding-top: 15px;">
                                    <div class="shopping_cart">
                                        <div id="cart" class="btn-shopping-cart">
                                            <a data-loading-text="Loading... " class="btn-group top_cart dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                                <div class="shopcart">
                                                    <span class="icon-c"><i class="fa fa-shopping-cart"></i></span>
                                                    <div class="shopcart-inner">
                                                        <p class="text-shopping-cart">Giỏ hàng</p>
                                                        <span class="total-shopping-cart cart-total-full">
                                                <span class="items_cart">0</span><span class="items_cart2"> item(s)</span><span class="items_carts">(               0)</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </a>
                                            <ul class="dropdown-menu pull-right shoppingcart-box" role="menu">
                                                <li>
                                                    <table class="table table-striped">
                                                        <tbody>


                                                            <tr>
                                                                <td colspan=2 class="text-left">Chưa có sản phẩm</td>
                                                            </tr>



                                                        </tbody>
                                                    </table>
                                                </li>
                                                <li>
                                                    <div>
                                                        <table class="table table-bordered">
                                                            <tbody>

                                                                <tr>
                                                                    <td class="text-left"><strong>Tổng</strong>
                                                                    </td>
                                                                    <td class="text-right"> 0</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>




                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>




                                </div>


                            </div>
                        </div>
                    </div> --}}


                    <!--end middle-->

                    {{-- </div>

            </div> --}}

            <!--end of middle-->

            <div class="header-bottom hidden-sm hidden-xs">
                <div class="container">
                    <div class="row">


                        <div class="bottom1 menu-vertical col-lg-2 col-md-3 col-sm-3">
                            <div class="responsive so-megamenu megamenu-style-dev ">
                                <div class="so-vertical-menu ">
                                    <nav class="navbar-default">
                                        <div class="container-megamenu vertical">


                                            <div id="menuHeading">
                                                <div class="megamenuToogle-wrapper">
                                                    <div class="megamenuToogle-pattern">
                                                        <div class="container">
                                                            <div>
                                                                <span></span>
                                                                <span></span>
                                                                <span></span>
                                                            </div>
                                                            PRODUCTS
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="navbar-header">
                                                <button type="button" id="show-verticalmenu" data-toggle="collapse" class="navbar-toggle">
                                                    <i class="fa fa-bars fa-2x"></i>
                                                    <span>Products</span>
                                                </button>
                                            </div>


                                            <div class="vertical-wrapper">
                                                <span id="remove-verticalmenu" class="fa fa-times"></span>
                                                <div class="megamenu-pattern">
                                                    <div class="container-mega">
                                                        <ul class="megamenu">
                                                            <?php
                                                                    $main_menu = DB::table('main_menu')->get();
                                                                    $main_category = [];
                                                                    foreach($main_menu as $val){
                                                                        array_push($main_category, DB::table('product_category')->where('id', $val->id_cate)->first());
                                                                    }
                                                                ?>
                                                                @foreach($main_category as $category_parent)
                                                                <li class="item-vertical  with-sub-menu hover">
                                                                    <p class="close-menu"></p>
                                                                    <a href="{{URL::to('/'.$category_parent->category_slug)}}" class="clearfix">
                                                                            <span>{{$category_parent->category_name}}</span>
                                                                            <b class="fa-angle-right"></b>
                                                                        </a>
                                                                    <div class="sub-menu" data-subwidth="60">
                                                                        <div class="content">
                                                                            <div class="row">
                                                                                <div class="col-sm-12">

                                                                                    <div class="row">
                                                                                        <?php
                                                                                                $product_category = DB::table('product_category')->where('category_parent',$category_parent->id)->get();
                                                                                            ?> @foreach($product_category as $category)
                                                                                        <div class="col-md-3 static-menu">
                                                                                            <div class="menu">
                                                                                                <ul>

                                                                                                    <li><a href="{{URL::to('/'.$category->category_slug)}}" class="main-menu">{{$category->category_name}}</a>
                                                                                                        <ul>
                                                                                                            <?php
                                                                                                                    $product_category_child = DB::table('product_category')->where('category_parent',$category->id)->get();
                                                                                                                ?> @foreach($product_category_child as $category_child)
                                                                                                            <li class="vertical-menu-lv3"><a href="{{URL::to('/'.$category_child->category_slug)}}">{{$category_child->category_name}}</a></li>
                                                                                                            @endforeach
                                                                                                        </ul>
                                                                                                    </li>

                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                        @endforeach


                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                </li>
                                                                @endforeach

                                                        </ul>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                    </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="main-menu-w col-lg-10 col-md-9 hidden-xs">
                                <div class="responsive so-megamenu megamenu-style-dev">
                                    <nav class="navbar-default">
                                        <div class=" container-megamenu  horizontal open ">
                                            <div class="navbar-header">
                                                <button type="button" id="show-megamenu" data-toggle="collapse" class="navbar-toggle">
                                                                    <span class="icon-bar"></span>
                                                                    <span class="icon-bar"></span>
                                                                    <span class="icon-bar"></span>
                                                            </button>
                                            </div>
                                            <div class="megamenu-wrapper no-trans" style="transition-duration: 0s; transform: translate(-648px, 0px);">
                                                <span id="remove-megamenu" class="fa fa-times"></span>
                                                <div class="megamenu-pattern">
                                                    <div class="container-mega">
                                                        <ul id="MEGA_MENU_REGION" class="megamenu" data-transition="slide" data-animationtime="250">


                                                        </ul>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </nav>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <?php
                        $banner_left = DB::table('banner')->where('location', 10)->first();
                        $banner_right = DB::table('banner')->where('location', 11)->first();
                ?>

                <div class="main-navigation-left hidden-xs hidden-sm hidden-md" style='background: url("{{asset(DB::table('product_image')->where('id',$banner_left->image)->value('product_image'))}}")'>

                </div>
                <div class="main-navigation-right  hidden-xs hidden-sm hidden-md" style='background: url("{{asset(DB::table('product_image')->where('id',$banner_right->image)->value('product_image'))}}")'>

                </div>

        </header>
        <div class="main-container container">


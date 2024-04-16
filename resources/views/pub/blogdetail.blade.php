<?php
use App\Http\Controllers\SanphamController;
$sanphamController = new SanphamController();

?>

@extends('layouts.master')
@section('meta')
<link href="{{asset('public/blog_img/'.$blog->blog_avatar)}}" type="image/png" />
    <title>{{$blog->blog_name}}</title>
    <meta NAME="ROBOTS" CONTENT="index,follow" />
    <meta name="title" content="LONGSHOP" />
    <meta name="description" content="Siêu thị điện máy HC giá rẻ, chính hãng, nhiều khuyến mãi, có trả góp, bảo hành uy tín, chất lượng tại siêu thị điện máy HC. Giao hàng và lắp đặt nhanh chóng" />
    <meta property="og:image" content="{{asset('public/blog_img/'.$blog->blog_avatar)}}" />
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1024">
    <meta property="og:image:height" content="1024">
@endsection
@section('content')
<script>
    $(document).ready(function () {
        $("html").addClass("page category-archive");
    });
</script>

<div class="main-container container" cac-mon-an-vat="">
    <section class="news-choose clearfix">
        <nav aria-label="breadcrumb" class="my-bread">
            <ul class="breadcrumb">
                <li>
                    <a href="n--tin-tuc"><i class="fa fa-home"></i></a>
                </li>

                <li>
                    <a id="" href="{{URL::to('/bai-viet')}}" class="main-menu">Bài viết</a>
                </li>

                <li>
                    <a id="" href="{{URL::to('/bai-viet/'.$blog->blog_slug)}}" class="main-menu">{{$blog->blog_name}}</a>
                </li>
            </ul>
        </nav>
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-9 choose-big">
                    <div class="detail-content-wrap clearfix">
                        <div class="row">
                            <div class="col-sm-12 detail-content-body">
                                <article id="the-post-content" style="text-align: justify;" class="entry content-entry">
                                    <h1 class="title-child-page">
                                        {{$blog->blog_name}}
                                    </h1>
                                    {!! $blog->blog_content!!}
                                    <p style="text-align: right;"><a href="{{URL::to('/')}}" target="_blank">LONGSHOP</a></p>

                                    <div class="row">
                                        <!--relate-new-->
                                        {{--
                                        <div class="col-sm-12 relate-new">
                                            <div class="right-new-choose clearfix">
                                                <div class="section-header">
                                                    <a href="#" target="_blank">
                                                        <h2>Bài viết liên quan</h2>
                                                    </a>
                                                </div>
                                                <div class="right-focus-wrap right-focus-wrap-no-bg row">
                                                    <div class="multi-posts col-sm-3">
                                                        <div class="post-thumbnail">
                                                            <a href="ni--nuong-thit-bang-bep-hong-ngoai">
                                                                <img src="/i/ecommerce/media/2938157_NEWS_74871.jpg" alt="Cách nướng thịt bằng bếp hồng ngoại ngon tuyệt " />
                                                            </a>
                                                        </div>
                                                        <div class="post-entry">
                                                            <a href="ni--nuong-thit-bang-bep-hong-ngoai">
                                                                <h3 class="post-box-title">Cách nướng thịt bằng bếp hồng ngoại ngon khó cưỡng</h3>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="multi-posts col-sm-3">
                                                        <div class="post-thumbnail">
                                                            <a href="ni--nuong-xuc-xich-bang-noi-chien-khong-dau">
                                                                <img src="/i/ecommerce/media/2933750_NEWS_74592.jpg" alt="Chia sẻ cách nướng xúc xích bằng nồi chiên không dầu" />
                                                            </a>
                                                        </div>
                                                        <div class="post-entry">
                                                            <a href="ni--nuong-xuc-xich-bang-noi-chien-khong-dau">
                                                                <h3 class="post-box-title">Nướng xúc xích bằng nồi chiên không dầu cực dễ, thơm ngon</h3>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="multi-posts col-sm-3">
                                                        <div class="post-thumbnail">
                                                            <a href="ni--lam-banh-mi-bo-toi-bang-noi-chien-khong-dau">
                                                                <img src="/i/ecommerce/media/2934067_NEWS_74683.jpg" alt="Cách Làm Bánh Mì Bơ Tỏi Bằng Nồi Chiên Không Dầu THƠM NGON, BÉO NGẬY" />
                                                            </a>
                                                        </div>
                                                        <div class="post-entry">
                                                            <a href="ni--lam-banh-mi-bo-toi-bang-noi-chien-khong-dau">
                                                                <h3 class="post-box-title">Hướng dẫn cách làm bánh mì bơ tỏi bằng nồi chiên không dầu thơm ngon béo ngậy</h3>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="multi-posts col-sm-3">
                                                        <div class="post-thumbnail">
                                                            <a href="ni--nuong-ca-bang-lo-nuong">
                                                                <img src="/i/ecommerce/media/2931786_NEWS_74305.jpg" alt="Bí quyết nướng cá bằng lò nướng đơn giản" />
                                                            </a>
                                                        </div>
                                                        <div class="post-entry">
                                                            <a href="ni--nuong-ca-bang-lo-nuong">
                                                                <h3 class="post-box-title">Chia sẻ cách nướng cá bằng lò nướng thơm ngon khó cưỡng</h3>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        --}}
                                        <!--end-relate-new-->
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3 choose-sm">
                    <div class="right-new-choose clearfix">
                        <div class="section-header">
                            <a href="n--tin-tuc">
                                <h2>Bài Mới nhất</h2>
                            </a>
                        </div>
                        <ul class="right-focus-wrap clearfix">
                            @foreach($blogs_new as $val)
                                <li class="multi-posts clearfix">
                                    <div class="post-thumbnail">
                                        <a href="{{URL::to('/bai-viet/'.$val->blog_slug)}}" rel="nofollow">
                                            <img src="{{asset('public/blog_img/'.$val->blog_avatar)}}" alt="{{$val->blog_name}}" />
                                        </a>
                                    </div>
                                    <div class="post-entry">
                                        <a href="{{URL::to('/bai-viet/'.$val->blog_slug)}}" rel="nofollow">
                                            <h3 class="post-box-title">{{$val->blog_name}}</h3>
                                        </a>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

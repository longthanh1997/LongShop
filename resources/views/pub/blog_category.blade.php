<?php
use App\Http\Controllers\SanphamController;
$sanphamController = new SanphamController();

?>

@extends('layouts.master')
@section('meta')
<link href="{{asset('/public/admin/img/logo/logo.jpg')}}" type="image/png" />
    <title>Posts - Longshop</title>
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
    $(document).ready(function () {
        $("html").addClass("page category-archive");
    });
</script>

<div class="main-container container blog-category">


    <section id="wrap-page-exp" class="clearfix h2-light">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-12 border-right-e6">
                    <div class="row row-2light">
                        <div class="col-sm-9 pt-15">
                            <div class="main-banner-wrap">
                                <div class="section-header">
                                    <h2>Highlighted</h2>
                                </div>
                                <div class="sub-banner-wrap">
                                    <a href="{{URL::to('bai-viet/'.$blogs[0]->blog_slug)}}" class="post-thumb"><img src="{{asset('public/blog_img/'.$blogs[0]->blog_avatar)}}" alt="{{$blogs[0]->blog_name}}" /></a>
                                    <a href="{{URL::to('bai-viet/'.$blogs[0]->blog_slug)}}"><h3 class="h2light-title">{{$blogs[0]->blog_name}}"</h3></a>
                                </div>
                            </div>
                            <div class="sub-2light">
                                <div class="row">
                                    <div class="sub-banner-wrap col-sm-6">
                                        <a href="{{URL::to('bai-viet/'.$blogs[1]->blog_slug)}}"class="post-thumb"><img src="{{asset('public/blog_img/'.$blogs[1]->blog_avatar)}}" alt="{{$blogs[1]->blog_name}}" /></a>
                                        <a href="{{URL::to('bai-viet/'.$blogs[1]->blog_slug)}}"><h3 class="sub-2light-title">{{$blogs[1]->blog_name}}</h3></a>
                                    </div>
                                    <div class="sub-banner-wrap col-sm-6">
                                        <a href="{{URL::to('bai-viet/'.$blogs[2]->blog_slug)}}"class="post-thumb"><img src="{{asset('public/blog_img/'.$blogs[2]->blog_avatar)}}" alt="{{$blogs[2]->blog_name}}" /></a>
                                        <a href="{{URL::to('bai-viet/'.$blogs[2]->blog_slug)}}"><h3 class="sub-2light-title">{{$blogs[2]->blog_name}}</h3></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3 relate-new pt-15">
                            <ul class="right-focus-wrap clearfix">
                                <div class="section-header">
                                    <h2>Most views</h2>
                                </div>

                                <li class="multi-posts clearfix">
                                    <div class="post-thumbnail">
                                        <span class="hot-news">HOT</span>
                                        <a href="{{URL::to('bai-viet/'.$blogs[0]->blog_slug)}}" rel="nofollow">
                                            <img src="{{asset('public/blog_img/'.$blogs[0]->blog_avatar)}}" alt="{{$blogs[0]->blog_name}}" />
                                        </a>
                                    </div>
                                    <div class="post-entry">
                                        <a href="{{URL::to('bai-viet/'.$blogs[0]->blog_slug)}}" rel="nofollow">
                                            <h3 class="post-box-title">{{$blogs[0]->blog_name}}</h3>
                                        </a>
                                    </div>
                                </li>

                                <li class="multi-posts clearfix">
                                    <div class="post-thumbnail">
                                        <span class="hot-news">HOT</span>
                                        <a href="{{URL::to('bai-viet/'.$blogs[1]->blog_slug)}}" rel="nofollow">
                                            <img src="{{asset('public/blog_img/'.$blogs[1]->blog_avatar)}}" alt="{{$blogs[1]->blog_name}}" />
                                        </a>
                                    </div>
                                    <div class="post-entry">
                                        <a href="{{URL::to('bai-viet/'.$blogs[1]->blog_slug)}}" rel="nofollow">
                                            <h3 class="post-box-title">{{$blogs[1]->blog_name}}</h3>
                                        </a>
                                    </div>
                                </li>

                                <li class="multi-posts clearfix">
                                    <div class="post-thumbnail">
                                        <span class="hot-news">HOT</span>
                                        <a href="{{URL::to('bai-viet/'.$blogs[2]->blog_slug)}}" rel="nofollow">
                                            <img src="{{asset('public/blog_img/'.$blogs[2]->blog_avatar)}}" alt="{{$blogs[2]->blog_name}}" />
                                        </a>
                                    </div>
                                    <div class="post-entry">
                                        <a href="{{URL::to('bai-viet/'.$blogs[2]->blog_slug)}}" rel="nofollow">
                                            <h3 class="post-box-title">{{$blogs[2]->blog_name}}</h3>
                                        </a>
                                    </div>
                                </li>
                                <li class="multi-posts clearfix">
                                    <div class="post-thumbnail">
                                        <span class="hot-news">HOT</span>
                                        <a href="{{URL::to('bai-viet/'.$blogs[3]->blog_slug)}}" rel="nofollow">
                                            <img src="{{asset('public/blog_img/'.$blogs[3]->blog_avatar)}}" alt="{{$blogs[3]->blog_name}}" />
                                        </a>
                                    </div>
                                    <div class="post-entry">
                                        <a href="{{URL::to('bai-viet/'.$blogs[3]->blog_slug)}}" rel="nofollow">
                                            <h3 class="post-box-title">{{$blogs[3]->blog_name}}</h3>
                                        </a>
                                    </div>
                                </li>
                                <li class="multi-posts clearfix">
                                    <div class="post-thumbnail">
                                        <span class="hot-news">HOT</span>
                                        <a href="{{URL::to('bai-viet/'.$blogs[4]->blog_slug)}}" rel="nofollow">
                                            <img src="{{asset('public/blog_img/'.$blogs[4]->blog_avatar)}}" alt="{{$blogs[4]->blog_name}}" />
                                        </a>
                                    </div>
                                    <div class="post-entry">
                                        <a href="{{URL::to('bai-viet/'.$blogs[4]->blog_slug)}}" rel="nofollow">
                                            <h3 class="post-box-title">{{$blogs[4]->blog_name}}</h3>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        <div class="new-line-row">
                            @foreach ($allblogs as $val)
                            <article class="item-list">
                                    <div class="post-thumbnail">
                                        <a href="{{URL::to('bai-viet/'.$val->blog_slug)}}" rel="nofollow">
                                            <img data-src="" src="{{asset('public/blog_img/'.$val->blog_avatar)}}" class="lazyloaded" alt="{{$val->blog_name}}" />
                                        </a>
                                    </div>
                                <div class="post-entry">
                                    <a href="{{URL::to('bai-viet/'.$val->blog_slug)}}" rel="nofollow">
                                        <h3 class="post-box-title">{{$val->blog_name}}</h3>
                                    </a>
                                    <p class="post-meta">
                                        <span class="tie-date"><i class="fa fa-clock-o"></i><span class="p-time">{{date('d/m/Y H:i:s', strtotime($val->created_at))}}</span></span>
                                    </p>
                                    <p class="post-excerpt">{{$val->blog_note}}</p>
                                </div>
                            </article>
                            @endforeach
                            {{ $allblogs->render()}}
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
</div>

@endsection

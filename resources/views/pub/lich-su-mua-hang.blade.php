<?php
    $curUser = DB::table('users')->where('phone', session('phone')['phone'])->get();
    $infoUser = $curUser[0];
?>

@extends('layouts.master')
@section('meta')
<link href="{{asset('/public/admin/img/logo/logo.jpg')}}" type="image/png" />
    <title>Lịch sử mua hàng - LONGSHOP</title>
    <meta NAME="ROBOTS" CONTENT="index,follow" />
    <meta name="title" content="LONGSHOP" />
    <meta name="description" content="LONGSHOP" />
    <meta property="og:image" content="{{asset('/public/admin/img/logo/logo.jpg')}}" />
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1024">
    <meta property="og:image:height" content="1024">
@endsection
@section('content')

    <section class="wrapper cate">
        <div class="container">
            <div class="right">

                <div class="user" data-customer="1019761405">
                    Chào {{ substr(strtolower($infoUser->name), 0, 3) }}
                    <b>Quốc Minh</b> - <b>{{session('phone')['phone']}}</b>
                    <a href="/lich-su-mua-hang/dang-xuat" class="logout-h">Thoát tài khoản</a>
                </div>

                <div class="result"></div>

                <div class="list" id="list_order" style="overflow-x: auto;"> <b>Đơn hàng Online đã mua gần đây</b>
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            @foreach ($curUser as $item)
                                @php
                                    $bill = DB::table('bill')->where('id_ofuser',$item->id)->first();
                                    $billDetails = DB::table('chitiet_bill')->where('id_ofbill', $bill->id)->get();
                                    $name = array();
                                @endphp
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Sản phẩm</th>
                                <th>Giá</th>
                                <th>Ngày đặt mua</th>
                                <th>Trạng thái</th>
                            </tr>
                            <tr class="" data-id="38766967">
                                <td>
                                    <a href="{{route('history.detail', $bill->id)}}">#{{$bill->id}}</a>
                                </td>

                                <td>
                                    <div>
                                        <a href="{{route('history.detail', $bill->id)}}">
                                            @foreach ($billDetails as $detail)
                                                @php
                                                    array_push($name, DB::table('product')->where('id',$detail->id_ofproduct)->value('product_name'))
                                                @endphp
                                            @endforeach
                                            {{implode(", ",$name)}}
                                        </a>

                                        <div class="link">
                                            <a href="{{route('history.detail', $bill->id)}}">Show detail</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <b>{{number_format($bill->bill_total, "0", ",", ".")}}$</b>
                                </td>
                                <td><span>{{date_format(new DateTime($bill->created_at), 'd/m/Y')}}</span></td>
                                <td>
                                    @if ($bill->bill_status == 1)
                                        <i class="success">Nhận đơn</i>
                                    @elseif($bill->bill_status == 2)
                                        <i class="success">Chờ thanh toán</i>

                                    @elseif($bill->bill_status == 3)
                                        <i class="success">Chờ đóng gói</i>

                                    @elseif($bill->bill_status == 4)
                                        <i class="success">Đang vận chuyển</i>

                                    @elseif($bill->bill_status == 5)
                                        <i class="success">Đã hoàn tất</i>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
    <div class="alert_box">
        <div class="alert_box__container">
            <i class="icon-close" onclick="$(this).parent().parent().hide()"></i>
            <div class="content"></div>
        </div>
    </div>

@endsection

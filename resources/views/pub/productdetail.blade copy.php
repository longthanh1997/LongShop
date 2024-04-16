<?php
use App\Http\Controllers\SanphamController;
$sanphamController = new SanphamController();

?>
@extends('layouts.master')
@section('content')
<link rel="stylesheet" href="{{URL::to('/resources/css/product.css')}}" />



        <section id=main-container class=themNoel>
            <ul class=breadcrumb>
                @foreach($breadscrumb as $value)
                <li><a href="{{URL::to('/'.$value->category_slug)}}" >{{$value->category_name}}</a><span>›</span>
                @endforeach
                    <li>{{$product->product_name}}
             </ul>
            <h1>{{$product->product_name }}</span></span>
            </h1><i class=icondmx-labelunique></i>
            <div class=likeshare>
                <div id=fb-root></div>
                <div class=fb-like data-href=/tivi/ffalcon-43sf1 data-layout=button_count data-action=like data-show-faces=true data-share=true></div>
            </div>
            <div class=clr></div>
            <div class=rowdetail>
                <aside class=picture>
                    <div class=loading-zone style=display:none><span class=cswrap><span class=csdot></span><span class=csdot></span><span class=csdot></span></span>
                    </div>
                    <div class=characteristics>
                        <div class="fotorama"  data-nav="thumbs" data-allowfullscreen="true" data-transition="crossfade" >
                            @foreach(explode(',',$product->product_gallery) as $image_id)
                                <img src="{{asset(DB::table('product_image')->where('id', $image_id)->value('product_image'))}}"  data-fit="cover">
                            @endforeach
                        </div>
                    </div>


                    <div class="key-selling kmh">
                        <div class=title_text>Đặc điểm nổi bật</div>
                        <?php echo $product->product_shortdsc;?>

                        <div class=ovlarticle></div>
                    </div>
                    <div><a href="" class=viewmorekeyselling>See more highlights</a></div>

                </aside>
                <aside class=price_sale><input type=hidden id=OnlineAreaSalePriceBK value=0.0>
                    <div id=dong class=c_m>
                        <div class="memory memory3 others">

                            {{-- <div class=m_default>Có <b>3 k&#237;ch cỡ m&#224;n h&#236;nh.</b> Bạn đang chọn <b class="bMeasureInfo normal">43&quot; </b></div> --}}
                            @if($product->product_group != null)
                            <div class="reprelst normal lesspro flex-1">
                                @foreach(explode(',',$product->product_group) as $value)
                                <?php
                                    $product_temp = DB::table('product')->where('id', $value)->first();
                                    $product_price_temp = DB::table('product_price')->where('id', $product_temp->product_price)->first();
                                ?>
                                <a class="item i2 nopromo" href="{{URL::to($sanphamController->getLinkProduct($value))}}">
                                    <span>
                                        @if($product->id == $product_temp->id)
                                        <sub class="icondetail-check"></sub>
                                        @else
                                        <i class=icon-opt></i>
                                        @endif
                                        <label class=rname>{{$product_temp->product_group_name}}
                                            <span> </span>
                                        </label>
                                    </span>
                                    <strong class=rprice>{{number_format($product_price_temp->price_promotion,0,",",".")}} $</strong>
                                </a>
                                @endforeach
                            </div>
                            <div class="area_price">
                                <div class="dl">Giá<b>:</b></div>
                                <strong class="kmgiagach"> {{number_format($product_price->price_promotion,0,",",".")}}$ </strong>
                                <strong class="dl"> {{number_format($product_price->price_regular,0,",",".")}}$ <b>-{{number_format((100 - ($product_price->price_promotion/$product_price->price_regular*100)),2,",",".")}}%</b> </strong>
                                <label class="install">0% installment payment</label><div class="bannercp"></div>
                            </div>
                            @else
                            <div class="area_price">
                                <div class="dl">Giá<b>:</b></div>
                                <strong class="kmgiagach"> {{number_format($product_price->price_promotion,0,",",".")}}$ </strong>
                                <strong class="dl"> {{number_format($product_price->price_regular,0,",",".")}}$ <b>-{{number_format((100 - ($product_price->price_promotion/$product_price->price_regular*100)),2,",",".")}}%</b> </strong>
                                <label class="install">0% installment payment</label><div class="bannercp"></div>
                            </div>
                            @endif

                        </div>
                    </div>
                    <div class=clr></div>
                    <div class=area_price>
                        {{-- <div class=dl>Gi&#225; tại <b class=province>TP. HCM</b><b>:</b></div><strong class=kmgiagach> 220$</strong> <strong class=dl> 255$ <b>-17%</b> </strong> <label class=install>0% installment payment</label>
                        <div class=bannercp></div> --}}
                    </div>
                    <div class="area_promotion newpro zero">
                        <strong> KHUYẾN MÃI</strong>
                        <div class=promo-content>
                            <?php echo $product->product_offer;?>
                        </div>
                    </div>
                    <div class="area_order 11">
                        <a href="/dat-hang?productId=215941" class="buy_now"> Buy now <span class="buy_now_subtext"> Delivery to your door </span> </a>
                    </div>



                    <div class=callorder><span>Call to order: <i class=icondetailV3-callme></i><a href=tel:0934768904>0934768904</a> (7:30am-22:00)pm</span></div>
                </aside>
                <aside class="checkexist show-cod">
                    {{-- <div class=checkstockbox><a class=popup2store href=javascript:><i class=icondetailV3-store></i>Xem si&#234;u thị c&#243; h&#224;ng trưng b&#224;y</a>
                        <div id=istock>
                            <div class=coverlay></div>
                            <div id=boxstock></div>
                        </div>
                    </div> --}}
                    <div class="policy_intuitive cate1942">
                        <div class=for-mobile>
                            <h4>Buy like a King - care like a VIP</h4>
                            <ul class=policy_new>
                                <li><span><i class=icondetailV3-ld-new></i></span>
                                    <p><b>FREE</b> installation work
                                        <li><span><i class=icondetailV3-1d1-new></i></span>
                                            <p>Error is innovation in <b>1 th&#225;ng</b> tận nh&#224; <a href=javascript: onclick=showPopupPolicy() title="Chính sách đổi trả"> <b data-tooltip-stickto=top data-tooltip-maxwidth=300 data-tooltip="
Trong tháng đầu tiên, nếu sản phẩm lỗi do nhà sản xuất, quý khách sẽ được đổi sản phẩm tương đương (cùng model, cùng màu, …) miễn phí."> Watch Detail </b> </a>
                                                <li><span><i class=icondetailV3-dt-new></i></span>
                                                    <p>asdfasdfasdf&#224; asdfasdfasdf&#224;asdf <b>test1</b>
                                                        <li><span><i class=icondetailV3-bh-new></i></span>
                                                            <p>warranty <b>real HOT DEAL</b>,Support full service
                                                                <li><span> <i class=icondetailV3-question-new></i> </span>
                                                                    <p>Support every things that you need
                                                                        <li><span> <i class=icondetailV3-hotline-new></i> </span>
                                                                            <p>Technical Center <a href=tel:18001764>0934768904</a> Free support throughout the period of use.</ul>
                        </div>
                        <ul class=policy>
                            <li><i class=icondetailV3-check-new></i>
                                <p>Th&#249;ng tivi có: <b>S&#225;ch hướng dẫn, Remote, Ch&#226;n đế</b>
                                    <li><i class=icondetailV3-check-new></i>
                                        <p><b> Bảo hành Remote 1 năm </b> - <a href="https://www.dienmayxanh.com/bao-hanh/ffalcon?key=Tivi" title="See detailed warranty information">See warranty points</a></ul>
                    </div>

                </aside>
                <div class=clr></div>
            </div>
            <div class=clr></div>

            <div class="productrelate electric">
                <div class=bar>
                    <h2>Similar product</h2>
                </div>
                <ul class="cate slider-new">
                    @foreach($related_products as $value)
                    <?php
                        $product_price_temp = DB::table('product_price')->where('id', $value->product_price)->first();
                    ?>
                        <li>
                            <a href="{{URL::to($sanphamController->getLinkProduct($value->id))}}">
                                <div class=thumbnail-product>

                                    <img width=100 height=100 class src="{{asset(DB::table('product_image')->where('id', $value->product_avatar)->value('product_image'))}}">
                                </div>
                                <label class=install> installment <b>0%</b> </label>
                                <div class=lblgiftfix></div>
                                <div class=name-product>
                                {{-- <img data-src=https://cdn.tgdd.vn/Brand/2/Mobell1942-s_52.png alt=Mobell width=25 height=25 class=manulogo>  --}}
                                <span class=prop>{{$value->product_name}}</span>
                                <label class=code>({{$value->product_sku}})</label></div>
                                <strong class=rc> {{number_format($product_price_temp->price_promotion,0,",",".")}}$ </strong>
                                <strong class=oldprice>{{number_format($product_price_temp->price_regular,0,",",".")}}$  </strong>
                                <span class=price-percent>-{{number_format((100 - ($product_price_temp->price_promotion/$product_price_temp->price_regular*100)),2,",",".")}}%</span></a>
                                <p class=rating-lst>
                                <span><b>4.3</b>/5<i class=icondmx-star></i></span>
                                <span class=sl-rating>7 reviews</span>
                    @endforeach
                        </ul>
            </div>
            <div class=box_content>
                <aside class=left_content>
                    <?php echo $product->product_longdsc;?>
                </aside>
                <aside class=right_content>
                    <div id=thong-so-ky-thuat class=tableparameter>
                        <h2>Technical Specifications</h2>
                        <?php echo $product->product_info; ?>
                        <button type=button class=viewparameterfull>See detailed technical specifications</button>
                    </div>
                    <div id=news></div>
                </aside>
            </div>
        </section>
        <div class=closebtn><span>✖</span>Close</div>
        <div class=fullparameter>
            <div class=scroll>
                <h3>Thông số kỹ thuật chi tiết Smart Tivi FFalcon 43 inch 43SF1</h3>
                <ul class=specs>
                    <li class=grp>Tổng quan
                        <li><span class=specname data-tooltip="&lt;p>C&amp;aacute;c c&amp;ocirc;ng nghệ m&amp;agrave;n h&amp;igrave;nh kh&amp;aacute;c nhau như CRT, LCD, LED, Plasma, OLED mang đến c&amp;aacute;c trải nghiệm kh&amp;aacute;c nhau cho người d&amp;ugrave;ng.&lt;/p>"
                                data-tooltip-stickto=right data-tooltip-maxwidth=400>Loại Tivi:</span><span class="specval prop-6539" data-val=4><a href=https://www.dienmayxanh.com/kinh-nghiem-hay/mot-so-loai-tivi-pho-bien-hien-nay-793656#smart-tivi title="Smart Tivi" target=_blank>Smart Tivi</a></span>
                            <li><span class=specname>Kích cỡ màn hình:</span><span class="specval prop-6540" data-val=43>43 inch</span>
                                <li><span class=specname data-tooltip="&lt;p>Độ ph&amp;acirc;n giải l&amp;agrave; số lượng điểm ảnh tr&amp;ecirc;n m&amp;agrave;n h&amp;igrave;nh bằng số lượng điểm ảnh chiều ngang nh&amp;acirc;n với số lượng điểm ảnh chiều dọc (cao) v&amp;agrave; c&amp;oacute; đơn vị l&amp;agrave; Pixel (px). Trong đ&amp;oacute; số lượng điểm ảnh chiều dọc thường được ch&amp;uacute; &amp;yacute; do c&amp;oacute; li&amp;ecirc;n quan đến kỹ thuật qu&amp;eacute;t h&amp;igrave;nh v&amp;agrave; chất lượng của h&amp;igrave;nh ảnh.&lt;/p>"
                                        data-tooltip-stickto=right data-tooltip-maxwidth=400>Độ phân giải:</span><span class="specval prop-6541" data-val=6><a href=https://www.dienmayxanh.com/kinh-nghiem-hay/diem-mat-nhung-do-phan-giai-pho-bien-hien-nay-tren-577178#full-hd title="Full HD" target=_blank>Full HD</a></span>
                                    <li class=grp>Kết nối
                                        <li><span class=specname>Kết nối Internet:</span><span class="specval prop-8886" data-val=1><a href=https://www.dienmayxanh.com/kinh-nghiem-hay/lan-la-gi-596356 title="Cổng LAN, Wifi" target=_blank>Cổng LAN, Wifi</a></span>
                                            <li><span class=specname>Cổng AV:</span><span class="specval prop-8887" data-val=1><a href=https://www.dienmayxanh.com/kinh-nghiem-hay/diem-mat-nhung-ket-noi-co-ban-tren-tivi-phan-2-633476#composite title="Có cổng Composite" target=_blank>Có cổng Composite</a></span>
                                                <li><a href=https://www.dienmayxanh.com/kinh-nghiem-hay/diem-mat-nhung-ket-noi-co-ban-tren-tivi-576709#HDMI class=linkTT target=_blank> <span class=specname data-tooltip="&lt;p>&lt;strong>HDMI&lt;/strong>&amp;nbsp;(l&amp;agrave; từ viết tắt của&amp;nbsp;&lt;strong>High-Definition Multimedia Interface&lt;/strong>) chỉ một ng&amp;otilde; cắm HDMI ho&amp;agrave;n to&amp;agrave;n tương th&amp;iacute;ch với m&amp;aacute;y vi t&amp;iacute;nh, m&amp;agrave;n h&amp;igrave;nh hiển thị v&amp;agrave; những thiết bị điện tử gia đ&amp;igrave;nh theo chuẩn Giao Tiếp H&amp;igrave;nh Ảnh KTS (DVI).&lt;/p>" data-tooltip-stickto=right data-tooltip-maxwidth=400>Cổng HDMI:</span></a>
                                                    <span class="specval prop-6554" data-val=2>2 cổng</span>
                                                    <li><span class=specname>Cổng xuất âm thanh:</span><span class="specval prop-8892" data-val=1><a href=https://www.dienmayxanh.com/kinh-nghiem-hay/cach-ket-noi-tivi-voi-dan-am-thanh-qua-jack-cam-3-663425 title="Jack loa 3.5 mm" target=_blank>Jack loa 3.5 mm</a></span>
                                                        <li><a href=https://www.dienmayxanh.com/kinh-nghiem-hay/diem-mat-nhung-ket-noi-co-ban-tren-tivi-576709#usb class=linkTT target=_blank> <span class=specname>USB:</span></a><span class="specval prop-6558"
                                                                data-val=2>2 cổng</span>
                                                            <li><span class=specname data-tooltip="&lt;p>Tivi được t&amp;iacute;ch hợp sẵn DVB-T2 gi&amp;uacute;p&amp;nbsp;cho chất lượng t&amp;iacute;n hiệu, h&amp;igrave;nh ảnh, &amp;acirc;m thanh tăng tối thiểu 30% trong c&amp;ugrave;ng điều kiện thu s&amp;oacute;ng so với truyền h&amp;igrave;nh Analog cũ.&lt;/p>"
                                                                    data-tooltip-stickto=right data-tooltip-maxwidth=400>Tích hợp đầu thu kỹ thuật số:</span><span class="specval prop-7226" data-val=1><a href=https://www.dienmayxanh.com/kinh-nghiem-hay/dvb-t2-la-gi-574834 title=DVB-T2 target=_blank>DVB-T2</a></span>
                                                                <li class=grp>Tính năng thông minh (Cập nhật 5/2020)
                                                                    <li><span class=specname>Hệ điều hành, giao diện:</span><span class="specval prop-7740" data-val=0><a href=https://www.dienmayxanh.com/kinh-nghiem-hay/co-gi-dac-biet-tren-he-dieu-hanh-tv-os-cua-smart-t-1136013 title="TV+ OS" target=_blank>TV+ OS</a></span>
                                                                        <li><span class=specname>Các ứng dụng sẵn có:</span><span class="specval prop-8888" data-val=0>YouTube, Netflix, Zing TV, FPT Play, Clip TV</span>
                                                                            <li><span class=specname>Remote thông minh:</span><span class="specval prop-8890" data-val=0>Không dùng được</span>
                                                                                <li><span class=specname>Điều khiển tivi bằng điện thoại:</span><span class="specval prop-8891" data-val=1><a href=https://www.dienmayxanh.com/kinh-nghiem-hay/cach-dieu-khien-smart-tivi-tcl-chay-he-dieu-hanh-t-1131359 title="Bằng ứng dụng T-Cast" target=_blank>Bằng ứng dụng T-Cast</a></span>
                                                                                    <li><span class=specname>Kết nối không dây với điện thoại, máy tính bảng:</span><span class="specval prop-7739" data-val=0><a href=https://www.dienmayxanh.com/kinh-nghiem-hay/cach-dieu-khien-smart-tivi-tcl-2016-bang-dien-thoa-832578 title="Bằng ứng dụng T-cast" target=_blank>Bằng ứng dụng T-cast</a></span>
                                                                                        <li><a href=https://www.dienmayxanh.com/kinh-nghiem-hay/ket-noi-chuot-ban-phim-voi-smart-tivi-de-thao-tac-796330 class=linkTT target=_blank> <span class=specname>Kết nối Bàn phím, chuột:</span></a>
                                                                                            <span class="specval prop-8099" data-val=1>Có thể kết nối (sử dụng tốt nhất trong trình duyệt web)</span>
                                                                                            <li class=grp>Công nghệ hình ảnh, âm thanh
                                                                                                <li><span class=specname data-tooltip="&lt;p>C&amp;ocirc;ng nghệ xử l&amp;yacute; h&amp;igrave;nh ảnh gi&amp;uacute;p cho tivi mang đến cho người d&amp;ugrave;ng những trải nghiệm tốt hơn về h&amp;igrave;nh ảnh, m&amp;agrave;u sắc v&amp;agrave; độ chi tiết.&lt;/p>"
                                                                                                        data-tooltip-stickto=right data-tooltip-maxwidth=400>Công nghệ hình ảnh:</span><span class="specval prop-6545" data-val=0><a href=https://www.dienmayxanh.com/kinh-nghiem-hay/nhung-cong-nghe-hinh-anh-tren-tivi-tcl-2018-1108287#micro-dimming title="Micro Dimming" target=_blank>Micro Dimming</a>, <a href=https://www.dienmayxanh.com/kinh-nghiem-hay/tivi-ffalcon-cua-nuoc-nao-co-tot-khong-1240393#cong-nghe-hinh-anh-true-color title="True color" target=_blank>True color</a></span>
                                                                                                    <li><span class=specname data-tooltip="&lt;p>C&amp;ocirc;ng nghệ &amp;acirc;m thanh l&amp;agrave; điều cực kỳ b&amp;iacute; mật, c&amp;aacute;c h&amp;atilde;ng gần như kh&amp;ocirc;ng tiết lộ ra ngo&amp;agrave;i v&amp;igrave; c&amp;oacute; thể bị c&amp;aacute;c đối thủ bắt chước.&amp;nbsp;&amp;nbsp;Từ những c&amp;ocirc;ng nghệ &amp;acirc;m thanh đơn giản như Stereo, cho đến Surround hay&amp;nbsp;Dolby Digital 5.1...đều mang đến những trải nghiệm kh&amp;aacute;c nhau về &amp;acirc;m thanh cho người d&amp;ugrave;ng.&lt;/p>"
                                                                                                            data-tooltip-stickto=right data-tooltip-maxwidth=400>Công nghệ âm thanh:</span><span class="specval prop-6547" data-val=0><a href=https://www.dienmayxanh.com/kinh-nghiem-hay/cac-cong-nghe-am-thanh-duoc-ung-dung-tren-tivi-sam-577175#dolby-ms10-ms11 title="Dolby MS11" target=_blank>Dolby MS11</a></span>
                                                                                                        <li><span class=specname>Tổng công suất loa:</span><span class="specval prop-6548" data-val=-1>8W + 8W</span>
                                                                                                            <li class=grp>Thông tin chung
                                                                                                                <li><span class=specname>Công suất:</span><span class="specval prop-7639" data-val=-1>75W</span>
                                                                                                                    <li><span class=specname>Kích thước có chân, đặt bàn:</span><span class="specval prop-6563" data-val=-1>Ngang 97 cm - Cao 62.3 cm - Dày 19.4 cm</span>
                                                                                                                        <li><span class=specname>Khối lượng có chân:</span><span class="specval prop-6564" data-val=-1>7.2 Kg</span>
                                                                                                                            <li><span class=specname>Kích thước không chân, treo tường:</span><span class="specval prop-6565" data-val=-1>Ngang 97 cm - Cao 56.8 cm - Dày 7.6 cm</span>
                                                                                                                                <li><span class=specname>Khối lượng không chân:</span><span class="specval prop-6566" data-val=-1>7.0 Kg</span>
                                                                                                                                    <li><span class=specname>Nơi sản xuất:</span><span class="specval prop-6567" data-val=0>Việt Nam</span>
                                                                                                                                        <li><span class=specname>Dòng sản phẩm:</span><span class="specval prop-6989" data-val=2020>2020</span>
                                                                                                                                            <li class=manu><span class=specname>Hãng:</span><span class=specval>FFALCON. <a href=javascript:void(0) onclick=showManuDes()>Xem thông tin hãng</a></span></ul>
            </div>
        </div>
        <script type=application/ld+json>
            {
                "@context": "http://schema.org",
                "@type": "BreadcrumbList",
                "itemListElement": [
                {
                "@type": "ListItem",
                "position": 1,
                "item": {
                "@id": "https://www.dienmayxanh.com/tivi",
                "name": "Tivi"
                }}
                ,{
                "@type": "ListItem",
                "position": 2,
                "item": {
                "@id": "https://www.dienmayxanh.com/tivi-ffalcon",
                "name": "FFALCON"
                }}
                ]}
        </script>
        <script type=application/ld+json>
            {"@context":"https://schema.org","@type":"FAQPage","@id":"http://www.dienmayxanh.com/tivi/ffalcon-43sf1#comment","url":"http://www.dienmayxanh.com/tivi/ffalcon-43sf1","commentCount":20,"mainEntity":[{"@type":"Question","name":"does it have 3 ? ","acceptedAnswer":{"@type":"Answer","text":"testing text : asfdasdfasdfsadfasdfasdfasdf. ","upvoteCount":null}}]}
        </script>
        <script type=application/ld+json>
            {"@context":"https://schema.org","@type":"Product","name":"Smart TV ","image":["https://cdn.tgdd.vn/Products/Images/1942/220283/ffalcon-43sf1-9-550x340.jpg"],"description":"Smart Tivi FFalcon 43 inch 43SF1 giá tốt, chính hãng, giao hàng tận nơi, nhiều quà tặng hấp dẫn, bảo hành chu đáo. Click xem ngay!","sku":"220283","mpn":"220283","brand":{"@type":"Thing","name":"FFALCON"},"review":[{"@type":"Review","author":"Vũ Vương","datePublished":"03/05/2020","reviewBody":"So với tivi sanco tivi này chất lượng kém xa. Mặc dù tivi sanco gặp một số lời nhưng là hàng vietnam nên phần mềm vẫn tốt hơn. Thuận viết hơn","image":[],"reviewRating":{"@type":"Rating","bestRating":5,"ratingValue":2.0}}],"aggregateRating":{"@type":"AggregateRating","ratingValue":0.0,"reviewCount":1,"bestRating":5,"worstRating":1},"additionalProperty":[{"@type":"PropertyValue","name":"Bluetooth","value":"Không"},{"@type":"PropertyValue","name":"Công suất","value":"75W"},{"@type":"PropertyValue","name":"Hệ điều hành, giao diện","value":"<a href=\"https://www.dienmayxanh.com/kinh-nghiem-hay/co-gi-dac-biet-tren-he-dieu-hanh-tv-os-cua-smart-t-1136013\" title=\"TV+ OS\" target=\"_blank\">TV+ OS</a>"},{"@type":"PropertyValue","name":"Công nghệ hình ảnh","value":"<a href=\"https://www.dienmayxanh.com/kinh-nghiem-hay/nhung-cong-nghe-hinh-anh-tren-tivi-tcl-2018-1108287#micro-dimming\" title=\"Micro Dimming\" target=\"_blank\">Micro Dimming</a>"},{"@type":"PropertyValue","name":"Kết nối Internet","value":"<a href=\"https://www.dienmayxanh.com/kinh-nghiem-hay/lan-la-gi-596356\" title=\"Cổng LAN, Wifi\" target=\"_blank\">Cổng LAN, Wifi</a>"},{"@type":"PropertyValue","name":"Loại Tivi","value":"<a href=\"https://www.dienmayxanh.com/kinh-nghiem-hay/mot-so-loai-tivi-pho-bien-hien-nay-793656#smart-tivi\" title=\"Smart Tivi\" target=\"_blank\">Smart Tivi</a>"},{"@type":"PropertyValue","name":"Công nghệ hình ảnh","value":"<a href=\"https://www.dienmayxanh.com/kinh-nghiem-hay/tivi-ffalcon-cua-nuoc-nao-co-tot-khong-1240393#cong-nghe-hinh-anh-true-color\" title=\"True color\" target=\"_blank\">True color</a>"},{"@type":"PropertyValue","name":"Bộ nhớ trong","value":"Hãng không công bố"},{"@type":"PropertyValue","name":"Kích thước có chân, đặt bàn","value":"Ngang 97 cm - Cao 62.3 cm - Dày 19.4 cm"},{"@type":"PropertyValue","name":"Các ứng dụng sẵn có","value":"YouTube, Netflix, Zing TV, FPT Play, Clip TV"},{"@type":"PropertyValue","name":"Loại Tivi","value":"<a href=\"https://www.dienmayxanh.com/kinh-nghiem-hay/smart-tivi-la-gi-578426\" title=\"Smart Tivi\" target=\"_blank\">Smart Tivi</a>"},{"@type":"PropertyValue","name":"Tần số quét thực","value":"Hãng không công bố"},{"@type":"PropertyValue","name":"Kích cỡ màn hình","value":"43 inch"},{"@type":"PropertyValue","name":"Khối lượng có chân","value":"7.2 Kg"},{"@type":"PropertyValue","name":"Cổng AV","value":"<a href=\"https://www.dienmayxanh.com/kinh-nghiem-hay/diem-mat-nhung-ket-noi-co-ban-tren-tivi-phan-2-633476#composite\" title=\"Có cổng Composite\" target=\"_blank\">Có cổng Composite</a>"},{"@type":"PropertyValue","name":"Độ phân giải","value":"<a href=\"https://www.dienmayxanh.com/kinh-nghiem-hay/diem-mat-nhung-do-phan-giai-pho-bien-hien-nay-tren-577178#full-hd\" title=\"Full HD\" target=\"_blank\">Full HD</a>"},{"@type":"PropertyValue","name":"Cổng HDMI","value":"2 cổng"},{"@type":"PropertyValue","name":"Công nghệ quét hình","value":"Đang cập nhật"},{"@type":"PropertyValue","name":"Kích thước không chân, treo tường","value":"Ngang 97 cm - Cao 56.8 cm - Dày 7.6 cm"},{"@type":"PropertyValue","name":"Cổng xuất âm thanh","value":"<a href=\"https://www.dienmayxanh.com/kinh-nghiem-hay/cach-ket-noi-tivi-voi-dan-am-thanh-qua-jack-cam-3-663425\" title=\"Jack loa 3.5 mm\" target=\"_blank\">Jack loa 3.5 mm</a>"},{"@type":"PropertyValue","name":"Cổng VGA","value":"Không"},{"@type":"PropertyValue","name":"Tivi 3D","value":"Không"},{"@type":"PropertyValue","name":"Remote thông minh","value":"Không dùng được"},{"@type":"PropertyValue","name":"Kích thước màn hình","value":"Từ 32 - 43 inch"},{"@type":"PropertyValue","name":"Khối lượng không chân","value":"7.0 Kg"},{"@type":"PropertyValue","name":"USB","value":"2 cổng"},{"@type":"PropertyValue","name":"Tiện ích","value":"Kết nối loa qua Bluetooth"},{"@type":"PropertyValue","name":"Điều khiển tivi bằng điện thoại","value":"<a href=\"https://www.dienmayxanh.com/kinh-nghiem-hay/cach-dieu-khien-smart-tivi-tcl-chay-he-dieu-hanh-t-1131359\" title=\"Bằng ứng dụng T-Cast\" target=\"_blank\">Bằng ứng dụng T-Cast</a>"},{"@type":"PropertyValue","name":"Công nghệ âm thanh","value":"<a href=\"https://www.dienmayxanh.com/kinh-nghiem-hay/cac-cong-nghe-am-thanh-duoc-ung-dung-tren-tivi-sam-577175#dolby-ms10-ms11\" title=\"Dolby MS11\" target=\"_blank\">Dolby MS11</a>"},{"@type":"PropertyValue","name":"Tiện ích","value":"Chiếu điện thoại lên TV (không dây)"},{"@type":"PropertyValue","name":"Tiện ích","value":"Dùng được chuột, bàn phím"},{"@type":"PropertyValue","name":"Tiện ích","value":"Điều khiển được bằng điện thoại"},{"@type":"PropertyValue","name":"Tiện ích","value":"Xem phim online trên tivi"},{"@type":"PropertyValue","name":"Tổng công suất loa","value":"8W + 8W"},{"@type":"PropertyValue","name":"Nơi sản xuất","value":"Việt Nam"},{"@type":"PropertyValue","name":"Kết nối không dây với điện thoại, máy tính bảng","value":"<a href=\"https://www.dienmayxanh.com/kinh-nghiem-hay/cach-dieu-khien-smart-tivi-tcl-2016-bang-dien-thoa-832578\" title=\"Bằng ứng dụng T-cast\" target=\"_blank\">Bằng ứng dụng T-cast</a>"},{"@type":"PropertyValue","name":"Kết nối Bàn phím, chuột","value":"Có thể kết nối (sử dụng tốt nhất trong trình duyệt web)"},{"@type":"PropertyValue","name":"Tính năng thông minh khác","value":"Không"},{"@type":"PropertyValue","name":"Dòng sản phẩm","value":"2020"},{"@type":"PropertyValue","name":"Tích hợp đầu thu kỹ thuật số","value":"<a href=\"https://www.dienmayxanh.com/kinh-nghiem-hay/dvb-t2-la-gi-574834\" title=\"DVB-T2\" target=\"_blank\">DVB-T2</a>"}],"offers":null}
        </script>
        <div id=modalManuDes class=modaltemplate>
            <div class=ctn><a href=javascript:void(0) onclick=closemanupopdetail() class=mdbtnclose></a>
                <p class=ttle>Giới thiệu về hãng <img width=70 height=30 data-src=https://cdn.tgdd.vn/Brand/2/FFALCON1942-s_25.png alt=FFALCON class=lazy>
                    <div id=modalManuDes_Ctn>
                        <p>- FFalcon là thương hiệu của Trung Quốc.
                            <p>- FFalcon được thành lập năm 2017.
                                <p>- Hiện tại, thương hiệu FFalcon hiện đã có mặt tại hơn 136 quốc gia và 5 châu lục trên toàn cầu, có sức ảnh hưởng nhất định tại thị trường Úc, Ấn Độ,...
                                    <p>- Kết hợp với các đối tác lớn như Tencent và South New Media (SNM) cho việc thiết kế, sản xuất và kinh doanh.
                                        <p>- FFalcon hướng tới việc cung cấp cho người tiêu dùng những trải nghiệm về sản phẩm và dịch vụ giải trí kỹ thuật số gia đình với số lượng người dùng trực tuyến nhiều hơn cùng nội dung phong phú hơn.</div>
            </div>
        </div>
        <div id=banner-popup class=hide></div>
        <div class="wrap_wrtp wrap_His hide">
            <div class=pop>
                <div class=hdpop><a href=javascript:closePopupReRating() class=closehd><span>✖</span></a></div>
                <div class=ctW><strong>Lịch sử đánh giá</strong>
                    <div class=hList></div>
                </div><a class=closeHis href=javascript:closePopupReRating()>Đóng</a></div>
        </div>
        <div class=locationbox__overlay_2></div>
        <div id=dlding>Loading ...</div>
        <section id=bn-promote></section>

@endsection

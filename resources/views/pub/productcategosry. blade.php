@foreach($products as $val)
                            <?php 
                                $product_price_temp = DB::table('product_price')->where('id', $val->product_price)->first();
                            ?>
                                    <div class="product-layout col-lg-14 col-md-4 col-sm-4 col-xs-6" id="{{$val->id}}">
                                        <div class="product-item-container">
                                            <div class="left-block left-b">
                                                <div class="year-product">
                                                </div>
        
                                                <!-- {{-- <div class="hc-installment-label">
                                                    0% installment payment
                                                </div> --}} -->
        
                                                <div class="product-image-container second_img">
        
                                                    <a id="ITEM_IMG_CATEGORY_{{$val->id}}" href="{{URL::to($sanphamController->getLinkProduct($val->id))}}" target="_self" title="{{$val->product_name}}">
                        <img id="" data-src="{{asset(DB::table('product_image')->where('id', $val->product_avatar)->value('product_image'))}}" class="img-1 img-responsive ls-is-cached lazyloaded" alt="{{$val->product_name}}" src="{{asset(DB::table('product_image')->where('id', $val->product_avatar)->value('product_image'))}}">
                        <img id="" data-src="{{asset(DB::table('product_image')->where('id', $val->product_avatar)->value('product_image'))}}" class="img-2 img-responsive ls-is-cached lazyloaded" alt="{{$val->product_name}}" src="{{asset(DB::table('product_image')->where('id', $val->product_avatar)->value('product_image'))}}">
                    </a>
                                                </div>
                                            </div>
                                            <div class="right-block">
        

        
                                                <div id="ITEM_PROM_INFO_21803" class="caption  hc-promotion-info">
                                                    <span>&nbsp;</span>
                                                </div>
                                                <div>
                                                    <h3 id="ITEM_DESC_{{$val->id}}"><a href="{{URL::to($sanphamController->getLinkProduct($val->id))}}" title="{{$val->product_name}}" target="_self">{{$val->product_name}}</a></h3>
                                                </div>
                                                <p class="price"><span class="price-new">{{number_format($product_price_temp->price_promotion,0,",",".")}}$</span>
                                                    <span class="price-old">{{number_format($product_price_temp->price_regular,0,",",".")}}$</span>
                                                    <span class="price_diff">-{{number_format((100 - ($product_price_temp->price_promotion/$product_price_temp->price_regular*100)),2,",",".")}}%</span></p>
                                                <p class="sold-out-label"></p>
                                                <p></p>
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
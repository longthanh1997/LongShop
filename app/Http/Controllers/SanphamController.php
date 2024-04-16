<?php

namespace App\Http\Controllers;
use App\Http\Controllers\FeatureController;

use Illuminate\Http\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class SanphamController extends Controller
{
    public function getProductdetail(Request $request){

        $slug_product = $request->route('slug_product');
        $slug_category_main = $request->route('slug_category');
        $slug_category_extend = $request->route('slug_category_extend');
        if($slug_category_extend != null){
            $slug_category = $slug_category_extend;
        }else{
            $slug_category =$slug_category_main;
        }
        $product = DB::table('product')->where('product_slug', $slug_product)->first();
        $product_category = DB::table('product_to_category')->where('id_product', $product->id)->get();

        foreach($product_category as $value){
            $category = DB::table('product_category')->where('id', $value->id_category)->first();
            if($category->category_slug == $slug_category){
                $sanphamController = new SanphamController();
                $breadscrumb = $sanphamController->createBreadscrumb($category->id);
                $related_products = $sanphamController->getRelatedProduct($category->id);
                $product_price = DB::table('product_price')->where('id', $product->product_price)->first();
                $comments = DB::table('comment')->where('cmt_ofproduct', $product->id)->where('cmt_status', 1)->get();
                $rate5= $rate4= $rate3= $rate2= $rate1 = 0;
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
                if(count($comments) ==0){
                    $rating_star = null;
                    $pkg_rate_percent = array(0,0,0,0,0);

                }else{
                    $rating_star = ($rate1*1 + $rate2*2 + $rate3*3 + $rate4*4 + $rate5*5)/(count($comments)*5) *5;
                    $pkg_rate_percent = array($rate1/count($comments)*100, $rate2/count($comments)*100, $rate3/count($comments)*100, $rate4/count($comments)*100, $rate5/count($comments)*100);

                }

                $pkg_rate_count = array($rate1, $rate2, $rate3, $rate4, $rate5);
                return view('pub.productdetail', ['rating_star'=>$rating_star, 'pkg_rate_count'=>$pkg_rate_count,'pkg_rate_percent'=>$pkg_rate_percent,'comments'=>$comments, 'product' => $product, 'breadscrumb' => $breadscrumb, 'related_products' => $related_products, 'product_price' => $product_price]);
            }
        }
        return view('404');
    }

    public function createBreadscrumb($category_id){
        $category = DB::table('product_category')->where('id', $category_id)->first();
        $category_parent = DB::table('product_category')->where('id', $category->category_parent)->first();
        $breadscrumb = array();
        array_push($breadscrumb, $category);
        while($category_parent != null){
            array_push($breadscrumb, $category_parent);
            $category_parent = DB::table('product_category')->where('id', $category_parent->category_parent)->first();
        }
        $breadscrumb = array_reverse($breadscrumb);

        return $breadscrumb;
    }

    public function getRelatedProduct($category_id){
        $product_category = DB::table('product_to_category')->where('id_category', $category_id)->get();
        $related_products = array();
        foreach($product_category as $value){
            $product = DB::table('product')->where('id', $value->id_product)->first();
            array_push($related_products, $product);
        }
        return $related_products;
    }

    public function getLinkProduct($product_id){
        $product = DB::table('product')->where('id', $product_id)->first();
        $product_category = DB::table('product_to_category')->where('id_product', $product_id)->first();
        if(is_object($product_category )){
        $category = DB::table('product_category')->where('id', $product_category->id_category)->first();
    
            $link = '/'.$category->category_slug.'/'.$product->product_slug;

        
        return $link;
        }else{
            return '/';
        }
       

    }

    public function getProductCategory(Request $request){
        $slug_category = $request->route('slug_category');
      
        $category = DB::table('product_category')->where('category_slug', $slug_category)->first();
        if($category != null){
            $sanphamController = new SanphamController();
            $product_category = DB::table('product_to_category')->where('id_category', $category->id)->orderBy('id','desc')->get();
            $products = array();
            $breadscrumb = $sanphamController->createBreadscrumb($category->id);
            foreach($product_category as $value){
                $product = DB::table('product')->where('id', $value->id_product)->first();
                array_push($products, $product);
            }
            $product_showonload = array_slice($products, 0, 16);
            return view('pub.productcategory',['products'=> $products, 'breadscrumb' => $breadscrumb,'category'=>$category, 'product_showonload'=>$product_showonload]);
        }
        return view('404');
    }
    public function postImgCmt(Request $request){

        $file = $_FILES['file'];
        $target = 'public/admin/img/img_comment/'.$file['name'];
        move_uploaded_file( $file['tmp_name'], $target);
        Db::table('comment_image')->insert(['cmt_img_name'=>$file['name'], 'cmt_img_url'=> $target]);
        $idimg = Db::table('comment_image')->where('cmt_img_name', $file['name'])->value('id');
        $img_pkg = array($idimg, asset($target));

        return $img_pkg;
    }
    public function postComment(Request $request){
        $product_id = $_POST['productid'];
        $rate_star = $_POST['ratestar'];
        $rate_name = $_POST['ratename'];
        $rate_phone = $_POST['ratephone'];
        $rate_email = $_POST['rateemail'];
        $rate_content = $_POST['ratecontent'];
        $checkPhone = DB::table('comment')->where('cmt_phone', $rate_phone)->where('cmt_ofproduct', $productid)->first();
        if($checkPhone == null){
            if (!empty($_POST['rateimage'])) {
                $rate_image = $_POST['rateimage'];
                DB::table('comment')->insert(['cmt_ofproduct'=>$product_id, 'cmt_name'=>$rate_name, 'cmt_phone' => $rate_phone, 'cmt_email'=> $rate_email, 'cmt_content'=>$rate_content, 'cmt_rate'=>$rate_star, 'cmt_like'=> 0, 'cmt_image'=>$rate_image, 'cmt_status' => 0]);
            }else{
                DB::table('comment')->insert(['cmt_ofproduct'=>$product_id, 'cmt_name'=>$rate_name, 'cmt_phone' => $rate_phone, 'cmt_email'=> $rate_email, 'cmt_content'=>$rate_content, 'cmt_rate'=>$rate_star, 'cmt_like'=> 0, 'cmt_image'=>"", 'cmt_status'=>0]);
            }
            $id_cmt = DB::table('comment')->where('cmt_phone', $rate_phone)->where('cmt_ofproduct', $product_id)->value('id');
            $html = '<div class="comment-box" id="cmt-'.$id_cmt.'">
            <div class="rep-comment-line nm-user">
                <div class="reply-wrap">
                    <div class="user-line">
                        <span class="name-of-comment">'.$rate_name.'</span>
                    </div>
                    <div class="comment-info">
                        <h5 class="comment-content">'.$rate_content.'</h5>
                        <ul class="comment-react clearfix">
                            <li class="time-post">
                                <span id="btn-reply" onclick="openboxrep(this)" data-id="'.$id_cmt.'">Trả lời</span>
                                <span id="btn-like" onclick="reactcmt(this)" data-id="'.$id_cmt.'">Thích <span class="count-react"></span></span>
                                <span>'.date("h:i:sa d-m-Y").'</span>
                            </li>
                        </ul>
                    </div>
                    <div class="comment-box-reply" id="box-reply" style="display: none;">
                        <form action="'.url('/post-reply-comment').'" id="reply-cmt-'.$id_cmt.'" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <input type="hidden" name="commentid" value="'.$id_cmt.'"/>
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
                                        <a id="reply-submit" onclick="postreplycomment(this)" class="btn btn-primary btn-send-reply" data-id="'.$id_cmt.'">Gửi đi <i class="fa fa-paper-plane"></i></a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>
               <div class="rep-comment-line reply-cmt-box">
                 <i class="arrow_box"></i>

               </div>

            </div>
        </div>';
            return $html;
        }else{
            return false;

        }
    }

    public function postReplyComment(Request $request){
        $comment_id = $_POST['commentid'];
        $reply_name = $_POST['replyname'];
        $reply_phone = $_POST['replyphone'];
        $reply_email = $_POST['replyemail'];
        $reply_content = $_POST['replycontent'];

        DB::table('comment_reply')->insert(['cmt_rep_ofcmt'=>$comment_id, 'cmt_rep_name'=>$reply_name, 'cmt_rep_phone' => $reply_phone, 'cmt_rep_email'=> $reply_email, 'cmt_rep_content'=>$reply_content, 'cmt_rep_like' => 0]);
        $html = '<div class="d-flex">
                    <div class="comment-info">
                        <h4 class="name-of-comment">
                            <b class="author">'.$reply_name.'</b>
                        </h4>
                        <h5 class="comment-content">'.$reply_content.'</h5>
                        <ul class="comment-react clearfix">
                            <li class="time-post">'.date("h:i:sa d-m-Y").'</li>
                        </ul>
                    </div>
                </div>';
        return $html;
    }

    public function searchProduct(Request $request){
        $key = $_GET['key'];
        $html = '';
        $sanphamController = new SanphamController();
        $products = DB::table('product')->where('product_name', 'LIKE', '%' . $key . '%')->paginate('6');
        if (count($products)>0) {
            foreach ($products as $val) {
                $product_price_temp = DB::table('product_price')->where('id', $val->product_price)->first();
                $html =$html. '<a href="'.url($sanphamController->getLinkProduct($val->id)).'"> <div class="row-product-search">
                            <div class="pr-avatar-search">
                                <img src="'.asset(DB::table('product_image')->where('id', $val->product_avatar)->value('product_image')).'"/>
                            </div>
                            <div class="pr-content-search">
                                <h5 class="product-name">'.$val->product_name.'</h5>
                                <span class="price-new">'.number_format($product_price_temp->price_promotion,0,",",".").'$</span><br/>
                                <span class="price-old">'.number_format($product_price_temp->price_regular,0,",",".").'$ </span> <span class="price-diff">-'.number_format((100 - ($product_price_temp->price_promotion/$product_price_temp->price_regular*100)),2,",",".").'%</span>
                            </div>
                        </div></a>';
            }
            $html.="<div class='text-center'><button onclick='xemthem()' class='btn btn-primary' style='width:100%' type='submit'>More Products </button></div>";
        }else{
            $html =$html. '<div style="text-align:center">Không có sản phẩm</div>';
        }
        return $html;
        
    }


    


    public function search(Request $request){
        $html = '';
        $url = $request->fullUrl();
        $url = explode('?keyword=',$url);
        $keyword = $_GET['keyword'];

        $html = '';
        $product_showonload = DB::table('product')->where('product_name', 'LIKE', '%' . $keyword . '%')->paginate('8');
        $count_product = DB::table('product')->where('product_name', 'LIKE', '%' . $keyword . '%')->count();
        return view('pub.search',['product_showonload'=>$product_showonload, 'count_product'=>$count_product,'keyword'=>$keyword]);
    }
      public function loadmoreSearchProducts(Request $request){
        $position = $_GET['position'];
        $keyword = $_GET['keyword'];

        $area = $_GET['area'];
        if($area == 'category'){
            $col = 3;
            $number_product = 4;
        }elseif($area == 'home'){
            $col = 15;
            $number_product = 6;
        }
        
        $products = DB::table('product')->where('product_name', 'LIKE', '%' . $keyword . '%')->get();
        $product_show = array();
        $sanphamController = new SanPhamController();
        for($i =0;$i<count($products); $i++){
            if($i>$position){
                if(count($product_show) <4){
                   array_push($product_show, $products[$i]);
                }
            }
        }
        $count_remain = count($products)-1-$position -4;
        $html="";
        foreach($product_show as $val){
                         $position+=1;       
            $product_price_temp = DB::table('product_price')->where('id', $val->product_price)->first();  
            $ins ="";
            $pricenew = "";
            $priceold = "";
            if($product_price_temp->price_installment ==1){
                 $ins ="<div class='tag-ins'>0% installment payment</div>";
                
             }
             if($product_price_temp->price_promotion != null){
                 $pricenew = $pricenew.number_format($product_price_temp->price_promotion,0,",",".");
                 $priceold = '<div class="price-old">'.number_format($product_price_temp->price_regular,0,",",".").'</div>
                          <div class="price-diff">-'.number_format((100 - ($product_price_temp->price_promotion/$product_price_temp->price_regular*100)),0,",",".").'%</div>';
             }else{
                 $pricenew = $pricenew.number_format($product_price_temp->price_regular,0,",",".");

             }
             
            $html = $html. '<div class="col-lg-'.$col.' col-md-3 col-sm-3 col-xs-6 item" data-position="'.$position.'">
            <div class="product-grid6 product-box ">
                <div class="product-image6 product-image">
                    <a href="'.url($sanphamController->getLinkProduct($val->id)).'">
                        <img class="product-avatar-'.$val->id.'" src="'.asset(DB::table('product_image')->where('id', $val->product_avatar)->value('product_image')).'">
                    </a>
                </div>
                 <div class="product-content">
                    <h3 class="title"><a href="'.url($sanphamController->getLinkProduct($val->id)).'">'.$val->product_name.'</a></h3>
                    <div class="price-new text-left">
                        '.$pricenew.'
                        </div>
                    <div class="price text-center">
                        '.$priceold.''.$ins.'

                    </div>
                  
                </div>
               
            </div>
        </div>';
                    
        }
        $pkg_tab = array($html, $count_remain);
        return $pkg_tab;
    }
    public function getLink($name){
    
        return view('/', compact('name'));
    }











    public function getAttribute($cate_parent, $type){
        // $cate_child = DB::table('product_category')->where('category_parent', $cate_parent->id)->get();
        // if(count($cate_child) != 0){
        //     foreach($cate_child as $val){
                
        //         if($val->category_type == $type){
        //             echo '<li><a href=""><input id="'.$val->id.'" type="radio" name="'.$val->name.'" value="'.$val->id.'" data-type="'.$val->type.'"><label>Toàn bộ</label></a></li>';
        //         }
        //         $sanphamController = new SanphamController();
        //         return $sanphamController->getAttribute($val, $type);

        //     }

        // }else{
        //     return null;

        // }
    }
    // public function getSanpham(Request $request){
    //     $featureController = new FeatureController();
    //     $category_slug_route = $request->route('category_slug');
    //     $product_slug = $request->route('product_slug');
    //     $product = DB::table('product')->where('product_slug', $product_slug)->first();
    //     $category_id = explode(',',$product->product_category);
    //     $cateParent = $featureController->getCateParent($category_id);

    //     $breadcrumb = array();
    //     // $breadcrumb = $featureController->createBreadcrumb($category_id);
    //     $breadcrumb = array_reverse($breadcrumb);
    //     $product_related = $featureController->getProductbyCategory($category_id[0]);

    //     if($category_slug_route == $cateParent->category_slug){
    //         return view('pub.productdetail', ['product' => $product, 'breadcrumb' => $breadcrumb, 'product_related' => $product_related]);
    //     }else{
    //         return view('404');
    //     }
    // }
    // public function getDanhmuc(Request $request){
    //     $category_route_slug = $request->route('category_slug');
    //     $product_category = DB::table('product_category')->where('category_slug', $category_route_slug)->first();
    //     if($product_category != null){
    //         $featureController = new FeatureController();
    //         $products = $featureController->getallProductofCategory($product_category->id);
    //         return view('pub.productcategory',['products' => $products]);
    //     }else{
    //         return view('404');
    //     }
    // }

}

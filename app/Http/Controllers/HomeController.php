<?php

namespace App\Http\Controllers;
use App\Http\Controllers\SanphamController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function getHome(){
        $products = DB::table('product')->paginate(8);

        $blogs = DB::table('blog')->paginate(4);

        $tab_cate = DB::table('product_category')->where('category_parent', 0)->paginate(12);
        $banner_chinh = DB::table('banner')->where('location', 1)->get();
        $banner_sale = DB::table('banner')->where('location', 2)->first();
        $banner_tivi = DB::table('banner')->where('location', 3)->first();
        $banner_maygiat = DB::table('banner')->where('location', 4)->first();
        $banner_tulanh = DB::table('banner')->where('location', 5)->first();
        $banner_tudong = DB::table('banner')->where('location', 6)->first();
        $banner_maylanh = DB::table('banner')->where('location', 7)->first();
        $banner_giadung = DB::table('banner')->where('location', 15)->first();
        $banner_locnuoc = DB::table('banner')->where('location', 16)->first();
        $banner_loa = DB::table('banner')->where('location', 17)->first();
        $banner_laptop = DB::table('banner')->where('location', 18)->first();
        $banner_baiviet = DB::table('banner')->where('location', 8)->first();
        
        
        $product_tivi = $this->getProductByCategory(2, 8);
        $product_maygiat = $this->getProductByCategory(40, 8);
        $product_tulanh = $this->getProductByCategory(18, 8);
        $product_maylanh = $this->getProductByCategory(111, 8);
        $product_sale = $this->getProductByCategory(124, 4);
        $product_giadung = $this->getProductByCategory(23, 8);
        $product_locnuoc = $this->getProductByCategory(21, 8);
        $product_loa = $this->getProductByCategory(12, 8);
        $product_laptop = $this->getProductByCategory(24, 8);
        
        
        // $product_to_category = DB::table('product_to_category')->where('id_category',40 )->orderBy('updated_at', 'desc')->paginate(8);
        // $product_maygiat=[];
        // foreach($product_to_category as $val){
        //     $pr = DB::table('product')->where('id', $val->id_product)->first();
        //     array_push($product_maygiat,$pr);
        // }
        // $product_to_category = DB::table('product_to_category')->where('id_category',18 )->orderBy('updated_at', 'desc')->take(8)->get();
        // $product_tulanh=[];
        // foreach($product_to_category as $val){
        //     $pr = DB::table('product')->where('id', $val->id_product)->first();
        //     array_push($product_tulanh,$pr);
        // }
        
        
        $product_tudong = $this->getProductByCategory(154, 8);
        // return $product_tudong;
        
        
        // $product_to_category = DB::table('product_to_category')->where('id_category',121 )->orderBy('updated_at', 'desc')->paginate(8);
        // $product_maylanh=[];
        // foreach($product_to_category as $val){
        //     $pr = DB::table('product')->where('id', $val->id_product)->first();
        //     array_push($product_maylanh,$pr);
        // }
        // $product_to_category = DB::table('product_to_category')->where('id_category',124 )->orderBy('updated_at', 'desc')->paginate(4);
        // $product_sale=[];
        // foreach($product_to_category as $val){
        //     $pr = DB::table('product')->where('id', $val->id_product)->first();
        //     array_push($product_sale,$pr);
        // }
        // $product_to_category = DB::table('product_to_category')->where('id_category',23 )->orderBy('updated_at', 'desc')->paginate(8);
        // $product_giadung=[];
        // foreach($product_to_category as $val){
        //     $pr = DB::table('product')->where('id', $val->id_product)->first();
        //     array_push($product_giadung,$pr);
        // }
        // $product_to_category = DB::table('product_to_category')->where('id_category',21 )->orderBy('updated_at', 'desc')->paginate(8);
        // $product_locnuoc=[];
        // foreach($product_to_category as $val){
        //     $pr = DB::table('product')->where('id', $val->id_product)->first();
        //     array_push($product_locnuoc,$pr);
        // }
        //  $product_to_category = DB::table('product_to_category')->where('id_category',12 )->orderBy('updated_at', 'desc')->paginate(8);
        // $product_loa=[];
        // foreach($product_to_category as $val){
        //     $pr = DB::table('product')->where('id', $val->id_product)->first();
        //     array_push($product_loa,$pr);
        // }
        //  $product_to_category = DB::table('product_to_category')->where('id_category',24 )->orderBy('updated_at', 'desc')->paginate(8);
        // $product_laptop=[];
        // foreach($product_to_category as $val){
        //     $pr = DB::table('product')->where('id', $val->id_product)->first();
        //     array_push($product_laptop,$pr);
        // }
        return view('pub.index',['banner_laptop'=>$banner_laptop,'banner_locnuoc'=>$banner_locnuoc,'banner_loa'=>$banner_loa,'banner_giadung'=>$banner_giadung,'product_laptop'=>$product_laptop,'product_loa'=>$product_loa,'product_locnuoc'=>$product_locnuoc,'product_giadung'=>$product_giadung,'product_sale'=>$product_sale,'product_maylanh'=>$product_maylanh,'product_tudong'=>$product_tudong,'product_tulanh'=>$product_tulanh,'product_maygiat'=>$product_maygiat,'product_tivi'=>$product_tivi,'products' => $products, 'tab_cate' => $tab_cate, 'blogs'=>$blogs,'banner_baiviet'=>$banner_baiviet, 'banner_sale'=>$banner_sale, 'banner_tivi'=>$banner_tivi, 'banner_maygiat'=>$banner_maygiat, 'banner_tulanh'=>$banner_tulanh, 'banner_tudong'=>$banner_tudong, 'banner_maylanh'=>$banner_maylanh, 'banner_chinh'=>$banner_chinh]);
    }
    
    public function getProductByCategory($id_category, $paginate){
        
        $product_to_category = DB::table('product_to_category')->select('id_product')->where('id_category', $id_category )->get();
        $id_product = array();
        foreach($product_to_category as $val){
            array_push($id_product,$val->id_product);
        }
        // return $id_product;
        return DB::table('product')->whereIn('id', $id_product)->orderBy('updated_at', 'desc')->take($paginate)->get();
    }

    public function getBlogCategory(Request $request){
        $blogs = DB::table('blog')->take(10)->get();
        $allblogs = DB::table('blog')->paginate(10);
        return view('pub.blog_category', ['blogs'=>$blogs, 'allblogs'=>$allblogs]);
    }

    public function getBlogDetail(Request $request){
        $blog_slug = $request->slug;
        $blog = DB::table('blog')->where('blog_slug', $blog_slug)->first();
        $blogs_new = DB::table('blog')->orderBy('id', 'desc')->paginate(10);
        return view('pub.blogdetail', ['blog'=>$blog, 'blogs_new'=>$blogs_new]);
    }
    public function loadFeatureProducts(Request $request){
        $category_id = $_GET['id'];
        $product_to_category = DB::table('product_to_category')->where('id_category', $category_id)->get();
        $product_to_category_show = DB::table('product_to_category')->where('id_category', $category_id)->paginate(6);
        $count_remain = count($product_to_category)-6;
        $products = array();
        foreach($product_to_category_show as $value){
            $product = DB::table('product')->where('id', $value->id_product)->first();
            array_push($products, $product);
        }
        $html="";
        $html = $html. '';
        $pkg_tab = array($html, $count_remain);
        return $pkg_tab;

    }
    public function loadmoreProducts(Request $request){
        $id_cate = $_GET['id_cate'];
        $id_lastproduct = $_GET['id_lastproduct'];
        $area = $_GET['area'];
        if($area == 'category'){
            $col = 3;
            $number_product = 16;
        }elseif($area == 'home'){
            $col = 15;
            $number_product = 16;
        }
        $product_to_category = DB::table('product_to_category')->where('id_category', $id_cate)->where('id_product','<', $id_lastproduct)->get();
        $product_to_category_show = DB::table('product_to_category')->where('id_category', $id_cate)->where('id_product','<', $id_lastproduct)->orderBy('id', 'desc')->paginate($number_product);

        $count_remain = count($product_to_category)-$number_product;
        $products = array();
        $sanphamController = new SanPhamController();
        foreach($product_to_category_show as $value){
            $product = DB::table('product')->where('id', $value->id_product)->first();
            array_push($products, $product);
        }
        $html="";
        foreach($products as $val){
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
             
            $html = $html. '<div class="col-lg-'.$col.' col-md-3 col-sm-3 col-xs-6 item" data-id="'.$val->id.'">
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
}

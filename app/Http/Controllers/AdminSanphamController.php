<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\admin;
use App\Models\Product_category;
use App\Models\Product_to_category;
use App\Models\Product_brand;
use App\Models\Product;
use App\Models\Product_price;
use App\Models\Product_image;
use App\Models\Bubble_title;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductExport;
use App\Imports\ProductImport;
use Illuminate\Support\Facades\DB;





class AdminSanphamController extends Controller
{
//product_category, product_name, product_sku, product_quantity, product_avatar, product_gallery, product_brand, product_variation_status, product_variation, product_status, product_shortdsc, product_longdsc, product_info, product_product_price

    private $htmlSelect2;
    private $htmlSelect3;
    public $arr;
    public function __construct(){
        $this->htmlSelect2 = '';
        $this->htmlSelect3 = '';
        $this->arr = array();
    }

    public function testModel(){
      return Excel::download(new UsersExport, 'users.xlsx');
    }
public function exportExcel(){
      return Excel::download(new ProductExport, 'products.xlsx');
    }
public function importExcel(Request $request)
    {
        Excel::import(new ProductImport, request()->file('in_import_excel'));
        Session::flash('success', 'Nhập file excel thành công');
        return back();
    }

    public function getShowProduct(){

        //$collection = Str::of('foo bar baz')->explode(',');
        $product = Product::orderby('id', 'DESC')->simplePaginate(50);
        //$product_category = DB::table('product_category')->get();
        $product_category = Product_category::all();
        $product_to_category = Product_to_category::all();
        $product_brand = Product_brand::all();
        $product_price = Product_price::all();
        $product_image = Product_image::all();
        $product_image = Product_image::all();
        $product_filter1 = array();
        foreach ($product as $value) {
            # code...
            array_push($product_filter1, $value->id);
        }
        return view('admin.showproduct')->with('product', $product)->with('product_category', $product_category)->with('product_brand', $product_brand)->with('product_price', $product_price)->with('product_image', $product_image)->with('product_filter1', $product_filter1)->with('filter_choose_category', 0)->with('filter_choose_brand', 0)->with('product_to_category', $product_to_category);
    }

    public function postFilterProduct(Request $request){

        $product = Product::orderby('id', 'DESC')->get();
        $product_to_category_filter = Product_to_category::where('id_category', $request->filter_category)->get();
        if($request->filter_category == 0 && $request->filter_brand == 0){

            $product_filter1 = array();
            foreach ($product as $value) {
                # code...
                array_push($product_filter1, $value->id);
            }
        }
        elseif($request->filter_category != 0 && $request->filter_brand == 0){
            //echo $request->filter_category;

            $product_filter1 = array();
            if(count($product_to_category_filter) > 0){
                foreach ($product_to_category_filter as $value) {

                    array_push($product_filter1, $value->id_product);

                }
            }

        }
        elseif($request->filter_category == 0 && $request->filter_brand != 0){
            //echo $request->filter_category;
            $product = Product::orderby('id', 'DESC')->get();
            $product_filter1 = array();
            foreach ($product as $value) {
                # code...
                $result = Str::of($value->product_brand)->trim()->isNotEmpty();
                if($result){
                    $str = Str::of($value->product_brand)->explode(',');
                    foreach ($str as $value1) {
                        # code...
                        if($value1 == $request->filter_brand){
                            array_push($product_filter1, $value->id);
                        }

                    }


                }


            }
        }
        elseif($request->filter_category != 0 && $request->filter_brand != 0){
            //echo $request->filter_category;
            $product_filter_brand = array();
            $product_filter_category = array();
            foreach ($product as $value) {
                # code...
                $result = Str::of($value->product_brand)->trim()->isNotEmpty();
                if($result){
                    $str = Str::of($value->product_brand)->explode(',');
                    foreach ($str as $value1){
                        # code...
                        if($value1 == $request->filter_brand){
                            array_push($product_filter_brand, $value->id);

                        }

                    }


                }


            }

            if(count($product_to_category_filter) > 0){
                foreach ($product_to_category_filter as $value) {

                    array_push($product_filter_category, $value->id_product);

                }
            }

            if(count($product_filter_brand) == 0 || count($product_filter_brand) == 0){
                $product_filter1 = array();
            }
            else{
                $product_filter1 = array();
                foreach ($product_filter_brand as $value) {
                    foreach ($product_filter_category as $value1) {
                        if($value == $value1){
                           array_push($product_filter1, $value);
                        }
                    }
                }
            }

        }


        //$product_category = DB::table('product_category')->get();
        $product_category = Product_category::get();
        $product_to_category = Product_to_category::get();
        $product_brand = Product_brand::get();
        $product_price = Product_price::get();
        $product_image = Product_image::all();
        return view('admin.showproduct')->with('product', $product)->with('product_category', $product_category)->with('product_brand', $product_brand)->with('product_price', $product_price)->with('product_image', $product_image)->with('product_filter1', $product_filter1)->with('filter_choose_category', $request->filter_category)->with('filter_choose_brand', $request->filter_brand)->with('product_to_category', $product_to_category);
    }



    public function getAddProduct(){
        //$product_category = Product_category::orderby('id', 'DESC')->get();
        $product_category = $this->ShowOptionCategoryInProduct(0);
        $product_brand = Product_brand::orderby('id', 'DESC')->get();
        $bubble_title = Bubble_title::orderby('id', 'DESC')->get();
        return view('admin.addproduct', ['product_category' => $product_category, 'product_brand' => $product_brand, 'bubble_title' => $bubble_title]);
    }



    public function getSearchAllProduct($key){
        if($key == '!@'){
            $product = Product::select('id', 'product_avatar', 'product_name')->orderby('id', 'DESC')->take(10)->get();
        }
        else{
            $product = Product::select('id', 'product_avatar', 'product_name')->where('product_name', 'like', '%'.$key.'%')->orderby('id', 'DESC')->take(10)->get();
        }
        $data ='';
        foreach ($product as $value) {

            $data .= '<li class="list-group-item list-group-item-action">
            <a href="'.url('/admin/product/editproduct/'.$value->id).'">
                <img class="mr-1" src="'.asset(Product_image::find($value->product_avatar)->product_image).'" alt=""><span>'.$value->product_name.'</span></a>
            </li>';
        }
        return $data;
    }

    public function getSearchProduct($key){
        if($key == '!@'){
            $product = Product::select('id', 'product_group_name', 'product_name')->orderby('id', 'DESC')->take(10)->get();
        }
        else{
            $product = Product::select('id', 'product_group_name', 'product_name')->where('product_name', 'like', '%'.$key.'%')->orderby('id', 'DESC')->take(10)->get();
        }

        return $product;
    }

    public function getChooseSearchProduct($id){
        $product = Product::find($id);
        $result = array();
        if(Str::of($product->product_group)->trim()->isNotEmpty()){
            $str = Str::of($product->product_group)->explode(',');
            $all_product = Product::all();
            foreach ($str as $value) {
                foreach ($all_product as $value1) {
                    # code...
                    if($value == $value1->id){
                        array_push($result, Product::find($value1->id));
                    }
                }
            }
            return $result;

        }
        else{
            return Product::where('id', $id)->get();
        }

    }



    public function postAddProduct(Request $request){
        //product_name, product_slug, product_category, product_brand, product_status, product_quantity, product_sku, product_price, product_promotion, price_installment, product_avatar, product_shortdsc, product_info, product_longdsc, product_variation_status, product_gallery
        $product = new Product();
        //sản phẩm có biến thể product_variation_status = 1


        $AdminhomeController = new AdminhomeController();

        $this->validate($request, [
        'product_name' => ['required', 'min:1', 'max:255'],
        'product_quantity' => ['max:255', 'regex:^[0-9]+$^'],
        'product_avatar' => ['file', 'image']
        ],
        [

        ]);

        $get_image_avatar = $request->file('product_avatar');
        if($get_image_avatar){

            $image =  $this->processImage($get_image_avatar);
            $product_image = new Product_image();
            $product_image->product_image = $image;
            $product_image->save();

            $product->product_avatar = $product_image->id;

        }



        // if(isset($request->product_brand)){
        //  $product->product_brand = $this->getCategoryAndBrand($request->product_brand);
        // }



        $product->product_name =$request->product_name;
        $product->product_slug = $AdminhomeController->createSlug($request->product_name);

        $product->product_status = $request->product_status;



        $product->product_quantity =$request->product_quantity;
        $product->product_sku =$request->product_sku;
        $product->product_shortdsc =$request->product_shortdsc;

        if(isset($request->total_offer)){
            $product->total_offer = $request->total_offer;
        }

        $product->product_offer =$request->product_offer;
        $product->product_info =$request->product_info;
        $product->product_longdsc =$request->product_longdsc;

        $get_image_gallery = $request->file('product_gallery');
        if($get_image_gallery){

            $product->product_gallery = $this->processGallery($get_image_gallery);
        }

        $product->product_price = $this->saveProductPrice($request->price_regular, $request->price_online,$request->price_promotion, $request->price_installment);

        $product->save();

        // if(isset($request->bubble_title)){
        //     foreach ($request->bubble_title as $value) {
        //         # code...
        //         $this->saveBubbleToProduct($product->id, $value);
        //     }

        // }

        if(isset($request->product_category)){
            foreach ($request->product_category as $value) {
                # code...
                $this->saveProductToCategory($product->id, $value);
            }
            //$product->product_category = $this->getCategoryAndBrand($request->product_category);
        }
        //add group variation
        if(isset($request->product_group) && $request->product_variation_status == 1){
            $product = Product::find($product->id);


            $product->product_group_name = $request->product_group_name;
            $product->product_group = $this->createStringGroupProduct($product->id, $request->product_group);
            $product->save();

        }

        Session::flash('success', 'You have added successfully');
        return Redirect::to('admin/product/editproduct/'.$product->id);
    }


    public function getEditProduct($id){

        $product = Product::where('id', $id)->first();


        $product_all = Product::all();


        $product_image = Product_image::all();

        $product_price_one = Product_price::where('id', $product->product_price)->first();

        $product_category = $this->ShowOptionCategoryInEditProduct(0, $id);

        $product_brand = Product_brand::orderby('id', 'DESC')->get();
        $bubble_title = Bubble_title::orderby('id', 'DESC')->get();
        return view('admin.editproduct')->with('product', $product)->with('product_category', $product_category)->with('product_brand', $product_brand)->with('product_price_one', $product_price_one)->with('product_image', $product_image)->with('product_all', $product_all)->with('bubble_title', $bubble_title);
    }


    public function getDeleteProductSingle($id){

        $product = Product::find($id);




        if(Str::of($product->product_group)->trim()->isNotEmpty()){

            $this->deleteProductGroupPrefix($product->id);
        }

        $product->delete();

        $product_price = Product_price::find($product->product_price);
        $product_price->delete();

        $this->deleteCategoryProductPrefix($id, 1);
        $this->deleteBubbleProductPrefix($id, 1);

        Session::flash('success', 'Deleted successfully !');
        return Redirect::to('/admin/product/showproduct');
    }


    public function getDeleteProduct($id){

        $product = Product::find($id);




        if(Str::of($product->product_group)->trim()->isNotEmpty()){

            $this->deleteProductGroupPrefix($product->id);
        }
        $this->deleteBubbleProductPrefix($id, 1);
        $product->delete();

        $product_price = Product_price::find($product->product_price);
        $product_price->delete();

        $this->deleteCategoryProductPrefix($id, 1);

        return $id;
    }




    public function postEditProduct(Request $request){
        //product_name, product_status, product_quantity, product_variation_status, product_shortdsc, product_info, product_longdsc, product_avatar, product_gallery[], id_product

        //product_category[], product_brand[]

        //variation2, product_price_variation1, product_promotion_variation1[], price_installment_variation1[]
        $this->validate($request, [
        'product_name' => ['required', 'min:1', 'max:255']
            ],
        [
        ]);
        $AdminhomeController = new AdminhomeController();
        $product = Product::find($request->id_product);

        $get_image_avatar = $request->file('product_avatar');
        if($get_image_avatar){

            $result = Str::of($product->product_avatar)->trim()->isNotEmpty();
            if($result){

                $image =  $this->processImage($get_image_avatar);

                $product_image = Product_image::find($product->product_avatar);
                $product_image->product_image = $image;
                $product_image->save();
            }
            else{

                $image =  $this->processImage($get_image_avatar);

                $product_image = new Product_image();
                $product_image->product_image = $image;
                $product_image->save();

                $product->product_avatar = $product_image->id;
            }






        }


        $get_image_gallery = $request->file('product_gallery');
        if($get_image_gallery){

            $result = Str::of($product->product_gallery)->trim()->isNotEmpty();
            if($result){
                $product->product_gallery = $product->product_gallery.','.$this->processGallery($get_image_gallery);
            }
            else{
                $product->product_gallery = $this->processGallery($get_image_gallery);
            }

        }



        $product->product_name = $request->product_name;
        $product->product_slug = $AdminhomeController->createSlug($request->product_name);

        $product->product_status = $request->product_status;
        $product->product_quantity = $request->product_quantity;



        $product->product_shortdsc = $request->product_shortdsc;

        if(isset($request->total_offer)){
            $product->total_offer = $request->total_offer;
        }
        else{
            $product->total_offer = null;
        }

        $product->product_offer = $request->product_offer;

        $product->product_info = $request->product_info;
$product->product_sku = $request->product_sku;
        $product->product_longdsc = $request->product_longdsc;
        // $product->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $this->updateProductPrice($product->product_price, $request->price_regular, $request->price_online, $request->price_promotion, $request->price_installment, $request->product_sku);

        // if(isset($request->product_brand)){
        //     $product->product_brand = $this->getCategoryAndBrand($request->product_brand);
        // }

        if($request->product_variation_status == 1){
            $product->product_group_name = $request->product_group_name;
            if(Str::of($product->product_group)->trim()->isEmpty()){
                if(isset($request->product_group)){

                    $product->product_group = $this->createStringGroupProduct($product->id, $request->product_group);
                }


            }
            else{
                //delete all group
                $this->deleteProductGroupPrefix($product->id);

                //add all group
                $product->product_group = $this->createStringGroupProduct($product->id, $request->product_group);

            }



        }
        else{
            if(Str::of($product->product_group)->trim()->isNotEmpty()){
                $this->deleteProductGroupPrefix($product->id);

            }

           $product->product_group = '';
        }


        $product->save();

        if(isset($request->bubble_title)){
                # code...
                $this->editProductBubble($product->id, $request->bubble_title);


        }

        if(isset($request->product_category)){
            $this->editProductCategory($product->id, $request->product_category);
        }


        Session::flash('success', 'Edited successful!');
        return Redirect::to('admin/product/editproduct/'.$product->id);


    }

    public function deleteProductGroupPrefix($id_product){
        $get_product_all = Product::whereNotIn('id', [$id_product])->get();
        foreach ($get_product_all as $value) {
            if(Str::of($value->product_group)->trim()->isNotEmpty()){
                $str = Str::of($value->product_group)->explode(',');
                foreach ($str as  $value1) {
                    if($value1 == $id_product){

                        $update_product_group = Product::find($value->id);
                        $string = Str::of($this->deleteOneValueString($value->product_group, $id_product))->rtrim(',');

                        if(Str::length($string) == 1){
                            $update_product_group->product_group = '';
                        }
                        else{
                            $update_product_group->product_group = $string;
                        }


                        $update_product_group->save();
                    }
                }
            }
        }
    }


    public function createStringGroupProduct($id_product, $product_group){
        $string = $id_product;
        foreach ($product_group as $value) {
            $string .=','.$value;
        }

        $this->updateGroupAllProduct($string, $product_group);
        return $string;
    }

    public function updateGroupAllProduct($string, $product_group){
        foreach ($product_group as $value) {
            $product_update = Product::find($value);
            $product_update->product_group = $string;
            $product_update->save();
        }
    }


    public function postEditProductList(Request $request){
        //echo $request->edit_list_product;
        if(!isset($request->check_list_product) || $request->edit_list_product == 0){
            Session::flash('error', 'Please select actions and categories');
            return back();

        }
        else{
            if($request->edit_list_product == 1){
                foreach ($request->check_list_product as $value) {
                    $product = Product::find($value);
                    $product->product_status = 0;
                    $product->save();
                }
                Session::flash('success', 'Successful implementation');
                return back();
            }
            elseif ($request->edit_list_product == 2) {
                foreach ($request->check_list_product as $value) {
                    $product = Product::find($value);
                    $product->product_status = 1;
                    $product->save();
                }
                Session::flash('success', 'Successful implementation');
                return back();
            }
            elseif ($request->edit_list_product == 3) {
                foreach ($request->check_list_product as $value) {
                    $this->getDeleteProduct($value);
                }
                Session::flash('success', 'Successful implementation');
                return back();
            }
            else{
                Session::flash('error', 'the f*ck you hacker');
                return back();
            }
        }


    }


    public function getShowBubble(){
        $bubble = DB::table('bubble_title')->orderBy('id', 'DESC')->get();
        return view('admin.bubbletitle')->with('bubble', $bubble);
    }

    public function postAddBubbleTitle(Request $request){
        $bubble_title = new Bubble_title();
        $bubble_title->name = $request->bubble_title_name;
        $bubble_title->save();
        return $bubble_title;
    }

    public function postEditBubbleTitle(Request $request){
        $bubble_title = Bubble_title::find($request->id_edit);
        $bubble_title->name = $request->bubble_title_name_edit;
        $bubble_title->save();

        return $bubble_title;
    }

    public function deleteBubbleTitle($id){
        $this->deleteBubbleProductPrefix($id, 0);
        Bubble_title::find($id)->delete();
        return $id;
    }

    public function postEditListBubbleTitle(Request $request){
        if($request->edit_list_bubble_title == 0 || !isset($request->check_list_bubble)){
            Session::flash('error', 'Please choose !');
            return back();
        }

        foreach ($request->check_list_bubble as $value) {
            $this->deleteBubbleTitle($value);
        }
        Session::flash('success', 'Successful implementation!');
        return back();
    }






    public function deleteProductGallery($id, $id_product){

        $product = Product::find($id_product);

        $result = Str::of($this->deleteOneValueString($product->product_gallery, $id))->trim()->isNotEmpty();
        if($result){
            $product->product_gallery = Str::of($this->deleteOneValueString($product->product_gallery, $id))->rtrim(',');
        }
        else{
            $product->product_gallery = '';
        }

        $product->save();

        $product_price = Product_image::find($id);
        $product_price->delete();

        return $id;
    }




    public function processImage($image){
        $get_name_image = $image->getClientOriginalName();

        $name_image = current(explode('.', $get_name_image));
        //echo $get_name_image.'<br/>';
        $new_image = $name_image.rand(1,100).'.'.$image->getClientOriginalExtension();
        $image->move('public/upload/product', $new_image);
        return '/public/upload/product/'.$new_image;
    }



    public function saveBubbleToProduct($id_product, $id_bubble){

        DB::table('bubble_to_product')->insert(['product_id' => $id_product, 'bubble_id' => $id_bubble]);
    }

    public function deleteBubbleProductPrefix($id, $type){
        //0: delete by category, 1: delete by product
        // $product_to_bubble = DB::table('bubble_to_product')->get();
        // if($type == 1){
        //     foreach ($product_to_bubble as $value) {
        //         if($value->product_id == $id){
        //             DB::table('bubble_to_product')->where('id', $value->id)->delete();
        //         }
        //     }
        // }
        // elseif($type == 0){
        //     foreach ($product_to_bubble as $value) {
        //         if($value->bubble_id == $id){
        //             DB::table('bubble_to_product')->where('id', $value->id)->delete();
        //         }
        //     }
        // }



    }


    public function saveProductToCategory($id_product, $id_category){
        $product_to_category = new Product_to_category();
        $product_to_category->id_product = $id_product;
        $product_to_category->id_category = $id_category;
        $product_to_category->save();
    }

    public function deleteCategoryProductPrefix($id, $type){
        //0: delete by category, 1: delete by product
        $product_to_category = Product_to_category::all();
        if($type == 1){
            foreach ($product_to_category as $value) {
                if($value->id_product == $id){
                    Product_to_category::find($value->id)->delete();
                }
            }
        }
        elseif($type == 0){
            foreach ($product_to_category as $value) {
                if($value->id_category == $id){
                    Product_to_category::find($value->id)->delete();
                }
            }
        }



    }

    public function editProductCategory($id_product, $product_category){

        $product_to_category = Product_to_category::where('id_product', $id_product)->get();


            if(count($product_to_category) > 0){

                foreach ($product_category as $value1) {
                    $check = 0;
                     foreach ($product_to_category as $value) {
                        if($value1 == $value->id_category){
                            //new create
                            $check = 1;
                        }
                    }
                    if($check == 0){
                        $this->saveProductToCategory($id_product, $value1);
                    }
                }
                foreach ($product_to_category as $value) {
                    $check = 0;
                    foreach ($product_category as $value1) {

                      if($value1 == $value->id_category){
                            //delete
                            $check = 1;
                        }
                    }
                    if($check == 0){
                        Product_to_category::find($value->id)->delete();
                    }

                }
            }
            else{
                foreach ($product_category as $value1) {
                    $this->saveProductToCategory($id_product, $value1);
                }

            }
    }


    public function editProductBubble($id_product, $product_bubble){

        $product_to_bubble = DB::table('bubble_to_product')->where('product_id', $id_product)->get();


            if(count($product_to_bubble) > 0){

                foreach ($product_bubble as $value1) {
                    $check = 0;
                     foreach ($product_to_bubble as $value) {
                        if($value1 == $value->bubble_id){
                            //new create
                            $check = 1;
                        }
                    }
                    if($check == 0){
                        $this->saveBubbleToProduct($id_product, $value1);
                    }
                }
                foreach ($product_to_bubble as $value) {
                    $check = 0;
                    foreach ($product_bubble as $value1) {

                      if($value1 == $value->bubble_id){
                            //delete
                            $check = 1;
                        }
                    }
                    if($check == 0){
                        DB::table('bubble_to_product')->where('id', $value->id)->delete();
                    }

                }
            }
            else{
                foreach ($product_bubble as $value1) {
                    $this->saveProductToCategory($id_product, $value1);
                }

            }
    }

    public function getBanner(){
        $banner = DB::table('banner')->orderBy('location', 'ASC')->get();
        return view('admin.banner')->with('banner', $banner);
    }

    public function postAddBanner(Request $request){

        $image = 'public/upload/product/product_default.png';

        $get_image = $request->file('image');

        if($get_image){
            $image = $this->processImage($get_image);
        }
        $product_image = new Product_image();
        $product_image->product_image = $image;
        $product_image->save();


        if(DB::table('banner')->insert(['image' => $product_image->id, 'number_order' => $request->number_order, 'location' => $request->location, 'note' => $request->note]))
        {

            Session::flash('success', 'Add success');
            return back();
        }
        else{
            Session::flash('error', 'Add failure');
            return back();
        }


    }

    public function postEditBanner(Request $request){
        //dd($request);

        DB::table('banner')->where('id', $request->id_edit_banner)->update(['number_order' => $request->edit_number_order, 'location' => $request->edit_location, 'note' => $request->edit_note]);


            $get_image = $request->file('edit_image');

            if($get_image){

                $product_image = Product_image::find($request->edit_id_image);

                $image = $this->processImage($get_image);
                $product_image->product_image = $image;
                $product_image->save();
            }

            Session::flash('success', 'Edited successfully');
            return back();
    }

    public function getDeleteBanner($id){


        if(Product_image::find(DB::table('banner')->where('id', $id)->value('image'))->delete() && DB::table('banner')->where('id', $id)->delete()){
            Session::flash('success', 'Deleted successfully');
            return back();
        }
        Session::flash('error', 'Error');
        return back();
    }



    public function getCategoryAndBrand($value){
        $string = '';
        foreach($value as $service){

            $string .= $service.',';
        }

        $string = Str::of($string)->rtrim(',');
        return $string;
    }

    public function ShowOptionCategoryInProduct($id, $text = 0){
        $product_category = Product_category::orderby('id', 'DESC')->get();
        foreach ($product_category as $value) {
            if($value->category_parent == $id){
                $this->htmlSelect2 .='<div class="form-check '.$text.'" style="margin-left:'.$text.'px">
                                  <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="product_category[]" value="'.$value->id.'">'.$value->category_name.'
                                  </label>
                                </div>';

                $this->ShowOptionCategoryInProduct($value->id, $text+20);
            }

        }
        return $this->htmlSelect2;
    }


    public function ShowOptionCategoryInEditProduct($id, $id_product, $text = 0){

        $product_category = Product_category::orderby('id', 'DESC')->get();
        $arr = array();

        $product_to_category = Product_to_category::all();

        foreach ($product_to_category as $value) {
            if($value->id_product == $id_product){
               array_push($arr, $value->id_category);
            }

        }


        $check = 0;
        foreach ($product_category as $value) {

                $check = 0;
                foreach ($arr as $value1) {
                    if($value1 == $value->id){
                        $check = 1;
                    }
                }

            if($value->category_parent == $id){
                if($check == 1){
                    $this->htmlSelect3 .='<div class="form-check '.$text.'" style="margin-left:'.$text.'px">
                                  <label class="form-check-label">
                                    <input type="checkbox" checked="checked" class="form-check-input" name="product_category[]" value="'.$value->id.'">'.$value->category_name.'
                                  </label>
                                </div>';
                }
                else{
                    $this->htmlSelect3 .='<div class="form-check '.$text.'" style="margin-left:'.$text.'px">
                                  <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="product_category[]" value="'.$value->id.'">'.$value->category_name.'
                                  </label>
                                </div>';
                }


                $this->ShowOptionCategoryInEditProduct($value->id, $id_product, $text+20);

            }

        }
        return $this->htmlSelect3;
    }

    public function processGallery($gallery_img){
        $id_image = '';
            foreach ($gallery_img as $value) {
                $Product_image = new Product_image();
                $gallery =  $this->processImage($value);
                $Product_image->product_image = $gallery;
                $Product_image->save();
                $id_image .=  $Product_image->id.',';
            }
            $id_image = Str::of($id_image)->rtrim(',');
            return $id_image;
    }




    public function saveProductPrice($price_regular = 0, $price_online = null, $price_promotion = null, $price_installment = null){

        $product_price = new Product_price();
        $product_price->price_regular = $price_regular;
        $product_price->price_online = $price_online;
        $product_price->price_promotion = $price_promotion;
        $product_price->price_installment = $price_installment;
        $product_price->save();

        return $product_price->id;
    }

    public function updateProductPrice($id, $price_regular = 0, $price_online = null, $price_promotion = null, $price_installment = null){
        $getvariationprice = Product_price::find($id);
        // if($price_regular != $getvariationprice->price_regular || $price_online != $getvariationprice->price_online || $price_promotion != $getvariationprice->price_promotion){
            // Product::find(Product::where('product_price', $id)->value('id'))->update(['updated_at' => Carbon::now('Asia/Ho_Chi_Minh')]);
        // }
        $getvariationprice->price_regular = $price_regular;
        $getvariationprice->price_online = $price_online;
        $getvariationprice->price_promotion = $price_promotion;
        $getvariationprice->price_installment = $price_installment;
        $getvariationprice->save();


    }

    public function deleteOneValueString($str, $id){
        $collection = Str::of($str)->explode(',');

        $string = '';
        foreach ($collection as $value) {
            # code...
            if($id != $value){
                $string .= $value.',';
            }
        }
        return $string;
    }

    // public function getCheckedParent($id, $string = ''){
    //     if(Product_category::find($id)->category_parent == 0){

    //     }
    //     $string .= Product_category::find($id)->category_parent.',';
    //     $this->getCheckedParent(Product_category::find($id)->category_parent, $string);
    // }


    public function fixBug(){
        return Str::random(20);
    }







}



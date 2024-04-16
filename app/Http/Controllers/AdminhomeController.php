<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\admin;
use App\Models\Product_category;
use App\Models\Product_brand;
use App\Models\Product;
use App\Models\bill;
use Illuminate\Support\Facades\DB;




class AdminhomeController extends Controller
{
    private $htmlSelect;
    private $htmlSelect1;
    public function __construct(){
        $this->htmlSelect = '';
        $this->htmlSelect1 = '';
    }

    public function getDashboard(){
        $qlt_product = Product::all();
        $all_bill = bill::all();

        $total_price_success = bill::where('bill_status', 5)->get();
        $total_bill_new = bill::where('bill_status', 1)->orderby('id', 'DESC')->get();
        $bills = bill::where('bill_status', 1)->orderby('id', 'DESC')->take(10)->get();
        $price = 0;
        foreach ($total_price_success as $value) {
            $price += $value->bill_total;
        }

        return view('admin.dashboard')->with('qlt_product', count($qlt_product))->with('total_bill_success', count($total_price_success))->with('total_bill_new', count($total_bill_new))->with('total_price', $price)->with('all_bill', count($all_bill))->with('bills', $bills);
    }

    //show template login
    public function getLogin(){
        if(!Auth::guard('admin')->check()){
            return view('admin.login');
        }
        else{
            return Redirect::to('admin/dashboard');
        }

    }

    public function getEditMegaMenu(Request $request){
        $parent_categories = DB::table('product_category')->where('category_parent', 0)->orderBy('id', 'asc')->get();
        $preview_menu = DB::table('main_menu')->get();
        $preview_menu_id = [];
        if(count($preview_menu)>0){
        foreach($preview_menu as $val){
            array_push($preview_menu_id, $val->id_cate);
        }}
        return view('admin.edit_megamenu', ['parent_categories'=>$parent_categories, 'preview_menu' =>$preview_menu, 'preview_menu_id'=>$preview_menu_id]);
    }

    public function postEditMegaMenu(Request $request){
        DB::table('main_menu')->truncate();

        $arr_id_cate = $_POST['arr_id_cate'];
        foreach($arr_id_cate as $val){
            DB::table('main_menu')->insert(['id_cate'=>$val]);
        }
         Session::flash('success', 'Successful implementation');

        return 'daucatmoi';
    }
    //category_sku, category_name, category_status

    //hiển thị giao diện thêm danh mục
    public function getAddCategory(){
        $product_category = $this->publicShowOptionCategory(0);
        $product_brand = Product_brand::orderBy('id', 'DESC')->get();
        return view('admin.addcategory')->with('product_category', $product_category)->with('product_brand', $product_brand);
    }
    //hiển thị giao diện danh mục
    public function getShowCategory(){
        //$product_category = Product_category::orderby('id', 'DESC')->get();
        $product_category = $this->publicShowOptionCategory(0);
        $product_category1 = $this->publicShowCategory(0);
        $product_brand = Product_brand::orderBy('id', 'DESC')->get();
        return view('admin.showcategory', ['product_category' => $product_category, 'product_category1' => $product_category1, 'product_brand' => $product_brand]);
    }

    //thêm danh mục sản phẩm
    public function postAddCategory(Request $request){
        //category_sku, category_name, category_status, category_parent
        $product_category = new Product_category();
        if(Product_category::where('category_slug', $this->createSlug($request->category_name))->exists()){


            $product_category->category_slug = $this->createSlug($request->category_name).'-'.rand(100000, 999999);
        }else{
            $product_category->category_slug = $this->createSlug($request->category_name);
        }


        $product_category->category_name = $request->category_name;
        $product_category->category_status = $request->category_status;


        $product_category->category_sku = $request->category_sku;
        $product_category->category_parent = $request->category_parent;
        $product_category->category_type = $request->category_type;
        $product_category->save();
        $id = $product_category->id;

        $get_product_category = Product_category::where('id', $id)->first();
        $html = '<option value="'.$id.'">'.$get_product_category->category_name.'</option>';
        $get_product_category->html = $html;
        return $get_product_category;
    }

    public function postAddCategorySingle(Request $request){

        //category_sku, category_name, category_status
        $product_category = new Product_category();
        if(Product_category::where('category_slug', $this->createSlug($request->category_name))->exists()){
            $product_category->category_slug = $this->createSlug($request->category_name).'-'.rand(6);
        }else{

            $product_category->category_slug = $this->createSlug($request->category_name);
        }
        $product_category->category_name = $request->category_name;
        $product_category->category_status = $request->category_status;
        $product_category->category_sku = $request->category_sku;
        $product_category->category_parent = $request->category_parent;
        $product_category->category_type = $request->category_type;
        $product_category->save();

        Session::flash('success', 'Added category successfully');
        return redirect()->back();
    }

    //sua danh muc
    public function postEditCategory(Request $request){
        //category_sku, category_name, category_status
        //category_sku_edit, category_name_edit, category_status_edit, id_edit, category_parent_edit
        if(Product_category::whereNotIn('id', [$request->id_edit])->where('category_slug', '=', $request->category_slug_edit)->exists()){
            return 1;
        }
        $product_category = Product_category::find($request->id_edit);
        $product_category->category_name = $request->category_name_edit;
        $product_category->category_status = $request->category_status_edit;

        $product_category->category_slug = $this->createSlug($request->category_slug_edit);

        $product_category->category_sku = $request->category_sku_edit;
        $product_category->category_parent = $request->category_parent_edit;
        $product_category->category_type = $request->category_type_edit;
        $product_category->save();

        $id = $product_category->id;
        $get_product_category = Product_category::where('id', $id)->first();
        $html = '<option value="'.$id.'">'.$get_product_category->category_name.'</option>';
        $get_product_category->html = $html;
        return $get_product_category;
    }


    public function postEditCategoryList(Request $request){
        if(!isset($request->check_list_category) || $request->edit_list_category == 0){
            Session::flash('error', 'Please select actions and categories');
            return back();
        }
        else{
            if($request->edit_list_category == 1){
                foreach ($request->check_list_category as $value) {
                    $product_category = Product_category::find($value);
                    $product_category->category_status = 0;
                    $product_category->save();
                }
                Session::flash('success', 'Successful implementation');
                return back();
            }
            elseif ($request->edit_list_category == 2) {
                foreach ($request->check_list_category as $value) {
                    $product_category = Product_category::find($value);
                    $product_category->category_status = 1;
                    $product_category->save();
                }
                Session::flash('success', 'Successful implementation');
                return back();
            }
            elseif ($request->edit_list_category == 3) {
                foreach ($request->check_list_category as $value) {
                    $this->getDeleteCategory($value);
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




    public function getDeleteCategory($id){
        $get_category = Product_category::where('category_parent', $id)->get();
        $get_category1 =  $get_category->toArray();
        if(count($get_category1) > 0){
            foreach ($get_category as $value) {
                $get_update_parent = Product_category::find($value->id);
                $get_update_parent->category_parent = 0;
                $get_update_parent->save();
            }
        }
        //update category of product
        $get_product = Product::all();
        $AdminSanphamController = new AdminSanphamController();
        foreach($get_product as $value){
            $result = Str::of($value->product_category)->trim()->isNotEmpty();
            if($result){
                $product = Product::find($value->id);
                $string = Str::of($AdminSanphamController->deleteOneValueString($value->product_category, $id))->rtrim(',');
                $product->product_category = $string;
                $product->save();
            }
        }

        $AdminSanphamController->deleteCategoryProductPrefix($id, 0);

        $product_category = Product_category::find($id);
        $product_category->delete();

        return $id;
    }



    public function getAddBrand(){
        return view('admin.addbrand');
    }
    public function postAddBrandSingle(Request $request){
        //brand_name, brand_sku, brand_status

        $product_brand = new Product_brand();
        $product_brand->brand_name = $request->brand_name;
        $product_brand->brand_status = $request->brand_status;
        $product_brand->brand_slug = $this->createSlug($request->brand_name);
        $product_brand->brand_sku = $request->brand_sku;
        $product_brand->save();

        Session::flash('success', 'Thêm thương hiệu thành công');
        return redirect()->back();
    }


    public function getShowBrand(){
        $product_brand = Product_brand::orderby('id', 'DESC')->get();
        return view('admin.showbrand', ['product_brand' => $product_brand]);
    }

    public function postAddBrand(Request $request){
        //brand_name, brand_sku, brand_status
        $product_brand = new Product_brand();
        $product_brand->brand_name = $request->brand_name;
        $product_brand->brand_status = $request->brand_status;
        $product_brand->brand_slug = $this->createSlug($request->brand_name);
        $product_brand->brand_sku = $request->brand_sku;
        $product_brand->save();

        $get_product_brand = Product_brand::where('brand_name', $request->brand_name)->orderby('id', 'DESC')->first();

        return $get_product_brand;
    }



    public function postEditBrand(Request $request){
        // brand_name_edit, brand_sku_edit, brand_status_edit, id_edit
        $product_brand = Product_brand::find($request->id_edit);
        $product_brand->brand_name = $request->brand_name_edit;
        $product_brand->brand_status = $request->brand_status_edit;
        $product_brand->brand_slug = $this->createSlug($request->brand_name_edit);
        $product_brand->brand_sku = $request->brand_sku_edit;
        $product_brand->save();

        $get_product_brand = Product_brand::where('id', $request->id_edit)->first();

        Session::flash('success', 'Sửa thương hiệu thành công');
        return $get_product_brand;
    }


    public function postEditBrandList(Request $request){
        if(!isset($request->check_list_brand) || $request->edit_list_brand == 0){
            Session::flash('error', 'Hãy chọn hành động và các thương hiệu');
            return back();
        }
        else{
            if($request->edit_list_brand == 1){
                foreach ($request->check_list_brand as $value) {
                    $product_brand = Product_brand::find($value);
                    $product_brand->brand_status = 0;
                    $product_brand->save();
                }
                Session::flash('success', 'Successful implementation');
                return back();
            }
            elseif ($request->edit_list_brand == 2) {
                foreach ($request->check_list_brand as $value) {
                    $product_brand = Product_brand::find($value);
                    $product_brand->brand_status = 1;
                    $product_brand->save();
                }
                Session::flash('success', 'Successful implementation');
                return back();
            }
            elseif ($request->edit_list_brand == 3) {
                foreach ($request->check_list_brand as $value) {
                    $this->getDeleteBrand($value);
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



    public function getDeleteBrand($id){

        $product_category = Product_category::all();
        foreach($product_category as $value){
            if($value->category_type != 0 && $value->category_type == $id){
               $product_category_find = Product_category::find($value->id);

                $product_category_find->category_type = 0;
                $product_category_find->save();
            }

        }



        // $get_product = Product::all();
        // $AdminSanphamController = new AdminSanphamController();
        // foreach($get_product as $value){
        //     $result = Str::of($value->product_brand)->trim()->isNotEmpty();
        //     if($result){
        //         $product = Product::find($value->id);
        //         $string = Str::of($AdminSanphamController->deleteOneValueString($value->product_brand, $id))->rtrim(',');
        //         $product->product_brand = $string;
        //         $product->save();
        //     }
        // }


        $product_brand = Product_brand::find($id);
        $product_brand->delete();
        return $id;
    }


    //check login
    public function postLogin(Request $request){
        //username, password
        if(Auth::guard('admin')->attempt(['name' => $request->username, 'password' => $request->password])){
            return Redirect::to('admin/dashboard');
        }
        else{
            Session::flash('error', 'Username or password is not correct!');
            return Redirect::to('admin/login');
        }
    }

    public function getLogout(){
        //echo "string";
        Auth::guard('admin')->logout();
        return Redirect::to('admin/login');



    }
    public function publicShowCategory($id, $text = ''){
        $product_category = Product_category::orderby('id', 'DESC')->get();
        foreach($product_category as $value){
            if($value->category_parent == $id){
                if($value->category_status == 1){
                    $t = '<span class="btn btn-success">Show</span>';
                }
                else{
                    $t = '<span class="btn btn-secondary">Hide</span>';
                }
                $this->htmlSelect .= '<tr class="post'.$value->id.'">
                    <td><input type="checkbox" class="check_list" value="'.$value->id.'" name="check_list_category[]"></td>
                    <td>'.$text.' '.$value->category_name.'</td>
                    <td>'.$t.'</td>
                    <td>'.$value->category_sku.'</td>
                    <td><button type="button" class="edit_modal_category btn btn-warning btn-icon-split" data-id="'.$value->id.'" data-category_type="'.$value->category_type.'" data-title="'.$value->category_name.'" data-status="'.$value->category_status.'" data-code="'.$value->category_sku.'" data-parent="'.$value->category_parent.'" data-slug="'.$value->category_slug.'">
                      <span class="icon text-white-50">
                          <i class="fas fa-tools"></i>
                      </span>
                      <span class="text">Sửa</span>
                    </button> <button type="button" class="delete_modal_category btn btn-danger btn-icon-split" data-id="'.$value->id.'" data-title="'.$value->category_name.'" data-status="'.$value->category_status.'" data-code="'.$value->category_sku.'" data-parent="'.$value->category_parent.'" data-slug="'.$value->category_slug.'">
                      <span class="icon text-white-50">
                          <i class="fas fa-trash"></i>
                      </span>
                      <span class="text">Delete</span>
                    </button></td>

                  </tr>';

                  $this->publicShowCategory($value->id, $text.'-');
            }
        }
        return $this->htmlSelect;
    }



    public function publicShowOptionCategory($id, $text = ''){
        $product_category = Product_category::orderby('id', 'DESC')->get();
        foreach($product_category as $value){
            if($value->category_parent == $id){

                $this->htmlSelect1 .= '<option value="'.$value->id.'">'.$text.' '.$value->category_name.'</option>';

                  $this->publicShowOptionCategory($value->id, $text.'-');
            }
        }
        return $this->htmlSelect1;
    }
    public function createSlug($string){
        $slug = Str::ascii($string);

        $slug = Str::lower($slug);
        $slug = Str::slug($slug, '-');
        return $slug;
    }
    // public function create(){
    //  $user = new admin();
    //  $user->name = 'mevivu';
    //  $user->email = 'mevivu@gmail.com';
    //  $user->password = bcrypt('12345');
    //  $user->level = 1;
    //  $user->save();
    //  echo "thành công";
    // }

    public function getDuyetComment(){
        if(Auth::guard('admin')->check()){
            $comments = DB::table('comment')->get();
            return view('admin.duyetcomment',['comments'=>$comments]);
        }
        else{
            return view('admin.login');        }

    }

    public function acceptComment(Request $request){
        $id = $_GET['id'];
        DB::table('comment')->where('id', $id)->update(['cmt_status'=>1]);
        return $id;
    }

    public function cancelComment(Request $request){
        $id = $_GET['id'];
        DB::table('comment')->where('id', $id)->update(['cmt_status'=>0]);
        return $id;
    }

    public function deleteComment(Request $request){
        $id = $_GET['id'];
        DB::table('comment')->where('id', $id)->delete();
        return $id;
    }

}

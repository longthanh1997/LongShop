<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class GiohangController extends Controller
{
    public function showGioHang(){
        $discount = session()->get('coupon')['discount'] ?? 0;
        $newTotal = ((double)str_replace('.','',Cart::subtotal()) - $discount);

        $now = Carbon::now();
        $day = $now->day;
        $hour = $now->toArray()['hour'];

        if(Cart::count() > 0) {
            return view('pub.gio-hang', compact('discount','newTotal', 'day', 'hour'));
        }
        return redirect('/');
    }
    public function add(Request $request){
        $product_id = $request->productid;
        $quantity = $request->quantity;
        $product = DB::table('product')->where('id', $product_id)->first();

        $productPrice = DB::table('product_price')->where('id', $product->product_price)->first();
        $productImg = DB::table('product_image')->where('id', $product->product_avatar)->value('product_image');

        if($productPrice->price_online != null) {
            Cart::add([
                'id' => $product_id,
                'name' => $product->product_name,
                'qty' => $quantity,
                'price' => $productPrice->price_online,
                'options' => [
                    'img_feature' => $productImg,
                    'category' => $product->product_category,
                    'price_regular' => $productPrice->price_regular,
                    'available_qty' => $product->product_quantity
                ]
            ]);
        } else {
            if($productPrice->price_promotion != null) {
                Cart::add([
                    'id' => $product_id,
                    'name' => $product->product_name,
                    'qty' => $quantity,
                    'price' => $productPrice->price_promotion,
                    'options' => [
                        'img_feature' => $productImg,
                        'category' => $product->product_category,
                        'price_regular' => $productPrice->price_regular,
                        'available_qty' => $product->product_quantity
                    ]
                ]);
            } else {
                Cart::add([
                    'id' => $product_id,
                    'name' => $product->product_name,
                    'qty' => $quantity,
                    'price' => $productPrice->price_regular,
                    'options' => [
                        'img_feature' => $productImg,
                        'category' => $product->product_category,
                        'available_qty' => $product->product_quantity
                    ]
                ]);
            }
        }

        $this->sessionCoupon();
        return redirect()->route('cart.index');
    }

    public function addAjax(Request $request){
        if($request->ajax()){
            $product_id = $request->productid;
            $quantity = $request->quantity;
            $product = DB::table('product')->where('id', $product_id)->first();

            $productPrice = DB::table('product_price')->where('id', $product->product_price)->first();
            $productImg = DB::table('product_image')->where('id', $product->product_avatar)->value('product_image');

            if($productPrice->price_online != null) {
                Cart::add([
                    'id' => $product_id,
                    'name' => $product->product_name,
                    'qty' => $quantity,
                    'price' => $productPrice->price_online,
                    'options' => [
                        'img_feature' => $productImg,
                        'category' => $product->product_category,
                        'price_regular' => $productPrice->price_regular,
                        'available_qty' => $product->product_quantity
                    ]
                ]);
                return response()->json([
                    Cart::content(),
                    Cart::subtotal(),
                    Cart::count()
                ],200);
            } else {
                if($productPrice->price_promotion != null) {
                    Cart::add([
                        'id' => $product_id,
                        'name' => $product->product_name,
                        'qty' => $quantity,
                        'price' => $productPrice->price_promotion,
                        'options' => [
                            'img_feature' => $productImg,
                            'category' => $product->product_category,
                            'price_regular' => $productPrice->price_regular,
                            'available_qty' => $product->product_quantity
                        ]
                    ]);
                    return response()->json([
                        Cart::content(),
                        Cart::subtotal(),
                        Cart::count()
                    ],200);
                } else {
                    Cart::add([
                        'id' => $product_id,
                        'name' => $product->product_name,
                        'qty' => $quantity,
                        'price' => $productPrice->price_regular,
                        'options' => [
                            'img_feature' => $productImg,
                            'category' => $product->product_category,
                            'available_qty' => $product->product_quantity
                        ]
                    ]);
                    return response()->json([
                        Cart::content(),
                        Cart::subtotal(),
                        Cart::count()
                    ],200);
                }
            }
        }
    }

    public function updateIncrease(Request $request){
        Cart::update($request->rowID, $request->qty);
        $this->sessionCoupon();
        $discount = session()->get('coupon')['discount'] ?? 0;
        $newTotal = ((double)str_replace('.','',Cart::subtotal()) - $discount);
        return response()->json([
            Cart::content(),
            Cart::subtotal(),
            $discount,
            $newTotal,
            Cart::count()
        ],200);
        return redirect()->route('cart.index');
    }

    public function updateDecrease(Request $request){
        Cart::update($request->rowID, $request->qty);
        $this->sessionCoupon();
        $discount = session()->get('coupon')['discount'] ?? 0;
        $newTotal = ((double)str_replace('.','',Cart::subtotal()) - $discount);
        return response()->json([
            Cart::content(),
            Cart::subtotal(),
            $discount,
            $newTotal,
            Cart::count()
        ],200);
    }

    public function delete(Request $request){
        Cart::remove($request->rowID);
        $this->sessionCoupon();
        $discount = session()->get('coupon')['discount'] ?? 0;
        $newTotal = ((double)str_replace('.','',Cart::subtotal()) - $discount);
        return response()->json([
            Cart::content(),
            Cart::subtotal(),
            $discount,
            $newTotal,
            Cart::count()
        ],200);
    }

    public function moveToCheckOut(Request $request)
    {
        $data = $request->all();
        $qty = Cart::count();
        $city = DB::table('province')->where('id', $data['Customer_City'])->first();
        $district = DB::table('district')->where('id', $data['Customer_District'])->first();
        $ward = DB::table('ward')->where('id', $data['Customer_Ward'])->first();

        $fullAddress = $data['Customer_Address']. ', '. $ward->_prefix . ' ' . $ward->_name . ', ' . $district->_prefix. ' ' . $district->_name . ', ' . $city->_name;


        // LUU VAO DB USER
        if($data['IsCustomerReveice'] == "true"){
            DB::table('users')->insert([
                'name' => $data['Customer_Sex']. ' '. $data['Customer_Name'],
                'phone' => $data['Customer_Phone'],
                'email' => $data['Customer_Email'],
                'address' => $fullAddress,
                'payment_method' => $data['paymentMethod'],
                'note' => $data['Note'],
                'nguoinhan_name' => $data['CustomerReceive_Sex']. ' '. $data['CustomerReceive_Name'],
                'nguoinhan_phone' => $data['CustomerReceive_Phone'],
                'hoadondo_company' => $data['Customer_CompanyName'],
                'hoadondo_address' => $data['Customer_CompanyAddress'],
                'hoadondo_mst' => $data['Customer_CompanyTax'],
            ]);
        } else {
            DB::table('users')->insert([
                'name' => $data['Customer_Sex']. ' '. $data['Customer_Name'],
                'phone' => $data['Customer_Phone'],
                'email' => $data['Customer_Email'],
                'address' => $fullAddress,
                'payment_method' => $data['paymentMethod'],
                'note' => $data['Note'],
                'hoadondo_company' => $data['Customer_CompanyName'],
                'hoadondo_address' => $data['Customer_CompanyAddress'],
                'hoadondo_mst' => $data['Customer_CompanyTax'],
            ]);
        }

        $getUserID = DB::table('users')->orderBy('id', 'desc')->where('phone', $data['Customer_Phone'])->value('id');
        if(isset($data['bill_promo'])){
            DB::table('bill')->insert([
                'id_ofuser' => $getUserID,
                'bill_total' => $data['totalSum'],
                'bill_so_luong' => $qty,
                'bill_promo' => $data['bill_promo'],
                'bill_coupon' => $data['bill_coupon'],
            ]);
        } else {
            DB::table('bill')->insert([
                'id_ofuser' => $getUserID,
                'bill_total' => $data['totalSum'],
                'bill_so_luong' => $qty,
            ]);
        }

        $getBillID = DB::table('bill')->orderBy('id', 'desc')->where('id_ofuser', $getUserID)->value('id');
        foreach (Cart::content() as $item) {
            DB::table('chitiet_bill')->insert([
                'id_ofbill' => $getBillID,
                'id_ofproduct' => $item->id,
                'SL' =>$item->qty
            ]);

            // UPDATE LAI QTY PRODUCT
            $product = Product::find($item->id);
            $product->update([
                'product_quantity' => $product->product_quantity - $item->qty,
            ]);
        }

        session()->put('user', [
            'sex' => $data['Customer_Sex'],
            'name' => $data['Customer_Name'],
            'phone' => $data['Customer_Phone'],
            'email' => $data['Customer_Email'],
            'note' => $data['Note'],
            'city' => $city->_name,
            'city_id' => $city->id,
            'district' => $district->_name,
            'prefix_district' => $district->_prefix,
            'district_id' => $district->id,
            'ward' => $ward->_name,
            'prefix_ward' => $ward->_prefix,
            'ward_id' => $ward->id,
            'address' => $data['Customer_Address'],
            'fullAddress' => $fullAddress,
            'paymentMethod' => $data['paymentMethod'],
            'nguoinhan_name' => $data['CustomerReceive_Sex']. ' '. $data['CustomerReceive_Name'],
            'nguoinhan_phone' => $data['CustomerReceive_Phone'],
            'hoadondo_company' => $data['Customer_CompanyName'],
            'hoadondo_address' => $data['Customer_CompanyAddress'],
            'hoadondo_mst' => $data['Customer_CompanyTax'],
            'total' => $data['totalSum'],
            'IDofUser' => $getUserID,
            'IDofBill' => $getBillID
        ]);
        if(isset($data['bill_promo']) && isset($data['bill_coupon'])){
            $content = array('name' => $data['Customer_Sex']. ' '. $data['Customer_Name'],
                        'phone' => $data['Customer_Phone'],
                        'email' => $data['Customer_Email'],
                        'hoadondo_company' => $data['Customer_CompanyName'],
                        'cart' => Cart::content(),
                        'subtotal' => Cart::subtotal(),
                        'total' => $data['totalSum'],
                        'address' => $fullAddress,
                        'billID' => $getBillID,
                        'paymentMethod' => $data['paymentMethod'],
                        'bill_promo' => $data['bill_promo'],
                    );
        } else {
            $content = array('name' => $data['Customer_Sex']. ' '. $data['Customer_Name'],
                        'phone' => $data['Customer_Phone'],
                        'email' => $data['Customer_Email'],
                        'hoadondo_company' => $data['Customer_CompanyName'],
                        'cart' => Cart::content(),
                        'subtotal' => Cart::subtotal(),
                        'total' => $data['totalSum'],
                        'address' => $fullAddress,
                        'paymentMethod' => $data['paymentMethod'],
                        'billID' => $getBillID,
                    );
        }

        Mail::send('emails.sendMailToAdmin', $content , function($message) use ($getBillID){
	        $message->to('nguyen259999@gmail.com')->subject('[DienMayNhanNgoc] Đơn hàng mới #'.$getBillID);
	    });

        Cart::destroy();
        return redirect()->route('checkout.index');
    }

    private function sessionCoupon()
    {
        if(session()->has('coupon')){
            $code = session()->get('coupon')['name'];
            $coupon = Coupon::where('coupon_code', $code)->first();

            if($coupon->coupon_sanpham != ''){
                $couponProduct = strval($coupon->coupon_sanpham);
            }else {
                $couponProduct = "0";
            }

            if($coupon->coupon_danhmucsanpham != ''){
                $couponCategory = strval($coupon->coupon_danhmucsanpham);
            }else {
                $couponCategory = "0";
            }

            $priceDiscount = 0;
            session()->forget('coupon');
            // LAY TRUYEN ID PRODUCT VA CATEGORY VAO TRONG MANG
            $products_id = array();
            $categories_id = array();

            foreach (Cart::content() as $item) {
                array_push($products_id, $item->id);
                array_push($categories_id, $item->options['category']);

                if(strpos($item->id, $couponProduct) !== false){
                    $priceDiscount += $item->price * $item->qty;
                }

                elseif(strpos($item->options['category'], $couponCategory) !== false){
                    $priceDiscount += $item->price * $item->qty;
                }
            }

            $proID = implode(',', $products_id);
            $catID = implode(',', $categories_id);

            // CHUYỂN CHUỖI THÀNH MẢNG
            $arr_proID = explode(",", $proID);
            $arr_catID = explode(",", $catID);

            session()->put('coupon', [
                'name' => $coupon->coupon_code,
                'discount' => $coupon->discount((double)str_replace('.','', $priceDiscount), $arr_proID, $arr_catID),
            ]);
        }
    }

    public function getLocation(Request $request)
    {
        $parentId = $request->parent;
        $type = $request->type;
        if($parentId && $type == 'city'){
            $location = DB::table('district')->where('_province_id', $parentId)->get();
            return response(['data' => $location]);
        } else {
            $location = DB::table('ward')->where('_district_id', $parentId)->get();
            return response(['data' => $location]);
        }
    }

}

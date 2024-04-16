<?php

namespace App\Http\Controllers;

use App\Models\coupon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function store(Request $request)
    {
        $coupon = coupon::findByCode($request->Coupon);
        $data = $request->all();
        $arr_proID = explode(",",$data['proID']);
        $arr_catID = explode(",",$data['catID']);
        if(!$coupon)
        {
            return redirect()->route('cart.index')->withErrors('Coupon khong hop le');
        }

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

        foreach (Cart::content() as $item) {
            if(strpos($item->id, $couponProduct) !== false){
                $priceDiscount += $item->price * $item->qty;
            }
            
            elseif(strpos($item->options['category'], $couponCategory) !== false){
                $priceDiscount += $item->price * $item->qty;
            }
        }

        session()->put('coupon', [
            'name' => $coupon->coupon_code,
            'discount' => $coupon->discount((double)str_replace('.','',$priceDiscount), $arr_proID, $arr_catID),
        ]);

        return redirect()->route('cart.index');
    }

    public function destroy()
    {
        session()->forget('coupon');
        return redirect()->route('cart.index')->with('succes_msg', 'Coupon da duoc xoa');
    }
}

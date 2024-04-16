<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        if(session('user')){
            $bill = DB::table('bill')->where('id', session('user')['IDofBill'])->first();
            $infoUser = DB::table('users')->where('id', session('user')['IDofUser'])->first();
            $billDetails = DB::table('chitiet_bill')->where('id_ofbill', session('user')['IDofBill'])->get();
            return view('pub.dat-hang', compact('bill', 'infoUser', 'billDetails'));
        } else {
            return redirect('/');
        }
    }

    public function huyDonHang(){
        Cart::destroy();
        DB::table('chitiet_bill')->where('id_ofbill', session('user')['IDofBill'])->delete();
        DB::table('bill')->where('id_ofuser', session('user')['IDofUser'])->delete();
        DB::table('users')->where('id', session('user')['IDofUser'])->delete();
        return redirect('/');
    }

    public function muaThem(){
        return redirect('/');
    }

}
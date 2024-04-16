<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LichsumuahangController extends Controller
{
    public function index(){
        if(session()->has('phone')){
            return view('pub.lich-su-mua-hang');
        }
        return redirect()->back();
    }

    public function logIn(){
        return view('pub.lich-su-dang-nhap');
    }

    public function checkLogIn(Request $request){
        $user = DB::table('users')->orderBy('id','desc')->where('phone', $request->txtPhoneNumber)->first();
        if($user){
            session()->put('phone', [
                'phone' => $request->txtPhoneNumber
            ]);
            return redirect()->route('history.index');
        }
        return back()->with('errorHistory','SĐT này chưa từng đặt hàng');
    }

    public function detailBill($id){
        $bill = DB::table('bill')->where('id', $id)->first();
        $infoUser = DB::table('users')->where('id',$bill->id_ofuser)->first();
        $billDetails = DB::table('chitiet_bill')->where('id_ofbill', $id)->get();
        return view('pub.lich-su-chi-tiet', compact('bill', 'infoUser', 'billDetails'));
    }

    public function updateNhanHang(Request $request){
        if($request->hdGender == 0){
            $nguoiNhanName = "Chị " . $request->txtFullName;
        } else {
            $nguoiNhanName = "Anh " . $request->txtFullName;
        }
        $idUser = DB::table('bill')->where('id', $request->orderId)->value('id_ofuser');
        DB::table('users')->where('id', $idUser)->update([
            'nguoinhan_name' => $nguoiNhanName,
            'nguoinhan_phone' => $request->txtPhoneNumber
        ]);
        return redirect()->back();
    }
}

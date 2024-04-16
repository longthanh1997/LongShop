<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\admin;
use App\Models\bill;
use App\Models\User;
use App\Models\coupon;
use App\Models\Product;
use App\Models\product_category;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\Mail;


class DonhangController extends Controller
{
    public function getTatCaDonHang()
    {                                        // show don hang

        $bills = DB::table('bill')
            ->join('users', 'users.id', '=', 'bill.id_ofuser')
            ->select('bill.*', 'users.*', 'bill.id as id')
            ->get();
        return view('admin.tatcadonhang', ['bills' => $bills]);
    }
    public function getTatCaMaUuDai()
    {
        $coupon = DB::table('coupon')
            ->leftJoin('product', 'coupon.coupon_sanpham', '=', 'product.id')
            ->leftJoin('product_category', 'coupon.coupon_danhmucsanpham', '=', 'product_category.id')
            ->select('coupon.*', 'product.product_name', 'product_category.category_name')
            ->get();

        return view('admin.tatcacoupon', ['coupon' => $coupon]);
    }
    public function getThemMaUuDai()
    {
        $product = Product::orderby('id')->get();
        $product_category = product_category::orderby('id')->get();
        return view('admin.themmauudai', ['products' => $product, 'product_categories' => $product_category]);
    }
    public function postThemMaUuDai(Request $request)
    {
        if ($request['coupon_type'] == 1) {
            $request['coupon_sanpham'] = null;
        } else {
            $request['coupon_danhmucsanpham'] = null;
        }
        $coupon = new coupon();
        $coupon->coupon_type                        = $request['coupon_type'];
        $coupon->coupon_code                        = $request['coupon_code'];
        $coupon->coupon_description                 = $request['coupon_description'];
        $coupon->coupon_value                       = $request['coupon_value'];
        $coupon->coupon_danhmucsanpham              = $request['coupon_danhmucsanpham'];
        $coupon->coupon_sanpham                     = $request['coupon_sanpham'];
        $coupon->coupon_date                        = $request['coupon_date'];
        $coupon->save();
        Session::flash('success', 'Added promotion code successfully');
        return redirect()->back();
    }
    public function getXoaMaUuDai($id)
    {
        $coupon = coupon::find($id);
        $coupon->delete();
        Session::flash('success', 'Deleted promotion code successfully');
        return redirect()->back();
    }
    public function getXoaDonHang($id)
    {
        $bill = bill::find($id);
        $bill->delete();
        Session::flash('success', 'Deleted promotion code successfully');
        return redirect()->back();
    }
    public function getSuaMaUuDai($id)
    {
        $product = Product::orderby('id')->get();
        $product_category = product_category::orderby('id')->get();
        $coupon = coupon::find($id);
        return view('admin.suamauudai', ['coupon' => $coupon, 'products' => $product, 'product_categories' => $product_category]);
    }
    public function getSuaDonHang($id)
    {
        $bill = bill::find($id);
        $user = User::find($bill->id_ofuser);
        $name = $user->nguoinhan_name;
        return view('admin.suadonhang', ['bill' => $bill, 'name' => $name]);
    }
    public function sendMail($id)
    {
        $bill = DB::table('bill')
            ->join('users', 'bill.id_ofuser', '=', 'users.id')
            ->where('bill.id', $id)->first();
        $getBillID = $bill->id;
        $userEmail = $bill->email;
        $items = DB::table('chitiet_bill')
            ->join('product_price', 'chitiet_bill.id_ofproduct', '=', 'product_price.id')
            ->join('product', 'product_price.id', '=', 'product.id')
            ->where('id_ofbill', $id)
            ->get();
        $total = 0;
        foreach ($items as $item) {
            $totalOfItem = $item->SL * $item->price_regular;
            $total += $totalOfItem;
        }
        // send mail
        $content = [
            'name' => $bill->nguoinhan_name,
            'phone' => $bill->phone,
            'email' => $userEmail,
            'hoadondo_company' => $bill->hoadondo_company,
            'cart' => 'Cart::content()',
            'subtotal' => 'Cart::subtotal()',
            'total' => 'Test tong tien',
            'address' => $bill->address,
            'billID' => $getBillID,
            'items' => $items,
            'total' => $total
        ];
        Mail::send('emails.sendMailToUser', $content, function ($message) use ($userEmail) {
            $message->to($userEmail)->subject('MEVIVU');
        });
        return redirect()->back();
    }
    public function changStatus($status, $id)
    {
        // if ($status == 2) {
        //     $bill = DB::table('bill')
        //         ->join('users', 'bill.id_ofuser', '=', 'users.id')
        //         ->where('bill.id', $id)->first();
        //     $getBillID = $bill->id;
        //     $userEmail = $bill->email;
        //     $items = DB::table('chitiet_bill')
        //         ->join('product_price', 'chitiet_bill.id_ofproduct', '=', 'product_price.id')
        //         ->join('product', 'product_price.id', '=', 'product.id')
        //         ->where('id_ofbill', $id)
        //         ->get();
        //     $total = 0;
        //     foreach ($items as $item) {
        //         $totalOfItem = $item->SL * $item->price_regular;
        //         $total += $totalOfItem;
        //     }
        //     // send mail
        //     $content = [
        //         'name' => $bill->nguoinhan_name,
        //         'phone' => $bill->phone,
        //         'email' => $userEmail,
        //         'hoadondo_company' => $bill->hoadondo_company,
        //         'cart' => 'Cart::content()',
        //         'subtotal' => 'Cart::subtotal()',
        //         'total' => 'Test tong tien',
        //         'address' => $bill->address,
        //         'billID' => $getBillID,
        //         'items' => $items,
        //         'total' => $total
        //     ];
        //     Mail::send('emails.sendMailToUser', $content, function ($message) use ($userEmail) {
        //         $message->to($userEmail)->subject('MEVIVU');
        //     });
        // }

        $bill = bill::find($id);
        $bill->bill_status = $status;
        $bill->save();
        // $result = ['status' => $status];
        // echo json_encode($result);
        // return redirect()->back();
        return 'Thay đổi trạng thái thành công';
    }
    public function postSuaMaUuDai(Request $request)
    {
        if ($request['coupon_type'] == 1) {
            $request['coupon_sanpham'] = null;
        } else {
            $request['coupon_danhmucsanpham'] = null;
        }
        $coupon = coupon::find($request['id']);
        $coupon->coupon_type                        = $request['coupon_type'];
        $coupon->coupon_code                        = $request['coupon_code'];
        $coupon->coupon_description                 = $request['coupon_description'];
        $coupon->coupon_value                       = $request['coupon_value'];
        $coupon->coupon_danhmucsanpham              = $request['coupon_danhmucsanpham'];
        $coupon->coupon_sanpham                     = $request['coupon_sanpham'];
        $coupon->coupon_date                        = $request['coupon_date'];
        $coupon->save();
        Session::flash('success', 'Edited promotion code successfully');
        return redirect()->route('coupon');
    }
    public function postSuaDonHang(Request $request)
    {
        $id = $request['id'];
        $name = $request['name'];
        $total = $request['total'];
        $status = $request['status'];
        $quantity = $request['quantity'];

        $bill = bill::find($id);
        $user = User::find($bill->id_ofuser);

        $user->nguoinhan_name = $name;
        $user->save();

        $bill->bill_total = $total;
        $bill->bill_status = $status;
        $bill->bill_so_luong = $quantity;
        $bill->save();
        Session::flash('success', 'Sửa đơn hàng đãi thành công');
        return redirect()->route('donhang');
    }
}

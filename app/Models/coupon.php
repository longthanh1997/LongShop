<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coupon extends Model
{
    use HasFactory;

    protected $table = 'coupon';

    protected $guarded =[];

    public static function findByCode($code){
        return Coupon::where('coupon_code', $code)->first();
    }

    public function discount($total, $arr_proID, $arr_catID)
    {
        if($this->coupon_type == 1 && (in_array($this->coupon_sanpham, $arr_proID) || in_array($this->coupon_danhmucsanpham,$arr_catID))){
            return $this->coupon_value;
        } 
        elseif ($this->coupon_type == 2 && (in_array($this->coupon_sanpham, $arr_proID) || in_array($this->coupon_danhmucsanpham,$arr_catID))) {
            return round(($this->coupon_value / 100) * $total);
        }
        else {
            return 0;
        }
    }
}

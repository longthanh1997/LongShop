<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_price extends Model
{
    use HasFactory;
    //price_regular, price_promotion, price_installment
    protected $table = "product_price";

    public $timestamps = false;
    // protected $fillable = [
    //     'product_name', 'product_desc', 'product_status'
    // ];
    protected $guarded =[];

 //    public function product_type()
	// {
	// 	return $this->belongsTo('App\Brand','brand_id', 'brand_id');
	// }
}

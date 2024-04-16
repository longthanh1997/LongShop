<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_brand extends Model
{
    use HasFactory;
    //brand_name, brand_sku, brand_status, brand_slug
    protected $table = 'product_brand';

    protected $guarded =[];

    // public function product(){
    // 	return $this->hasMany('App\Product','brand_id', 'brand_id');
    // }
}

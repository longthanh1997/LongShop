<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_category extends Model
{
    use HasFactory;
    //category_sku, category_name, category_status, category_parent, category_slug
    protected $table = 'product_category';

    protected $guarded =[];

    // public function product(){
    // 	return $this->hasMany('App\Product','brand_id', 'brand_id');
    // }
}

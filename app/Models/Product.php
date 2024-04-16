<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    //product_category, product_name, product_sku, product_quantity, product_avatar, product_gallery, product_brand, product_variation_status, product_variation, product_status, product_shortdsc, product_longdsc, product_info
    protected $table = "product";

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

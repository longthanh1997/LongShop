<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_image extends Model
{
    use HasFactory;
    //product_image, 
    protected $table = "product_image";
    
    public $timestamps = false;
    // protected $fillable = [
    //     'product_name', 'product_desc', 'product_status'
    // ];
    protected $guarded =[];
}

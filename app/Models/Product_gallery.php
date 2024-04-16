<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_gallery extends Model
{
	//product_image
    use HasFactory;
    protected $table = 'product_gallery';

    protected $guarded =[];
}

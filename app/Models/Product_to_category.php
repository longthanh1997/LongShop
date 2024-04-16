<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_to_category extends Model
{
    use HasFactory;
    //id_product, id_category
    protected $table = 'product_to_category';

    protected $guarded =[];
}

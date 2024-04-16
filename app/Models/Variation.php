<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    use HasFactory;
    //variation_oftype, variation_sku, variation_name, variation_price
    protected $table = 'variation';

    protected $guarded =[];
}

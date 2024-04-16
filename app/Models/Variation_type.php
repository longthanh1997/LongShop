<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation_type extends Model
{
    use HasFactory;
    //variation_type_sku, variation_type_name
    protected $table = 'variation_type';

    protected $guarded =[];
}

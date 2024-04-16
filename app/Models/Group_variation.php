<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group_variation extends Model
{
    use HasFactory;
    //id_variation, id_price
    protected $table = 'group_variation';

    protected $guarded =[];
}

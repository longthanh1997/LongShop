<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;

class FeatureController extends Controller{

    public function getSortPrice(Request $request){
        $type_sort = $request->type_sort;
        $category = $request->category;
        $products = DB::table('product')
            ->join('product_price', 'product.product_price', '=', 'product_price.id')
            ->where('')
            ->select('product', 'product_price')
            ->get();
        if($type_sort == 'min_max'){

        }

    }

}


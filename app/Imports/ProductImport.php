<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Product;
use App\Models\Product_price;
use App\Http\Controllers\AdminhomeController;

class ProductImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
    	$AdminhomeController = new AdminhomeController();
        
        //
        unset($collection[0]);
        foreach ($collection as $key => $value) {
        	if($product = Product::find($value[0])){
        		$product->product_slug = $AdminhomeController->createSlug($value[1]);
        		Product_price::where('id', $product->product_price)->update([
        			"price_regular" => $value[2],
        			"price_online" => $value[3],
        			"price_promotion" => $value[4],
        			"price_installment" => $value[5] == 1 ? 1 : 0
        		]);
        		$product->product_sku = $value[6];
        		$product->product_status = $value[7] == 1 ? 1 : 0 ;
        		$product->total_offer = $value[8];
        		$product->save();
        	}
        }
    }
}

<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table("product")
        ->join("product_price", "product.product_price", "=", "product_price.id")
        ->select("product.id as id", "product_name", "product_price.price_regular", "product_price.price_online", "product_price.price_promotion", "product_price.price_installment", "product_sku", "product_status", "total_offer")->get();

    }

    public function headings() :array {
    	return ["ID", "Tên SP", "Giá hiện tại", "Giá online", "Giá giảm", "Trả góp", "Mã SP", "trạng thái", "Tổng tiền khuyến mãi"];
    }
}

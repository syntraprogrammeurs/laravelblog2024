<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Product_ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $products = DB::table('products')->select('id')->get();
        $productcategories = DB::table('product_categories')->select('id')->get();

        foreach($products as $product){
            $productCategoryIds = $productcategories->random(rand(1,3))->pluck('id')->toArray();
            DB::table('product_productcategory')->insert(
              array_map(function($productCategoryId) use($product){
                  return [
                      'product_id'=>$product->id,
                      'productcategory_id'=> $productCategoryId,
                      'created_at'=>now(),
                        'updated_at'=>now()
                  ];
              }, $productCategoryIds
              )
            );
        }
    }
}

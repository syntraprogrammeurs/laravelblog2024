<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $productcategories =['elektro','tuin','sport'];
        foreach($productcategories as $productcategory){
            ProductCategory::create([
               'name'=>$productcategory,
               'description'=>fake()->paragraphs(3,true)
            ]);
        }
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\ProductDescription;
use App\ProductType;


class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();
        DB::table('product_descriptions')->truncate();
        DB::table('product_types')->truncate();

//am using the create but not DB::table('products')->insert([]) because create allows the timestamps methods to work and the time(), but DB allows you to insert many values in array and does not allow timestamps methods to work and the time()
        Product::create([
        	'user_id' => 1,
        	'product_name' => 'BOTTOM PROFILE',
        	'qty' => 400,
        	'pcs_rft' => 'PCS'

        ]);

    	Product::create([
    		'user_id' => 1,
        	'product_name' => 'HAND RAIL',
        	'qty' => 800,
        	'pcs_rft' => 'RFT' 
        	
    ]);


    ProductDescription::create(['product_id' => 1,'description' => 'STAR']);
    ProductType::create(['product_id' => 1, 'type' => '75 MM']);
    ProductDescription::create(['product_id' => 2, 'description' => 'ROUND']);
    ProductType::create(['product_id' => 2, 'type' => 'NA']);

    
}
}

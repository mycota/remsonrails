<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\ProductDescription;
use App\ProductType;
use App\ProductImage;


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
        ProductImage::truncate();
        DB::table('product_descriptions')->truncate();
        DB::table('product_types')->truncate();

        //am using the create but not DB::table('products')->insert([]) because create allows the timestamps methods to work and the time(), but DB allows you to insert many values in array and does not allow timestamps methods to work and the time()
        $bottom_profile = Product::create(['user_id' => 1, 'product_name' => 'Bottom Profile', 'qty' => 0, 'pcs_rft' => 'PCS']);

        $hand_rail = Product::create(['user_id' => 1, 'product_name' => 'Hand Rail', 'qty' => 0, 'pcs_rft' => 'RFT']);

        $bottom_profile_descript = array('Smart Line Continue Profile', 'Sea Line Bracket Profile', 'Square Line Bracket Profile', 'Slim Line Continue Profile', 'Small Line Continue Profile', 'Star Line Bracket Profile', 'Sky Line Bracket Profile', 'Spark Line Bracket Profile', 'Sleek Line Continue Profile', 'Super Line Continue Profile', 'Signature Line Continue Profile');

        $bottom_profile_images = array('smart_line.jpg', 'sea_line.jpg', 'square_line.jpg', 'slim_line.jpg', 'small_line.jpg', 'star_line.jpg', 'sky_line.jpg', 'spark_line.jpg', 'sleek_line.jpg', 'super_line.jpg', 'signature_line.jpg');


        for ($i=0; $i < count($bottom_profile_descript); $i++) {

            $image = ProductImage::create(['user_id'=>1, 'image_name'=>$bottom_profile_images[$i]]);
            $bottom_profile->product_despt()->create(['product_image_id'=>$image->id, 'description' =>$bottom_profile_descript[$i]]);
        }


        $hand_rail_descript = array('Round Hand Rail', 'Square Hand Rail', 'Small Hand Rail', 'Slim Hand Rail', 'Edge Guard Hand Rail', 'Half Round Hand Rail', 'Rectangle Hand Rail', 'Incline Hand Rail');

        $hand_rail_image = array('round_hand_rail.jpg', 'square_hand_rail.jpg', 'samll_hand_rail.jpg', 'slim_hand_rail.jpg', 'edge_guard_hand_rail.jpg', 'half_round_hand_rail.jpg', 'rectangle_hand_rail.jpg', 'incline_hand_rail.jpg');

        for ($i=0; $i < count($hand_rail_descript); $i++) {

            $imagehr = ProductImage::create(['user_id'=>1, 'image_name'=>$hand_rail_image[$i]]);
            $hand_rail->product_despt()->create(['product_image_id'=>$imagehr->id, 'description' =>$hand_rail_descript[$i]]);
        }

        $product_type = array('50 mm', '75 mm', '100 mm', '150 mm', 'Full Profile'); // for bottom profile only

        for ($i=0; $i < count($product_type); $i++) { 
            $bottom_profile->product_type()->create(['type' =>$product_type[$i]]);
        }
    
}
}


//am using the create but not DB::table('products')->insert([]) because create allows the timestamps methods to work and the time(), but DB allows you to insert many values in array and does not allow timestamps methods to work and the time()
    //     Product::create([
    //         'user_id' => 1,
    //         'product_name' => 'BOTTOM PROFILE',
    //         'qty' => 0,
    //         'pcs_rft' => 'PCS'

    //     ]);

    //     Product::create([
    //         'user_id' => 1,
    //         'product_name' => 'HAND RAIL',
    //         'qty' => 0,
    //         'pcs_rft' => 'RFT' 
            
    // ]);


    // ProductDescription::create(['product_id' => 1,'description' => 'STAR']);
    // ProductType::create(['product_id' => 1, 'type' => '75 MM']);
    // ProductDescription::create(['product_id' => 2, 'description' => 'ROUND']);
    // ProductType::create(['product_id' => 2, 'type' => 'NA']);


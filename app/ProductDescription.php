<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDescription extends Model
{
    protected $guarded = [];
	
    public function productDespt()
    {
    	return $this->belongsTo(Product::class, 'product_id');
    }

    public function product_image()
    {
    	return $this->belongsTo(ProductImage::class, 'product_image_id');
    }
}

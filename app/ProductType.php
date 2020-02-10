<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $guarded = [];
	
    public function productType()
    {
    	return $this->belongsTo(Product::class, 'product_id');
    }
}

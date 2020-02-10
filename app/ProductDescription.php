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
}

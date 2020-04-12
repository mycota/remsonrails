<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $guarded = [];
	
    public function user_image()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function product_description()
    {
        return $this->hasOne(ProductDescription::class);
    }
}

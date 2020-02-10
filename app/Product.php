<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function userprod()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }


    public function product_despt()
    {
        return $this->hasMany(ProductDescription::class);
    }

    public function product_type()
    {
        return $this->hasMany(ProductType::class);
    }
}

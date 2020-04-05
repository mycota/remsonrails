<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    protected $guarded = [];

    public function product_color_order(){

    	return $this->belongsTo(QuotationOrder::class, 'quotation_order_id');
    }
}

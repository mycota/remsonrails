<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $guarded = [];

    public function product_detail_order(){

    	return $this->belongsTo(QuotationOrder::class, 'quotation_order_id');
    }
}

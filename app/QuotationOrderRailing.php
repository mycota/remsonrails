<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuotationOrderRailing extends Model
{
    protected $guarded = [];

    public function railing_order(){

    	return $this->belongsTo(QuotationOrder::class, 'quotation_order_id');
    }
    
}

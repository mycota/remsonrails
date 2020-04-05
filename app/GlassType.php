<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GlassType extends Model
{
    protected $guarded = [];

    public function glass_type_order(){

    	return $this->belongsTo(QuotationOrder::class, 'quotation_order_id');
    }
}

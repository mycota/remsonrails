<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RailingReport extends Model
{
    protected $guarded = [];

    public function railing_report_order(){

    	return $this->belongsTo(QuotationOrder::class, 'quotation_order_id');
    }
}

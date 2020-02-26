<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuotationOrderRailing extends Model
{
    protected $guarded = [];
    
    public function qoutrailing()
    {
    	return $this->belongsTo(QuotationOrder::class, 'quotOrdID');
    }
}

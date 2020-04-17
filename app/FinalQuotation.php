<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinalQuotation extends Model
{
    protected $guarded = [];

    public function final_quot_user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function final_quot_cust()
    {
    	return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function final_quot_order(){

    	return $this->belongsTo(QuotationOrder::class, 'quotation_order_id');
    }
}

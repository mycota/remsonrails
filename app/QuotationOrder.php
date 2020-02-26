<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuotationOrder extends Model
{
    protected $guarded = [];


    public function quotorderRail()
    {
        return $this->hasMany(QuotationOrderRailing::class);
    }

    public function userquot()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function custquot()
    {
    	return $this->belongsTo(Customer::class, 'customer_id');
    }
}

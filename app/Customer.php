<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
	protected $guarded = [];

    public function userscust()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function custquotorder()
    {
        return $this->hasMany(QuotationOrder::class);
    }

    // public function payments_customer()
    // {
    //     return $this->hasMany(Payment::class);
    // }

    
}

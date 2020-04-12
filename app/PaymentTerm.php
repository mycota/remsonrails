<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentTerm extends Model
{
   	protected $guarded = [];

    public function userpayterm()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }
}

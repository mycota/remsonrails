<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    
	protected $guarded = [];

    public function userlogs()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }
}

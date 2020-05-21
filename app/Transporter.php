<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transporter extends Model
{
    protected $guarded = [];

    public function userstransp()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function trans()
    {
        return $this->hasMany(Transportered::class);
    }
}

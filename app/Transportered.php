<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transportered extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function trans_tranport()
    {
        return $this->belongsTo(Transporter::class, 'transporter_id');
    }

    public function trans_order(){
        return $this->belongsTo(QuotationOrder::class, 'quotation_order_id');
    }
}

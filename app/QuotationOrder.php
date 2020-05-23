<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuotationOrder extends Model
{
    protected $guarded = [];

    public function userquot()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function custquot()
    {
    	return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function order_railings(){

    	return $this->hasMany(QuotationOrderRailing::class);
    }

    public function order_glass_types(){

    	return $this->hasMany(GlassType::class);
    }

    public function order_product_details(){

    	return $this->hasMany(ProductDetail::class);
    }

    public function order_product_colors(){

    	return $this->hasMany(ProductColor::class);
    }

    public function order_railing_reports(){

    	return $this->hasMany(RailingReport::class);
    }

    public function order_final_quot()
    {
        return $this->hasOne(FinalQuotation::class);
    }

    public function order_trans()
    {
        return $this->hasOne(Transportered::class);
    }
}

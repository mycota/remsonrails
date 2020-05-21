<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'email', 'phone', 'gender', 'active', 'verifyToken',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    # accessers and mutators
    public function getActiveAttribute($attribute)
    {
        return [
            1 => 'Active',
            0 => 'Inactive',
        ][$attribute];
    }

    // put all yr sql query here
    public function scopeActive($query){
        // this is a select statement to get customers where active = 1
        return $query->where('active', 1);
    }


    public function scopeInactive($query){
        // this is a select statement to get customers where active = 0
        return $query->where('active', 0);
    }

    public function roles()
    {
        return $this->beLongsToMany('App\Role');
    }

    public function hasAnyRoles($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    public function hasAnyRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function logs()
    {
        return $this->hasMany(Logs::class);
    }

    public function products()
    {
        return $this->hasMany(Products::class);
    }

    public function transporters()
    {
        return $this->hasMany(Transporter::class);
    }

    public function quotationorder()
    {
        return $this->hasMany(QuotationOrder::class);
    }

    public function payterms()
    {
        return $this->hasMany(PaymentTerm::class);
    }

    public function user_images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function user_final_quot()
    {
        return $this->hasMany(FinalQuotation::class);
    }

    public function user_tranport()
    {
        return $this->hasMany(Transportered::class);
    }

}

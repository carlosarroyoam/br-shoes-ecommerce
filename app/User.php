<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'is_admin'
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
            'is_admin' => 'boolean',
    ];

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get the addresess records associated with the user.
     */
    public function shipmentAddresses()
    {
        return $this->hasMany('App\UserShipmentAddress');
    }

    /**
     * Get the contact details record associated with the user.
     */
    public function contactDetails()
    {
        return $this->hasOne('App\UserContactDetails');
    }

    /**
     * Get the addresess records associated with the user.
     */
    public function shoppingBag()
    {
        return $this->hasOne('App\ShoppingBag');
    }

    /**
     * Get the addresess records associated with the user.
     */
    public function wishList()
    {
        return $this->hasOne('App\WishList');
    }

    /**
     * Get all of the user's profile picture.
     */
    public function profilePicture()
    {
        return $this->morphOne('App\Image', 'imageable');
    }
}

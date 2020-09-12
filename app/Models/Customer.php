<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    /**
     * Get the customer's user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     *
     */
    public function user()
    {
        return $this->morphOne('App\Models\User', 'userable');
    }

    /**
     * Get the shipping address records associated with the customer.
     */
    public function shipmentAddresses()
    {
        return $this->hasMany(\App\Models\CustomerShipmentAddress::class);
    }

    /**
     * Get the contact details record associated with the customer.
     */
    public function contactDetails()
    {
        return $this->hasOne(\App\Models\CustomerContactDetails::class);
    }

    /**
     * Get the shopping bag record associated with the customer.
     */
    public function shoppingBag()
    {
        return $this->hasOne(\App\Models\ShoppingBag::class);
    }

    /**
     * Get the wish list record associated with the customer.
     */
    public function wishList()
    {
        return $this->hasOne(\App\Models\WishList::class);
    }
}

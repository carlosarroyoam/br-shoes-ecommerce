<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'price', 'description', 'featured',
    ];

    /**
     * Get the pictures for the product.
     */
    public function pictures()
    {
        return $this->hasMany('App\Pictures');
    }
}

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
     * Get all of the product's pictures.
     */
    public function pictures()
    {
        return $this->morphMany('App\Image', 'imageable');
    }

    /**
     * Get all of the categories for the product.
     */
    public function tags()
    {
        return $this->morphToMany('App\Categories', 'categorizable');
    }

}

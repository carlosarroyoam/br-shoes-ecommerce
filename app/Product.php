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
        'name', 'slug', 'description', 'featured',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'featured' => 'boolean',
    ];

    /**
     * Get all of the product's variants.
     */
    public function variants()
    {
        return $this->hasMany('App\ProductVariant');
    }

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

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}

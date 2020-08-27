<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug',
    ];

    /**
     * Get all of the products that are assigned this category.
     */
    public function products()
    {
        return $this->morphedByMany('App\Products', 'categorizable');
    }

}

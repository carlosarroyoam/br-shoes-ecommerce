<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property boolean $is_super
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Admin extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'is_super',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'is_super' => 'boolean',
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
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{

    /**
     * Get the user that owns the contact details.
     */
    public function order()
    {
        return $this->belongsTo('App\Order');
    }

}

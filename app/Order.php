<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    /**
     * Get the contact details record associated with the user.
     */
    public function orderDetails()
    {
        return $this->hasOne('App\OrderDetails');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactDetails extends Model
{

    /**
     * Get the user that owns the contact details.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //

    public function userData()
    {
        return $this->hasMany(UserData::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}

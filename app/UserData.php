<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    private $age;
    //
    protected $fillable = ['first_name','last_name','phone','birthday','avatar'];

    // Omitted for brevity
    protected $hidden = ['user_id','created_at','updated_at','id','birthday','city_id','first_name','last_name'];

    protected $casts = [
        'is_admin' => 'boolean',

    ];

    public function getAgeAttribute()
    {
        return   Carbon::parse($this->attributes['birthday'])->age;
    }

    public function getFullNameAttribute()
    {
        return $this->attributes['first_name'].' '. $this->attributes['last_name'];
    }

    public function getCityAttribute()
    {
        $title = $this->city()->get('title_ru');
        return $title;
    }

    protected $appends = ['age', 'full_name','city'];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}

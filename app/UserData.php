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
        $title = $this->city()->get();
        $str = '';
        foreach ($title as $ot){
         $str = $ot['title_ru'];
        }
        return $str;
    }

    public function getRegionAttribute()
    {
        $city = $this->city()->get();
        $str = '';
        foreach ($city as $regionModel){
            $str = $regionModel['id'];
        }
        $region = Region::find($str);
        return $region->title_ru;
    }

    public function getCountryAttribute()
    {
        $city = $this->city()->get();
        $str = '';
        foreach ($city as $regionModel){
            $str = $regionModel['id'];
        }
        $region = Region::find($str);
        $country = Country::find($region->country_id);
        return $country->title_ru;
    }

    protected $appends = ['age', 'full_name','city','region','country'];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}

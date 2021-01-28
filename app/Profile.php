<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Profile extends Model
{
    protected $fillable = ['user_id','birthday','blood_type','image'];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function licenses()
    {
        return $this->belongsToMany('App\License');
    }
    
    public function getBirthDay()
    {
        return Carbon::parse($this->birthday)->age;
    }
}

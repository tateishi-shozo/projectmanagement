<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    protected $guarded =[];
    
    //Projectモデルとのリレーション定義
    public function projects()
    {
        return $this->belongsToMany('App\Project');
    }
    
    public function profiles()
    {
        return $this->belongsToMany('App\Profile');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    protected $fillable = ['name'];
    
    //Projectモデルとのリレーション定義
    public function projects()
    {
        return $this->belongsToMany('App\Project');
    }
}

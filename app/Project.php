<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //Licenseモデルとのリレーションの定義
    public function licenses()
    {
        return $this->belongsToMany('App\License');
    }
}

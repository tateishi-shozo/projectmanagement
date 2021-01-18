<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Project extends Model
{
    protected $guarded = ['id','created_at','updated_at'];
    protected $fillable = ['project_name','start_date','end_date','number_of_people','memo'];
    //Licenseモデルとのリレーションの定義
    public function licenses()
    {
        return $this->belongsToMany('App\License');
    }
    
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use Carbon\Carbon;

class Project extends Model
{
    protected $guarded = ['id','created_at','updated_at'];
    protected $fillable = ['project_name','start_date','end_date','number_of_people','memo'];
    //Licenseモデルとのリレーションの定義
    public function licenses()
    {
        return $this->belongsToMany('App\License');
    }
    
    public function dialies()
    {
        return $this->hasMany('App\Dialy');
    }
    
    public function getRemainingDays()
    {
        $end_day = new Carbon($this->end_date);
        
        return Carbon::today()->diffInDays($end_day,false);
    }
}

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
        return $this->belongsToMany('App\License')->withPivot('required_least_count');
    }
    
    public function dialies()
    {
        return $this->hasMany('App\Dialy');
    }
    
    public function getRemainingDays()
    {
        $end_day = new Carbon($this->end_date);
        $diff =Carbon::today()->diffInDays($end_day,false);
        
        if($diff >"0"){
            return Carbon::today()->diffInDays($end_day,false);
        }else{
            return "終了";
        }
    }
    
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}

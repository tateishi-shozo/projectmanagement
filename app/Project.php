<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class Project extends Model
{
    protected $guarded =[];
    //Licenseモデルとのリレーションの定義
    public function licenses()
    {
        return $this->belongsToMany('App\License')->withPivot('required_least_count')->withTimestamps();;
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
        return $this->belongsToMany('App\User')->withPivot('start_date','end_date')->withTimestamps();
    }
    
    public function getAssignableUsers()
    {
        return DB::table('users')
                        ->leftJoin('project_user','users.id','=','project_user.user_id')
                        ->leftJoin('profiles','users.id','=','profiles.user_id')
                        ->where('users.is_admin','=','1')
                        ->where('project_user.end_date','>',now())
                        ->orwhere('project_user.start_date','>',$this->end_date)
                        ->orwhere('project_user.end_date','<',$this->start_date)
                        ->orwhereNull('project_user.user_id')
                        ->get();
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return $this->belongsToMany('App\User')->withPivot('start_date','end_date');
    }
    
    public static function GetName($id)
    {
        $project = self::find($id);
        $projects = self::whereBetween('start_date', [$project->start_date, $project->end_date]) ->get();
        return $projects;
    }
    
    public function getAssignableUsers()
    {
        $assignable_users_ids = DB::table('users')
                        ->leftJoin('project_user','users.id','=','project_user.user_id')
                        ->where('users.is_admin','=','1')
                        ->orwhere("project_user.start_date",'>',$this->end_date)
                        ->orWhere("project_user.end_date",'<',$this->start_date)
                        ->orwhereNull('project_user.user_id')
                        ->get();
                        
      return $assignable_users_ids;
    }
}
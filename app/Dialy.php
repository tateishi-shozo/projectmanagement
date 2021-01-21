<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dialy extends Model
{
    protected $fillable =['user_id','project_id','memo'];
    
    public function fees()
    {
        return $this->belongsToMany('App\Fee');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}

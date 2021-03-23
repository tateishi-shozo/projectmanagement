<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Dialy extends Model
{
    protected $fillable =['user_id','project_id','memo'];
    
    public static $rules = array(
        'fee_ids' => 'required',
    );
    
    public function fees()
    {
        return $this->belongsToMany('App\Fee')->withPivot('weight');
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

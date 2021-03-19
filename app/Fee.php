<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $fillable = ['place','classification','price'];
    
    public static $rules = array(
        'place' => 'required',
        'classification' => 'required',
        'price' =>'required',
    );
    
    public function dialies()
    {
        return $this->belongsToMany('App\Dialy');
    }
}

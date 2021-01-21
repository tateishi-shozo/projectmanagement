<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $fillable = ['place','classification','price'];
    
    public function dialies()
    {
        return $this->belongsToMany('App\Dialy');
    }
}

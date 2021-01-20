<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DialyController extends Controller
{
    public function add()
    {
        return view('user.dialy.create');
    }
}

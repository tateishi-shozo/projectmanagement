<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\License;
use App\Project;
use App\User;
use App\Profile;

class ProjectController extends Controller
{
     public function index(User $user)
    {
        return view('user.project.index',compact('user'));
    }
}

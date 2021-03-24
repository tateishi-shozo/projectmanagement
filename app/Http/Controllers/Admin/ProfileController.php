<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Profile;
use App\License;
use Carbon\Carbon;
use Storage;


class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::all();
        
        return view('admin.profile.index',compact('profiles'));
    }
}
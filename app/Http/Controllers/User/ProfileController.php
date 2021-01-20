<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Profile;
use App\License;
use App\User;

class ProfileController extends Controller
{
    public function add()
    {
        $licenses = License::all();
        $user = Auth::user();
        
        return view('user.profile.create',compact('licenses','user'));
    }
    
    public function create(Request $request)
    {
        $profile = new Profile;
        $form = $request->all();
        //dd($request->license_ids);
        
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $profile->image = basename($path);
          } else {
              $profile->image = null;
          }
          
        $profile->fill($form);
        $profile->save();
        
        $profile->licenses()->attach($request->license_ids);
        
        
        return redirect('user/profile/create');
    }
}
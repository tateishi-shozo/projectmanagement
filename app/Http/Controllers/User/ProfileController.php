<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            dd($path);
            $profile->image = basename($path);
          } else {
              $profile->image = basename("public/image/noimage.png");
          }
          
        $profile->fill($form);
        $profile->save();
        
        $profile->licenses()->attach($request->license_ids);
        
        
        return redirect('user/profile/');
    }
    
    public function index()
    {
        $user = Auth::user();
        $profile = $user->profile;
        
        return view('user.profile.index',compact('profile','user'));
    }
    
    public function edit()
    {
        $user = Auth::user();
        $profile = $user->profile;
        $licenses = License::all();
        $license_ids = $profile->licenses->pluck('id')->toArray();
        
        return view('user.profile.edit',compact('profile','user','licenses','license_ids'));
    }
    
    public function update(Request $request)
    {
        $user = Auth::user();
        $profile = Profile::find($user->profile->id);
        
        $form = $request->all();
        
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $form['image']= basename($path);
          } 
        
        $profile->fill($form)->save();
        
        $profile->licenses()->sync($request->license_ids);
        
        return redirect('user/profile/');
    }
}
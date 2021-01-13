<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\License;

class ProjectController extends Controller
{
    //
    public function add(Request $request)
    {
        $licenses = License::all();
        
        return view('admin.project.create',compact('licenses'));
    }
    
    public function create()
    {
        return redirect('admin/project/create');
    }
}

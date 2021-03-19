<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\License;

class LicenseController extends Controller
{
    public function index(Request $request)
    {
        $licenses = License::all();
        
        return view('admin.license.index',compact('licenses'));
    }
    
    public function create(Request $request)
    {
        $this->validate($request,License::$rules);
        
        $license = new License;
        $form = $request->all();
        
        $license->fill($form)->save();
        
        return redirect('/admin/license/index');
    }
    
    public function delete(Request $request)
    {
        $license = License::find($request->id);
        $license->delete();
        
        return redirect('/admin/license/index');
    }
    
}

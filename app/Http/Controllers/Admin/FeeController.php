<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Fee;

class FeeController extends Controller
{
    public function index(Request $request)
    {
        $fee = Fee::all();
        
        return view('admin.fee.index',compact('fee'));
    }
    
    public function create(Request $request)
    {
        $this->validate($request,Fee::$rules);
        
        $fee = new Fee;
        $form = $request->all();
        
        $fee->fill($form)->save();
        
        return redirect('/admin/fee/index');
    }
    
    public function delete(Request $request)
    {
        $fee = Fee::find($request->id);
        $fee->delete();
        
        return redirect('/admin/fee/index');
    }
}

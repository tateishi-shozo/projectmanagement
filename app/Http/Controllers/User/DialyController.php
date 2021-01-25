<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Dialy;
use App\User;
use App\Fee;
use App\Project;

class DialyController extends Controller
{
    public function add()
    {
        $user = Auth::user();
        $projects = Project::all();
        $fees = Fee::all();
        
        return view('user.dialy.create',compact('fees','user','projects'));
    }
    
    public function create(Request $request)
    {
        $dialy = new Dialy;
        $form = $request->all();
        
        $dialy->fill($form);
        $dialy->save();

        $dialy_fees =  array();
        $forms = $request->all();
       
        for($i = 0;$i<count($request->fee_ids);$i++)
        {
            $fee_id = $request->fee_ids[$i];
            $dialy_fees[$fee_id] = ["weight" => $forms["weight_".$fee_id]];
        }
        
        $dialy->fees()->sync($dialy_fees);
        
        return redirect('user/dialy/create');
    }
    
    public function index()
    {
        $dialys = Dialy::all();
        
        return view('user.dialy.index',compact('dialys'));
    }
}

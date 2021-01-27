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
        
        return redirect('user/dialy/index');
    }
    
    public function index()
    {
        $dialies = Dialy::all();
        
        return view('user.dialy.index',compact('dialies','total'));
    }
    
    public function edit(Request $request)
    {
        $dialy = Dialy::find($request->id);
        $user = Auth::user();
        $fees = Fee::all();
        $fee_ids = $dialy->fees->pluck('id')->toArray();
        
        $fee_weight = [];
        
        foreach($dialy->fees as $fee){
            $fee_weight[$fee->id] = $fee->pivot->weight;
        }
        
        return view('user.dialy.edit',compact('dialy','user','fees','fee_ids','fee_weight'));
    }
    
    public function update(Request $request)
    {
        $dialy = Dialy::find($request->id);
        $form = $request->all();
        
        $dialy->fill($form)->save();
        
        $dialy_fees =  array();
        $forms = $request->all();
       
        for($i = 0;$i<count($request->fee_ids);$i++)
        {
            $fee_id = $request->fee_ids[$i];
            $dialy_fees[$fee_id] = ["weight" => $forms["weight_".$fee_id]];
        }
        
        $dialy->fees()->sync($dialy_fees);
        
        return redirect('user/dialy/index');
    }
    
    public function delete(Request $request)
    {
        //外部キー設定のため削除できない
        $dialy = Dialy::find($request->id);
        $dialy->delete();
        
        return redirect('user/dialy/index');
    }
}

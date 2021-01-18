<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\License;
use App\Project;

class ProjectController extends Controller
{
    //
    public function add(Request $request)
    {
        $licenses = License::all();
        
        return view('admin.project.create',compact('licenses'));
    }
    
    public function create(Request $request)
    {
        $project = new Project;
        $form = $request->except('license_ids','required_least_counts');
        //unset($form['_token']);
        
        $project->fill($form);
        $project->save();
        
        //dd($request->license_ids,$request->required_least_counts);
        $requiered_licenses =  array();
        //$keys = array_keys($license_projects);
        //$count = count($license_projects[$keys[0]]);
        //dd($request);
       // $id = 1;
       $forms = $request->all();
       
        for($i = 0;$i<count($request->license_ids);$i++)
        {
            $license_id = $request->license_ids[$i];
            $requiered_licenses[$license_id] = ["required_least_count" => $forms["required_least_counts_".$license_id]];
        }
        //$license_projects->licenses()->sync(['license_id' => $request->license_id,'required_least_count' => $request->required_least_count]);
        //dd($requiered_licenses);
        $project->licenses()->sync($requiered_licenses);
        
        return redirect('admin/project/create');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\License;
use App\Project;
use App\User;
use App\Profile;

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
        $form = $request->only('project_name','start_date','end_date','number_of_people','memo');
        
        $project->fill($form);
        $project->save();

        $requiered_licenses =  array();
        
        $forms = $request->all();
       
        for($i = 0;$i<count($request->license_ids);$i++)
        {
            $license_id = $request->license_ids[$i];
            $requiered_licenses[$license_id] = ["required_least_count" => $forms["required_least_counts_".$license_id]];
        }

        $project->licenses()->attach($requiered_licenses);
        
        return redirect('admin/project/index');
    }
    
    
    public function index(Request $request)
    {
        $cond_project_name = $request->cond_project_name;
        $sort_by = $request->sort_by;
        
        $query = Project::query();
        
        if(isset($cond_project_name))
        {
            $query->where('project_name','like', '%'.$cond_project_name.'%');
        }
        
        if(isset($sort_by))
        {
            $query->orderBy('start_date',$sort_by);
        }
        
        $projects = $query->paginate(10);
        
      
      return view('admin.project.index',compact('projects','cond_project_name','sort_by'));
    }

  
    public function edit(Request $request)
    {
        $project = Project::find($request->id);
        $licenses = License::all();
        
        $license_ids = $project->licenses->pluck('id')->toArray();
        
        $license_required_least_counts = [];
        
        foreach($project->licenses as $license){
            $license_required_least_counts[$license->id] = $license->pivot->required_least_count;
        }
        
        
        return view('admin.project.edit',compact('project','licenses','license_ids','license_required_least_counts'));
    }
    
    public function update(Request $request)
    {
        $project = Project::find($request->id);
        $form = $request->only('project_name','start_date','end_date','number_of_people','memo');
        
        $project->fill($form)->save();
        
        $requiered_licenses =  array();
        
        $forms = $request->all();
       
        for($i = 0;$i<count($request->license_ids);$i++)
        {
            $license_id = $request->license_ids[$i];
            $requiered_licenses[$license_id] = ["required_least_count" => $forms["required_least_counts_".$license_id]];
        }
        
        $project->licenses()->sync($requiered_licenses);
        
        return redirect('admin/project/index');
    }
    
    public function delete(Request $request)
    {
        $project = Project::find($request->id);
        $project->delete();
        
        return redirect('admin/project/index');
    }
    
    public function assign(Request $request)
    {
        $project = Project::find($request->id);
        
        $licenses = License::all();
        
        $users = $project->getAssignableUsers();
        
        $notassingusers = $project->notAssignableUsers();

        return view('admin.project.assign',compact('project','licenses','users','notassingusers'));
        
    }
    
    public function record(Request $request)
    {
        $project = Project::find($request->id);
        
        $project_users = array();
        $project_users[$request->user_id] = ['start_date' => $request->start_date,'end_date' => $request->end_date];

        $project->users()->attach($project_users);
        return back();
    }
}
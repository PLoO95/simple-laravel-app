<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Project;
use App\Models\Reward;
use App\Models\ApiResponse;
use Validator;

class ProjectController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    public function index(){
        $project = Project::all();
        return dd($project->toArray());
    }
    public function store(Request $request){
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|string'
        ]);

        if($validator->fails()){
            $respone = array('code' => 400, 'type' => 'error', 'message' => $validator->errors());
            return $respone;       
        }
        
        Project::create($input);

        $respone = array('code' => 201, 'type' => 'success', 'message' => 'Created');
        return $respone;
    }
    public function show($id){
        $project;
        if($id == 'started' || $id == 'finished' || $id == 'draft'){
            $project = Project::where('status',$id)->get();
            if(count($project) == 0)
                $project = null;
        }
        else if(is_numeric($id)){
            $project = Project::find($id);
        }
        else {
            $api = new ApiResponse(400,'error','Invalid ID supplied');
            return $api->getData();
        }
        if($project == null)
        {
            $api = new ApiResponse(404,'error','Project not found');
            return $api->getData();
        }
        $rewards = array();
        $data = array();
        if(is_numeric($id)){ 
            $rewards = Reward::where('projectId',$id)->get();
            $data = array( 'id' => $project->id, 'name' => $project->name, 'description' => $project->description, 'status' => $project->status, 'rewards' => $rewards);
        }
        else{ 
            for($i = 0;$i<count($project);$i++)
                array_push($rewards,Reward::where('projectId',$project[$i]['id'])->get());
            for($i = 0;$i<count($project);$i++){
                $col = array( 'id' => $project[$i]['id'], 'name' => $project[$i]['name'], 'description' => $project[$i]['description'], 'status' => $project[$i]['status'], 'rewards' => $rewards[$i]);
                array_push($data,$col);
            }
        }
        return $data;
    }
    public function findByStatus(){
        return view("project.findbystatus");
    }

    public function update(Request $request){
        $input = $request->all();

        $validator = Validator::make($input, [
            'id' => 'required|integer',
            'name' => 'required|string',
            'status' => 'required|string'
        ]);
        if($validator->fails()){
            $respone = array('code' => 400, 'type' => 'error', 'message' => $validator->errors());
            return $respone;       
        }

        $project = Project::find($input['id']);
        if ($project == null) {
            $api = new ApiResponse(404,'error','Project not found');
            return $api->getData();
        }
        $project->name = $input['name'];
        $project->status = $input['status'];
        $project->save();

        $api = new ApiResponse(200,'success','Updated succesfull');
        return $api->getData();
    }
    public function updateManager($id){
        if(!is_numeric($id)){
            $api = new ApiResponse(400,'error','Invalid ID supplied');
            return $api->getData();
        }
        $project = Project::find($id);
        if ($project == null) {
            $api = new ApiResponse(404,'error','Project not found');
            return $api->getData();
        }
        return view('project.update',array('project' => $project));
    }

    public function create(){
        return view('project.create');
    }

    public function delete($id){
        $respone = array('code' => 0, 'type' => '', 'message' => '');
        if(!is_null($id)){
            if(!is_null(Project::where('id',$id)->get())){    
                Project::where('id',$id)->delete();
                $respone = array('code' => 200, 'type' => 'Success', 'message' => 'Ok');
            }
            else
                $respone = array('code' => 404, 'type' => 'Error', 'message' => 'Project not found');
        }
        else
            $respone = array('code' => 401, 'type' => 'Error', 'message' => 'Invalid ID supplied');

        return $respone;
    }
    public function deleteManager(){
        $projects = Project::all();

        $data = array('projects' => $projects);

        return view('project.delete',$data);
    }
}

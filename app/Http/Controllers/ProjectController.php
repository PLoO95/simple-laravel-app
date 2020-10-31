<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Project;
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
    public function update(){
        return 'update';
    }
    public function show($id){
        if(!is_numeric($id)){
            $api = new ApiResponse(400,'error','Invalid ID supplied');
            return $api->getData();
        }
        $project = Project::find($id);
        if ($project == null) {
            $api = new ApiResponse(404,'error','Project not found');
            return $api->getData();
        }
        return $project;
    }
    public function findByStatus(){
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

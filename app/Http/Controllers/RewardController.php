<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reward;
use Validator;

class RewardController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    public function index(){
        $reward = Reward::all();
        return dd($reward->toArray());
    }
    public function store(Request $request){
        $input = $request->all();

        $validator = Validator::make($input, [
            'projectId' => 'required|integer',
            'name' => 'required|string',
            'description' => 'required|string',
            'amount' => 'required|integer'
        ]);

        if($validator->fails()){

            $respone = array('code' => 400, 'type' => 'error', 'message' => $validator->errors());
            return $respone;       
        }

        Reward::create($input);

        $respone = array('code' => 200, 'type' => 'success', 'message' => 'Created');
        return $respone;
    }
    public function create(){
        return view('reward.create');
    }
}

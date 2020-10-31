<?php

namespace App\Models;

class ApiResponse
{
    public $code;
    public $type;
    public $message;

    public function __construct($code,$type,$message){
        $this->code = $code;
        $this->type = $type;
        $this->message = $message;
    }

    public function getData(){
        return array('code'=>$this->code,'type'=>$this->type,'message'=>$this->message);
    }
}

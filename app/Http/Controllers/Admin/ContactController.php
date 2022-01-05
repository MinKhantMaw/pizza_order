<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
     // contact form
    public function contactCreate(Request $request){
        $data=$this->requestUserData($request);
        dd($data);
    }
    private function requestUserData($request){
        return[
            'user_id'=>auth()->user()->id,
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message,
        ];
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $pizza=Pizza::where('publish_status',1)->get();
        return view('user.home')->with(['pizza'=>$pizza]);
    }
    public function pizzaDetails($id){
       $pizza=Pizza::where('pizza_id',$id)->first();
       return view('user.detail')->with(['pizza'=>$pizza]);
    }
}

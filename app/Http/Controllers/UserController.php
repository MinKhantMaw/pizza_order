<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Pizza;

class UserController extends Controller
{
    public function index()
    {
        $pizza = Pizza::where('publish_status', 1)->get();
        $category = Category::get();
        // dd($category->toArray());
        return view('user.home')->with(['pizza' => $pizza, 'category' => $category]);
    }
    public function pizzaDetails($id)
    {
        $pizza = Pizza::where('pizza_id', $id)->first();
        return view('user.detail')->with(['pizza' => $pizza]);
    }
    public function itemSearch($id)
    {
        $search = Pizza::where('category_id', $id)->get();
        $category = Category::get();
        return view('user.home')->with(['pizza' => $search,'category'=>$category]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Pizza;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $pizza = Pizza::where('publish_status', 1)->paginate(6);
        $category = Category::get();
        // dd($category->toArray());
        $status = count($pizza) == 0 ? 0 : 1;

        return view('user.home')->with(['pizza' => $pizza, 'category' => $category, 'status' => $status]);
    }
    public function pizzaDetails($id)
    {
        $pizza = Pizza::where('pizza_id', $id)->first();
        return view('user.detail')->with(['pizza' => $pizza]);
    }
    public function itemSearch($id)
    {
        $search = Pizza::where('category_id', $id)->paginate(6);
        $status = count($search) == 0 ? 0 : 1;
        $category = Category::get();
        return view('user.home')->with(['pizza' => $search, 'category' => $category, 'status' => $status]);
    }
    public function pizzaSearch(Request $request)
    {
        $search = Pizza::orWhere('pizza_name', 'like', '%' . $request->searchData . '%')->paginate(6);
        $status = count($search) == 0 ? 0 : 1;
        $category = Category::get();
        $search->appends($request->all());
        return view('user.home')->with(['pizza'=>$search, 'category'=>$category, 'status' => $status]);
    }
}

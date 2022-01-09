<?php

namespace App\Http\Controllers;

use auth;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Pizza;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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
    // pizza details page
    public function pizzaDetails($id)
    {
        $pizza = Pizza::where('pizza_id', $id)->first();
        Session::put('pizza_details', $pizza);
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
        return view('user.home')->with(['pizza' => $search, 'category' => $category, 'status' => $status]);
    }
    public function searchPrice(Request $request)
    {
        $min = $request->minPrice;
        $max = $request->maxPrice;
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $query = Pizza::select('*');
        if (!is_null($startDate) && is_null($endDate)) {
            $query = $query->whereDate('created_at', '>=', $startDate);
        } else if (is_null($startDate) && !is_null($endDate)) {
            $query = $query->whereDate('created_at', '<=', $endDate);
        } else if (!is_null($startDate) && !is_null($endDate)) {
            $query = $query->whereDate('created_at', '>=', $startDate)
                ->whereDate('created_at', '<=', $endDate);
        }
        if (!is_null($min) && is_null($max)) {
            $query = $query->where('price', '>=', $min);
        } else if (is_null($min) && !is_null($max)) {
            $query = $query->where('price', '<=', $max);
        } else if (!is_null($min) && !is_null($max)) {
            $query = $query->where('price', '>=', $min)
                ->where('price', '<=', $max);
        }
        $query = $query->paginate(6);
        $query->appends($request->all());
        $status = count($query) == 0 ? 0 : 1;
        $category = Category::get();
        return view('user.home')->with(['pizza' => $query, 'category' => $category, 'status' => $status]);
    }
    public function order()
    {
        $pizzaInfo = Session::get('pizza_details');
        // dd($pizzaInfo->toArray());
        return view('user.order')->with(['pizza' => $pizzaInfo]);
    }
    public function orderPage(Request $request)
    {
        $pizzaInfo=Session::get('pizza_details');
        $userId=auth()->user()->id;
        $count=$request->pizzaCount;
        $validator = Validator::make($request->all(), [
            'pizzaCount' => 'required',
            'payment'   =>'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

       $orderData=$this->requestOrderData($pizzaInfo,$userId,$request);
       for ($i=0; $i < $count; $i++) {
           Order::create($orderData);
       }
       $waitingTime=$pizzaInfo['waiting_time'] * $count ;
       return back()->with(['totalTime'=>$waitingTime]);
    }

    private function requestOrderData($pizzaInfo,$userId,$request){
        return [
            'customer_id' => $userId,
            'pizza_id' =>$pizzaInfo['pizza_id'],
            'carrier_id' =>0,
            'payment_status'=>$request['payment'],
            'order_time' => Carbon::now(),
        ];
    }
}

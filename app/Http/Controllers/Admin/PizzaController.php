<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Pizza;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PizzaController extends Controller
{
    // pizza list
    public function pizza()
    {
        $pizza = Pizza::paginate(5);
        if (count($pizza) == 0) {
            $emptyStatus = 0;
        } else {
            $emptyStatus = 1;
        }
        return view('admin.pizza.list')->with(['pizza' => $pizza, 'status' => $emptyStatus]);
    }
    //pizza create page
    public function createPizza()
    {
        $category = Category::get();
        return view('admin.pizza.create')->with(['category' => $category]);
    }

    //pizza  insert
    public function insertPizza(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required',
            'price' => 'required',
            'publish' => 'required',
            'category' => 'required',
            'discount' => 'required',
            'buyOnegetOne' => 'required',
            'waitingTime' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $image = $request->file('image');
        $imageName = uniqid() . '_' . $image->getClientOriginalName();
        $image->move(public_path() . '/images/', $imageName);

        $data = $this->requestPizzaData($request, $imageName);
        Pizza::create($data);
        return redirect()->route('admin#pizza')->with(['createSuccess' => "Pizza Created"]);
    }

    // delete pizza
    public function deletePizza($id)
    {
        // image delete CODE
        $data = Pizza::select('image')->where('pizza_id', $id)->first();
        $imageName = $data['image'];
        Pizza::where('pizza_id', $id)->delete(); //database delete
        if (File::exists(public_path() . '/images/' . $imageName)) {
            File::delete(public_path() . '/images/' . $imageName);
        }
        return back()->with(['deletePizza' => 'Pizza Deleted']);
    }

    // pizza information
    public function infoPizza($id)
    {
        $data = Pizza::where('pizza_id', $id)->first();
        return view('admin.pizza.info')->with(['pizza' => $data]);
    }

    // edit pizza
    public function editPizza($id)
    {
        $category = Category::get();
        $data = Pizza::select('pizzas.*', 'categories.category_name', 'categories.category_id')
            ->join('categories', 'pizzas.category_id', 'categories.category_id')
            ->where('pizza_id', $id)
            ->first();
        //  dd($data->toArray());
        return view('admin.pizza.edit')->with(['pizza' => $data, 'category' => $category]);
    }
    // update pizza code
    public function updatePizza($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            // 'image' => 'required',
            'price' => 'required',
            'publish' => 'required',
            'category' => 'required',
            'discount' => 'required',
            'buyOnegetOne' => 'required',
            'waitingTime' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $updateData = $this->requestUpdatePizzaData($request);
        if (isset($updateData['image'])) {

            // get old image from pizza table
            $image = Pizza::select('image')->where('pizza_id', $id)->first();
            $imageName = $image['image'];

            // old image delete from pizza table
            if (File::exists(public_path() . '/images/' . $imageName)) {
                File::delete(public_path() . '/images/' . $imageName);
            }

            // create new image
            $image = $request->file('image');
            $imageName = uniqid() . '_' . $image->getClientOriginalName();
            $image->move(public_path() . '/images/', $imageName);
            $updateData['image'] = $imageName;
            // dd($updateData['image']);
            // image update
            Pizza::where('pizza_id', $id)->update($updateData);
            // dd("image update ok");
            return redirect()->route('admin#pizza')->with(['updatePizza' => 'Pizza Updated']);
        } else {
            Pizza::where('pizza_id', $id)->update($updateData);
            return redirect()->route('admin#pizza')->with(['updatePizza' => 'Pizza Updated']);
        }

    }
    // search pizza data
    public function searchPizza(Request $request) {
        $searchPizza = $request->pizza_search;
        $searchData = Pizza::orWhere('pizza_name','like', '%'.$searchPizza.'%')
                                ->orWhere('price',$searchPizza)
                                ->paginate(5);
        $searchData->appends($request->all());
        if (count($searchData)==0) {
           $emptyStatus=0;
        }else {
            $emptyStatus=1;
        }
        return view('admin.pizza.list')->with(['pizza'=>$searchData,'status'=>$emptyStatus]);
    }
    // validation check code
    private function requestUpdatePizzaData($request)
    {
        $arr = [
            'pizza_name' => $request->name,
            // 'image' => $imageName,
            'price' => $request->price,
            'publish_status' => $request->publish,
            'category_id' => $request->category,
            'discount_price' => $request->discount,
            'buy_one_get_one_status' => $request->buyOnegetOne,
            'waiting_time' => $request->waitingTime,
            'description' => $request->description,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        if (isset($request->image)) {
            $arr['image'] = $request->image;
        }
        return $arr;
    }
    //pizza request data
    private function requestPizzaData($request, $imageName)
    {
        return [
            'pizza_name' => $request->name,
            'image' => $imageName,
            'price' => $request->price,
            'publish_status' => $request->publish,
            'category_id' => $request->category,
            'discount_price' => $request->discount,
            'buy_one_get_one_status' => $request->buyOnegetOne,
            'waiting_time' => $request->waitingTime,
            'description' => $request->description,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

}

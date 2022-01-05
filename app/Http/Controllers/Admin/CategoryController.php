<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pizza;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{


        // category list page
        public function category()
        {
            $data = Category::select('categories.*',DB::raw('COUNT(pizzas.category_id) as count'))
                            ->leftJoin('pizzas','pizzas.category_id','categories.category_id')
                            ->groupBy('categories.category_id')
                            ->paginate(5);
            //  dd($data->toArray());
            return view('admin.category.list')->with(['category' => $data]);
        }
        // category add page
        public function addCategory()
        {
            return view('admin.category.addCategory');
        }
        // category create page
        public function createCategory(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $data = [
                'category_name' => $request->name,
            ];
            Category::create($data);
            return redirect()->route('admin#category')->with(['categorySuccess' => "Category Added Successfully"]);
        }
        // category delete
        public function deleteCategory($id)
        {
            Category::where('category_id', $id)->delete();
            return back()->with(['deleteSuccess' => 'Category Deleted Successfully']);
        }
        // category update&edit
        public function editCategory($id)
        {
            $data = Category::where('category_id', $id)->first();
            //    dd($data->toArray());
            return view('admin.category.edit')->with(['category' => $data]);
        }
        // category update
        public function updateCategoty(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $updateData=[
                'category_name' => $request->name,
            ];
            Category::where('category_id',$request->id)->update($updateData);
            return redirect()->route('admin#category')->with(['categoryUpdate'=>'Category Updated...!']);
        }
        // category search
        public function searchCategory(Request $request)
        {
            $data=Category::where('category_name', 'like', '%' . $request->searchData .'%')->paginate(5);
           $data->appends($request->all());
            return view('admin.category.list')->with(['category'=>$data]);
        }

        // category item click
        public function categoryItem($id)
        {
            $data=Pizza::select('pizzas.*','categories.category_name as categoryName')
                        ->join('categories','categories.category_id','pizzas.category_id')
                        ->where('pizzas.category_id',$id)->paginate(5);

            return view ('admin.category.item')->with(['pizza'=>$data]);
        }

}

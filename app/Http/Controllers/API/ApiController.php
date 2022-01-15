<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Response;

class ApiController extends Controller
{
    public function categoryList()
    {
        $category = Category::get();
        $response = [
            'status' => 200,
            'message' => 'success',
            'data' => $category,
        ];
        return Response::json($response);
    }
    public function create(Request $request)
    {
        $data = [
            'category_name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        Category::create($data);
        $response = [
            'status' => '200',
            'message' => 'success',
        ];
        return Response::json($response);
    }
    public function details(Request $request)
    {
        $id = $request->id;
        $data = Category::where('category_id', $id)->first();
        if (!empty($data)) {
            return Response::json([
                'status' => 200,
                'message' => 'success',
                'data' => $data,
            ]);
        }
        return Response::json([
            'status' => 200,
            'message' => 'fails',
            'data' => $data,
        ]);

    }
    public function delete($id)
    {
        $delete = Category::where('category_id', $id)->first();
        if (empty($delete)) {
            return Response::json([
                'status' => 200,
                'message' => 'This category does not have',

            ]);

        }
        Category::where('category_id', $id)->delete();
        return Response::json([
            'status' => 200,
            'message' => 'This category is deleted successfully',
        ]);

    }

    public function update(Request $request)
    {
        $updated = [
            'category_id' => $request->id,
            'category_name' => $request->name,
            'updated_at' => Carbon::now(),
        ];
        $check = Category::where('category_id', $request->id)->first();
        if (!empty($check)) {
            Category::where('category_id', $request->id)->update($updated);
            return Response::json([
                'status' => 200,
                'message' => 'updated successfully',
            ]);
        }
        return Response::json([
            'status' => 200,
            'message' => 'fails',
        ]);

    }
}

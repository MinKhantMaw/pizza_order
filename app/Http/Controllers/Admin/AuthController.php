<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function userList()
    {
        $userList = User::where('role', 'user')->paginate(4);
        return view('admin.auth.user')->with(['user' => $userList]);
    }
    public function userDelete($id)
    {
        User::where('id', $id)->delete();
        return back()->with(['userDelete' => 'User Account Delete']);
    }
    public function userSearch(Request $request)
    {
        $search = $this->search('user', $request);
        return view('admin.auth.user')->with(['user' => $search]);
    }
    public function adminList()
    {
        $adminList = User::where('role', 'admin')->paginate(3);
        return view('admin.auth.admin')->with(['admin' => $adminList]);
    }
    public function adminDelete($id)
    {
        User::where('id', $id)->delete();
        return back()->with(['deleteAdmin' => 'Delete Admin Account']);
    }
    public function adminSearch(Request $request)
    {
        $search = $this->search('admin', $request);
        return view('admin.auth.admin')->with(['admin' => $search]);
    }
    private function search($role, $request)
    {
        $searchData = User::where('role', $role)
            ->where(function ($query) use ($request) {
                $query->orWhere('name', 'like', '%' . $request->searchData . '%')
                    ->orWhere('name', 'like', '%' . $request->searchData . '%')
                    ->orWhere('email', 'like', '%' . $request->searchData . '%')
                    ->orWhere('phone', 'like', '%' . $request->searchData . '%')
                    ->orWhere('address', 'like', '%' . $request->searchData . '%');
            })->paginate(3);

        $searchData->append($request->all());
        return $searchData;

    }
}

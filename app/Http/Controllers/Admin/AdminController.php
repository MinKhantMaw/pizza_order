<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function profile()
    {
        $id = auth()->user()->id;
        $userData = User::where('id', $id)->first();
        return view('admin.profile.index')->with(['user' => $userData]);
    }
    public function updateProfile($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $updateProfile = $this->requestProfileData($request);
        User::where('id', $id)->update($updateProfile);
        return back()->with(['updateProfile' => 'User Profile updated']);
    }

    public function changePasswordPage()
    {
        return view('admin.profile.changePassword');
    }
    public function changePassword($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'confirmPassword' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $data = User::where('id', $id)->first();
        $oldPassword = $request->oldPassword;
        $newPassword = $request->newPassword;
        $confirmPassword = $request->confirmPassword;
        $hashPassword = $data['password'];
        if (Hash::check($oldPassword, $hashPassword)) {
            if ($newPassword != $confirmPassword) {
                return back()->with(['passwordnotmatch' => 'New password & Confirm password are not equal...']);
            } else {
                if (strlen($newPassword) <= 6 || strlen($confirmPassword) <= 6) {
                    return back()->with(['lengthError' => 'Your password must be at least 6 characters']);
                } else {
                    $hash = Hash::make($newPassword);
                    User::where('id', $id)->update([
                        'password' => $hash,
                    ]);
                    return back()->with(['successChangePassword' => 'Your Password has been changed...']);
                }
            }
        } else {
            return back()->with(['oldpasserror' => 'Your Old Password is incorrect....']);

        }
    }
   
    private function requestProfileData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
    }
}

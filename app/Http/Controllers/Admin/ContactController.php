<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
     // contact form
    public function contactCreate(Request $request){
        $validator=Validator::make($request->all(),[
            'name' => 'required',
            'email'=>'required',
            'message' => 'required',
        ]);
        if ($validator->fails()) {
           return back()->withErrors($validator)->withInput();
        }
        $data=$this->requestUserData($request);
        Contact::create($data);
        return back()->with(['contactSuccess'=>'Your Message Send']);
    }
    public function contactList(){
        $contact=Contact::orderBy('contact_id','DESC')->paginate(5);
       return view('admin.contact.list')->with(['contact'=>$contact]);
    }
    // contact search
    public function contactSearch(Request $request){
        $search=Contact::orWhere('name','like','%' . $request->searchData . '%')
                        ->orWhere('email','like','%' . $request->searchData . '%')
                        ->paginate(5);
        $search->appends($request->all());
        if (count($search)==0) {
            $emptyStatus = 0;
        }else {
            $emptyStatus=1;
        }
        return view('admin.contact.list')->with(['contact'=>$search,'status'=>$emptyStatus]);
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

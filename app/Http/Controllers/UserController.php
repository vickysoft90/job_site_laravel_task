<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\JobLocation;
class UserController extends Controller
{
   function index(){
    $locationArr = JobLocation::get()->toArray();
    return view('dashboards.users.index',compact('locationArr'));
   }

   function profile(){
       return view('dashboards.users.profile');
   }
   function settings(){
       return view('dashboards.users.settings');
   }

   function registerUser(Request $request){
           
    $validator = \Validator::make($request->all(),[
        'name'=>'required',
    ]);

    if(!$validator->passes()){
        return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
    }else{
         $query = User::find(Auth::user()->id)->update([
              'name'=>$request->name,
         ]);

         if(!$query){
             return response()->json(['status'=>0,'msg'=>'Something went wrong.']);
         }else{
             return response()->json(['status'=>1,'msg'=>'Your profile info has been update successfuly.']);
         }
    }
}



}

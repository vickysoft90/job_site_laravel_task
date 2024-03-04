<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\JobLocation;
use App;
use DB;
use File;
class AdminController extends Controller
{
        function index(){        
            $userArr =User::with('location')->where('role', '=', 2)->orderBy('id', 'DESC')->get();
            $locationArr = JobLocation::get()->toArray();
            return view('dashboards.admins.index',compact('userArr','locationArr'));
        }

       function filterUser(Request $request){
       
        if(ISSET($request->id)){
            $path = 'users/resumes/';
            $oldResume = User::find($request->id)->getAttributes()['resume'];
            if( $oldResume != '' ){

                if( File::exists(public_path($path.$oldResume))){
                    File::delete(public_path($path.$oldResume));
                }
            }
            $path = 'users/images/';
            $oldpic = User::find($request->id)->getAttributes()['picture'];
        
            if( $oldpic != '' ){
                if(File::exists(public_path($path.$oldpic))){
                    File::delete(public_path($path.$oldpic));
                }
            }
            User::find($request->id)->delete(); // softdelete

            $userArr = User::with('location')->where('role', '=', 2)->orderBy('id', 'DESC')->get();
           
        }else{
            $query = User::with('location')->where('role', '=', 2);

            if ($request->filled('skill')) {
                $query->where('skill', 'LIKE', '%' . $request->input('skill') . '%');
            }
        
            if ($request->filled('location_id')) {
                $query->where('location_id', '=', $request->input('location_id'));
            }
        
            if ($request->filled('search')) {
                $query->where(function ($subquery) use ($request) {
                    $subquery->where('name', 'LIKE', '%' . $request->input('search') . '%')
                             ->orWhere('email', 'LIKE', '%' . $request->input('search') . '%');
                });
            }
        
            if ($request->filled('minExp') && $request->filled('maxExp')) {
                $query->whereBetween('exp', [$request->input('minExp'), $request->input('maxExp')]);
            }
                
            $userArr = $query->orderBy('id', 'DESC')->get();
           
        }
        $a=" <table class='table' id='div_related_user_access_clients'>
             <thead>
                 <tr>
                    <th>Sno</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Phone</th>
                     <th>Experience</th>
                     <th>Location</th>
                     <th>Photo</th>
                     <th>Resume</th>
                     <th>Delete</th>
                 </tr>
             </thead><tbody>";
             $i=0;
             foreach($userArr as $val){
                $i=$i+1;
                $resume='users/resumes/'.$val['resume'];
                 $a.="<tr><td>".$i."</td><td>".$val['name']."</td><td>".$val['email']."</td><td>".$val['phone']."</td><td>".$val['experience']."</td><td>".$val['location']['location']."</td><td><img src=".$val['picture']."  width='50'></td><td><a href=".$resume." download='resume' target='_blank'>Download</a></td><td><i class='fas fa-trash-alt' title='delete user' onclick='callFilter(".$val['id'].")'></i></td></tr>";
             }
             $a.="</table>";
             return  response()->json(['status'=>1,'msg'=>$a]);
       }
    
       function profile(){
        $locationArr = JobLocation::get()->toArray();
           return view('dashboards.admins.profile',compact('locationArr'));
       }
       function settings(){
           return view('dashboards.admins.settings');
       }

       function updateInfo(Request $request){
           
               $validator = \Validator::make($request->all(),[
                   'name'=>'required',
                   'email'=> 'required|email|unique:users,email,'.Auth::user()->id,
                   'file'=> 'mimes:pdf',
               ]);

               if(!$validator->passes()){
                   return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
               }else{
                        if ($request->file('file')!=null){
                            $validator = \Validator::make($request->all(),[
                                'file'=> 'mimes:pdf'
                            ]);
                            if(!$validator->passes()){
                                return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
                            }
                                    $path = 'users/resumes/';
                                    $file = $request->file('file');
                                    $new_name = 'UIMG_'.date('Ymd').uniqid().'.pdf';
                                    //Upload new image
                                    $upload = $file->move(public_path($path), $new_name);
                                    //Get Old picture
                                    $oldResume = User::find(Auth::user()->id)->getAttributes()['resume'];

                                    if( $oldResume != '' ){
                                        if( \File::exists(public_path($path.$oldResume))){
                                            \File::delete(public_path($path.$oldResume));
                                        }
                                    }
                                    $update = User::find(Auth::user()->id)->update(['resume'=>$new_name]);

                           }

                    $query = User::find(Auth::user()->id)->update([
                         'name'=>$request->name,
                         'email'=>$request->email,
                         'skill'=>$request->skill,
                         'location_id'=>$request->location_id,
                         'phone'=>$request->phone,
                         'experience'=>$request->experience,
                         'notice'=>$request->notice,
                    ]);

                    if(!$query){
                        return response()->json(['status'=>0,'msg'=>'Something went wrong.']);
                    }else{
                        return response()->json(['status'=>1,'msg'=>'Your profile info has been update successfuly.']);
                    }
               }
       }

       function updatePicture(Request $request){
           $path = 'users/images/';
           $file = $request->file('admin_image');
           $new_name = 'UIMG_'.date('Ymd').uniqid().'.jpg';

           //Upload new image
           $upload = $file->move(public_path($path), $new_name);
           
           if( !$upload ){
               return response()->json(['status'=>0,'msg'=>'Something went wrong, upload new picture failed.']);
           }else{
               //Get Old picture
               $oldPicture = User::find(Auth::user()->id)->getAttributes()['picture'];

               if( $oldPicture != '' ){
                   if( \File::exists(public_path($path.$oldPicture))){
                       \File::delete(public_path($path.$oldPicture));
                   }
               }

               //Update DB
               $update = User::find(Auth::user()->id)->update(['picture'=>$new_name]);

               if( !$upload ){
                   return response()->json(['status'=>0,'msg'=>'Something went wrong, updating picture in db failed.']);
               }else{
                   return response()->json(['status'=>1,'msg'=>'Your profile picture has been updated successfully']);
               }
           }
       }


       function changePassword(Request $request){
           //Validate form
           $validator = \Validator::make($request->all(),[
               'oldpassword'=>[
                   'required', function($attribute, $value, $fail){
                       if( !\Hash::check($value, Auth::user()->password) ){
                           return $fail(__('The current password is incorrect'));
                       }
                   },
                   'min:8',
                   'max:30'
                ],
                'newpassword'=>'required|min:8|max:30',
                'cnewpassword'=>'required|same:newpassword'
            ],[
                'oldpassword.required'=>'Enter your current password',
                'oldpassword.min'=>'Old password must have atleast 8 characters',
                'oldpassword.max'=>'Old password must not be greater than 30 characters',
                'newpassword.required'=>'Enter new password',
                'newpassword.min'=>'New password must have atleast 8 characters',
                'newpassword.max'=>'New password must not be greater than 30 characters',
                'cnewpassword.required'=>'ReEnter your new password',
                'cnewpassword.same'=>'New password and Confirm new password must match'
            ]);

           if( !$validator->passes() ){
               return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
           }else{
                
            $update = User::find(Auth::user()->id)->update(['password'=>\Hash::make($request->newpassword)]);

            if( !$update ){
                return response()->json(['status'=>0,'msg'=>'Something went wrong, Failed to update password in db']);
            }else{
                return response()->json(['status'=>1,'msg'=>'Your password has been changed successfully']);
            }
           }
       }

}
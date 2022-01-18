<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Profile;
use App\user;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends Controller
{
    use MediaUploadingTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function profile()
    {
        return view('admin.profile.profile');
    }
    public function updateProfile(Request $request)
    {
        $id = auth()->user()->id;
        Profile::whereId($id)->update(request()->except(['_token']));
        //Profile::findOrFail($id)->update($request->all());


//        echo '<pre>';print_r($profile);die;
        return redirect()->route('admin.profile.me')->with('message', 'Data Updated Successfully.');
    }

    function updatePicture(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ]);
        $path = 'logos';
        $file = $request->file('logo');
        $name = $request->file('logo')->getClientOriginalName();
        $new_name = date('Ymd').'-'.$name;

        //Upload new image
        $upload = $file->move(public_path($path), $new_name);

        if( !$upload ){
            return redirect()->route('admin.profile.me')->with('message', 'Something went wrong, upload new picture failed.');
        }else{
            //Get Old picture
            $oldPicture = User::find(Auth::user()->id)->getAttributes()['logo'];

            if( $oldPicture != '' ){
                if( \File::exists(public_path($path.$oldPicture))){
                    \File::delete(public_path($path.$oldPicture));
                }
            }

            //Update DB
            $update = User::where('id', Auth::user()->id)->update(['logo'=>$new_name]);

            if( !$upload ){
                return redirect()->route('admin.profile.me')->with('message', 'Something went wrong, updating picture in db failed.');
            }else{
                return redirect()->route('admin.profile.me')->with('message', 'Your profile picture has been updated successfully!');
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
            'oldpassword.min'=>'Old password must have at least 8 characters',
            'oldpassword.max'=>'Old password must not be greater than 30 characters',
            'newpassword.required'=>'Enter new password',
            'newpassword.min'=>'New password must have at least 8 characters',
            'newpassword.max'=>'New password must not be greater than 30 characters',
            'cnewpassword.required'=>'ReEnter your new password',
            'cnewpassword.same'=>'New password and Confirm new password must match'
        ]);

        if( !$validator->passes() ){

            return redirect()->route('admin.profile.me')->with('message', 'Your password has not been changed');
        }else{

            $update = User::find(Auth::user()->id)->update(['password'=>\Hash::make($request->newpassword)]);

            if( !$update ){
                return redirect()->route('admin.profile.me')->with('message', 'Something went wrong, Failed to update password in db');
            }else{
                return redirect()->route('admin.profile.me')->with('message', 'Your password has been changed successfully');
            }
        }
    }
}

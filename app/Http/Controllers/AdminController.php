<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  //while using auth we must use this
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();



        $notification = array(
            'message' => 'Oops You Logged out of Your Account',
            'alert-type' =>'warning'
        );

        return redirect('/login')->with($notification);//After logout itredirect to the mentioned url
    }//End method





    public function profile(){
        $id = Auth::user()->id;
        $admindata = User::find($id);
        return view('admin.admin_profile_view', compact('admindata'));   //It gives database info as admindata to the file admin_profile_view so we  can access database on the file directly
    }//End method




    public function editprofile(){
        $id = Auth::user()->id;
        $editdata = User::find($id);
        return view('admin.admin_profile_edit', compact('editdata'));
    }//End method



    public function storeprofile(Request $request){
        $id = Auth::user()->id;  //it returns the id of the user who is currently logged in
        $data = User::find($id);   //It find the datas of the id and store in the $data variable
        $data->name = $request->name;
        $data->email = $request->email;
        $data->username = $request->username;

        //For storing image
        if ($request->file('profile_image')) {
            $file =  $request->file('profile_image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['profile_image'] = $filename;
        }
        $data->save();


        $notification = array(
            'message' => 'Profile Updated in successfully',
            'alert-type' =>'success'
        );

        return redirect()->route('admin.profile')->with($notification);
    }//End method


    public function changepassword(){

        return view('admin.admin_change_password');
    }//End method



    public function updatepassword(Request $request){
        $validatedata = $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'confirm_password' => 'required|same:newpassword',
        ]);
        $hashedpassword = Auth::user()->password;
        if (Hash::check($request->oldpassword,$hashedpassword)) {
            $users = User::find(Auth::id());
            $users->password = bcrypt($request->newpassword);
            $users->save();

            session()->flash('message', 'Password is updated Successfully');
            return redirect()->back();
        } else {
            session()->flash('message', 'OldPassword is not matched');
            return redirect()->back();
        }

    }//End method
}

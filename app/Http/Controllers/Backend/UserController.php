<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClassModel;
use Auth;
use Hash;
use Str;    


class UserController extends Controller
{

    public function my_account()
    {
        $data['getRecord'] = User::getSignle(Auth::user()->id);
        $data['meta_title'] = "My Account";
        return view('backend.my_account', $data);
    }

    public function update_account(Request $request)
    {
        $user = User::getSignle(Auth::user()->id);
        $user->name = trim($request->name);
        if (Auth::user()->is_admin == 3)
        {
            $user->last_name = trim($request->last_name);
        }
        if (!empty($request->file('profile_pic')))
        
        {
           $ext = $request->file('profile_pic')->getClientOriginalExtension();
           $file = $request->file('profile_pic');
           $randomStr = date('Ymdhis').Str::random(20);
           $filename = strtolower($randomStr).'.'.$ext;
       
           $file->move('upload/profile/', $filename);
       
           $user->profile_pic = $filename;
           $user->save();
       }
       $user->save();

       return redirect()->back()->with('success', 'Account Successfully Update');
    }
    public function change_password()
    {
        $data['meta_title'] = "Change Password";
        return view('backend.change_password', $data);
    }
    public function update_password(Request $request)
{
    $request->validate([
        'old_password' => 'required',
        'new_password' => 'required|min:6|confirmed',
    ], [
        'new_password.confirmed' => 'New Password and Confirm Password do not match!',
    ]);

    $user = User::find(Auth::id());

    if (!Hash::check($request->old_password, $user->password)) {
        return redirect()->back()->with('error', 'Old Password is incorrect!');
    }

    if (Hash::check($request->new_password, $user->password)) {
        return redirect()->back()->with('error', 'New password must be different from the old password!');
    }

    $user->password = Hash::make($request->new_password);
    $user->save();

    return redirect()->back()->with('success', 'Password Successfully Updated!');
}

    
}
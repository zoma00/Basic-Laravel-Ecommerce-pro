<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;


class ChangePass extends Controller
{
    public function CPassword(){
        return view('admin.body.change_password');
    }

 public function UpdatePassword(Request $request)
{
    $request->validate([
        'oldpassword' => 'required',
        'password' => 'required|confirmed',
    ]);

    $hashedPassword = Auth::user()->password;

    if (!Hash::check($request->oldpassword, $hashedPassword)) {
        return redirect()->back()->with('error', 'Current password is invalid.');
    }

    $user = User::find(Auth::id());
    $user->password = Hash::make($request->password);
    $user->save();

    Auth::logout();

    return redirect()->route('login')->with('success', 'Password changed successfully.');
}

public function PUpdate(){
    if(Auth::user())
    $user = User::find(Auth::user()->id);
if($user){
    return view('admin.body.update_profile',compact('user'));
}
}

public function UpdateProfile(Request $request)
{
    $user = User::find(Auth::user()->id);

    if ($user) {
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    return redirect()->back()->with('error', 'User not found.');
}



}

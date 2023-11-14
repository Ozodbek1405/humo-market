<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ChangeProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('profile.profile');
    }

    public function profileChange(ChangeProfileRequest $request, $user_id)
    {
        $data = $request->validated();
        $user = User::find($user_id);
        $user->update($data);
        return redirect()->back()->with(['success' => 'Saved successfully']);
    }

    public function changePasswordProfile($user_id)
    {
        $user = User::find($user_id);
        return view('profile.changePassword',compact('user'));
    }

    public function changeProfile(ChangePasswordRequest $request,$user_id)
    {
        $data = $request->validated();
        $user = User::find($user_id);
        if (!$data || (!isset($data['old_password']) && $user->password)){
            return back()->with(['error' => 'Enter old password']);
        }
        if (isset($data['old_password']) && !Hash::check($data['old_password'], $user->password)){
            return back()->with(['error' => 'Old password is incorrect']);
        }
        $data['password'] = Hash::make($data['password']);
        unset($data['old_password']);
        $user->update($data);
        return redirect()->back()->with(['success' => 'Saved successfully']);
    }
}

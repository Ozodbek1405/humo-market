<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;

class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function registerPost(RegisterRequest $request)
    {
        $data = $request->validated();
        /** @var User $user */
        $user = User::query()->create($data);
        auth()->login($user);
        if (session()->has('redirectTo')) {
            $url = session()->get('redirectTo');
            session()->forget('redirectTo');
            return redirect($url);
        }
        return redirect()->route('home');
    }
}

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
        return redirect()->route('home');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $phone = $request->phone;
        $password = $request->password;
        /** @var User $user */
        $user = User::query()->where('phone',$phone)->first();
        if (!$user || !Hash::check($password, $user->password)) {
            return redirect()->back()->with('error', 'The phone number or password is incorrect');
        }
        auth()->login($user);
        return redirect()->route('home');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('home');
    }

    public function redirectToGoogle()
    {
        try {
            return Socialite::driver('google')->redirect();
        }catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            /** @var User $findUser */
            $findUser = User::query()->where('google_id', $user->id)->first();
            if($findUser){
                Auth::login($findUser);
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                ]);
                Auth::login($newUser);
            }
            return redirect()->route('home');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}

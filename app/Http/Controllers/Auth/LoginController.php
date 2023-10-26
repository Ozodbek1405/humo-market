<?php

namespace App\Http\Controllers\Auth;

use SCart\Core\Front\Controllers\Auth\LoginController as Login;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Login
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username(): string
    {
        return 'phone';
    }

    protected function validateLogin(Request $request)
    {
        $messages = [
            'phone.digits'       => sc_language_render('validation.digits', ['attribute'=> sc_language_render('customer.phone')]),
            'phone.required'    => sc_language_render('validation.required', ['attribute'=> sc_language_render('customer.phone')]),
            'phone.numeric'    => sc_language_render('validation.numeric', ['attribute'=> sc_language_render('customer.phone')]),
            'password.required' => sc_language_render('validation.required', ['attribute'=> sc_language_render('customer.password')]),
        ];
        $this->validate($request, [
            'phone'    => 'required|numeric|digits:9',
            'password' => 'required|string',
        ], $messages);
    }
}

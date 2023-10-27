<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use SCart\Core\Front\Controllers\Auth\ResetPasswordController as ResetPassword;
use SCart\Core\Front\Models\ShopCustomer;

class ResetPasswordController extends ResetPassword
{
    public function __construct()
    {
        parent::__construct();
    }

    public function password_change(Request $request): RedirectResponse
    {
        $messages = [
            'password.required' => sc_language_render('validation.required', ['attribute'=> sc_language_render('customer.password')]),
            'password.confirmed' => sc_language_render('validation.confirmed', ['attribute'=> sc_language_render('customer.password')]),
            'password.min' => sc_language_render('validation.password.min', ['attribute'=> sc_language_render('customer.password')]),
            'password_confirm.required' => sc_language_render('validation.required', ['attribute'=> sc_language_render('customer.password_confirm')]),
            'password_confirm.min' => sc_language_render('validation.password.min', ['attribute'=> sc_language_render('customer.password')]),
        ];
        $v = Validator::make(
            $request->all(),
            [
                'password' => sc_customer_validate_password()['password_confirm'],
            ],
            $messages
        );
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors());
        }
        $password = $request->get('password');
        $phone_number = $request->session()->get('reset_code')['value'];
        $customer = ShopCustomer::query()->where('phone', $phone_number)->firstOrFail();
        $customer->password = bcrypt($password);
        $customer->save();

        return redirect()->route('login');
    }

    public function resetView()
    {
        return view('templates.s-cart-light.auth.reset');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use SCart\Core\Front\Models\ShopCustomer;
use SCart\Core\Rules\CaptchaRule;

class SendCodeController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function code(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        if (Auth::user()) {
            return redirect()->route('home');
        }
        return view('templates.s-cart-light.auth.code');
    }

    public function reset_code(Request $request): Factory|View|Application|RedirectResponse
    {
        $data = $request->all();
        $dataMapping['code'] = 'required|numeric|digits:6';
        if (sc_captcha_method() && in_array('forgot', sc_captcha_page())) {
            $data['captcha_field'] = $data[sc_captcha_method()->getField()] ?? '';
            $dataMapping['captcha_field'] = ['required', 'string', new CaptchaRule];
        }
        $validator = Validator::make($data, $dataMapping);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $phone_number = $request->session()->get('reset_code')['value'];
        $customer = ShopCustomer::query()->where('phone', $phone_number)->firstOrFail();

        if ($data['code'] === $customer->verify_code) {
            if (strtotime($customer->verify_expiration) >= strtotime(Carbon::now())) {
                return redirect()->route('reset.view');
            }
            return back()->with(['error' => 'Kod muddati tugagan']);
        }
        return back()->with(['error' => "Xato kod kiritildi"]);
    }
}

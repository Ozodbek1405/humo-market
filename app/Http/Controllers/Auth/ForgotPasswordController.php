<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use SCart\Core\Front\Controllers\Auth\ForgotPasswordController as Forgot;
use App\Services\SendSmsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use SCart\Core\Front\Models\ShopCustomer;
use SCart\Core\Rules\CaptchaRule;

class ForgotPasswordController extends Forgot
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
     */

    /**
     * Send a reset link to the given user.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function sendResetLinkEmail(Request $request): RedirectResponse
    {
        $data = $request->all();
        $dataMapping['phone'] = 'required|numeric|exists:shop_customer|digits:9';
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
        $customer = ShopCustomer::query()->where('phone',$data['phone'])->first();
        $code = rand(100000,999999);
        $customer->verify_code = $code;
        $customer->verify_expiration = Carbon::now()->addMinutes(15);
        $customer->save();
        session()->put('reset_code', ['key' => 'phone', 'value' => $customer->phone]);
        SendSmsService::sms_packages('998'.$customer->phone ,'Tasdiqlash kodi: '.$code);
        return redirect()->route('send.code');
    }
}

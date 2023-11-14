<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ResetCodeRequest;
use App\Http\Requests\ResetRequest;
use App\Models\User;
use App\Services\SendSmsService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class ResetController extends Controller
{
    public function reset()
    {
        return view('auth.reset-password');
    }

    public function resetSubmit(ResetRequest $request)
    {
        $data = $request->validated();
        $phone = $data['phone'];
        $user = User::query()->where('phone',$phone)->first();
        $code = rand(100000,999999);
        $user->verify_code = $code;
        $user->verify_expiration = Carbon::now()->addMinutes(5);
        $user->save();
        session()->put('reset_code', ['key' => 'phone', 'value' => $user->phone]);
        SendSmsService::sms_packages($user->phone ,'Tasdiqlash kodi: '.$code);
        return redirect()->route('code');
    }

    public function code()
    {
        return view('auth.code');
    }

    public function codeSubmit(ResetCodeRequest $request)
    {
        $data = $request->validated();
        $phone_number = $request->session()->get('reset_code')['value'];
        $user = User::query()->where('phone', $phone_number)->firstOrFail();

        if ($data['code'] === $user->verify_code) {
            if (strtotime($user->verify_expiration) >= strtotime(Carbon::now())) {
                return redirect()->route('change');
            }
            return back()->with(['error' => 'Code has expired']);
        }
        return back()->with(['error' => "An error code was entered"]);
    }

    public function change()
    {
        return view('auth.change');
    }

    public function changePassword(PasswordRequest $request)
    {
        $data = $request->validated();
        $phone = $request->session()->get('reset_code')['value'];
        $user = User::query()->where('phone', $phone)->firstOrFail();
        $user->password = Hash::make($data['password']);
        $user->save();
        return redirect()->route('login');
    }

}

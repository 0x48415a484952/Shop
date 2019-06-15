<?php

namespace App\Http\Controllers\Auth;


use Kavenegar;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
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

    // use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }


    public function action(ForgotPasswordRequest $request)
    {
        $userInfo = User::where('phone', $request->get('phone'))
                ->where('social_id', $request->get('social_id'))
                ->whereNull('phone_verified_at')->count();
                // dd($userInfo);
        if ($userInfo > 0) {

            $verificationCode = mt_rand(100000,999999);
            
            $newPassword = Str::random(12);
            User::where('phone', $request->get('phone'))
                ->where('social_id', $request->get('social_id'))
                ->update(['password' => Hash::make($newPassword), 'phone_verification_code' => $verificationCode]);
            $result = Kavenegar::VerifyLookup($request->get('phone'), $verificationCode, $newPassword, null, 'resetPasswordUnverified');
            return response()->json(['data' => ['message' => trans('messages.account_have_been_updated')] ], 200);
        }

        $userInfo = User::where('phone', $request->get('phone'))
                ->where('social_id', $request->get('social_id'))
                ->whereNotNull('phone_verified_at')->count();
                // dd($userInfo);
        if ($userInfo > 0) {
            $newPassword = Str::random(12);
            User::where('phone', $request->get('phone'))
                ->where('social_id', $request->get('social_id'))
                ->update(['password' => Hash::make($newPassword)]);
            $result = Kavenegar::VerifyLookup($request->get('phone'), $newPassword, null, null, 'resetPasswordVerified');
            return response()->json(['data' => ['message' => trans('messages.new_password_sent')] ], 200);
        }

        

        return response()->json(['data' => ['message' => trans('messages.invalid_credentials')] ], 422);
    }
}

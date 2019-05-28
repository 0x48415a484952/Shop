<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Kavenegar;
use Throwable;
use Exception;
use App\Rules\NationalCode;
use Illuminate\Support\Str;
//use Tymon\JWTAuth\JWTAuth;


class UserController extends Controller
{
    public function authenticate(Request $request) 
    {
        $credentials = null;
        $phoneLogin = $request->get('phone') != null && $request->get('password') != null;

        if ($phoneLogin) {
            $credentials = $request->only('phone', 'password');
        } 
        
        $socialIdLogin = $request->get('social_id') != null && $request->get('password') != null;

        if ($socialIdLogin) {
            $credentials = $request->only('social_id', 'password');
        }

        if (!is_array($credentials)) {
            return response()->json(['status' => '0','message' => trans('messages.fill_out_all_parameteres')], 400);
        }

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['status' => '0','message' => trans('messages.invalid_credentials')], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['status' => '0', 'message' => trans('messages.could_not_create_token')], 500);
        }

        return response()->json(['status' => '1','token' => $token]);
    }

    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'phone' => ['required', 'numeric', 'digits:11', 'unique:users'],
                'social_id' => ['required', 'numeric', 'digits:10', new NationalCode, 'unique:users'],
                'password' => ['required', 'string', 'min:10', 'max:255'],
                'confirm_password' => ['required', 'string', 'min:10', 'max:255', 'same:password']
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => '0', 'message' => trans('messages.validation_errors'), 'errors' => $validator->errors()], 422);
            }

            $verificationCode = mt_rand(100000,999999);

            //dd($verificationCode);

            $user = User::create([
                'phone' => $request->get('phone'),
                'phone_verification_code' => $verificationCode,
                'social_id' => $request->get('social_id'),
                'password' => Hash::make($request->get('password')),
            ]);

            $token = JWTAuth::fromUser($user);

            $result = Kavenegar::VerifyLookup($request->get('phone'), $verificationCode, null, null, 'verification');
            
            return response()->json(['status' => '1', 'message' => tarns('messages.your_account_have_been_created'), 'result' => $result, 'token' => $token], 201);

        } catch (Throwable $e) {
            return response()->json(['status' => '0', 'message' => $e->getMessage()]);
        }
    }

    public function changePhone(Request $request)
    {
        $validator = Validator::make($request()->all(), [
            'phone' => 'required|string|digits:11',
            ]);

        try {
            if ($validator->fails()) {
                throw new Exception ($validator->errors(), 400);
            }
            
            $user = JWTAuth::User();
            $verificationCode = mt_rand(100000,999999);
            
            if ($user->phone_verified_at != null) {
                throw new Exception(trans('messages.you_can_not_change_your_phone'), 400);
            }

            if ($user->phone == $request->get('phone')) {
                throw new Exception (trans('messages.old_phone_equals_new_phone'), 400);
            }
            
            User::where('id', $user->id)
                ->update(['phone' => $request->get('phone'), 'phone_verification_code' => $verificationCode]);

            $result = Kavenegar::VerifyLookup($request->get('phone'), $verificationCode, null, null, 'verification');

            return response()->json(['status' => '1', 'message' => trans('messages.phone_number_have_been_changed')], 200);

        } catch (\Throwable $e) {
            return response()->json(['status' => '0', 'message' => $e->getMessage()], $e->getCode());
        }
    }

    public function sendVerificationCodeAgain(Request $request)
    {

        try {

            $user = JWTAuth::User();

            $nowDate = new DateTime();
            $userDate = $user->updated_at;

            $nowDate = (int)$nowDate->format('U');
            $userDate = (int)$userDate->format('U');
            $interval = $nowDate - $userDate;

            if ($user->phone_verified_at != null) {
                throw new Exception (trans('messages.already_confirmed_phone'));
            }

            if ($interval > 120) {

                $verificationCode = mt_rand(100000,999999);

                User::where('id', $user->id)
                    ->update(['phone_verification_code' => $verificationCode]);

                $result = Kavenegar::VerifyLookup($request->get('phone'), $verificationCode, null, null, 'verification');

                return response()->json(['status' => '1', 'user' => $user, 'message' => trans('messages.new_confirmation_code_sent'), 'result' => $result], 200);
            }
            
            throw new Exception (trans('messages.try_again_in_two_minutes'), 400);

        } catch (\Throwable $e) {
            return response()->json(['status' => '0', 'message' => $e->getMessage()], $e->getCode());
        }
    }

    public function confirm(Request $request) 
    {
        $validator = Validator::make($request()->all(), [
            'phone_verification_code' => 'required|string|digits:6',
        ]);
        
        try {
            
            if ($validator->fails()) {
                throw new Exception ($validator->errors(), 400);
            }

            $user = JWTAuth::User();
            
            if ($user->phone_verified_at) {
                throw new Exception (trans('messages.already_confirmed_phone'), 400);
            }

            if ($user->phone_verification_code == $request->get('phone_verification_code')) {
                User::where('id', $user->id)
                    ->update(['phone_verified_at' => date_create(), 'phone_verification_code' => mt_rand(100000, 999999)]);
                return response()->json(['status' => '1', 'message' => trans('messages.phone_number_confirmed')]);
            }

            throw new Exception (trans('messages.confirmation_code_not_true'), 400);

        } catch (Throwable $e) {
            return response()->json(['status' => '0', 'message' => $e->getMessage()], $e->getCode());
        }
    }

    public function forgotPassword(Request $request)
    {
        try {
            
            $validator = Validator::make($request->all(), [
                'phone' => ['required', 'numeric', 'digits:11'],
                'social_id' => ['required', 'numeric', 'digits:10', new NationalCode]
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => '0', 'message' => trans('messages.something_went_wrong'), 'errors' => $validator->errors()], 422);
            }
            
            $userInfo = User::where('phone', $request->get('phone'))
                ->where('social_id', $request->get('social_id'))
                ->whereNull('phone_verified_at')->count();

            if ($userInfo > 0) {

                $verificationCode = mt_rand(100000,999999);
                
                $newPassword = Str::random(12);
                User::where('phone', $request->get('phone'))
                    ->where('social_id', $request->get('social_id'))
                    ->update(['password' => Hash::make($newPassword), 'phone_verification_code' => $verificationCode]);
                $result = Kavenegar::VerifyLookup($request->get('phone'), $verificationCode, $newPassword, null, 'resetPasswordUnverified');
                return response()->json(['status' => '1', 'message' => trans('messages.account_have_been_updated'), 'result' => $result], 200);
            }

            $userInfo = User::where('phone', $request->get('phone'))
                ->where('social_id', $request->get('social_id'))
                ->whereNotNull('phone_verified_at')->count();
            
            if ($userInfo > 0) {
                $newPassword = Str::random(12);
                User::where('phone', $request->get('phone'))
                    ->where('social_id', $request->get('social_id'))
                    ->update(['password' => Hash::make($newPassword)]);
                $result = Kavenegar::VerifyLookup($request->get('phone'), $newPassword, null, null, 'resetPasswordVerified');
                return response()->json(['status' => '1', 'message' => trans('messages.new_password_sent'), 'result' => $result], 200);
            }

            throw new Exception(trans('messages.invalid_credentials'), 400);

        } catch (Throwable $e) {
            return response()->json(['status' => '0', 'message' => $e->getMessage()], $e->getCode());
        }
    }

}

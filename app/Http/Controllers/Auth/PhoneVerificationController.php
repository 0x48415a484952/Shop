<?php

namespace App\Http\Controllers\Auth;

use JWTAuth;
use Exception;


use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PhoneVerificationResource;
use App\Http\Requests\Auth\PhoneVerificationRequest;

class PhoneVerificationController extends Controller
{
    public function action(PhoneVerificationRequest $request) 
    {
        
        // $user = JWTAuth::User();
        // // return $user;
        // // dd($user);
        // if ($user->phone_verification_code == $request->get('phone_verification_code')) {
        //     User::where('id', $user->id)
        //         ->update(['phone_verified_at' => date_create(), 'phone_verification_code' => mt_rand(100000, 999999)]);
        //     return new PhoneVerificationResource($user);
        // }

        // $validator = Validator::make($request()->all(), [
        //     'phone_verification_code' => 'required|string|digits:6',
        //     'social_id' => 'required'
        // ]);
        
        // try {
            
            // if ($validator->fails()) {
            //     throw new Exception ($validator->errors(), 400);
            // }
            $nationalCode = base64_decode($request->get('social_id'));
            // dd($nationalCode);
            $user = User::where('social_id', $nationalCode)
                    ->where('phone_verification_code', $request->get('phone_verification_code'))->first();
            // dd($user);

            if(!$user) return response()->json(['errors' => ['message' => trans('messages.invalid_credentials')]], 422);

            if ($user->phone_verified_at) {
                return response()->json(
                [
                    'errors' => ['message' => trans('messages.already_confirmed_phone')]
                ], 422);
            }

            if ($user->phone_verification_code == $request->get('phone_verification_code')) {
                User::where('social_id', $user->social_id)
                    ->update(['phone_verified_at' => date_create(), 'phone_verification_code' => mt_rand(100000, 999999)]);
                return response()->json(
                    [
                        'data' => ['message' => trans('messages.phone_number_confirmed')]
                    ], 200);
            }

            // throw new Exception (trans('messages.confirmation_code_not_true'), 400);

        // } catch (Throwable $e) {
        //     return response()->json(['status' => '0', 'message' => $e->getMessage()], 400);
        // }
    }

}

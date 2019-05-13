<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use JWTAuth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Throwable;
use Exception;
use App\Http\Resources\PhoneVerificationResource;

class PhoneVerificationController extends Controller
{
    public function action(Request $request) 
    {
        
            $user = JWTAuth::User();
            // return $user;
            // dd($user);
            if ($user->phone_verification_code == $request->get('phone_verification_code')) {
                User::where('id', $user->id)
                    ->update(['phone_verified_at' => date_create(), 'phone_verification_code' => mt_rand(100000, 999999)]);
                return new PhoneVerificationResource($user);
            }

    }
}

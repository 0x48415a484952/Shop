<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\PrivateUserResource;

class LoginController extends Controller
{
    public function action(LoginRequest $request)
    {
        // $credentials = [];
        // $phoneLogin = $request->get('phone') != null && $request->get('password') != null;

        // if ($phoneLogin) {
        //     $credentials = $request->only('phone', 'password');
        // } 
        
        // $socialIdLogin = $request->get('social_id') != null && $request->get('password') != null;

        // if ($socialIdLogin) {
        //     $credentials = $request->only('social_id', 'password');
        // }

        // if (!is_array($credentials)) {
        //     return response()->json(['status' => '0','message' => trans('messages.fill_out_all_parameteres')], 400);
        // }
        
        if(!$token = auth()->attempt($request->only('social_id', 'password'))) {
            return response()->json([
                'errors' => [
                    'social_id' => [ trans('messages.invalid_credentials') ]
                ]
            ], 422);
        }

        return (new PrivateUserResource($request->user()))
            ->additional([
                'meta' => [
                    'token' => $token
                ]
            ]);
    }
}

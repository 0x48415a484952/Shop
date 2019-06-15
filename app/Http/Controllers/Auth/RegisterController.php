<?php

namespace App\Http\Controllers\Auth;

use JWTAuth;
use Exception;
use Kavenegar;
use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\PrivateUserResource;

class RegisterController extends Controller
{
    // /*
    // |--------------------------------------------------------------------------
    // | Register Controller
    // |--------------------------------------------------------------------------
    // |
    // | This controller handles the registration of new users as well as their
    // | validation and creation. By default this controller uses a trait to
    // | provide this functionality without requiring any additional code.
    // |
    // */

    // use RegistersUsers;

    // /**
    //  * Where to redirect users after registration.
    //  *
    //  * @var string
    //  */
    // protected $redirectTo = '/home';

    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    // /**
    //  * Get a validator for an incoming registration request.
    //  *
    //  * @param  array  $data
    //  * @return \Illuminate\Contracts\Validation\Validator
    //  */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:6', 'confirmed'],
    //     ]);
    // }

    // /**
    //  * Create a new user instance after a valid registration.
    //  *
    //  * @param  array  $data
    //  * @return \App\User
    //  */
    // protected function create(array $data)
    // {
    //     return User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //     ]);
    // }

    public function action(RegisterRequest $request)
    {
        $validation = $request->validated();
        $validation['phone_verification_code'] =  mt_rand(100000,999999);
        $user = User::create($validation);
        Kavenegar::VerifyLookup($user->phone, $user->phone_verification_code, null, null, 'verification');
        $token = JWTAuth::fromUser($user);
        // $cookie = cookie('auth._token.local', 'Bearer '. $token, 120);
        // return (new PrivateUserResource($user->refresh()))->response()->cookie($cookie);



        // dd($_SERVER);
        // $domain = ($_SERVER['HTTP_HOST'] != 'localhost:8000') ? $_SERVER['HTTP_HOST'] : false;
        // dd($domain);
        // setcookie('cookiename', $token, time()+60*60*24*365, '/', $domain, false);
        return new PrivateUserResource($user->refresh());
    }
}

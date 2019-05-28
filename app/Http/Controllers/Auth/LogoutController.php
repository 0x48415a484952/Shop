<?php

namespace App\Http\Controllers\Auth;

use JWTAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function action()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
    }
}

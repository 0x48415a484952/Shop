<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
class DataController extends Controller
{
    public function open() 
    {
        $data = "this data is open and can be accessed without the client being authenticated";
        return response()->json(compact('data'),200);
    }

    public function close()
    {
        $data = "Only authorized users can see this";
        
        dd(JWtAuth::User()->level);
    }
}

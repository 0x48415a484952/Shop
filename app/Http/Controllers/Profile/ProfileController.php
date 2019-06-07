<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PublicInformationResource;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    public function me(Request $request)
    {
        // return (new PrivateUserResource($request->user()))
        // ->additional([
        //     'information' => [
        //         $request->user()->information
        //     ]
        // ]);
        

        // dd($request->user()->information);
        if($request->user()->information != null) {
            return new PublicInformationResource($request->user()->information);
        }

        return false;
        // return new PublicInformationResource($request->user()->information);
    }


}

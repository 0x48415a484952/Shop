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

        return new PublicInformationResource($request->user()->information);
    }


}

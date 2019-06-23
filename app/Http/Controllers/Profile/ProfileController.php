<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PublicInformationResource;
use App\Http\Requests\Profile\StoreInformationRequest;
use App\Models\Information;
use App\Http\Resources\PrivateInformationResource;

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
            return new PrivateInformationResource($request->user()->information);
        }

        return '';
        // return new PublicInformationResource($request->user()->information);
    }


    public function store(StoreInformationRequest $request)
    // public function store(Request $request)
    {
        if($request->user()) {
            $info = new Information;
            $info->first_name = $request->first_name;
            $info->last_name = $request->last_name;
            $info->job = $request->job;
            $info->birth_date = $request->birth_date;
            $info->level = 1;
            $info->user()->associate($request->user());
            // $info->product()->associate($request->product_id);
            $info->save();
            return $info;
        }
    }


}

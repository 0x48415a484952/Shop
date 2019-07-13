<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PrivateUserResource;
use App\Http\Requests\Profile\StoreInformationRequest;

class ProfileStoreController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    public function action(StoreInformationRequest $request)
    {
        $user = $request->user();     
        User::where('id', $user->id)->update([
            'first_name' => $request->first_name, 
            'last_name' => $request->last_name,
            'job' => $request->job,
            'birth_date' => $request->birth_date
        ]);

        $user = $user->fresh();
        return new PrivateUserResource($user);
    }
}

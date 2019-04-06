<?php

namespace App\Http\Controllers\Cities;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Models\City;
use App\Models\Province;

class CityController extends Controller
{
    public function index()
    {
        return CityResource::collection(City::get());
    }

    public function show($id)
    {
        // $province = Province::findOrFail($id);
        return Province::with('city')->findOrFail($id)->city;
    }
}

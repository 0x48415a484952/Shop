<?php

namespace App\Http\Controllers\Cities;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Http\Resources\ProvinceResource;

class CityController extends Controller
{
    public function index()
    {
        return CityResource::collection(City::get());
    }

    public function show($id)
    {
        // $province = Province::findOrFail($id);
        return CityResource::collection(Province::with('city')->findOrFail($id)->city);
    }
}

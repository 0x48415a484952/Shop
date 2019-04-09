<?php

namespace App\Http\Controllers\Provinces;

use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Http\Resources\ProvinceResource;

class ProvinceController extends Controller
{
    public function index()
    {
        return ProvinceResource::collection(Province::get());
    }

    public function show($provinceId)
    {
        // $province = Province::findOrFail($id);
        return CityResource::collection(Province::with('city')->findOrFail($provinceId)->city);
    }
}

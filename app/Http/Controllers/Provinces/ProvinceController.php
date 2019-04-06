<?php

namespace App\Http\Controllers\Provinces;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProvinceResource;
use App\Models\Province;

class ProvinceController extends Controller
{
    public function index()
    {
        return ProvinceResource::collection(Province::get());
    }
}

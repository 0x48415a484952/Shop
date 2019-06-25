<?php

namespace App\Http\Controllers\Sliders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Http\Requests\Sliders\SliderStoreRequest;
use App\Http\Resources\SlidersIndexResource;

class SliderController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:api', 'role.authorization'])->except('index');
    }

    public function index()
    {
        return SlidersIndexResource::collection(Slider::all());
    }

    public function store(SliderStoreRequest $request)
    {
        $slider = new Slider;
        $slider->image = $request->image;
        $slider->title = $request->title;
        $slider->sort = $request->sort;
        $slider->save();
        return new SlidersIndexResource($slider);
    }

    public function destroy(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);
        $slider->delete();
        return response()->json(null, 204);
    }
}

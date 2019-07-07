<?php

namespace App\Http\Controllers\Sliders;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\SlidersIndexResource;
use App\Http\Requests\Sliders\SliderStoreRequest;
use App\Models\Category;

class SliderController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:api', 'role.authorization'])->except('index');
    }

    public function index()
    {
        return SlidersIndexResource::collection(Slider::all());
        // return SlidersIndexResource::collection(Slider::with('categories')->get());
    }

    public function store(SliderStoreRequest $request)
    {
        $slider = new Slider;
        $slider->title = $request->title;
        // $slider->category_id = $request->category_id;
        // $slider->sort = $request->sort;
        
        $category = Category::findOrFail($request->category_id);
        $slider->image = time().'.'.$request->image->getClientOriginalExtension();
        Storage::disk('local')->putFileAs('public', $request->image, $slider->image);
        // $slider->categories()->save($request->category_id);
        $category->sliders()->save($slider);
        // $slider->categories()->save($category);
        // $slider->save();
        
        return new SlidersIndexResource($slider);
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->delete();
        return response()->json(null, 200);
    }
}

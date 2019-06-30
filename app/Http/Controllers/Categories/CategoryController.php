<?php

namespace App\Http\Controllers\Categories;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Exception;
use Throwable;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\Categories\CategoryStoreRequest;

//use Illuminate\Support\Facades\Response;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware(['jwt.verify', 'role.authorization'], ['only' => ['create', 'store', 'edit', 'destroy']]);
        // Alternativly
        // $this->middleware(['jwt.verify', 'role.authorization'], ['except' => ['index', 'show']]);
    }


    public function index()
    {
        // return Category::all();
        return CategoryResource::collection(
            Category::with('children.children')->parents()->ordered()->get()
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request)
    {
            $category = new Category;
            $category->parent_id = $request->parent_id;
            $category->title = $request->title;
            $category->slug = $request->slug;
            $category->save();
            return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$this->makePath($id);
        return Category::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Category::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'parent_id' => ['required', 'numeric', 'digits:1'],
                'title' => ['required', 'string'],
                'slug' => ['required', 'string'],
            ]);
    
            if ($validator->fails()) {
                return response()->json(['status' => 'fail', 'message' => 'something went wrong', 'errors' => $validator->errors()], 422);
            }

            Category::where('id', $id)
                    ->update(['parent_id' => $request->parent_id, 'title' => $request->title, 'slug' => $request->slug]);
    
            return response()->json(['status' => 'success', 'message' => 'new category has been added to the list', 'result' => $category], 201);
        } catch (Throwable $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categories = Category::with('children.children')->where('id', $id)->get();
        $categories->each->delete();
        return response()->json(['status' => 'success', 'message' => 'category has been deleted'], 200);
    }

    public function makePath($id)
    {
        //dd('ok');
        try {
            $path = [];
            do {
                $category = Category::find($id);
                //dd($category->id);
                if (!$category->id) throw Exception();
                $path[] = $category;
                if ($category->parent_id == 0) return $path;
                $id = $category->parent_id;
            } while(true);
        } catch(Throwable $e) {
            return [];
        }
    }

    public function makeMegaMenu($id)
    {
        // try {
        //     $path = [];
        //     do {
        //         $category = Category::find($id);
        //         //dd($category->id);
        //         if (!$category->id) throw Exception();
        //         $path[] = $category;
        //         if ($category->parent_id == 0) return $path;
        //         $id = $category->parent_id;
        //     } while(true);
        // } catch(Throwable $e) {
        //     return [];
        // }
    }
}

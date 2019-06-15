<?php

namespace App\Http\Controllers\Comments;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Http\Requests\Comment\CommentStoreRequest;

class CommentController extends Controller
{
    public function index()
    {
        return Comment::get();
    }

    // public function store(Request $request, Product $product)
    // {
    //     // $product = $product->load('comments.product');
    //     $user = $request->user();
    //     // dd($request->user());
    //     // dd($product);

    //     $product->comments([
    //         'user_id' => $user->id,
    //         'title' => $request->title,
    //         'content' => $request->content
    //     ])->save();
    // }

    public function store(CommentStoreRequest $request)
    {
        if($request->user()) {
            $comment = new Comment;
            $comment->title = $request->title;
            $comment->content = $request->content;
            $comment->user()->associate($request->user());
            $comment->product()->associate($request->product_id);
            $comment->save();
            return response()->json('fine', 200);
        }

        // dd($request->user()->id);
        // $comment = new Comment;
        // $comment->title = $request->title;
        // $comment->content = $request->content;
        // $comment->user()->associate($request->user()->id);
        // $comment->product()->associate($request->product_id);
        // $comment->save();
        
        
        return response()->json(['errors' => ['message' => 'you should login first to be able to add comments', 'status' => '!login']], 422);
    }
}

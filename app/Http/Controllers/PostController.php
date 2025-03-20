<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PostController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', except: ['index', 'show'])
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Thread $thread)
    {
        return $thread->posts()->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Thread $thread)
    {
        $fields = $request->validate([
           'body' => 'required|string'
        ]);

        $post = $thread->posts()->create([
            'user_id' => $request->user()->id,
            'body' => $fields['body']
        ]);
        return ['post' => $post];
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return ['post' => $post];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $fields = $request->validate([
           'body' => 'required'
        ]);

        $post->update($fields);
        return ['post' => $post];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return ['message' => 'Post deleted successfully.'];
    }
}

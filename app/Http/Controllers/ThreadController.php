<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class ThreadController extends Controller implements HasMiddleware
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
    public function index()
    {
        $threads = Thread::with('posts')->get();
        return ['threads' => $threads];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
        ]);

        $thread = $request->user()->threads()->create($fields);

        return ['thread' => $thread, 'message' => 'Thread created successfully.'];
    }

    /**
     * Display the specified resource.
     */
    public function show(Thread $thread)
    {
        $thread->load('posts');
        return [
            'thread' => $thread
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Thread $thread)
    {
        Gate::authorize('modify', $thread);

        $fields = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
        ]);

        $thread->update($fields);

        return ['thread' => $thread, 'message' => 'Thread updated successfully.'];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Thread $thread)
    {
        Gate::authorize('modify', $thread);

        $thread->delete();

        return ['message' => 'Thread deleted successfully.'];
    }
}

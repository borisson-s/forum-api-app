<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Thread::all();
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

        $thread = Thread::create($fields);

        return ['thread' => $thread, 'message' => 'Thread created successfully.'];
    }

    /**
     * Display the specified resource.
     */
    public function show(Thread $thread)
    {
        return [
            'thread' => $thread
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Thread $thread)
    {
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
        $thread->delete();

        return ['message' => 'Thread deleted successfully.'];
    }
}

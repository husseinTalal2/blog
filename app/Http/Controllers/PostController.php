<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(Post::class, 'post');
    // }
    public function show(Post $post)
    {
        $post->load('comments.user'); // Eager load the post's comments with their associated users

        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $post = auth()->user()->posts()->create($validatedData);

        return $post->__get("id");
    }

    public function edit(Post $post)
    {
        // Authorize that the authenticated user is the owner of the post
        $this->authorize('update', $post);
        
        return view('posts.edit', compact('post'));
    }
    public function update(Request $request, Post $post)
    {
        // Authorize that the authenticated user is the owner of the post
        $this->authorize('update', $post);
        
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);
    
        $post->update($validatedData);
    
        return $post->__get("id");
    }
    
    public function destroy(Request $request, Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully'], Response::HTTP_OK);
    }

}

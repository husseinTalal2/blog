<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Post;
use App\Models\Comment;
class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'body' => 'required',
        ]);

        $comment = new Comment();
        $comment->body = $validatedData['body'];
        $comment->post_id = $post->id;
        $comment->user_id = auth()->user()->id; // Add user ID
        $comment->save();

        return response()->json(['message' => 'Comment created successfully', 'comment' => $comment], Response::HTTP_CREATED);
    }

    public function update(Request $request, Post $post, Comment $comment)
    {

        $validatedData = $request->validate([
            'body' => 'required',
        ]);

        $comment->update($validatedData);

        return response()->json(['message' => 'Comment updated successfully', 'comment' => $comment], Response::HTTP_OK);
    }

    public function destroy(Post $post, Comment $comment)
    {

        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully'], Response::HTTP_OK);
    }
}

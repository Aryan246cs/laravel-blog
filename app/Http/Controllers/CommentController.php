<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
{
    $request->validate([
        'body' => 'required'
    ]);

    Comment::create([
        'user_id' => auth()->id(),
        'post_id' => $postId,
        'body' => $request->body
    ]);

    return back();
}


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    public function store($postId)
    {
        $like = Like::where('post_id', $postId)->where('user_id', auth()->id())->first();

        if ($like) {
            $like->delete(); // toggle like
        } else {
            Like::create([
                'user_id' => auth()->id(),
                'post_id' => $postId
            ]);
        }

        return back();
    }


}

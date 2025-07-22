<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class insightController extends Controller
{
    public function index()
    {
        $users = User::withCount('usersCoolPosts')
            ->with([
                'usersCoolPosts' => function ($query) {
                    $query->withCount('likes');
                }
            ])
            ->get();

        return view('website-insight', compact('users'));
    }


}

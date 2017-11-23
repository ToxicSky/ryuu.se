<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Tag;

class TagController extends Controller
{
    public function mostUsed()
    {
        $tags = Tag::withCount(
            'posts'
        )->orderBy(
            'posts_count', 'desc'
        )->limit(10)->get();

        return response()->json($tags);
    }
}

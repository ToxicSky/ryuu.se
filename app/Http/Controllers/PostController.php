<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    /**
     * @var string
     */
    const POST_NOT_FOUND_VIEW = 'posts.not_found';

    /**
     * @param Request $request
     * @param int $id
     */
    public function view(Request $request, int $id)
    {
        $post = null;
        try {
            $post = Post::where('id', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return view(self::POST_NOT_FOUND_VIEW);
        }

        return view('posts.view', [
            'post' => $post,
        ]);
    }

    /**
     * @param Request $request
     */
    public function create(Request $request)
    {
        try {
            $post = new Post;
            $post->fill($request->input());
            $post->save();

            $url = sprintf('/posts/%d', $post->id);
            return redirect($url);
        } catch (Exception $e) {
            Log::error($e);
            return redirect('home');
        }
    }

    public function update(Request $request, int $id)
    {
        try {
            $post = Post::where('id', $id)->firstOrFail();
            $post->fill($request->input());
            $post->save();
        } catch (Exception $e) {
            Log::error($e);
        }

        $url = sprintf('/posts/%s', $id);
        return redirect($url)
    }

    /**
     * @param Request $request
     * @param int $id
     */
    public function delete(Request $request, int $id)
    {
        try {
            Post::destroy($id);
        } catch (Exception $e) {
            Log::error($e);
        } finally {
            return redirect('home');
        }
    }
}

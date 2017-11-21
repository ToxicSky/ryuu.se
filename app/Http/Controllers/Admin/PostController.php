<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::get();

        return view('admin.posts.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        $tags       = Tag::get();

        return view('admin.posts.create', [
            'categories' => $categories,
            'tags'       => $tags,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $route = route('admin.posts.index');

        try {
            $post = new Post;
            $data = $request->validate($post->validationRules());

            $tags = $request->input('new_tags') ?? '';
            $tags = (new Tag)->createFromStr($tags);
            if ($request->input('tags')) {
                $tags = array_merge($tags, $request->input('tags'));
            }

            $insert = [
                'title'       => $data['title'],
                'body'        => $data['body'],
                'category_id' => $data['category'],
            ];

            $post->fill($insert);
            $post->save();
            $post->tags()->sync($tags);

            Session::forget('archive');

            $route = route('admin.posts.show', ['post' => $post->id]);
        } catch (Exception $e) {
            Log::error($e);
        } finally {
            return redirect($route);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.view', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::get();
        $tags       = Tag::get();

        return view('admin.posts.update', [
            'post'       => $post,
            'categories' => $categories,
            'tags'       => $tags,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate($post->validationRules(true));
        $tags = $request->input('tags') ?? [];

        $insert = [
            'title'       => $data['title'],
            'body'        => $data['body'],
            'category_id' => $data['category'],
        ];

        $post->fill($insert);
        $post->tags()->sync($tags);
        $post->save();

        $url = route('admin.posts.edit', ['post' => $post->id]);
        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Add\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($post)
    {
        try {
            $post->delete();
        } catch (Exception $e) {
            Log::error($e);
        } finally {
            return redirect(route('admin.posts.index'));
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;

class PostController extends Controller
{
    /**
     * @var array Contains rules for post-forms.
     */
    private $rules = [
        'title'    => 'required|max:191|unique:posts',
        'body'     => 'required|min:10',
        'category' => 'required|min:1',
    ];

    public function __construct()
    {
        $this->middleware('auth')->except(
            'index', 'show'
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::get();
        return view('posts.index', [
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

        return view('posts.create', [
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
        $route = route('posts');
        try {

            $validator = Validator::make($request->all(), $this->rules);

            if ($validator->fails()) {
                return redirect('posts.create')
                    ->withErrors($validator)
                    ->withInput();
            }

            $data = [
                'title'       => $request->input('title'),
                'body'        => $request->input('body'),
                'category_id' => $request->input('category'),
            ];

            $tags = (new Tag)->createFromStr($request->input('new_tags'));

            if ($request->input('tags')) {
                $tags = array_merge($tags, $request->input('tags'));
            }

            $post = new Post($data);
            $post->save();
            $post->tags()->sync($tags);

            $route = route('posts.show', ['id' => $post->id]);
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
        return view('posts.view', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.update', [
            'post' => $post,
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
        $post->fill($request->input());
        $post->save();

        $url = url('posts', [$post->id]);
        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        try {
            $post->delete();
        } catch (Exception $e) {
            Log::error($e);
        } finally {
            return redirect(route('admin.posts'));
        }
    }
}

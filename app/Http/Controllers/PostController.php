<?php
/**
 * Created by PhpStorm.
 * User: Next
 * Date: 2018/3/14
 * Time: 22:56
 */

namespace App\Http\Controllers;


use App\Post;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(6);
        return view('post/index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('post/show', compact('post'));
    }

    public function create()
    {
        return view('post/create');
    }

    public function store()
    {
        $post = Post::create(request(['title', 'content']));
        return redirect('/posts');
    }

    public function delete()
    {
    }

    public function edit()
    {
        return view('post/edit');
    }

    public function update()
    {
    }
}
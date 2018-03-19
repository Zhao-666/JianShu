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
        $this->validate(request(), [
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10'
        ], [
            'title.min' => '文章标题过短'
        ]);
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

    public function image_upload()
    {
        $path = request()->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/' . $path);
    }
}
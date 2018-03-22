<?php
/**
 * Created by PhpStorm.
 * User: Next
 * Date: 2018/3/14
 * Time: 22:56
 */

namespace App\Http\Controllers;


use App\Comment;
use App\Post;
use App\Zan;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->withCount(['comments','zans'])->paginate(6);
        return view('post/index', compact('posts'));
    }

    public function show(Post $post)
    {
        $post->load('comments');
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
        ]);

        $user_id = Auth::id();
        $params = array_merge(request(['title', 'content']), compact('user_id'));
        Post::create($params);
        return redirect('/posts');
    }

    public function delete(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect('/posts');
    }

    public function edit(Post $post)
    {
        return view('post/edit', compact('post'));
    }

    public function update(Post $post)
    {
        $this->validate(request(), [
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10'
        ]);

        $this->authorize('update', $post);

        $post->title = request('title');
        $post->content = request('content');
        $post->save();
        return redirect("/posts/$post->id");
    }

    public function image_upload()
    {
        $path = request()->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/' . $path);
    }

    public function comment(Post $post)
    {
        $this->validate(request(), [
            'content' => 'required|min:3'
        ]);
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->content = request('content');
        $post->comments()->save($comment);

        return back();
    }

    public function zan(Post $post)
    {
        $param = [
            'user_id' => Auth::id(),
            'post_id' => $post->id
        ];
        Zan::firstOrCreate($param);
        return back();
    }

    public function unzan(Post $post)
    {
        $post->zan(Auth::id())->delete();
        return back();
    }
}
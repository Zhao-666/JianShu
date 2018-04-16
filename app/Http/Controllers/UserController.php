<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function setting()
    {
        return view('user.setting');
    }

    public function settingStore()
    {

    }

    public function show(User $user)
    {
        $user = User::withCount(['stars', 'fans', 'posts'])->find($user->id);

        $posts = $user->posts()->orderBy('created_at', 'desc')->take(10)->get();

        $stars = $user->stars;
        $suser = User::whereIn('id', $stars->pluck('star_id'))->withCount(['stars', 'fans', 'posts'])->get();

        $fans = $user->fans;
        $fuser = User::whereIn('id', $fans->pluck('fan_id'))->withCount(['stars', 'fans', 'posts'])->get();

        return view('user.show', compact('user', 'posts', 'suser', 'fuser'));
    }

    public function fan(User $user)
    {
        $me = Auth::user();
        $me->doFan($user->id);

        return [
            'error' => 0,
            'msg' => ''
        ];
    }

    public function unfan(User $user)
    {
        $me = Auth::user();
        $me->doUnfan($user->id);
        return [
            'error' => 0,
            'msg' => ''
        ];
    }
}

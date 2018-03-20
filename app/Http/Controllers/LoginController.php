<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function login()
    {
        //验证
        $this->validate(request(), [
            'email' => 'required|email',
            'password' => 'required|min:5|max:10',
            'is_remember' => 'integer'
        ]);
        //逻辑
        $user = request(['email', 'password']);
        $isRemember = (bool)request('is_remember');
        if (Auth::attempt($user, $isRemember)) {
            return redirect('/posts');
        }

        //渲染
        return Redirect::back()->withErrors('邮箱密码不匹配');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}

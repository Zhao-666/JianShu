<?php
/**
 * Created by PhpStorm.
 * User: Next
 * Date: 2018/3/14
 * Time: 22:56
 */

namespace App\Http\Controllers;


class PostController extends Controller
{

    public function index()
    {
        return view('post/index');
    }

    public function show()
    {
        return view('post/show');
    }

    public function create()
    {
        return view('post/create');
    }

    public function store()
    {
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
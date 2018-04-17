<?php

namespace App\Http\Controllers;

use App\Topic;

class TopicController extends Controller
{
    public function show(Topic $topic)
    {
        return view('topic/show');
    }

    public function submit(Topic $topic)
    {
        return;
    }
}

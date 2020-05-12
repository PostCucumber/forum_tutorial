<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Thread;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($channelID, Thread $thread)
    {
        // dd(request()->all());
        $thread->addReply([
            'thread_id' => request('thread_id'),
            'user_id' => request('user_id'),    
            'body' => request('body'),
        ]);

        return back();
    }
}

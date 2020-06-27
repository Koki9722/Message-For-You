<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BoardList;
use App\Post;
use Illuminate\Support\Facades\Auth;

class ShareController extends Controller
{
    public function update($board_id)
    {
        $judge = Post::where('id', $board_id)->first();
        $judge->sharejudge = 1;
        $judge->save();
        return redirect('share/'.$board_id);
    }

    public function show(Post $post)
    {
        if($post->sharejudge == 1) {
            // $messages = BoardList::where('board_id', $board_id)
            //     ->orderBy('post_number', 'asc')->get();
            $messages = $post->boardlist;

            if (isset($messages)) {
                return view('share', ['messages' => $messages, 'title' => $post->board_title]);
            } else {
                return redirect()->route('home');
            }
        } else {
            $messages = "";
            return view('share', ['messages' => $messages, 'post' => $post]);
        }

    }
}

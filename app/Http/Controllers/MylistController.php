<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;

class MylistController extends Controller
{
    // マイリストにメッセージボードを渡す
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $query = Post::query();

        if (!empty($keyword)) {
            $query->where('user_id', Auth::id())->where('id', 'like', '%'.$keyword.'%')->orWhere('board_title', 'like', '%'.$keyword.'%');
        }

        $posts = $query->where('user_id', Auth::id())->orderBy('id', 'desc')->paginate(10);
            return view('mylist')->with('posts', $posts)->with('keyword', $keyword);
    }

}


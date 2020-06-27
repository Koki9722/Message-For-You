<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\React;

class AllListsController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $query = Post::query();
        
        if (!empty($keyword)) {
            $query->where('id', 'like', '%'.$keyword.'%')->orWhere('board_title', 'like', '%'.$keyword.'%');
        }

        // ページネーション
        $posts = $query->orderBy('id', 'desc')->paginate(10);
        // return view('list', ['posts' => $posts]);
        return view('list')->with('posts', $posts)->with('keyword', $keyword);
    }
}

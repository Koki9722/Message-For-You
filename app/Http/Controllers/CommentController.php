<?php

namespace App\Http\Controllers;

use App\BoardList;
use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function show(BoardList $post_number) 
    {
        $post = $post_number;
        if ($post) {
            return view('reply.show', ['post' => $post]);
        } 
    }

    public function store(Request $request) 
    {
        $params = $request->validate([
            'post_id' => 'required|exists:board_lists,post_number',
            'body' => 'required|max:20000',
        ]);

        $post = BoardList::where('post_number', $params['post_id'])->first();
        $post->comment()->create($params);

        return back()->with('my_status', __('返信を追加しました。'));
        // return redirect()->route('reply.show', ['post' => $post])->with('my_status', __('コメントを追加しました。'));
    }

    public function update(Request $request) 
    {
        $params = $request->validate([
            'post_id' => 'required|exists:board_lists,post_number',
            'body' => 'required|max:20000',
        ]);

        $post = BoardList::where('post_number', $params['post_id'])->first();
        $post->comment()->update(['body' => $params['body']]);

        return back()->with('my_status', __('返信を編集しました。'));
    }

    public function destroy($post_number) 
    {
        Comment::where('post_id', $post_number)->delete();
        return back()->with('my_status', __('返信を削除しました。'));
    }
}

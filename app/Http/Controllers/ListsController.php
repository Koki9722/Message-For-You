<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BoardList;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ListsController extends Controller
{
    public function store(Request $request)
    //メッセージの追加
    {
        $board_id = $request->board_id;
        $post_lists = $request->validate([
            'board_text' => 'required|max:100',
            'nickname' => 'required|max:20',
        ]);

        BoardList::create([
            'board_id' => $board_id,
            'id' => Auth::id(),
            'board_text' => $post_lists['board_text'],
            'nickname' => $post_lists['nickname'],
        ]);

        return redirect('new/'.$board_id)->with('my_status', __('投稿を追加しました。'));
    }

    public function show(Post $post)
    //メッセージの表示
    {
        // $post = Post::where('id', $board_id)->first();
        $board_id = $post->id;
        $permission = User::where('id', Auth::id())->first();
        if (Auth::id() == $post->user_id || $permission->permission_id == $board_id || $post->board_password === null) {
            // $messages = BoardList::where('board_id', $board_id)
            //     ->orderBy('post_number', 'asc')->get();

            $messages = $post->boardlist;
            $my_message = "";

            // 自分のメッセージを取得
            foreach ($messages as $message) {
                if ($message->id == Auth::id()) {
                    $my_message = $message;
                    break;
                } 
            }

            if ($my_message !== "") {
                $post_judge = 1;
            } else {
                $post_judge = 0;
            };

            $now_number = $messages->count();

            if (isset($messages)) {
                return view('new',
                    ['messages' => $messages,
                    'post' => $post,
                    'now_number' => $now_number,
                    'post_judge' => $post_judge,
                    'my_message' => $my_message,]
            );} else {
                return redirect()->route('home');
            }
        } else {
            return view('password', ['post' => $post]);
        }
    }

    public function match(Post $post, Request $request)
    {
        if (Hash::check($request->password, $post->board_password)) {
            $permission = User::where('id', Auth::id())->first();
            $permission->permission_id = $post->id;
            $permission->save();
            return redirect('new/'. $post->id);
        } else {
            return back();
        }
    }

    public function update($post_number, Request $request)
    {
        //編集機能
        $board_update = $request->validate([
            'board_text' => 'required|max:100',
            'nickname' => 'required|max:10',
        ]);

        BoardList::where('post_number', $post_number)->update(['board_text'=> $board_update['board_text'], 'nickname' => $board_update['nickname']]);

        return back()->with('my_status', __('投稿を編集しました。'));
    }

    public function destroy($post_number)
    {
        //削除機能
        BoardList::where('post_number', $post_number)->delete();
        return back()->with('my_status', __('投稿を削除しました。'));
    }
}

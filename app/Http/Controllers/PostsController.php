<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Hash;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function store(Request $request)
    {
        // 新しいメッセージボードの作成
        // バリデーション
        $board_post = $request->validate([
            'board_title' => 'required|max:32' ,
            'min_number' => ['required', 'numeric'],
            'max_number' => 'required|numeric|gt:min_number',
        ]);

        $board_password = $request['board_password'];
        if (!($board_password === null)) {
            $board_password = Hash::make($board_password);
        } else {
            $board_password = null;
        }
            
        // データベースに保存
        $data = Post::create([
            'board_title' => $board_post['board_title'],
            'board_password' => $board_password,
            'min_number' => $board_post['min_number'],
            'max_number' => $board_post['max_number'],
            'user_id' => Auth::id(),
            'sharejudge' => 0,
            'about' => "",
            ]);
        
        // 作成したページに飛ぶ
        $last_insert_id = $data->id;
        return redirect('new/'.$last_insert_id)->with('my_status', __('新規メッセージを作成しました。'));
    }

    public function update($id, Request $request)
    {
        $about = $request->about;
        $query = Post::query();
        //編集機能
        if ($about) {
            $query->where('id', $id)->update(['about' => $about]);

            return redirect('new/'.$id)->with('my_status', __('募集概要を変更しました。'));
            
        } else {
            $post_update = $request->validate([
                'board_title' => 'required|max:32',
            ]);

            $query->where('id', $id)->update(['board_title'=> $post_update['board_title']]);

            return redirect('new/'.$id)->with('my_status', __('タイトルを変更しました。'));
        }
    }

    public function destroy($id)
    {
        Post::where('id', $id)->delete();
        return back()->with('my_status', __('投稿を削除しました。'));
    }

}

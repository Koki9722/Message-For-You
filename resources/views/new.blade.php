@extends('layouts.app')

@section('content')
    <div class="board-post-wrapper">
        <h1>id：{{ $post->id }}&#9タイトル：{{ $post->board_title}}</h1>
        <p id="user-name">募集者名：{{$post->user->name}}</p>
        @if ($post->user_id === Auth::id())
            <button class="btn title-change-click" onclick="clickBtn1();">タイトルを変更する</button>
            <form id="changeBtn" class="board_title-form" method="POST" action="{{ route('posts.update', $post->id) }}">
                @csrf
                @method('PUT')
                <div>
                    <input class="board_title_new {{ $errors->has('board_title') ? 'is-invalid' : '' }}" type="text" 
                    name="board_title" placeholder="タイトル" value="{{ old('board_title') ?: $post->board_title }}">
                        @if ($errors->has('board_title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('board_title') }}
                                </div>
                        @endif
                    <div>
                            <button class="btn title-change-btn">変更</button>
                    </div>
                </div>
            </form>
        @endif
        <article>
            <section>
                <h1 class="message-about">募集概要</h1>
                <p id = "about-main">{{ $post->about }}</p>
                @if ($post->user_id === Auth::id())
                    <form method="POST" action="{{ route('posts.update', $post->id) }}">
                        @csrf
                        @method('PUT')
                        <textarea id="about-textarea" placeholder="募集条件やルールなどを記入してください。"
                        name="about">{{ old('about') ?: $post->about }}</textarea>
                        <div id="about-close-style">
                            <p class="about-close" onclick="ChangeAboutClose()">閉じる</p>
                        </div>
                        <button id="about-ok" type="submit">決定</button>
                    </form>
                    <button id="about-change" type="button" onclick="ChangeAboutForm();">編集</button>
                @endif
            </section>
        </article>
    </div>
    @if ($post_judge == 0 && $post->max_number-$now_number > 0)
    <h1 class="heading1">新規投稿</h1>
    @elseif ($post_judge == 1)
    <h1 class="heading1">投稿を編集する</h1>
    @endif
    <!-- 新規メッセージフォーム -->
    <div class="contents-main-wrapper">
    @if ($post_judge == 0  && $post->max_number-$now_number > 0)
        <form class="new-form" method="POST" action="{{ route('lists.store') }}">
        @csrf
            ニックネーム：
            <input id="nickname" class="  {{ $errors->has('nickname') ? 'is-invalid' : '' }}" type="text" 
            name="nickname"  onkeyup="NameLength(value, 'word-count1');">
            <p id="word-count1">0文字</p>
            @if ($errors->has('nickname'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nickname') }}
                    </div>
            @endif
            <input type="hidden" name="board_id" value="{{ $post->id }}">
            <textarea id="textLimited" class="new-text {{ $errors->has('board_text') ? 'is-invalid' : '' }}" type="text" 
                name="board_text" placeholder="メッセージを入力してください" 
                onkeyup="TextLength(value,'word-count2');">{{ old('board_text') }}</textarea>
            @if ($errors->has('board_text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('board_text') }}
                    </div>
            @endif
            <p id="word-count2">0文字</p>
            <div class="new-submit-div">
                <button class="new-submit btn-green" type="submit">追加</button>
            </div>
            <p id="line-error">5行以内で入力してください。</p>
        </form>
    @elseif ($post_judge == 1)
        <!-- 更新ボタン -->
        <form class="new-form new-form-posting" method="POST" action="{{ route('lists.update', $my_message->post_number) }}">
        @csrf
        @method('PUT')
            ニックネーム：
            <input id="nickname" class="{{ $errors->has('nickname') ? 'is-invalid' : '' }}" type="text"
                name="nickname" placeholder="ニックネーム" value="{{ old('nickname') ?: $my_message->nickname }}" onkeyup="NameLength(value, 'word-count1');">
            <p id="word-count1">0文字</p>
            @if ($errors->has('nickname'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nickname') }}
                    </div>
            @endif
            <textarea id="textLimited" class="new-text {{ $errors->has('board_text') ? 'is-invalid' : '' }}" type="text" 
                name="board_text" onkeyup="TextLength(value,'word-count2');">{{ old('board_text') ?: $my_message->board_text }}</textarea>
            @if ($errors->has('board_text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('board_text') }}
                    </div>
            @endif
            <p id="word-count2">0文字</p>
            <div class="new-submit-div">
                <button class="new-submit btn-green" type="submit">編集</button>
            </div>
            <p id="line-error">5行以内で入力してください。</p>
        </form>
        <!-- 削除ボタン -->
        <div class="delete-btn-wrapper">
            <form method="POST" action="{{ route('lists.destroy', $my_message->post_number) }}">
            @csrf
            @method('DELETE')
            <div class="btn-danger-wrapper">
                <button class="btn btn-danger">削除する</button>
            </div>
            </form>
        </div>
    @endif
    </div>

    <!-- 投稿一覧を表示-->
    <div class="post-lists-preview">
    @if ($post->min_number - $now_number <= 0)
        <h3 class="number-left" class="{{$share_judge = 1}}">完成！</h3>
        @if ($post->user_id == Auth::id())
            <form method="POST" action="{{ route('share.update', $post->id) }}" class="share-form">
                @csrf
                @method('PUT')
                <div class="share-btn-group">
                <button class="btn posts-share-btn">共有ページを作成する</button>
                <span id="explain-share" onclick="explainShowBtn();" onmouseenter="explainShow();" onmouseleave="explainHide();">?</span>
                <p id="explain" class="explain-hide">共有ページが作成されると、ユーザー登録をしていない人でも全てのメッセージが見られるようになります。</p>
                </div>
            </form>
        @endif
    @else
        <h3 class="number-left">残り{{$post->min_number - $now_number }}人で完成！</h3>
    @endif
    </div>
    <div class="post-stock-wrapper container">
        <div class="post-stock-content row">
            @if (isset($messages))
                @foreach ($messages as $message)
                <div class="post-stock col-md-4 mb-5 col-sm-6" id="user-{{ $message['id'] }}">
                    <div class="box">
                        <div class="post-text">{{ $message->board_text}}</div>
                        <div class="post-nickname">{{$message->nickname}}</div>
                    </div>
                    @if ($post->user_id === Auth::id())
                        <div class="link-width">
                            <a class="link" href="http://localhost:8000/reply/{{$message->post_number}}">返信する</a>
                        </div>
                    @endif
                    @if($message->comment)
                    <div class="reply-width-right">
                        <a href="http://localhost:8000/reply/{{$message->post_number}}" class="reply">返信済み</a>
                    </div>
                    @endif
                </div>
                @endforeach
            @endif
        </div>
    </div>
    <div id="limit-number-width">
            <span class="limit-number-color"></span>
            <span class="limit-number-text">締め切りまであと{{$post->max_number - $now_number}}人</span>
    </div>
    
    <link rel="stylesheet" href="{{asset('css/new.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script src="{{ asset('js/new.js') }}"></script>
@endsection
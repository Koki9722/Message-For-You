<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
    
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <a href="http://localhost:8000/home">Message For You</a>
        @if ($messages != "")
        <!-- アラートの表示 -->
        <div id="alert-copy"></div>
        <!-- タイトルの表示 -->
        <h2 class="board_title">{{$title}}</h2>
        <!-- ポストの表示 -->
        <div class="post-lists"></div>
        <div class="post-stock-wrapper container">
            <div class="post-stock-content row">
                @if (isset($messages))
                    @foreach ($messages as $message)
                        <div class="post-stock col-md-4 mb-5 col-sm-6" id="user-{{ $message['id'] }}">
                            <div class="box">
                                <div class="post-text">{{ $message->board_text}}</div>
                                <div class="post-nickname">{{$message->nickname}}</div>
                                
                            </div>
                            @if($message->comment)
                                <div class="reply-show-width">
                                    <button class="reply-show-btn reply-hide">返信があります。</button>
                                </div>
                                <div class="post-reply-group">
                                    <p class="post-reply">{{$message->comment->body}}</p>
                                    <div class="post-reply-width">
                                        <p class="post-reply-close">閉じる</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <input id="url" value="{{ url()->current() }}">
        <button type="button" id="copy-btn">URLをコピーする</button>
        <script src="{{ asset('js/app.js') }}" defer></script>
        @else
            <h2 class="board_title">共有ページが未作成です</h2>
            <div class="share-complete">
                下記ページを完成させましょう。<br>
                タイトル：<a href="../new/{{$post->id}}">{{$post->board_title}}</a>
            </div>
        @endif
        <link rel="stylesheet" href="{{ asset('css/new.css') }}">
        <link rel="stylesheet" href="{{ asset('css/share.css') }}">
        <script src="{{ asset('js/share.js') }}"></script>
    </body>
</html>
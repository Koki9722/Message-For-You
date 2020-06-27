@extends('layouts.app')

@section('content')
    <h1 class="heading1">メッセージ内容</h1>
    <p class="message-detail">{{$post->board_text}}</p>
    @if ($post->post->user_id === Auth::id())
        <h1 class="heading1">返信</h1>
        @if (!$post->comment)
            <div id="reply-wrapper-post">
                <form class="reply-form" method="POST" action="{{ route('reply.store') }}">

                @csrf

                    <input name="post_id" type="hidden" value="{{$post->post_number}}">
                    <textarea class="reply-text {{ $errors->has('body') ? 'is-invalid' : '' }}" name="body">{{ old('body')}}</textarea>
                    @if ($errors->has('body'))
                        <div class="invalid-feedback">
                            {{ $errors->first('body') }}
                        </div>
                    @endif

                    <div class="reply-submit-div">
                        <button class="reply-submit" type="submit">返信する</button>
                    </div>
                </form>
            </div>
        @else
            <div id="reply-wrapper-update">
                <form class="reply-form" method="POST" action="{{ route('reply.update', $post->post_number) }}">
                @method('PUT')
            
                    @csrf

                    <input name="post_id" type="hidden" value="{{$post->post_number}}">
                    <textarea class="reply-text {{ $errors->has('body') ? 'is-invalid' : '' }}" name="body">{{ old('body') ?: $post->comment->body }}</textarea>
                    @if ($errors->has('body'))
                        <div class="invalid-feedback">
                            {{ $errors->first('body') }}
                        </div>
                    @endif

                    <div class="reply-submit-div">
                        <button class="reply-submit" type="submit">編集する</button>
                    </div>
                </form>
                <div class="delete-btn-wrapper">
                <form method="POST" action="{{ route('reply.destroy', $post->post_number) }}">
                @csrf
                @method('DELETE')
                <div class="btn-danger-wrapper">
                    <button class="btn btn-danger">削除する</button>
                </div>
                </form>
            </div>
        @endif
    @endif
    <h1 class="heading1">返信内容</h1>
    @if ($post->comment)
    <div class="reply-detail">
        {{$post->comment->body}}
    </div>
    @endif
    <div id="back">
        <button id="back-btn" onclick="location.href='http://localhost:8000/new/{{$post->board_id}}'">戻る</button>
    </div>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/new.css') }}">
    <link rel="stylesheet" href="{{ asset('css/reply.css') }}">
@endsection
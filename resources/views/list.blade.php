@extends('layouts.app')

@section('content')
    <div class="search-form-wrapper">
        <form class="search-form" action="{{ url('/list') }}">
            <div class="search-form-group">
                <input class="search-keyword" type="text" name="keyword" value="{{ $keyword }}" placeholder="id or title">
            </div>
            <button class="btn search-btn" type="submit"><span></span></button>
        </form>
    </div>
    <h1 class="heading1">リスト</h1>
    <p id="mark-explain">*マークのページにはパスワードが設定されています。</p>
    <div class="link-wrapper">
        @foreach ($posts as $post)
            <div class="link-list">
                <div class="link-id-title">
                    <div class="list-id">id：{{ $post->id }}</div>
                    <div class="list-title">
                        <p>タイトル：{{ $post->board_title}}</p>
                        @if (!($post->board_password === null))
                    <span id="password-have">*</span>
                @endif
                    </div>
                </div>
                <div class="link-space">
                    <button class="btn new-link-btn" onclick="location.href='new/{{$post->id}}'">
                        ページを開く
                    </button>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mb-5 mt-5">
        {{ $posts->links('vendor/pagination/original_pagination') }}
    </div>
    <link rel="stylesheet" href="{{ asset('css/mylist.css') }}">
@endsection
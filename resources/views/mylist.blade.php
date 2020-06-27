@extends('layouts.app')

@section('content')
    <div class="search-form-wrapper">
        <form class="search-form" action="{{ url('/mylist') }}">
            <div class="search-form-group">
                <input class="search-keyword" type="text" name="keyword" value="{{ $keyword }}" placeholder="id or title">
            </div>
            <button class="btn search-btn" type="submit"><span></span></button>
        </form>
    </div>
    <h1 class="heading1">{{ Auth::user()->name }}さんの作成履歴</h1>
    <div class="link-wrapper">
        @foreach ($posts as $post)
            <div class="link-list">
                <p>id：{{ $post->id }}&#9タイトル：{{ $post->board_title}}</p>
                <div class="link-space">
                    <button class="btn new-link-btn" onclick="location.href='new/{{$post->id}}'">
                        編集ページ
                    </button>
                    <button class="btn share-link-btn"  onclick="location.href='share/{{$post->id}}'">
                        共有ページ
                    </button>
                    <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
                        @csrf
                        @method('DELETE')
                            <button class="btn delete-btn">削除</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mb-5 mt-5">
        {{ $posts->links('vendor/pagination/original_pagination') }}
    </div>
    <link rel="stylesheet" href="{{asset('css/mylist.css')}}">
@endsection
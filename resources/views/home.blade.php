@extends('layouts.app')

@section('content')
    <h1 class="heading1">○ ようこそ{{ Auth::user()->name }}さん</h1>
    <div class="new-message-wrapper main-wrapper">
                <button id="openModal" type="button" class="new-message-button modal-show"
                onclick="clickOpen();">メッセージを募集する</button>
    </div>
    <div class="message-history-wrapper main-wrapper">
                <button type="button" class="message-history-button" onclick="location.href='mylist'">
                    作成履歴
                </button>
    </div>
    <div id="newMask" class="modal-wrapper hidden" onclick="clickMask();"></div>
    <div id="newModal" class="modal-content hidden">
            <i id="closeModal" class="fas fa-times" onclick="clickClose();"></i>
            <h2 class="new-message-header">募集用ページを作成</h2>
            <form class="modal-form" method="POST" action="{{ route('posts.store') }}">
                @csrf

                <input class="new-message-title form-control {{ $errors->has('board_title') ? 'is-invalid' : '' }}"
                value ="{{ old('board_title') }}" placeholder="タイトル" type="text" name="board_title">
                @if ($errors->has('board_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('board_title') }}
                    </div>
                @endif
                <input class="new-message-password form-control" placeholder="パスワード" type="password" name="board_password">
                @if ($errors->has('board_password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('board_password') }}
                    </div>
                @endif
                <div class="message-num">
                    <input class="min-message-num form-control {{ $errors->has('min_number') ? 'is-invalid' : '' }}" 
                    placeholder="最低募集人数" type="number" name="min_number">
                    <input class="max-message-num form-control {{ $errors->has('max_number') ? 'is-invalid' : '' }}" 
                    placeholder="最大募集人数" type="number" name="max_number">
                </div>
                @if ($errors->has('min_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('min_number') }}
                    </div>
                @endif
                @if ($errors->has('max_number'))
                <div class="invalid-feedback">
                    {{ $errors->first('max_number') }}
                </div>
                @endif
                <div class="new-message-submit">
                    <button type="submit" class="message-submit-btn">作成する</button>
                </div>
            </form>
    </div>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
@endsection

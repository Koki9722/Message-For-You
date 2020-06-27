@extends('layouts.app')

@section('content')
    <form method="POST" action="{{$post->id}}" id="page-password-form">
        @csrf
        <p>パスワードを入力してください。</p>
        <input type="password" name="password">
        <button type="submit" class="input-submit">送信する</button>
    </form>
    <link rel="stylesheet" href="{{ asset('css/password.css') }}">
@endsection
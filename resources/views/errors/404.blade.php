@extends('layouts.app')

@section('content')
    <h1 class="heading1">お探しのページは見つかりませんでした。</h1>
    <div class="a-width">
        <a class="error-redirect" href="{{ route('home') }}">ホームへ戻る</a>
    </div>
    <link rel="stylesheet" href="{{asset('css/error.css')}}">
@endsection
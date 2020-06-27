
@extends('layout')

@section('content')
    <div class="top-content">
        <div class="top-image"></div>
            <header>
                <div class="header-wrapper">
                    <div class="header-left">
                        <a class="header-title" href="">
                            Message For You
                        </a>
                    </div>
                    <nav>
                        <ul class="header-right">
                            <li><a class="list new-button" href="register">新規登録</a></li>
                            <li><a class="login list" href="login">ログイン</a></li>
                        </ul>
                    </nav>
                </div>
            </header>
            <div class="alert-position-adjustment">
                <div class="alert-wrapper">
                    @if (session('my_status'))
                        <div class="alert alert-success">
                            {{ session('my_status')}}
                        </div>
                    @endif
                </div>
            </div>
            <div class="service-discription-wrapper">
                <div class="service-title">
                    <h1 class="title-thanks-letter">Message For You</h1>
                </div>
                <div class="service-discription">
                    Message For Youは、メッセージを募集するアプリです。
                    <br>
                    お世話になった・応援している・誕生日の人などにメッセージを送れます。
                    <br>
                    また、質問の募集用ページとして利用することもできます。
                </div>
                <div class="new-button">
                    <button class="register-button" type="button" onclick="location.href='register'">
                        新規登録はこちら
                    </button>
                </div>
            </div>
    </div>
        
        <div class="main-discription"></div>
        <div class="regist"></div>
        <footer></footer>
        <div class="site-credit"></div>
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection

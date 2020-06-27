'use strict';

// 募集概要の編集
function ChangeAboutForm() {
    document.getElementById('about-main').style.display = "none";
    document.getElementById('about-change').style.display = "none";
    document.getElementById('about-textarea').style.display = "block";
    document.getElementById('about-ok').style.display = "inline-block";
    document.getElementById('about-close-style').style.display = "block";
}

function ChangeAboutClose() {
    document.getElementById('about-main').style.display = "block";
    document.getElementById('about-change').style.display = "inline-block";
    document.getElementById('about-textarea').style.display = "none";
    document.getElementById('about-ok').style.display = "none";
    document.getElementById('about-close-style').style.display = "none";
}

// 文字数カウント（名前）
function NameLength(str, resultid) {
    document.getElementById(resultid).innerHTML = str.length + "文字";
}

// 文字数カウント + 行数制限（テキストエリア）
function TextLength(str, resultid) {
    str = str.replace(/\\n|\r\n|\n\r|\r|\n/g, "\r\n");
    let lines = str.split('\n');
    let max_line_num = 5;

    const newSubmit = document.getElementsByClassName('new-submit')[0];
    const lineError = document.getElementById('line-error');

    if (lines.length > max_line_num) {
        newSubmit.style.display = "none";
        lineError.style.display = "inline";
    } else {
        newSubmit.style.display = "inline-block";
        lineError.style.display = "none";
    }
    document.getElementById(resultid).innerHTML = str.length + "文字";
}

// タイトル変更フォームの表示・非表示
function clickBtn1() {
    const changeBtn = document.getElementById('changeBtn');
    if (changeBtn.style.display == "block") {
        changeBtn.style.display = "none";
    } else {
        changeBtn.style.display = "block";
    }
}

// 説明文の表示
function explainShow() {
    document.getElementById('explain').style.display = "inline-block";
}

function explainHide() {
    document.getElementById('explain').style.display = "none";
}

function explainShowBtn() {
    const explain = document.getElementById('explain');
    var explainClass = explain.classList.contains('explain-hide');

    if (explainClass == true) {
        explain.style.display = "inline-block";
        explain.classList.remove('explain-hide');
        explain.classList.add('explain-show');
    } else {
        explain.style.display = "none";
        explain.classList.remove('explain-show');
        explain.classList.add('explain-hide');
    }
}

// 締め切りまでを時間で非表示
if (!(document.getElementsByClassName('limit-number-color')[0].classList.contains('fadeout'))) {
    setTimeout(function() {
        document.getElementsByClassName('limit-number-color')[0].classList.add('fadeout');
    }, 6000);
}
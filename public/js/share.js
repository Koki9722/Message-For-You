'use strict';
{
    const alertCopy = document.getElementById('alert-copy');
    const replyShowBtn = document.getElementsByClassName('reply-show-btn');
    const postReply = document.getElementsByClassName('post-reply-group');
    const replyNum = replyShowBtn.length;

    // urlコピー
    document.getElementById('copy-btn').addEventListener('click', () => {
        alertCopy.style.display = "block";
        alertCopy.innerHTML = "共有ページのＵＲＬをコピーしました。"
        setTimeout(() => {
            alertCopy.style.display = "none";
        }, 2500);

        if (!navigator.clipboard) {
            var url = document.getElementById('url');
            url.focus();
            url.setSelectionRange(0,99999);
            document.execCommand("copy");
            url.blur();
        } else {
        navigator.clipboard.writeText(location.href);
        }
    });

    // 返信を表示・非表示
    for (let i = 0; i < replyNum; i++) {
        replyShowBtn[i].addEventListener('click', ()=> {
            var replyClass = replyShowBtn[i].classList.contains('reply-hide');
            if ( replyClass == true) {
                postReply[i].style.display = "block";
                replyShowBtn[i].classList.add('reply-show');
                replyShowBtn[i].classList.remove('reply-hide');
            } else {
                postReply[i].style.display = "none";
                replyShowBtn[i].classList.add('reply-hide');
                replyShowBtn[i].classList.remove('reply-show');
            }
            
        });
        document.getElementsByClassName('post-reply-close')[i].addEventListener('click', ()=> {
            postReply[i].style.display = "none";
            replyShowBtn[i].classList.add('reply-hide');
            replyShowBtn[i].classList.remove('reply-show');
        });
    }

    
}

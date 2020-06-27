'use strict';

    // 新規メッセージモーダルの表示・非表示
        function clickOpen() {
            // newModal.classList.remove('hidden');
            // newMask.classList.remove('hidden');
            newModal.style.visibility = "visible";
            newMask.style.visibility = "visible";
        }

        function clickClose() {
            // newModal.classList.add('hidden');
            // newMask.classList.add('hidden');
            newModal.style.visibility = "hidden";
            newMask.style.visibility = "hidden";
        }

        function clickMask() {
            // newModal.classList.add('hidden');
            // newMask.classList.add('hidden');
            newModal.style.visibility = "hidden";
            newMask.style.visibility = "hidden";
        }

    // アラートをゆっくり消す
        const alertWrapper = document.getElementsByClassName('alert-success');
        if (alertWrapper[0] != null) {
            setTimeout(function() {
                alertWrapper[0].classList.add('fadeout-to-right');
            }, 2500);
            setTimeout(function() {
                document.getElementsByClassName('alert-wrapper')[0].style.display = "none";
            }, 5000);
        }

    // エラーアラートの表示
        const errorFeedback = document.getElementsByClassName('invalid-feedback');
        if (errorFeedback.length > 0) {
            const alertParent = document.getElementsByClassName('alert-wrapper');
            const alertError = document.createElement('div');
            const text = document.createTextNode('エラーが発生しました');

            // プロパティ・値の設定
            alertError.className = 'alert alert-success';

            // ノードの挿入
            alertError.appendChild(text);

            // 子要素として追加
            alertParent[0].appendChild(alertError);

        }
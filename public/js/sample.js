$(function(){
    //モーダルの表示
    $('.new-button').click(function(){
        $('.modal-wrapper').fadeIn();
    });
    
    //モーダルを閉じる
    $('.fa-times').click(function(){
        $('.modal-wrapper').fadeOut();
    });

});
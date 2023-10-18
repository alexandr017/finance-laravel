$(function(){

    // hide FAQ first element for mobile
    if(document.body.clientWidth <= 769){
        //$('#ca1').collapse('hide');
    }

    // selects
    $(document).on('click','.new-select span',function(){
        var text = $(this).text();
        var val = $(this).attr('data-val');
        $(this).closest('.new-select').find('b').text(text);
        $(this).closest('.new-select').find('b').attr('data-val',val);
        $(this).closest('div').hide();
    });

    $('.new-select i').on('click',function(){
        $('.new-select div').not($(this).closest('.new-select').find('div')).hide();
        $(this).closest('.new-select').find('div').toggle();
    });


});

setTimeout(update_img_and_bg,1);

// menu hover on desktop
if($(window).width() > 769){
    $('header ul li').on('mouseover',function(e){
        $(this).find('ul').show();
        width = $(this).find('a').width();
        $(this).find('.menu-cursor').css('transform','translateX('+ (width/2-7) +'px) rotate(45deg)');

    }).on('mouseout',function(e){

        $(this).find('ul').hide();
        $(this).find('.menu-cursor').remove();
    });
}


// вызов живо-сайта
$('#o_k_click button').click(function(){
    (function(){ var widget_id = 'Y5Z2sXofKC';var d=document;var w=window;function l(){
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true;
        s.src = '//code.jivosite.com/script/widget/'+widget_id
        ; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}
        if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}
        else{w.addEventListener('load',l,false);}}})();
});


// защита от копирования
document.oncopy = function () {
    var bodyElement = document.body;
    var selection = getSelection();
    var href = document.location.href;
    if(window.isAuth == undefined){
        var copyright = ' - Читайте подробнее на #ВЗО: <a href="'+ href +'">' + href + '</a>';
    } else {
        var copyright = '';
    }
    var text = selection + copyright;
    var divElement = document.createElement('div');
    divElement.style.position = 'absolute';
    divElement.style.left = '-99999px';
    text1 = document.createTextNode(text); //создал текстовый узел
    divElement.appendChild(text1); //и добавил его
    bodyElement.appendChild(divElement);
    selection.selectAllChildren(divElement);
    setTimeout(function(){
        bodyElement.removeChild(divElement);
    }, 0);
};

function update_img_and_bg(){
    $('img.loading_lazy').each(function () {
        $(this).wrap('<div class="single-img-wrap"></div>');
    });


    $('.def_bg[data-src]').each(function(){
        $(this).css('background','url('+$(this).attr('data-src')+')').removeAttr('data-src');
    })
}

function update_img_and_bg_full_version(){

    $('.def_bg[data-src]').each(function(){
        $(this).css('background','url('+$(this).attr('data-src')+')').removeAttr('data-src');
    })
}

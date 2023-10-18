
/* добавление комментария */
$(document).on('submit','#AddComment',function(e){
    var name = $('#commentUserName').val();
    var id = $('#commentUserId').val();
    var comment = $('#commentUserComment').val();
    var post = $('#commentPost').val();
    var token = $('#token').val();
    var parent = $('#commentParent').val();
    var captcha = $('#g-recaptcha-response').val();


    var parent = $(this).parent().attr('data-id');
    if(parent == undefined) parent = 'null';

    $.ajax({
        type: "POST",
        url: "/forms/comment_add",
        data: {
            '_token': token,
            'name': name,
            'uid': id,
            'pid' : post,
            'parent':parent,
            'comment': comment,
            'captcha': captcha
        },
        success: function(data){
            $('#formModal .modal-body').html('<p>'+data+'</p>');
            $('#formModal').modal();
        }
    });
    return false;
});


$(document).on('click','#cancel-comment-reply-link',function(e){
    e.preventDefault();
    var form = $('#AddComment');
    $('#AddCommentWrap').html(form);
    $(this).next('form').remove();
    $('#cancel-comment-reply-link').before('<a rel="nofollow" class="comment-reply-link" href="#">Ответить</a>');
    $(this).remove();
});


$(document).on('click','.comment-reply-link',function(e){
    e.preventDefault();
    var form = $('#AddComment');
    $('#AddCommentWrap').html('');
    $(this).after(form);
    $('#cancel-comment-reply-link').before('<a rel="nofollow" class="comment-reply-link" href="#">Ответить</a>');
    $('#cancel-comment-reply-link').remove();
    $(this).after('<a rel="nofollow" href="#" id="cancel-comment-reply-link">Отменить ответ</a>');
    $(this).remove();
});
/* конец добавления комментария */





// выравниваем ширину через 1.5 секунды чтобы картинки в модуле успели загрузится

setTimeout(function(){

    if(document.body.clientWidth > 992){
        $('.offer_in_rating_wrap').each(function(){
            window.max_width_for_class_of_rat_item = 50;

            $(this).find('.of_rat_item').each(function(){
                if(parseInt($(this).css('height')) > window.max_width_for_class_of_rat_item) {
                    window.max_width_for_class_of_rat_item = parseInt($(this).css('height'));
                }
            });

            $(this).each(function(){
                $(this).find('.of_rat_item').css('height',window.max_width_for_class_of_rat_item+'px');
            });
            window.max_width_for_class_of_rat_item = 50;
        });

        $('.of_rat_un_wrap.l').each(function(){
            if(parseInt($(this).css('height'))>parseInt($(this).next('.of_rat_un_wrap.r').css('height'))){
                $(this).next('.of_rat_un_wrap.r').css('height',$(this).css('height'));
            } else {
                $(this).css('height',$(this).next('.of_rat_un_wrap.r').css('height'));
            }
        });
    }

},1500);







// скрытие таблицы
if(document.body.clientWidth < 768){
    addTableWrap('#single_content_wrap table');
    addTableWrap('.single table');
}
//addTableWrap('.overpayment-table');

function addTableWrap(selector){
    $(selector).each(function(){
        var table = $(this);
        i = 0;
        $(table).find('tr').each(function(){
            i++;
        });
        if(i > 7){
            i = 0;
            table.wrap('<div class="table-toggle-wrap"></div>');
            table.after('<span class="table-toggle down">Показать всё <i class="fa fa-chevron-down"></i></span>');
            $(table).find('tr').each(function(){
                i++;
                if(i>7) $(this).addClass('hide');
            });
        }
    });
}

$(document).on('click','.table-toggle.down',function(){
    $(this).html('Скрыть <i class="fa fa-chevron-up"></i>').removeClass('down').addClass('up');
    $(this).parent('.table-toggle-wrap').find('tr').removeClass('hide');
});

$(document).on('click','.table-toggle.up',function(){
    $(this).html('Показать всё <i class="fa fa-chevron-down"></i>').removeClass('up').addClass('down');
    var table = $(this).parent().find('table');
    i = 0;
    $(table).find('tr').each(function() {
        i++;
        if (i > 7) {
            $(this).addClass('hide');
        }
    })
});

$('#send_to_email').on('change',function(){
    var checked = $(this).is(':checked');
    if (checked) {
        $('.email_group').show();
    } else {
        $('.email_group').hide();
    }
});


// индикатор чтения
$(function() {
    $(window).on("scroll resize", function() {
        //var o = $(window).scrollTop() / ($(document).height() - $(window).height());
        var o = $(window).scrollTop() / ($('.content').height() - $(window).height());
        $(".progress-bar").css({
            "width": (100 * o | 0) + "%"
        });
        $('progress')[0].value = o;
    })
});


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



$('.hint').on('click',function(){
  $('.form-hint').not($(this).next('p.form-hint')).hide();
  $(this).next('p.form-hint').toggle();
});





$(document).on('scroll',function(){
  var block = $('.fixed-blue');
  if(block.css('display')=='none'){
    offsetTop = $(window).scrollTop();
    if(offsetTop > 100){
      block.show();
      $('body').css('padding-top',block.outerHeight());
    }
  }
})


$('#menu-mob-button').on('click',function(){
    $('.mob-menu-wrap').show();
    $('.mob-menu-wrap').animate({
        'left':'0'
    },350,function(){});
});

//
$('.mob-close').on('click',function(){
    $('.mob-menu-wrap').animate({
        'left':'-200%'
    },350,function(){
        $('.mob-menu-wrap').hide();
    });
});

//var menuCode = $('.mobl-menu').html();

$('ul.mobl-menu li a.a-sub-m').click(function(e){
    e.preventDefault();
    $('.mobl-menu').hide();
    $('#sub-menu').find('div').html('<i class="fa fa-arrow-left"><span>' + $(this).attr('data-text') + '</span></i>');
    $('#sub-menu').find('ul').html($(this).parent().find('ul').html());
    $('#sub-menu').animate({
        'left':'0'
    },250,function(){});
});

$('#sub-menu-title').click(function(){
    $('.mobl-menu').show(250);
    $('#sub-menu').animate({
        'left':'-200%'
    },250,function(){});
});



$('.side-block-dart .side-title').on('click',function(){
  $(this).next('.side-box').toggle();
  if($(this).find('i').hasClass("fa-angle-up")){
            $(this).find('i').removeClass("fa-angle-up").addClass("fa-angle-down");
        } else {
            $(this).find('i').addClass("fa-angle-up").removeClass("fa-angle-down");
        }
});



var files;

// Вешаем функцию на событие
// Получим данные файлов и добавим их в переменную
$('input[type=file]').change(function(event){
    files = event.target.files;
});

window.company_add_submited = false;
$('#company_add').on('submit',function(){

    if(window.company_add_submited == true) {
        $('#formModal .modal-body').html('Вы уже оправили сообщение');
        $('#formModal').modal();
        return false;
    };


    var files_;



    var formData = new FormData();
    formData.append('name', $('#name').val());
    formData.append('email', $('#email').val());
    formData.append('comment', $('#comment').val());
    formData.append('captcha', $('#g-recaptcha-response').val());

    var i =1;
    $.each( files, function( key, value ){
        formData.append('file'+i, value);
        i++;
    });



    $.ajax({
        type: "POST",
        url: "/forms/company_add",
        data: formData,
        processData: false,
        contentType: false,

        success: function(data){
            $('#formModal .modal-body').html('<p>'+data+'</p>');
            $('#formModal').modal();
            window.company_add_submited = true;
        }
        });
    return false;
});





$('#widget_install').on('submit',function(){

    var token = $('meta[name="csrf-token"]').attr('content');
    var name = $('#name').val();
    var email = $('#email').val();
    var company = $('#company').val();
    var comment = $('#comment').val();
    var captcha = $('#g-recaptcha-response').val();

    $.ajax({
type: "POST",
url: "/forms/widget_install",
data: {
    '_token': token,
    'name': name,
    'email': email,
    'company':company,
    'comment': comment,
    'captcha':captcha
},
success: function(data){
    $('#formModal .modal-body').html('<p>'+data+'</p>');
    $('#formModal').modal();
}
});
    return false;
});






$('#form_advertising').on('submit',function(){
    var token = $('meta[name="csrf-token"]').attr('content');
    var name = $('#name').val();
    var phone = $('#phone').val();
    var email = $('#email').val();
    var company = $('#company').val();
    var question = $('#question').val();
    var captcha = $('#g-recaptcha-response').val();
    $.ajax({
        type: "POST",
        url: "/forms/advertising",
        data: {
            '_token': token,
            'name': name,
            'phone': phone,
            'email': email,
            'company': company,
            'question': question,
            'captcha':captcha
        },
        success: function(data){
            $('#formModal .modal-body').html('<p>'+data+'</p>');
            $('#formModal').modal();
            $('#name').val('');
            $('#phone').val('');
            $('#email').val('');
            $('#company').val('');
            $('#question').val('');
        }
    });
    return false;
});






$('.showPhoneForm0').on('click',function(){
    $('#creditHistory').show();
    $('html, body').animate({
        scrollTop: $("#creditHistory").offset().top
    }, 2000);
});

$('#creditHistory').on('submit',function(){
    alert('Сервис временно недоступен');
    return false;
});






/* акардион */
$('.itop').each(function(){
    if($(this).parent().find('.imore').css('display') == 'block')
        $(this).prepend('<i class="fa fa-minus"></i>');
    else
        $(this).prepend('<i class="fa fa-plus"></i>');
});

$('.itop').on('click',function(){
    if($(this).find('i').hasClass('fa-plus')){
        $(this).find('i').addClass('fa-minus').removeClass('fa-plus');
    } else {
        $(this).find('i').removeClass('fa-minus').addClass('fa-plus');
    }
    $(this).next('.imore').toggle();
    $(this).toggleClass('active-itop');
    $('.itop').not($(this)).removeClass('active-itop');
});

$('.next-accordion').on('click',function(){
    $(this).closest('.imore').hide();
    $(this).closest('.hitem').find('.itop').find('i').addClass('fa-plus').removeClass('fa-minus');
    $(this).closest('.hitem').next().find('.imore').show();
    $(this).closest('.hitem').next().find('.itop').find('i').removeClass('fa-minus').addClass('fa-minus');
    $([document.documentElement, document.body]).animate({
        scrollTop: $(this).closest('.hitem').next().find('.itop').offset().top
    }, 2000);
});


















$(function(){
    $('.post-ratings i').each(function(){
        $(this).attr('data-value',$(this).attr('class'));
    })
});



$('.post-ratings i').on('mouseover',function(){
    var item = $(this).attr('data-item');
    for(var i=1; i<=item; i++){
        $(this).parent().find('i[data-item="'+i+'"]').attr('class','fa fa-star star-hover');
    }
}).on('mouseout',function(){
        var parent = $(this).parent();
        parent.find('i').each(function(){
            $(this).attr('class','fa '+$(this).attr('data-value'));
        });
}).on('click',function(){
    var rating = $(this).attr('data-item');
    var type = $(this).parent().attr('data-type');
    var id = $(this).parent().attr('data-id');
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "POST",
        url: "/actions/rating-add",
        data: {
            '_token': token,
            'rating': rating,
            'id': id,
            'type' : type,
        },
        success: function(data){
            $('.post-ratings').html(data);
        }
    });
    return false;
});





$('.companies-rating i').on('mouseover',function(){
    var item = $(this).attr('data-item');
    for(var i=1; i<=item; i++){
        $(this).parent().find('i[data-item="'+i+'"]').attr('class','fa fa-star star-hover');
    }
}).on('mouseout',function(){
    if($('#reviewRating').val() == 0){
        var parent = $(this).parent();
        parent.find('i').each(function(){
            $(this).attr('class','fa '+$(this).attr('data-value'));
        });
    } else {
        $(this).parent().find('i').attr('class','fa fa-star-o');
        for(var i=1; i<=$('#reviewRating').val(); i++){
            $(this).parent().find('i[data-item="'+i+'"]').attr('class','fa fa-star');
        }
    }
}).on('click',function(){
    $(this).parent().find('i').attr('class','fa fa-star-o');
    var value = $(this).attr('data-item');
    $('#reviewRating').val(value);

    $(this).parent().find('i').attr('class','fa fa-star-o');
    for(var i=1; i<=$('#reviewRating').val(); i++){
        $(this).parent().find('i[data-item="'+i+'"]').attr('class','fa fa-star');
    }
});







$('.insert_video').on('click', function(){
    var parent = $(this).closest('.insert-video-wrap');
    var video = parent.find('.data-video').attr('data-video');
    var html = '<div class="iframe-shadow"><iframe width="560" height="315" src="'+ video +'"></iframe></div>';
    parent.html(html);

});

$('.video-button').on('click', function(){
    var parent = $(this).closest('.insert-video-wrap');
    var video = parent.find('.data-video').attr('data-video');
    var html = '<div class="iframe-shadow"><iframe width="560" height="315" src="'+ video +'"></iframe></div>';
    parent.html(html);
});









$(document).on('click','.cart_more',function(){
    $(this).next('.panel-cart').toggle();
    if($(this).find('i').hasClass('fa-angle-down')){
        $(this).find('i').removeClass('fa-angle-down').addClass('fa-angle-up');
    } else {
        $(this).find('i').addClass('fa-angle-down').removeClass('fa-angle-up');
    }
})


                
$(window).scroll(function() {
    if($(this).scrollTop() != 0) {
        $('#toTop').fadeIn();
    } else {
        $('#toTop').fadeOut();
    }
});    
 
$('#toTop').click(function() {
    $('body,html').animate({scrollTop:0},800);
});
























// скрол на странице продуктов

//if(document.body.clientWidth > 768){
if ($(".fixed-company")[0]){
$(document).ready(function($) {
    $nav = $('.fixed-company');
    //$nav.css('width', $nav.outerWidth());
    $window = $(window);
    $h = $nav.offset().top;
    $h += 50;
    $window.scroll(function() {
        if ($window.scrollTop() > $h) {
            $nav.addClass('fixed');
        } else {
            $nav.removeClass('fixed');
        }
    });
});
}

//}

function getLoadCountReview(){
    var current = parseInt($('#loadReviews').attr('data-groups-current'));
    var selector = '.rev-group-' + (++current);
    var next_count = $(selector).length;
    $('#loadReviews span').html(' '+next_count);
}

$(function(){
    getLoadCountReview();
});


$('#loadReviews').on('click',function(){

    offsetTop = $(window).scrollTop();

    if($(this).attr('filter')){
        var current = parseInt($(this).attr('data-groups-current'));
        var all = parseInt($(this).attr('data-groups-count'));
        var selector = '.filteredGroupId-' + (++current);
        $(selector).removeClass('hide');
    } else {
        var current = parseInt($(this).attr('data-groups-current'));
        var all = parseInt($(this).attr('data-groups-count'));
        var selector = '.rev-group-' + (++current);
    }

    $(selector).removeClass('display_none');
    if(all <= (current)){
        $(this).remove();
    } else {
        $(this).attr('data-groups-current',(current));
    }
    getLoadCountReview();
    $(window).scrollTop(offsetTop);
});

// переключение вкладов в компаниях
$('.vab .left-block li').on('click',function(){
    var id = $(this).attr('data-id');
    var vab = $(this).closest('.vab');
    $('.left-block li').not(this).removeClass('active');
    $(this).addClass('active');
    vab.find('.right-block>div').removeClass('show');
    vab.find('.right-block>div[data-id='+id+']').addClass('show');
});


$('.remove-review').on('click',function(){
    var id = $(this).closest('.comment-item').attr('id');
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "POST",
        url: "/actions/remove-review",
        data: {
            '_token': token,
            'id': id,
        }
    });
    $(this).closest('.comment-item').remove();
    return false;
});


$(document).on('click','.edit-review',function(e){
    var id = $(this).closest('.comment-item').attr('id');
    id = id.replace('comment-','');
    var token = $('meta[name="csrf-token"]').attr('content');
    var rating = prompt('Введите значение нового рейтинга');
    rating = rating.replace(',','.');
    rating = parseFloat(rating);

    var values = [0.5, 1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5, 5];
    if(values.indexOf(rating) == -1)
    {
        alert('Введенное значение не является числом или не подходит для поля "Рейтинг"');
        return false;
    }


    $.ajax({
        type: "POST",
        url: "/actions/edit-review",
        data: {
            '_token': token,
            'id': id,
            'rating': rating
        }
    });
    return false;
});

// печать карточки
$(document).on('click','.print_card',function(e){
    e.preventDefault();

   var sOption="toolbar=yes,location=no,directories=yes,menubar=yes,scrollbars=yes,width=900,height=300,left=100,top=25";
   var sWinHTML = $(this).closest("div.one-offer").html();

   var winprint=window.open("","",sOption);
       winprint.document.open();
       winprint.document.write('<html><head><link href="/old_theme/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet"><link href="/old_theme/css/bootstrap.min.css" rel="stylesheet"><link href="/old_theme/css/s.php?v=0853" rel="stylesheet">');
       winprint.document.write('<style>.no-print{display:none !important}.row.spidometrs>div,.row.three-block>div{display:inline-block;width:33%}* { -webkit-print-color-adjust: exact; }</style></head><body onload="window.print();">');
       winprint.document.write('<div class="offers-list"><div class="one-offer">');
       winprint.document.write(sWinHTML);
       winprint.document.write('</div></div>');
       winprint.document.write('</body></html>');
       winprint.document.close();
       winprint.focus();
});


// мы помогли
$(document).on('click','.hdl',function(e){
    $.ajax({
        type: "GET",
        url: "/actions/inc-help-count",
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'link': $(this).attr('href'),
            'card_id': $(this).attr('data-id'),
            'city': window.city,
            'client_id': window.clientID
        },
    });
    var current = $('.side-box .help span').text();
    current = current.replace(' ','');
    current = parseInt(current);
    ++current;
    current = current.toString();
    current = current.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
    $('.side-box .help span').text(current);
});



// избранные карточки
$(function(){
    favorites();
    compare();
});

function favorites(){
    //favorites = localStorage.setItem('vzo',Array(1,2,3));
    favorites = localStorage.getItem('vzo');
    if(favorites == null) return;
    favoritesArr = favorites.split(',');
    for(i=0; i<favoritesArr.length; i++){
      if(favoritesArr[i] == '') favoritesArr.splice(i, 1);
    }
    localStorage.setItem('vzo',favoritesArr)
    var count = favoritesArr.length;
    $('.go-to-favorites').show();
    $('.go-to-favorites').append(' <span>'+count+'</span>');
    $('.one-offer').each(function(){
        var fav = $(this).find('.favorite');
        var id = fav.attr('data-id');
        for(i=0; i<favoritesArr.length; i++){
            if(parseInt(id) == parseInt(favoritesArr[i])){
                $(fav).removeClass('add_to_favorite').addClass('remove_from_favorite').find('span.fav').text('Удалить из избранных');
                if (window.isAuth == true) {
                    $(fav).after('<br class="go_to_fav"><a class="go_to_fav" href="/account/favorites"><i class="fa fa-sign-in"></i> Перейти в избранное</a>');
                } else {
                    $(fav).after('<br class="go_to_fav"><a class="go_to_fav" href="/favorites"><i class="fa fa-sign-in"></i> Перейти в избранное</a>');
                }
            }
        }
    });
    //localStorage.removeItem("vzo");
}

$(document).on('click','.add_to_favorite',function(e){
    e.preventDefault();
    favorites = localStorage.getItem('vzo');
    if(favorites == null){
        favoritesArr = Array();
    } else {
        favoritesArr = favorites.split(',');
    }
    favoritesArr.push($(this).attr('data-id'));
    favorites = localStorage.setItem('vzo',favoritesArr);
    $(this).removeClass('add_to_favorite').addClass('remove_from_favorite').find('span.fav').text('Удалить из избранных');
    if (window.isAuth == true) {
        $(this).after('<br class="go_to_fav"><a class="go_to_fav" href="/account/favorites"><i class="fa fa-sign-in"></i> Перейти в избранное</a>');
    } else {
        $(this).after('<br class="go_to_fav"><a class="go_to_fav" href="/favorites"><i class="fa fa-sign-in"></i> Перейти в избранное</a>');
    }

});

$(document).on('click','.remove_from_favorite',function(e){
    e.preventDefault();
    favorites = localStorage.getItem('vzo');
    if(favorites == null){
        favoritesArr = Array();
    } else {
        favoritesArr = favorites.split(',');
    }
    var id = $(this).attr('data-id');
    for(i=0;i<favoritesArr.length; i++){
        if(parseInt(favoritesArr[i]) == parseInt(id)){
            favoritesArr.splice(i, 1);
        }
    }

    favorites = localStorage.setItem('vzo',favoritesArr);
    $(this).addClass('add_to_favorite').removeClass('remove_from_favorite').find('span.fav').text('В избранное');
    $(this).closest('.one-offer').find('.go_to_fav').remove();
});

/******************************************************************************************************/
/***************************************** СРАВНЕНИЕ КАРТОЧЕК *****************************************/
/******************************************************************************************************/
function compare(){

    var link = '';
    switch (window.category_id){
        case 1: link = '/compare'; break;
        case 2: link = '/rko/compare'; break;
        case 4: link = '/online-credit/compare'; break;
        case 5: link = '/credit-cards/compare'; break;
        case 6: link = '/debit-cards/compare'; break;
        default: link =  '/compare';
    }
    var buttons = '';
    buttons = buttons + '<a href="'+link+'" class="form-btn1"><b class="fa fa-angle-double-left"></b> Перейти к сравнению</a>';
    buttons = buttons + '<button id="compare-clear" data-id="'+window.category_id+'">Сбросить</a>';
    $('.cilp_inner').html(buttons);

    favorites = localStorage.getItem('vzo_compare'+window.category_id);

    if(favorites == null) return;

    favoritesArr = favorites.split(',');
    for(i=0; i<favoritesArr.length; i++){
        if(favoritesArr[i] == '') favoritesArr.splice(i, 1);
    }
    localStorage.setItem('vzo_compare'+window.category_id,favoritesArr);
    $('.one-offer').each(function(){
        var fav = $(this).find('.compare');
        var id = fav.attr('data-id');
        for(i=0; i<favoritesArr.length; i++){
            if(parseInt(id) == parseInt(favoritesArr[i])){
                $(fav).removeClass('add_to_compare').addClass('remove_from_compare').find('span').text('- удалить из сравнения');
                $(fav).after('<a class="go_to_compare" href="'+link+'"><i class="fa fa-sign-in"></i> Перейти к сравнению</a>');
            }
        }
    });


    //localStorage.removeItem("vzo_compare");
}
// end function compare

// добавление к сравнению
$(document).on('click','.add_to_compare',function(e){
    e.preventDefault();
    favorites = localStorage.getItem('vzo_compare'+window.category_id);
    if (favorites == null) {
        favoritesArr = Array();
    } else {
        favoritesArr = favorites.split(',');
        if(favoritesArr.length == 10){
            alert('Нельзя добавлять более 10 карточек одного раздела в сравнение');
            return;
        }
    }
    var id = $(this).attr('data-id');
    favoritesArr.push(id);
    var logo = $(this).closest('.one-offer').find('.bor img').attr('src');
    if($('.card-mn-logo-review-block').length != 0) {
        logo = $(this).closest('.one-offer').find('.card-mn-logo-review-block img').attr('src');
    }
    var item = '<span data-id="'+id+'"><img src="'+logo+'" alt=""><i class="fa fa-remove"></i></span>';
    var link = '';
    switch (window.category_id){
        case 1: link = '/compare'; break;
        case 2: link = '/rko/compare'; break;
        case 4: link = '/online-credit/compare'; break;
        case 5: link = '/credit-cards/compare'; break;
        case 6: link = '/debit-cards/compare'; break;
        default: link =  '/compare';
    }
    $('.cilp_inner').prepend(item);
    $('#compare_in_listing_pages').show();
    favorites = localStorage.setItem('vzo_compare'+window.category_id,favoritesArr);
    $(this).removeClass('add_to_compare').addClass('remove_from_compare').find('span').text('- удалить из избранных');
    $(this).after('<a class="go_to_compare" href="'+link+'"><i class="fa fa-sign-in"></i> Перейти к сравнению</a>');
});

// удаление из сравнения (из карточки)
$(document).on('click','.remove_from_compare',function(e){
    e.preventDefault();
    favorites = localStorage.getItem('vzo_compare'+window.category_id);
    if(favorites == null){
        favoritesArr = Array();
    } else {
        favoritesArr = favorites.split(',');
    }
    var id = $(this).attr('data-id');
    for(i=0;i<favoritesArr.length; i++){
        if(parseInt(favoritesArr[i]) == parseInt(id)){
            favoritesArr.splice(i, 1);
        }
    }
    favorites = localStorage.setItem('vzo_compare'+window.category_id,favoritesArr);
    $(this).addClass('add_to_compare').removeClass('remove_from_compare').find('span').text('+ к сравнению');
    $(this).closest('.one-offer').find('.go_to_compare').remove();
    $('.cilp_inner span').each(function(){
        if (parseInt($(this).attr('data-id')) == parseInt(id)) $(this).remove();
    });
});

// удаление из сравнения (из плашки)
$(document).on('click','.cilp_inner i',function() {
    favorites = localStorage.getItem('vzo_compare' + window.category_id);
    var span = $(this).parent();
    if (favorites == null) {
        favoritesArr = Array();
    } else {
        favoritesArr = favorites.split(',');
    }
    var id = $(this).parent('span').attr('data-id');
    for (i = 0; i < favoritesArr.length; i++) {
        if (parseInt(favoritesArr[i]) == parseInt(id)) {
            favoritesArr.splice(i, 1);
            //console.log(parseInt(id));
        }
    }
    favorites = localStorage.setItem('vzo_compare' + window.category_id, favoritesArr);
    span.remove();
});

// очистка сравнения
$(document).on('click','#compare-clear',function(){
    localStorage.removeItem("vzo_compare"+window.category_id);
    document.location.reload();
});

$(document).on('click','.col-md-4a i.fa-remove',function(){
    var id = $(this).attr('data-id');
    favorites = localStorage.getItem('vzo_compare' + window.category_id);
    for (i = 0; i < favoritesArr.length; i++) {
        if (parseInt(favoritesArr[i]) == parseInt(id)) {
            favoritesArr.splice(i, 1);
        }
    }
    favorites = localStorage.setItem('vzo_compare' + window.category_id, favoritesArr);
    document.location.reload();
});

/******************************************************************************************************/
/******************************************************************************************************/





// закрытие блоков между карточками
$('.info-offer i.fa-close').on('click',function(){
    $(this).closest('.info-offer').remove();
});






// калькулятор микрозаймов
$('.calc-block button').on('click',function(){
    var sum = $('#mc_summ').val();
    var days = $('#mc_term').val();
    var percent = $('#mc_percent').val().replace(',', '.');
    var category_id = $('#mc_term').attr('data-category-id');

    if (category_id == 7) {
        var total = sum * days * percent / 700;
    } else {
        var total = sum * percent * 0.01 * days;
    }


    if (isNaN(total)) {
        $('.mc_result').html('Переплата: <span>0</span>');
    } else {
        total = total.toFixed(2);
        total = total.replace(/(\d)(?=(\d{3})+(\D|$))/g, '$1 ');
        total = total.toString().replace('.', ',');
        $('.mc_result').html('Переплата:<br> <span>'+total+' <i class="fa fa-rouble"></i></span>');
    }
});





// forms

if(document.body.clientWidth < 768){
$('.name-line').each(function(){
  if($(this).text().length <= 10){
    $(this).closest('.one-offer').find('.mob-mar').css('margin-top','95px');
  } else {
    if($(this).text().length >=29){
      $(this).closest('.one-offer').find('.mob-mar').css('margin-top','145px');
    } else {

    }
  }

});
}

$(document).on('click','.card_remove',function(){
    var card = $(this);
    var id = $(this).attr('data-id');
    var ccid = $(this).attr('data-ccid');
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "POST",
        data: {'_token': token,card_id:id,listing_id:listing_id,'ccid':ccid},
        url: '/actions/remove-card',
        success: function (data) {
            card.closest('.one-offer').remove();
        }
    });

});


// promo
$('.getPromo').on('click',function(){
    var input = $(this).closest('.center-block').find('input');
    input.attr('value',input.attr('data-value'));
});

//comparison
if(document.body.clientWidth > 768){
$(function(){
    $('.cmp_wrap').each(function(){
        var cmp_wrap = $(this);
        var max = 0;
        cmp_wrap.find('.cmp_i').each(function(){
            if($(this).height() > max ) max = $(this).height(); 
        });
        cmp_wrap.find('.cmp_i').each(function(){
            $(this).height(max);
        });
    });
});
}


$(document).on('submit','#callMeForm_',function(e){
      e.preventDefault();
      var token = $('meta[name="csrf-token"]').attr('content');
      var name = $('#c_name').val();
      var phone = $('#c_hone').val();

      if (!name || !phone) {
          alert('Вы не заполнили все поля');
          return false;
      }


      $.ajax({
          type: "POST",
          url: "/forms/call_me",
          data: {
              '_token': token,
              'name': name,
              'phone': phone
          },
          success: function(data){
            $('#callMe .modal-body').html('<p>'+data+'</p>');
          }
      });

      return false;
});

// function debounce(func, wait, immediate) {
//     let timeout;
//
//     return function () {
//         const context = this;
//         const args = arguments;
//
//         const later = function() {
//             timeout = null;
//             if (!immediate) func.apply(context, args);
//         };
//
//         const callNow = immediate && !timeout;
//
//         clearTimeout(timeout);
//
//         timeout = setTimeout(later, wait);
//
//         if (callNow) func.apply(context, args);
//     };
// };
// $("#searchInputBySite").bind("input", function() {
//     debounce(searchCall(),350,true)
// })
// function searchCall() {
//     var searchHint = $('#searchInputBySite').val();
//     if(searchHint.length > 2){
//         var token = $('meta[name="csrf-token"]').attr('content');
//         var value = searchHint;
//         console.log('aa '+value);
//         $.ajax({
//             type: "GET",
//             url: "/forms/search_hint",
//             data: {
//                 '_token': token,
//                 's': value
//             },
//             success: function(data){
//                 // console.log(data);
//                 if(data.length>0){
//                     var res = '';
//                     for(i=0; i<data.length; i++){
//                         if(data[i]!= null) res = res + "<li>" + data[i] + "</li>";
//                     }
//                     $('#search-hint').html(res);
//                     $('#search-hint').show('block');
//                 }
//             }
//         });
//     } else {
//         $('#search-hint').hide();
//         $('#search-hint').html('');
//     }
// };

$("#searchInputBySite").bind("input", function() {

    if($(this).val().length > 2){
        var token = $('meta[name="csrf-token"]').attr('content');
        var value = $(this).val();
        console.log('okk '+value);
        $.ajax({
            type: "GET",
            url: "/forms/search_hint",
            data: {
                '_token': token,
                's': value
            },
            success: function(data){
                // console.log(data);
                if(data.length>0){
                    var res = '';
                    for(i=0; i<data.length; i++){
                        if(data[i]!= null) res = res + "<li>" + data[i] + "</li>";
                    }
                    $('#search-hint').html(res);
                    $('#search-hint').show('block');
                }else {
                }
            }
        });
    } else {
        $('#search-hint').hide();
        $('#search-hint').html('');
    }
});

$(document).on('click','#search-hint li',function(){
    $('#searchInputBySite').val($(this).text());
    $('.search-wrap-form form').submit();
});


$('.zero-pos-more').on('click',function(e){
    e.preventDefault()
    if($(this).find('i').hasClass('fa-plus')){
        $(this).find('i').removeClass('fa-plus').addClass('fa-minus');
        $('.zero-pos').toggle();
    } else {
        $(this).find('i').addClass('fa-plus').removeClass('fa-minus');
        $('.zero-pos').toggle();
    }
});


/* Переписано
var join = $('.search-form'),
    joinLink = $('.header-search'),
    indexClick = 0;
$ ( function() {
    joinLink.click( function(event) {
        if (indexClick === 0) {
            join.fadeIn(700);
            join.show()
            indexClick = 1;
            joinLink.addClass('fa-remove').removeClass('.header-search');
        }
        else {
            join.hide();
            indexClick = 0;
            joinLink.removeClass('fa-remove').addClass('.header-search');
        }
        event.stopPropagation();
    });
});
$(document).click(function(event) {
    if ($(event.target).closest(".search-form").length) return;
    join.hide();
    indexClick = 0;
    joinLink.removeClass('fa-remove').addClass('.header-search');
    event.stopPropagation();
});
*/



$(document).on('click','.form-hint-img',function(){
    $(this).closest('.form-group').find('p').toggle();
});

//переключалки на вкладах карточек
$(document).on('click', '.rko-card-btn', function() {
    $(this).parent().find('.rko-card-btn').removeClass('active');
    $(this).addClass('active');
    var id = $(this).attr('data-tab');
    $(this).parent().parent().find('.rko-card-wrap').hide();
    $(this).parent().parent().find('.rko-card-wrap-'+id).show();
    console.log(id);
});

// подсказки у карточек у займов оплата и погашение
$(document).on('mouseover touchstart','.zaim-p-icon',function(){
    $('.sprite-block').remove();
    title = $(this).attr('data-title');
    $(this).append('<div class="sprite-block">'+title+'</div>');
}).on('mouseout','.zaim-p-icon',function(){
    $(this).parent().find('.sprite-block').remove();
});


// новые подсказки (глобальные)
$(document).on('mouseover touchstart','.vzo_icons',function(){
    $('.sprite-block').remove();
    title = $(this).attr('data-title');
    $(this).append('<div class="sprite-block">'+title+'</div>');
}).on('mouseout','.vzo_icons',function(){
    $(this).parent().find('.sprite-block').remove();
});

// этот код хз откуда и надо ли
$(document).on('mouseout','.pay-icons',function(){
    $(this).parent().find('.sprite-block').remove();
});

// подказки на шаблоне компаний.. нужно будет убрать после переписания
$(document).on('mouseover touchstart','.zaym_cards span',function(){
    $('.sprite-block').remove();
    id = $(this).attr('data-icon');
    title = '';
    switch (id){
        case    "1" : title = "Без процентов"; break;
        case    "2" : title = "С плохой КИ"; break;
        case    "3" : title = "Круглосуточно"; break;
        case    "4" : title = "С продлением"; break;
        case    "5" : title = "Моментальные"; break;
        case    "6" : title = "Погашение по частям"; break;
        case    "7" : title = "Микрофинансовая компания"; break;
        case    "8" : title = "Микрокредитная компания"; break;
    }
    $(this).append('<div class="sprite-block">'+title+'</div>');
});










// раскрытие отзывов
$('body').on('click', '.show_the_reviews', function(){
    $(this).next().show();
    $(this).prev('.three_dots').remove();
    $(this).remove();
});

// активные ссылки
$(function(){

    checkMenu('.desktop > li > a');
    checkMenu('#menu-verhnee-menyu-new > li > a');

    function checkMenu(selector){
        $(selector).each(function(){
            var isChildMenu = false;
            if($(this).attr('href') == location.pathname ){
                $(this).removeAttr('href').addClass('active');
            } else{
                $(this).parent().find('ul li').each(function () {
                    if($(this).find('a').attr('href') == location.pathname){
                        $(this).find('a').removeAttr('href').addClass('active');
                        isChildMenu = true;
                    }
                });
            }
            if(isChildMenu){
                $(this).addClass('active');
            }
        });
    }

});



// скрытие таблицы
console.log(document.body.clientWidth);
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
            table.wrap('<div class="table-toggle-wrap table-scroll"></div>');
            table.after('<span class="table-toggle down">Показать всё <i class="fa fa-chevron-down"></i></span>');
            $(table).find('tr').each(function(){
                i++;
                if(i>7) $(this).addClass('hide');
            });
        } else {
            table.wrap('<div class="table-scroll"></div>');
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

// скрол на хабах (мб не используется)
/*
if((document.body.clientWidth > 1200) && ($('body').find('.ltable').length > 0)){
    $('.ltable th').each(function(){
        width = $(this).width();
       $(this).attr('width',width);
    });
    $(document).ready(function($) {
        var foot = $(".ltable thead").clone().html();
        $('.ltable').append('<tfoot style="height: 10px;">' + foot + '</tfoot>');
        $nav = $('.ltable');
        $window = $(window);
        $h = $nav.offset().top -30;
        $window.scroll(function() {

            if ($window.scrollTop() > $h) {
                $nav.find('thead').addClass('f-block');
            } else {
                $nav.find('thead').removeClass('f-block');
            }

            if($window.scrollTop() > $h + $nav.height()){
                $nav.find('thead').removeClass('f-block');
            }

        });
    });
}
*/

$('.show_all_filtres').on('click',function(){
   $(this).hide();
   $('.all_filttres_wrap').show();
});



$(document).ready(function () {
        if(document.body.clientWidth > 768){


            $('.single img').each(function(){
                if($(this).attr('width') > 300){
                    $(this).wrap('<div class="single-img-wrap"></div>');
                }
            });

            $('.single-page img').each(function(){
                if($(this).attr('width') > 300){
                    $(this).wrap('<div class="single-img-wrap"></div>');
                }
            });
            $('#single_content_wrap img').each(function(){
                if($(this).attr('width') > 300){
                    $(this).wrap('<div class="single-img-wrap"></div>');
                }
            });
            $('.children-pages img').each(function(){
                if($(this).attr('width') > 300){
                    $(this).wrap('<div class="single-img-wrap"></div>');
                }
            });

    }

    $('.single iframe:not(.none)').wrap('<div class="iframe-shadow"></div>');
    $('#single_content_wrap iframe:not(.none)').wrap('<div class="iframe-shadow"></div>');

});


// жалоба
$(document).on('click','.complaint', function () {
    window.complaint_card_id = $(this).attr('data-id');
    $('#CardComplaint').modal();
});

$('#CardComplaintSelect .line').on('click',function () {
    if ($(this).attr('data-val') == 9) {
        $('#CardComplaintText').show();
    } else {
        $('#CardComplaintText').hide();
    }
});

$('#CardComplaint button.form-btn1').on('click',function() {

    var token = $('meta[name="csrf-token"]').attr('content');
    var type = $('#CardComplaintSelect .active-element').attr('data-val');
    var message = $('#CardComplaintText').val();

    if (type == 0) {
        alert('Вы не выбрали пункт');
        return false;
    }
    if (type == 9 && message == '') {
        alert('Вы не заполнили поле');
    }


    $.ajax({
        type: "POST",
        url: "/actions/add-complaint",
        data: {
            '_token': token,
            'type': type,
            'message': message,
            'card_id': window.complaint_card_id,
            'metrika_id':  window.clientID
        },
        success: function(data){
            alert(data);
            $('#CardComplaint').modal('toggle');
        }
    });
    return false;

});
// конец жалоба

$(function (){
    if($(".g-recaptcha").length) {
        dynamicallyLoadScript('https://www.google.com/recaptcha/api.js');
    }
});

// tabs from bootstrap
$(function(){
    $('.nav-tabs a').on('click',function(e){
        e.preventDefault();
        id = $(this).attr('href');
        $('.nav-tabs a').removeClass('active');
        $(this).addClass('active');
        $(this).closest('.nav-tabs-wrap').find('.tab-content>div').css('display','none');
        $(this).closest('.nav-tabs-wrap').find('.tab-content').find(id).css('display','block');
    });
})

// только числа
function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

    return true;
}

$(function(){

    // нажатие Esc
    $(document).keyup(function(e) {
        if(e.key === "Escape") {
            $('.modal').removeClass('show');
        }
    });

});



// фиксация меню в подвале

if((document.body.clientWidth > 1200) && ($('body').find('.sidebar_menu_wrap').length > 0)){

    $(document).ready(function($) {

        var section = $('h2'), // теги - заголовки, к которым вяжутся якоря
            nav = $('.side_bar_menu_scroll'),
            navHeight = nav.outerHeight(); // получаем высоту навигации

        // поворот экрана
        window.addEventListener('orientationchange', function () {
            navHeight = nav.outerHeight();
        }, false);




        $('.sidebar_menu_wrap .side-block').css('width',$('.sidebar').width());

        $h = $('.sidebar').offset().top
            + $('.sidebar').height()
            - $('.sidebar .sidebar_menu_wrap').height();

        // определение какой класс вешать
        if ($('body').find('.fixed-company').length > 0) {
            class_name = 'sidebar-fixed-block-on-company';
        } else {
            class_name = 'sidebar-fixed-block';
        }


        $(window).scroll(function() {

            // фиксация самого меню в сайдбаре при скролле
            if ($(window).scrollTop() > $h) {
                $('.main').find('.sidebar_menu_wrap .side-block').addClass(class_name);
            } else {
                $('.main').find('.sidebar_menu_wrap .side-block').removeClass(class_name);
            }

            const_offset = 500;


            if($(window).scrollTop() > $('.main').height() - const_offset){
                $('.main').find('.sidebar_menu_wrap .side-block').removeClass(class_name);
            }




            var position = $(this).scrollTop();
            // выделение активной ссылки в меню при скролле
            section.each(function () {
                var top = $(this).offset().top - navHeight - 5,
                    bottom = top + $(this).outerHeight();


                if (position >= top && position <= bottom) {
                    nav.find('a').removeClass('active');
                    section.removeClass('active');

                    $(this).addClass('active');
                    console.log($(this));
                    nav.find('a[href="#' + $(this).attr('id') + '"]').addClass('active');
                }
            });


        });

        // плавный скролл
        nav.find('a').on('click', function () {
            var id = $(this).attr('href');

            $('html, body').animate({
                scrollTop: $(id).offset().top - navHeight
            }, 500);

            return false;
        });


    });
}

$('.show_more_db').click(function () {
    $('.ic-db-wrap li').removeClass('d_n');
    $(this).hide();
});


$('.ep_btn').on('click', function(){
    $(this).parent().removeClass('ep_text_wrap');
   $(this).remove();
});

$('.verified_by_expert').on('click', function (e) {
    var menu_height = 150;
    var target = $(this).attr('href');
    e.preventDefault();
    $('html, body').animate({
        scrollTop: $(target).offset().top - menu_height
    }, 1000);
});



var switcher = document.getElementById("switcher");
if(switcher){
switcher.addEventListener("click", function () {
    if (switcher.className.match("sun")) {
        document.cookie = "DARK_MODE=dark; path=/;";
        var head  = document.getElementsByTagName('head')[0];
        var link  = document.createElement('link');
        link.rel  = 'stylesheet';
        link.type = 'text/css';
        link.href = '/old_theme/css/dark_mode.css';
        link.media = 'all';
        link.id = 'dark_styles';
        head.appendChild(link);
        switcher.className = switcher.className.replace("sun", "moon");
    } else {
       // $(document).on('click', '#dark_styles', function(){
       //     // alert(1);
       //      $(this).remove();
       //  });
        document.cookie = "DARK_MODE=dark; path=/; Max-Age=-1";
        switcher.className = switcher.className.replace("moon", "sun");
        // $('#dark_styles').remove();
        $('link[rel=stylesheet][href~="/old_theme/css/dark_mode.css"]').remove();
    }
});
}


// мини плагин
(function(){
    $.fn.modal = function(){
        $(this).addClass('show');
        $("body").css({
            "overflow": "hidden"
        });
    }
})($);

$(function(){
    // закрытие
    $(document).on('click','.modal .close', function () {
        $(this).closest('.modal').removeClass('show');
        $("body").css({
            "overflow": "auto"
        });
        $('#formModal .modal-body').html('');
    });
    // вызыв
    $(document).on('click','[data-toggle=modal]', function () {
        var selector = $(this).attr('data-target');
        $(selector).addClass('show');
        $("body").css({
            "overflow": "hidden"
        });
    });

});



if ($(window).width() < 1700) {
    $('.geo_cities_list').height('55vh');
}

$(document).on('click', '.modal.show', function(e){
     if ($(e.target).hasClass('modal')) {
         $(this).removeClass('show');
         $('body').css('overflow', 'initial')
     }
    //console.log ($(e.target).attr('class'));
});


$(document).on('click', '#getPromoCode_', function(){
    $.ajax({
        type: "GET",
        url: "/actions/get-card-promocode",
        data: {
        },
        success: function(data){
            $('#PromoCodeValue').val(data)
            $('#PromoCodeValue').show();
        }
    });
    return false;
});
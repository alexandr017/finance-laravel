$( document ).ready(function() {
    let searchParams = new URLSearchParams(window.location.search);
    let get_letter = searchParams.get('letter');
    if(!get_letter){
        $('.dictionary_link').first().addClass("active_letter").removeAttr('href');
    } else {
        $('.dictionary_link:contains('+get_letter+')').addClass("active_letter").removeAttr('href');
    }
    $('.dictionary_list li a').first().addClass("active_link");
    var content = $('.active_link').parent().data('content');
    var btn_more = "<div class='btn_more_block'><a href='"+$('.active_link').attr('href')+"' class='btn_more text-center'>Подробнее</a></div>";
    content = content+btn_more;
    if($(window).width() > 576){
        $('.letter_content').html(content);
    }else {
        $('.active_link').parent().append($('.letter_content').html(content));
        $('.hide_show_content i').css('display','inline-block');
    }
    if ($(window).width() > 576) {
        $('.term_link').mouseover(function () {
            $('.active_link').removeClass('active_link');
            $(this).toggleClass('active_link');
            let content = $(this).parent().data('content');
            var btn_more = "<div class='btn_more_block'><a href='"+$('.active_link').attr('href')+"' class='btn_more text-center'>Подробнее </a></div>";
            $('.letter_content').html(content+btn_more);
        });
    } else {
        let term_href = $('.term_link').attr('href');
        $('.btn_more').attr('href',term_href);

        $('.term_link').click(function () {
            if($(this).hasClass('active_link')){
                $(this).toggleClass('active_link');
                $('.letter_content').html('');
            }else{
                $('.active_link').removeClass('active_link');
                $(this).addClass('active_link');
                $(this).attr('data-link',$(this).attr('href'));
                $(this).removeAttr('href');
                let content = $(this).parent().data('content');
                var btn_more = "<div class='btn_more_block'><a href='"+$(this).attr('data-link')+"' class='btn_more text-center'>Подробнее </a></div>";
                $('.letter_content').html(content + btn_more);
                $('.active_link').parent().append($('.letter_content').html(content + btn_more));
            }
        });
    }

    $('.dictionary_link').click(function () {
        let letter = $(this).html();
        $(location).attr('href',`terms?letter=${letter}`);
    });
    $("#searchInputByWord").bind("change paste keyup", function() {
        if($(this).val().length > 2){
            var token = $('meta[name="csrf-token"]').attr('content');
            var value = $(this).val();
            $.ajax({
                type: "GET",
                url: "/forms/search_term",
                data: {
                    '_token': token,
                    'term': value
                },
                success: function(data){
                    // data = JSON.parse(data);
                    if(data.length>0){
                        if (data.length>5){
                            $('#search-term').css('overflow-y','scroll');
                        }else {
                            $('#search-term').removeAttr('style');
                        }
                        var res = '';
                        for(i=0; i<data.length; i++){
                            if(data[i]!= null) res = res + `<li><a href=terms/${data[i].alias}>${data[i].h1}</li>`;
                        }
                        $('#search-term').html(res);
                        $('#search-term').show('block');
                    } else {
                        $('#search-term').hide();
                    }
                }
            });
        } else {
            $('#search-term').hide();
            $('#search-term').html('');
        }
    })
});

$('#searchInputByWordForm').on('submit', function(e){
    e.preventDefault();
    return false;
});
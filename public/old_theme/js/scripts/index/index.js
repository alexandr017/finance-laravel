$(document).ready(function() {


$('.index-cards-count > div').click(function(){
    location.href = $(this).attr('data-url');
});
});

function fakeLoader() {
    $('.offers-list').addClass('loading');
    setTimeout(function(){
        $('.offers-list').removeClass('loading');
    }, 700);
}




$(function(){

    /*

$('#debitCardsSlider').slick({
    dots: false,
    infinite: false,
    speed: 300,
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    responsive: [
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
});

$('#creditCardsSlider').slick({
    dots: false,
    infinite: false,
    speed: 300,
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    responsive: [
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
});

$('#creditsSlider').slick({
    dots: false,
    infinite: false,
    speed: 300,
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    responsive: [
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
});

$('#autoCreditsSlider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

$('#rkoSlider').slick({
    dots: false,
    infinite: false,
    speed: 300,
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    responsive: [
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
});


$('#newsSlider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    $('#zalogiSlider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('#cashBackSlider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('#insuranceSlider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
*/


});




// подгрузка и сортировка карточек


// сортировка карточек
$('.sorting-line span').on('click',function(){
    $('#load_more').show();
    var field = $(this).parent().attr('data-field');
    window.field = field;
    window.number_page = 1;
    var token = $('meta[name="csrf-token"]').attr('content');
    var options = Array();

    $('.options-list span').each(function(){
        if($(this).find('input:checked')) options.push ($(this).find('input:checked').val());
    });

    if($(this).parent().hasClass('active')){
        if($(this).parent().find('i').hasClass('fa-arrow-circle-up')){
            $(this).parent().find('i').removeClass('fa-arrow-circle-up').addClass('fa-arrow-circle-down');
            var sort_type = 'desc';
        } else {
            var sort_type = 'asc';
            $(this).parent().find('i').addClass('fa-arrow-circle-up').removeClass('fa-arrow-circle-down');
        }
        window.sort_type = sort_type;


        window.default_sorting_counter = 0;

    } else {
        $('.sorting-line li').each(function(){
            $(this).removeClass('active');
            $(this).find('i').attr('class','');
        });
        $(this).parent().find('i').addClass('fa-arrow-circle-down').addClass('fa')
        $(this).parent().addClass('active');

    }

    if (field == 'title' || field == 'maintenance') {
        if (sort_type == 'asc') {
            sort_type = 'desc';
        } else {
            sort_type = 'asc';
        }
    }

    if (sort_type == undefined) {
        sort_type = 'desc';
    }

    window.default_sorting_counter++;

    var data = {};
    data['field'] = field;
    data['page'] = 1;
    data['listing_id'] = window.listing_id;
    data['category_id'] = window.category_id;
    data['count_on_page'] = window.count_on_page;
    data['options'] = options;
    data['sort_type'] = sort_type;
    data['section_type'] = window.section_type;


    for(var key in window.sidebar_listings) {
        data[key] = window.sidebar_listings[key];
    }


    $.ajax({
        type: "GET",
        url: "/actions/load_cards_for_listings",
        data: data,
        success: function(data){
            $('.offers-list').html(data['code']);

            update_img_and_bg_full_version();

            if(data['count']){
                $('#load_more').show();
                $('#load_more_index_page').show();
            } else {
                $('#load_more').hide();
                $('#load_more_index_page').hide();
            }

            if (data['count'] < 10) {
                $('#load_more').hide();
            }

            countTemp = window.cards_count - window.number_page*10;

            if(countTemp > 10)
                labelCount = 10;
            else
                labelCount = countTemp;

            $("#load_more").find('span').html(labelCount);


        }
    });
});



// подгрузка карточек
$('#load_more').on('click',function(){
    var bnt = $(this);
    window.number_page++;
    var token = $('meta[name="csrf-token"]').attr('content');
    var options = Array();

    $('.options-list span').each(function(){
        if($(this).find('input:checked')) options.push ($(this).find('input:checked').val());
    });

    var data = {};
    data['field'] =  window.field;
    data['page'] = window.number_page;
    data['listing_id'] = window.listing_id;
    data['category_id'] = window.category_id;
    data['count_on_page'] = window.count_on_page;
    data['options'] = options;
    data['sort_type'] = window.sort_type;
    data['section_type'] = window.section_type;




    for(var key in window.sidebar_listings) {
        data[key] = window.sidebar_listings[key];
    }

    offsetTop = $(window).scrollTop();

    $.ajax({
        type: "GET",
        url: '/actions/load_cards_for_listings',
        data: data,
        success: function(data){
            $('.offers-list').append(data['code']);

            update_img_and_bg_full_version();

            $(window).scrollTop(offsetTop);

            if(data['count']){
                $('#load_more').show();
            } else {
                $('#load_more').hide();
            }

            if (data['count'] < 10) {
                $('#load_more').hide();
            }

            countTemp = window.cards_count - window.number_page*10;

            if(countTemp > 10)
                labelCount = 10;
            else
                labelCount = countTemp;


            if (labelCount < 0) {
                if(window.cards_count > 20)
                    labelCount = 10;
                else
                    labelCount = window.cards_count - 10;
            }

            if (labelCount == 0) {
                $('#load_more').hide();
            }


            bnt.find('span').html(labelCount);





        }
    });
});


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


    /*quizz*/
    $('.quiz-btn-search').on('click',function (){
        var category = $('#quiz-cat-sel .active-element').attr('data-val');
        searchQuizes(category);
    })
    $('.refresh-by-selected-quizz').on('click',function (){
        var category = $('#quiz-cat-sel .active-element').attr('data-val');
        searchQuizes(category);
    })
    $('#quiz-autocredit-sum').on('change',function () {
        if ($(this).val() > 0) {
            $('#quiz-autocredit-first-pay').removeAttr('disabled');
        } else if($(this).val() == '' || $(this).val() == 0) {
            $('#quiz-autocredit-first-pay').attr('disabled','disabled');
            $('#quiz-autocredit-first-pay').val('');
        }
    })
    function searchQuizes(category,quizLoadedCardslength = 0){
        var token = $('meta[name="csrf-token"]').attr('content');
        if (category == 1) {
            var zaimSum = $('#quiz-zaim-sum').val();
            var zaimTerm = $('#quiz-zaim-term').val();
            var dayPerc = $('#quiz-perc-per-day').val();
            dayPerc = (dayPerc != '' && dayPerc != null) ? dayPerc.replace(',','.') : '';
            var age = $('#quiz-age').val();
            var advancedSearchFilters = [];
            var advancedSearchOptions = [];
            // $(window).resize(function() {
            if($(window).width() <= 767){

            }
            // });
            $('.quiz-payment-methods span input:checked').each(function(){
                advancedSearchFilters.push ($(this).val());
            })
            $('.quiz-borrower-history-block span input:checked').each(function(){
                advancedSearchFilters.push ($(this).val());
            })
            $('.quiz-docs span input:checked').each(function () {
                advancedSearchFilters.push ($(this).val());
            })
            $('.quiz-other span input:checked').each(function () {
                if($(this).val() == 'prolongation') {
                    advancedSearchOptions.push ($(this).val());
                }
                advancedSearchFilters.push ($(this).val());
            })
            if($('#quiz-speed').val() != '') {
                advancedSearchFilters.push ($('#quiz-speed').val());
            }
            if($('#quiz-city').val() != ''){
                advancedSearchFilters.push ($('#quiz-city').val());
            }
            var data = {
                '_token': token,
                'category': category,
                'zaimSum': zaimSum,
                'zaimTerm': zaimTerm,
                'dayPerc': dayPerc,
                'age': age,
                'advancedSearchFilters': advancedSearchFilters,
                'advancedSearchOptions': advancedSearchOptions
            };
        }
        else if (category == 4) {
            var creditSum = $('#quiz-credit-sum').val();
            var creditTerm = $('#quiz-credit-term').val();
            var yearPerc = $('#quiz-perc-per-year').val();
            if(yearPerc != ''){
                yearPerc = yearPerc.replace(',','.');
            }
            var age = $('#quiz-age').val();
            var advancedSearchFilters = [];
            $('.quiz-cr-viplati-celi span input:checked').each(function(){
                advancedSearchFilters.push ($(this).val());
            })
            $('.quiz-loan span input:checked').each(function(){
                advancedSearchFilters.push ($(this).val());
            })
            $('.quiz-other span input:checked').each(function(){
                advancedSearchFilters.push ($(this).val());
            })
            var data = {
                '_token': token,
                'category': category,
                'creditSum': creditSum,
                'creditTerm': creditTerm,
                'yearPerc': yearPerc,
                'age': age,
                'advancedSearchFilters': advancedSearchFilters
            };
        }
        else if (category == 5) {
            var creditCardMaxLim = $('#quiz-credit-cards-max-lim').val();
            var creditCardNoPercTerm = $('#quiz-credit-card-nonperc-period').val();
            var yearPerc = $('#quiz-perc-per-year').val();
            if(yearPerc != ''){
                yearPerc = yearPerc.replace(',','.');
            }
            var age = $('#quiz-age').val();
            var openedPayment = $('#quiz-payment-for-open').val();
            var servicePayment = $('#quiz-service-payment').val();
            var advancedSearchFilters = [];
            $('.quiz-payment span input:checked').each(function(){
                advancedSearchFilters.push ($(this).val());
            })
            $('.quiz-loan span input:checked').each(function(){
                advancedSearchFilters.push ($(this).val());
            })
            $('.quiz-div-history span input:checked').each(function(){
                advancedSearchFilters.push ($(this).val());
            })
            var data = {
                '_token': token,
                'category': category,
                'creditCardMaxLim': creditCardMaxLim,
                'creditCardNoPercTerm': creditCardNoPercTerm,
                'openedPayment': openedPayment,
                'maintenance': servicePayment,
                'yearPerc': yearPerc,
                'age': age,
                'advancedSearchFilters': advancedSearchFilters
            };
        }
        else if (category == 6) {
            var debCardOpened = $('#quiz-deb-card-opened').val();
            var debCardYearService = $('#quiz-deb-year-service').val();
            var advancedSearchFilters = [];
            var advancedSearchOptions = [];
            $('.quiz-tip-karti span input:checked').each(function(){
                advancedSearchFilters.push ($(this).val());
            })
            $('.quiz-loan span input:checked').each(function(){
                advancedSearchFilters.push ($(this).val());
            })
            $('.quiz-bonusi-valyuta span input:checked').each(function(){
                advancedSearchFilters.push ($(this).val());
            })
            $('.quiz-other span input:checked').each(function(){
                advancedSearchFilters.push ($(this).val());
            })
            $('.quiz-options span input:checked').each(function(){
                advancedSearchOptions.push ($(this).val());
            })
            var data = {
                '_token': token,
                'category': category,
                'debCardOpened': debCardOpened,
                'debCardYearService': debCardYearService,
                'advancedSearchFilters': advancedSearchFilters,
                'advancedSearchOptions': advancedSearchOptions
            };
        }
        else if (category == 2) {
            var rkoOpened = $('#quiz-rko-opened').val();
            var rkoYearService = $('#quiz-rko-year-service').val();
            var advancedSearchFilters = [];
            $('.quiz-adv-search-first-block span input:checked').each(function(){
                advancedSearchFilters.push ($(this).val());
            })
            $('.quiz-adv-search-second-block span input:checked').each(function(){
                advancedSearchFilters.push ($(this).val());
            })
            var data = {
                '_token': token,
                'category': category,
                'rkoOpened': rkoOpened,
                'rkoYearService': rkoYearService,
                'advancedSearchFilters': advancedSearchFilters
            };
        }
        else if (category == 8) {
            var autoCreditSum = $('#quiz-autocredit-sum').val();
            var autoCreditTerm = $('#quiz-autocredit-term').val();
            var autoCreditPercPerYear = $('#quiz-perc-per-year').val();
            var autoCreditAge = $('#quiz-age').val();
            var autoCreditFirstPay = $('#quiz-autocredit-first-pay').val();
            var advancedSearchFilters = [];
            $('.quiz-adv-search-second-block span input:checked').each(function(){
                advancedSearchFilters.push ($(this).val());
            })
            var data = {
                '_token': token,
                'category': category,
                'autoCreditSum': autoCreditSum,
                'autoCreditTerm': autoCreditTerm,
                'autoCreditPercPerYear': autoCreditPercPerYear,
                'autoCreditAge': autoCreditAge,
                'autoCreditFirstPay': autoCreditFirstPay,
                'advancedSearchFilters': advancedSearchFilters
            };
        }
        data['quizLoadedCardslength'] = quizLoadedCardslength;
        $.ajax({
            type: "POST",
            url: 'load-quizz',
            data: data,
            success: function(data){
                $('.quiz-div-button').append('___'+data['card_count']);
                var quizCardsForLoading = data['card_count']-quizLoadedCardslength;
                var countPrefix = (quizCardsForLoading <20) ? (quizCardsForLoading-10) : 10;
                if(countPrefix <= 0) {
                    $('#quiz_load_more').css('display','none');
                }
                if(quizCardsForLoading == data['card_count']) {
                    $('.offers-list').fadeOut();
                    $('.listing .offers-list').html(data['result']);
                    $('.offers-list').fadeIn();
                    $('#quiz_load_more').parent().remove();
                    if(data['card_count'] > 10){
                        $('.listing .offers-list').after('<div class="text-center"><button class="form-btn1" id="quiz_load_more" data-cards = "10">Показать ещё <span>'+countPrefix+'</span></button></div>');
                    }
                } else {
                    $('.listing .offers-list').append(data['result']);
                    quizLoadedCardslength = $('.offers-list .one-offer').length;
                    $('#quiz_load_more').attr('data-cards',quizLoadedCardslength);
                    $('#quiz_load_more span').html(countPrefix);
                    update_img_and_bg_full_version();
                    return;
                }
                update_img_and_bg_full_version();
                $('#quiz_load_more').on('click',function (){
                    var category = $('#quiz-cat-sel .active-element').attr('data-val');
                    quizLoadedCardslength = $('.offers-list .one-offer').length;
                    searchQuizes(category,quizLoadedCardslength);
                })
            }
        })
    }
    $('.quizz #quiz-cat-sel .line').on('click',function (){
        var elem = $('.quiz-div-search .quiz-search-terms');
        var newActiveEl = $(this).data('val');
        if(!elem.hasClass('.display_none')){
            elem.removeClass('d-flex')
            elem.addClass('display_none')
        }
        $('.quizz-'+newActiveEl).removeClass('display_none');
        $('.quizz-'+newActiveEl).addClass('d-flex');
        $('.quizz .quiz-adv-search').html('');
        var url = 'load-advance-block/'+newActiveEl;
        $.ajax({
            type: "GET",
            url: url,
            success: function(data){
                $('.quizz .quiz-adv-search').append(data);
            }
        })
    })
    $('.quizAdvSearch').on('click',function () {
        $('.quiz-adv-search').toggleClass('display_none');
        $(this).find('i').toggleClass('fa-chevron-down');
        $(this).find('i').toggleClass('fa-chevron-up');
        $('.quiz-div-button').toggleClass('display_none');
    })
    $('.quiz-reset-selected').on('click',function () {
        $('.quiz-bordered-block input:checked').each(function () {
            $(this)[0].checked = false;
        })
    })
    /*quizz*/
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


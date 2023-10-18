$(document).ready(function() {
    $('#credit-select .hidden-elements .line').click(function () {
      var text = $(this).text();
      $(this).parent().parent().find('.active-element').html(text);
      $(this).parent().find('.line').removeClass('active');
      $(this).addClass('active');
      var value = $(this).data('val');

      if ($(this).parent().parent().is('#credit-select')) {
        var arrayValue = [];

        if (value == "0") {
            arrayValue = [];
            arrayValue = [
                ['На карту', '/card', '/card'],
                ['На Киви-кошелек', '/qiwi', '/qiwi'],
                ['С 18 лет', '/zajm-18', '/zajm-18'],
                ['Со 100% одобрением', '/100-procentov', '/100-procentov'],
                ['С плохой кредитной историей', '/history', '/history'],
                ['Без отказа', '/bez-otkaza', '/bez-otkaza'],
                ['Без процентов', '/besplatnyj-zajm', '/besplatnyj-zajm'],
                ['Без карты', '/bez-karty', '/bez-karty'],
                ['Без звонков', '/bez-zvonkov', '/bez-zvonkov'],
                ['Долгосрочные', '/dolgosrochnye', '/dolgosrochnye'],
            ];
        }
        if (value == "1") {
            arrayValue = [];
            arrayValue = [
                ['Москва', '/zalogi/moskva', '/zalogi/moskva'],
                ['Санкт-Петербург', '/zalogi/sankt-peterburg', '/zalogi/sankt-peterburg'],
                ['Новосибирск', '/zalogi/novosibirsk', '/zalogi/novosibirsk'],
                ['Ростов-на-Дону', '/zalogi/rostov-na-donu', '/zalogi/rostov-na-donu'],
                ['В Краснодаре', '/zalogi/krasnodar', '/zalogi/krasnodar'],
                ['В Екатеринбурге', '/zalogi/ekaterinburg', '/zalogi/ekaterinburg'],
                ['В Самаре', '/zalogi/samara', '/zalogi/samara'],
                ['В Челябинске', '/zalogi/chelyabinsk', '/zalogi/chelyabinsk'],
                ['В Тюмени', '/zalogi/tyumen', '/zalogi/tyumen'],
                ['В Улан-Удэ', '/zalogi/ulan-udje', '/zalogi/ulan-udje'],
            ];
        }
        if (value == "2") {
            arrayValue = [];
            arrayValue = [
                ['Со 100% одобрением', '/online-credit/100-procentnoe-odobrenie', '/online-credit/100-procentnoe-odobrenie'],
                ['С моментальным решением', '/online-credit/momentalnoe-reshenie', '/online-credit/momentalnoe-reshenie'],
                ['С диф. платежами', '/online-credit/differencirovannye-platezhi', '/online-credit/differencirovannye-platezhi'],
                ['Без посещения банка', '/online-credit/bez-posesheniya-banka', '/online-credit/bez-posesheniya-banka'],
                ['Без подтверждения дохода', '/online-credit/bez-podtverzhdeniya-dohoda', '/online-credit/bez-podtverzhdeniya-dohoda'],
                ['Без отказа', '/online-credit/bez-otkaza', '/online-credit/bez-otkaza'],
                ['С 18 лет', '/online-credit/18-let', '/online-credit/18-let'],
                ['С 20 лет', '/online-credit/20-let', '/online-credit/20-let'],
                ['Сроком от 3 лет', '/online-credit/3-goda', '/online-credit/3-goda'],
                ['Сроком от 5 лет', '/online-credit/5-let', '/online-credit/5-let'],
            ];
        }
        if (value == "3") {
            arrayValue = [];
            arrayValue = [
                ['Со 100% одобрением', '/credit-cards/so-100-procentnym-odobreniem', '/credit-cards/so-100-procentnym-odobreniem'],
                ['С плохой кредитной историей', '/credit-cards/plohaja-kreditnaja-istorija', '/credit-cards/plohaja-kreditnaja-istorija'],
                ['Без проверок', '/credit-cards/bez-proverok', '/credit-cards/bez-proverok'],
                ['Без отказа', '/credit-cards/bez-otkaza', '/credit-cards/bez-otkaza'],
                ['По паспорту', '/credit-cards/pasport', '/credit-cards/pasport'],
                ['Для безработных', '/credit-cards/dlya-bezrabotnyh', '/credit-cards/dlya-bezrabotnyh'],
                ['С 18 лет', '/credit-cards/18-let', '/credit-cards/18-let'],
                ['С 21 года', '/credit-cards/21-god', '/credit-cards/21-god'],
                ['С 23 лет', '/credit-cards/23-goda', '/credit-cards/23-goda'],
                ['С доставкой курьером', '/credit-cards/kuryerom', '/credit-cards/kuryerom'],
            ];
        }
        if (value == "5") {
            arrayValue = [];
            arrayValue = [
                ['Для ИП', '/rko/dlya-ip', '/rko/dlya-ip'],
                ['За один день', '/rko/za-odin-den', '/rko/za-odin-den'],
                ['В евро', '/rko/v-evro', '/rko/v-evro'],
                ['Выгодные', '/rko/vygodnye', '/rko/vygodnye'],
                ['Дешевые', '/rko/deshevyj', '/rko/deshevyj'],
                ['С торговым эквайрингом', '/rko/torgovyi-ekvajring', '/rko/torgovyi-ekvajring'],
                ['С интернет-эквайрингом', '/rko/internet-ekvajring', '/rko/internet-ekvajring'],
                ['С зарплатным проектом', '/rko/zarplatnye-proekty', '/rko/zarplatnye-proekty'],
                ['С валютным контролем', '/rko/valyutnyj-kontrol', '/rko/valyutnyj-kontrol'],
                ['С оформлением онлайн', '/rko/onlajn', '/rko/onlajn'],
            ];
        }

        var textHtml = '';
        //console.log(arrayValue.length);

        for (var i = 0; i < arrayValue.length; i++) {

          if (i == 0) {
            textHtml += '<span class="line active" data-val="' + arrayValue[i][1] + '" data-url="' + arrayValue[i][2] + '">' + arrayValue[i][0] + '</span>';
            $('#credit-select2 .active-element').text(arrayValue[i][0]);
            $('#credit-select2 .active-element').attr('data-val',arrayValue[i][1]);
          } else {
            textHtml += '<span class="line" data-val="' + arrayValue[i][1] + '" data-url="' + arrayValue[i][2] + '">' + arrayValue[i][0] + '</span>';
          }
        }
        //console.log(textHtml);

        $('#credit-select2 .hidden-elements').html(textHtml);

        $('#credit-select2 .hidden-elements .line').click(function () {
          var text = $(this).text();
          $(this).parent().parent().find('.active-element').html(text);
          $(this).parent().find('.line').removeClass('active');
          $(this).addClass('active');
        });
      } // end if parent parent is credic select
    });



    $('.reviews').slick({
        dots: false,
        infinite: false,
        speed: 300,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });


    $('.experts').slick({
        dots: false,
        infinite: false,
        speed: 300,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });




   var ArrValues = [
            '- сервис подбора микрозаймов №1 в Рунете',
            '- быстрый и удобный сервис подбора кредитов и карт',
            '- сервис бесплатной проверки кредитного рейтинга',
            '- сервис поиска надежных залоговых компаний',
            '- сервис подбора банков для расчетно-кассового обслуживания',
            '- полезные финансовые статьи, инфографика и обучающие видео',
            '- самый полный каталог микрофинансовых компаний России',
            '- вы скорее всего попали сюда по рекомендации'
                ];
                var typed = new Typed('#typed', {
                strings: ArrValues,
                typeSpeed: 60,
                backSpeed: 0,
                smartBackspace: true, // this is a default
                loop: true
              });


$('.index-cards-count > div').click(function(){
    location.href = $(this).attr('data-url');
});
});











// поиск в сайдбаре для категории 1
$('#slf_zaimy').on('submit',function(){
    slf_zaimy();
    return false;
});

$('#find_by_options-1').on('click',function(){
    slf_zaimy();
});


function slf_zaimy(){
    $('#load_more').show();
    window.number_page = 1;
    var slf_summ = $('#slf_summ').val();
    var slf_time = $('#slf_time').val();
    var slf_percent = $('#slf_percent').val();
    var slf_age = $('#slf_age').val();
    var token = $('meta[name="csrf-token"]').attr('content');

    var options = Array();

    $('.options-list span').each(function(){
        if($(this).find('input:checked')) options.push ($(this).find('input:checked').val());
    });

    window.sidebar_listings['slf_summ'] = slf_summ;
    window.sidebar_listings['slf_time'] = slf_time;
    window.sidebar_listings['slf_percent'] = slf_percent;
    window.sidebar_listings['slf_age'] = slf_age;

    $.ajax({
        type: "GET",
        url: "/actions/load_cards_for_listings",
        //url: "/actions/cards_sorting",
        data: {
            '_token': token,
            'field': window.field,
            'page': 1,
            'listing_id': window.listing_id,
            'count_on_page': window.count_on_page,
            'category_id': 1,
            'section_type': 2,
            'options': options,
            'sort_type': window.sort_type,
            'slf_summ': slf_summ,
            'slf_time': slf_time,
            'slf_percent': slf_percent,
            'slf_age': slf_age,

        },
        success: function(data){
            $('.offers-list').html(data['code']);
            update_img_and_bg();
            if(data['load']){
                $('#load_more').show();
            } else {
                $('#load_more').hide();
            }

        }
    });
}


/*
$(function(){
    $.ajax({
        type: "GET",
        url: "/index-base-cards-load",
        //data: data,
        success: function(data){
            $('.offers-list').prepend(data);
            update_img_and_bg();
            //$('#load_more_index_page').show();
        }
    });
});
*/

window.number_page = 1;
window.listing_id = -1;
window.category_id = 1;
window.count_on_page = 10;
window.field = 'km5';
window.sort_type = 'desc';
window.sidebar_listings = {};
if(document.body.clientWidth > 768){
    //$('header').addClass('fixed');
    $(window).scroll(function() {
        if($(this).scrollTop() != 0) {
            $('header').addClass('fixed');
            $('header').css('border-bottom','1px solid #ddd');
        } else {
            $('header').css('border-bottom','0');
            $('header').removeClass('fixed');
        }
    });
}


$(function(){


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


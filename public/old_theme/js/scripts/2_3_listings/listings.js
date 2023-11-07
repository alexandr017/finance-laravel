function fakeLoader() {
    $('.offers-list').addClass('loading');
    setTimeout(function(){
        $('.offers-list').removeClass('loading');
    }, 700);
}

// поиск в сайдбаре для категории 1
    $('#slf_zaimy').on('submit',function(){
        slf_zaimy();
        return false;
    });

    $('#find_by_options-1').on('click',function(){
        slf_zaimy();
    });
    $('#slf_zaimy').parent().parent().find('.side-block-dart .options-list').on('change', function () {
        slf_zaimy();
    })

    function slf_zaimy(){
        fakeLoader();
        $('#load_more').show();
        window.number_page = 1;
        var slf_summ = $('#slf_summ').val();
        var slf_time = $('#slf_time').val();
        var slf_percent = $('#slf_percent').val();
        slf_percent = slf_percent.replace(',','.');
        var slf_age = $('#slf_age').val();

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
            data: {
                'field': window.field,
                'page': 1,
                'listing_id': window.listing_id,
                'category_id' : window.category_id,
                
                'count_on_page': window.count_on_page,
                'options': options,
                'sort_type': window.sort_type,
                'slf_summ': slf_summ,
                'slf_time': slf_time,
                'slf_percent': slf_percent,
                'slf_age': slf_age

            },
            success: function(data){
                $('.offers-list').html(data['code']);
                showOrHideLoadBtn(data['nextPage']);
            }
        });
    }



// поиск в сайдбаре для категории 2
    $('#slf_rko').on('submit',function(){
        slf_rko();
        return false;
    });

    $('#find_by_options-2').on('click',function(){
        slf_rko();
    });
    $('#slf_rko').parent().parent().find('.side-block-dart .options-list').on('change', function () {
        slf_rko();
    })

    function slf_rko(){
        fakeLoader();
        $('#load_more').show();
        window.number_page = 1;
        var slf_opened = $('#slf_opened').val();
        var slf_maintenance = $('#slf_maintenance').val();
        var slf_count_payment = $('#slf_count_payment').val();

        var options = Array();

        $('.options-list span').each(function(){
            if($(this).find('input:checked')) options.push ($(this).find('input:checked').val());
        });

        window.sidebar_listings['slf_opened'] = slf_opened;
        window.sidebar_listings['slf_maintenance'] = slf_maintenance;
        window.sidebar_listings['slf_count_payment'] = slf_count_payment;

        $.ajax({
            type: "GET",
            url: "/actions/load_cards_for_listings",
            data: {
                'field': window.field,
                'page': 1,
                'listing_id': window.listing_id,
                'category_id' : window.category_id,
                
                'count_on_page': window.count_on_page,
                'options': options,
                'sort_type': window.sort_type,
                'slf_opened': slf_opened,
                'slf_maintenance': slf_maintenance,
                'slf_count_payment': slf_count_payment,

            },
            success: function(data){
                $('.offers-list').html(data['code']);
                showOrHideLoadBtn(data['nextPage']);
            }
        });
    }










// поиск в сайдбаре для категории 3
    $('#slf_zalogi').on('submit',function(){
        slf_zalogi();
        return false;
    });

    $('#find_by_options-3').on('click',function(){
        slf_zalogi();
    });

    $('#slf_zalogi').parent().parent().find('.side-block-dart .options-list').on('change', function () {
        slf_zalogi();
    })

    function slf_zalogi(){
        fakeLoader();
        $('#load_more').show();
        window.number_page = 1;
        var slf_summ = $('#slf_summ').val();
        var slf_time = $('#slf_time').val();
        var slf_percent = $('#slf_percent').val();
        slf_percent = slf_percent.replace(',','.');

        var options = Array();

        $('.options-list span').each(function(){
            if($(this).find('input:checked')) options.push ($(this).find('input:checked').val());
        });

        window.sidebar_listings['slf_summ'] = slf_summ;
        window.sidebar_listings['slf_time'] = slf_time;
        window.sidebar_listings['slf_percent'] = slf_percent;

        $.ajax({
            type: "GET",
            url: "/actions/load_cards_for_listings",
            data: {
                'field': window.field,
                'page': 1,
                'listing_id': window.listing_id,
                'category_id' : window.category_id,
                
                'count_on_page': window.count_on_page,
                'options': options,
                'sort_type': window.sort_type,
                'slf_summ': slf_summ,
                'slf_time': slf_time,
                'slf_percent': slf_percent,

            },
            success: function(data){
                $('.offers-list').html(data['code']);
                showOrHideLoadBtn(data['nextPage']);

            }
        });
    }









// поиск в сайдбаре для категории 4
    $('#slf_credits').on('submit',function(){
        slf_credits();
        return false;
    });

    $('#find_by_options-4').on('click',function(){
        slf_credits();
    });
    $('#slf_credits').parent().parent().find('.side-block-dart .options-list').on('change', function () {
        slf_credits();
    })


    function slf_credits(){
        fakeLoader();
        $('#load_more').show();
        window.number_page = 1;
        var slf_summ = $('#slf_summ').val();
        slf_summ = slf_summ.replace(',','.');
        var slf_time = $('#slf_time').val();
        var slf_age = $('#slf_age').val();
        var options = Array();

        $('.options-list span').each(function(){
            if($(this).find('input:checked')) options.push ($(this).find('input:checked').val());
        });

        window.sidebar_listings['slf_summ'] = slf_summ;
        window.sidebar_listings['slf_time'] = slf_time;
        window.sidebar_listings['slf_age'] = slf_age;

        $.ajax({
            type: "GET",
            url: "/actions/load_cards_for_listings",
            data: {
                'field': window.field,
                'page': 1,
                'listing_id': window.listing_id,
                'category_id' : window.category_id,
                
                'count_on_page': window.count_on_page,
                'options': options,
                'sort_type': window.sort_type,
                'slf_summ': slf_summ,
                'slf_time': slf_time,
                'slf_age': slf_age,

            },
            success: function(data){
                $('.offers-list').html(data['code']);
                showOrHideLoadBtn(data['nextPage']);
            }
        });
    }



// поиск в сайдбаре для категории 5
    $('#slf_credits_cards').on('submit',function(){
        slf_credits_cards();
        return false;
    });

    $('#find_by_options-5').on('click',function(){
        slf_credits_cards();
    });
    $('#slf_credits_cards').parent().parent().find('.side-block-dart .options-list').on('change', function () {
        slf_credits_cards();
    })

    function slf_credits_cards(){
        fakeLoader();
        $('#load_more').show();
        window.number_page = 1;
        var slf_limit_max = $('#slf_limit_max').val();
        slf_limit_max = slf_limit_max.replace(',','.');
        var slf_none_percent_period = $('#slf_none_percent_period').val();
        var slf_age = $('#slf_age').val();
        var slf_percent_min = $('#slf_percent_min').val();
        var options = Array();

        $('.options-list span').each(function(){
            if($(this).find('input:checked')) options.push ($(this).find('input:checked').val());
        });

        window.sidebar_listings['slf_limit_max'] = slf_limit_max;
        window.sidebar_listings['slf_none_percent_period'] = slf_none_percent_period;
        window.sidebar_listings['slf_age'] = slf_age;
        window.sidebar_listings['slf_percent_min'] = slf_percent_min;

        $.ajax({
            type: "GET",
            url: "/actions/load_cards_for_listings",
            data: {
                'field': window.field,
                'page': 1,
                'listing_id': window.listing_id,
                'category_id' : window.category_id,
                
                'count_on_page': window.count_on_page,
                'options': options,
                'sort_type': window.sort_type,
                'slf_limit_max': slf_limit_max,
                'slf_none_percent_period': slf_none_percent_period,
                'slf_age': slf_age,
                'slf_percent_min': slf_percent_min,

            },
            success: function(data){
                $('.offers-list').html(data['code']);
                showOrHideLoadBtn(data['nextPage']);
            }
        });
    }



    // поиск в сайдбаре для категории 6
    $('#slf_debit_cards').on('submit',function(){
        slf_debit_cards();
        return false;
    });

    $('#find_by_options-6').on('click',function(){
        slf_debit_cards();
    });
    $('#slf_debit_cards').parent().parent().find('.side-block-dart .options-list').on('change', function () {
        slf_debit_cards();
    })

    function slf_debit_cards(){
        fakeLoader();
        $('#load_more').show();
        window.number_page = 1;
        var slf_maintenance = $('#slf_maintenance').val();
        var slf_opened = $('#slf_opened').val();
        var slf_age = $('#slf_age').val();
        var options = Array();


        $('.options-list span').each(function(){
            if($(this).find('input:checked')) options.push ($(this).find('input:checked').val());
        });

        window.sidebar_listings['slf_maintenance'] = slf_maintenance;
        window.sidebar_listings['slf_opened'] = slf_opened;
        window.sidebar_listings['slf_age'] = slf_age;

        $.ajax({
            type: "GET",
            url: "/actions/load_cards_for_listings",
            data: {
                'field': window.field,
                'page': 1,
                'listing_id': window.listing_id,
                'category_id' : window.category_id,
                
                'count_on_page': window.count_on_page,
                'options': options,
                'sort_type': window.sort_type,
                'slf_maintenance': slf_maintenance,
                'slf_opened': slf_opened,
                'slf_age': slf_age,

            },
            success: function(data){
                $('.offers-list').html(data['code']);
                showOrHideLoadBtn(data['nextPage']);
            }
        });
    }







    // поиск в сайдбаре для категории 4
    $('#slf_autocredits').on('submit',function(){
        slf_autocredits();
        return false;
    });

    $('#find_by_options-8').on('click',function(){
        slf_autocredits();
    });
    $('#slf_autocredits').parent().parent().find('.side-block-dart .options-list').on('change', function () {
        slf_autocredits();
    })

    function slf_autocredits(){
        fakeLoader();
        $('#load_more').show();
        window.number_page = 1;
        var slf_summ = $('#slf_summ').val();
        slf_summ = slf_summ.replace(',','.');
        var slf_time = $('#slf_time').val();
        var slf_age = $('#slf_age').val();
        var options = Array();

        $('.options-list span').each(function(){
            if($(this).find('input:checked')) options.push ($(this).find('input:checked').val());
        });

        window.sidebar_listings['slf_summ'] = slf_summ;
        window.sidebar_listings['slf_time'] = slf_time;
        window.sidebar_listings['slf_age'] = slf_age;

        $.ajax({
            type: "GET",
            url: "/actions/load_cards_for_listings",
            data: {
                'field': window.field,
                'page': 1,
                'listing_id': window.listing_id,
                'category_id' : window.category_id,
                
                'count_on_page': window.count_on_page,
                'options': options,
                'sort_type': window.sort_type,
                'slf_summ': slf_summ,
                'slf_time': slf_time,
                'slf_age': slf_age,

            },
            success: function(data){
                $('.offers-list').html(data['code']);
                showOrHideLoadBtn(data['nextPage']);
            }
        });
    }







    // поиск в сайдбаре для категории 6

    $('#find_by_options-10').on('click',function(){
        slf_ipoteki();
    });


    function slf_ipoteki(){
        fakeLoader();
        $('#load_more').show();
        window.number_page = 1;
        //var slf_maintenance = $('#slf_maintenance').val();
        //var slf_opened = $('#slf_opened').val();
        //var slf_age = $('#slf_age').val();
        var options = Array();


        $('.options-list span').each(function(){
            if($(this).find('input:checked')) options.push ($(this).find('input:checked').val());
        });

        //window.sidebar_listings['slf_maintenance'] = slf_maintenance;
        //window.sidebar_listings['slf_opened'] = slf_opened;
        //window.sidebar_listings['slf_age'] = slf_age;

        $.ajax({
            type: "GET",
            url: "/actions/load_cards_for_listings",
            data: {
                'field': window.field,
                'page': 1,
                'listing_id': window.listing_id,
                'category_id' : window.category_id,
                
                'count_on_page': window.count_on_page,
                'options': options,
                'sort_type': window.sort_type,
                //'slf_maintenance': slf_maintenance,
                //'slf_opened': slf_opened,
                //'slf_age': slf_age,

            },
            success: function(data){
                $('.offers-list').html(data['code']);
            }
        });
    }


    $('#slf_bank').on('focus', function(){
        $.ajax({
            type: "GET",
            url: "/actions/get_banks_names",
            success: function(data){
                $('#slf_bank + div').html('');
                for (i=0; i<data.length; i++) {
                    $('#slf_bank + div').append("<div>" + data[i].name + "</div>");
                }
            }
        });
    });

    $("#slf_bank").keyup(function(){
        _this = this;
        $.each($(".hidden-banks div"), function() {
            if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                $(this).hide();
            else{
                $(this).show();
            }
        });
        if($('#search-bank').val() == '')
            $('.hidd-elements').hide();
        else
            $('.hidd-elements').show();

        $('.hidden-banks div').css('border-bottom:','1px solid #ccc;');
        var i = 1;
        $('.hidden-banks div[style*=block]').each(function(){
           if(i == $('.hidden-banks div[style*=block]').length){
               $(this).css('border','none');
           }
           i++;
        });

    });

    $(document).on("click", '.hidden-banks div', function() {
    //$('.hidden-banks div').on('click',function(){
        $("#slf_bank").val($(this).text());
        $('.hidden-banks div').hide();
        console.log($(this).text());
    })


    $('#find-bank-btn').on('click',function(e){
        e.preventDefault();
        var bank = $("#slf_bank").val();
        var listing_id = window.listing_id;
        $.ajax({
            type: "GET",
            data: {bank:bank,listing_id:listing_id},
            url: '/actions/get_banks_by_name',
            success: function (data) {
                $('.offers-list').html(data);
                var options_inputs = $('.side-block-dart .options-list input');
                for (options_input of options_inputs) {
                    options_input.checked = false;
                };
                var sidebar_search_inputs = $('.sidebar-search-first-block input');
                for (sidebar_search_input of sidebar_search_inputs) {
                    sidebar_search_input.value = '';
                };
                $('#load_more').hide();
                $('.clear-search-bank').css('display','inline-block');
            }
        });
        return false;

    });

    $('.clear-search-bank').click(function(){
        document.location.reload();
    });



    /* залоги подгрузка типов имуществ*/
    $('#zalogi_select .line').on('click',function(){
        var alias = $(this).attr('data-val');
        var token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "GET",
            url: "/actions/zalogi_child_types",
            data: {
                '_token': token,
                'alias': alias,

            },
            success: function(data){
                $('#zalogi_select_result').html(data);
                $('#zalogi_select_result').parent().find('b').text('Тип имущества');

            }
        });
    });

    /* переход на дочернуюю страницу в залогах */
    $('.go-to-zalogi-page').on('click',function(){
        var city = $('#zalogi_select').parent().find('b').attr('data-val');
        var page = $('#zalogi_select_result').parent().find('b').attr('data-val');
        if((city == undefined) || (page == undefined)) {
            alert('Вы не выбрали город и/или тип имущества');
            return;
        }
        location.href = city + page;
    });


    $(function(){
        $('img.def_load').each(function(){
            $(this).attr('src',$(this).attr('data-src'));
        })
    })

// показать всю форму
    $('#show_full_form').on('click',function(){
        $(this).hide();
        $(this).closest('form').find('.display_none').show();
    });


/*

    $('#popular_banks_slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 992,
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

*/

/************************************************************************/


$('.change-city').on('click',function () {
    $('#citiesModal').addClass('in');
    $.ajax({
        type: "GET",
        url: "/actions/zalogi_cities",
        success: function(data){
            $('.cities').html('');
            // data = JSON.parse(data);
            var str ='';
            data.forEach(function(items) {
                str += '<div class="cities_row">';
                $.each( items, function(key, value) {
                    if(key != ''){
                        str += '<div class="cities_block">';
                        str += `<h5>${key}</h5>`;
                        $.each( value, function(item,city) {
                            str += `<a class="form-line" href=/${city[0]}>${city[1]}</a>`;
                        });
                        str += '</div>';
                    }
                });
                str += '</div><br>';
            });
            $('.cities').append(str);
        }
    });
});
$("#search-city").keyup(function(){
    _this = this;
    $.each($(".find-city .cities .form-line"), function() {
        if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1){
            $(this).hide();
            if($(this).parent().find('div').attr('style') == '' || $(this).parent().find('div').attr('style') == undefined){
                $(this).parent().find('h5').show();
            }
        } else{
            $(this).show();
            $(this).parent().find('h5').show();
        }
    });
});


function showOrHideLoadBtn (count) {
    console.log('count = ' + count);
    if(count > 0){
        $('#load_more').show();
        $('#load_more_index_page').show();
    } else {
        $('#load_more').hide();
        $('#load_more_index_page').hide();
    }

    if(count > 10)
        var labelCount = 10;
    else
        var labelCount = count;

    $("#load_more").find('span').html(labelCount);
}




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
    window.sort_type = sort_type;
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
    fakeLoader();
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


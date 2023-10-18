@extends('frontend.layouts.app')
@section ('title', $page->title)
@section ('h1', $page->h1)
@section ('meta_description', $page->meta_description)

<?php
$category_url = '/zalogi';
$print_text = array(
    'Займы под залог по всей России - деньги под ПТС, автомобиль и недвижимость',
    'Займы под залог по всей России - только проверенные предложения в вашем городе',
    'Займы под залог по всей России - быстрый поиск по самым выгодным предложениям',
    'Займы под залог по всей России - крупные суммы без строгих требований к заемщикам',
    'Займы под залог по всей России - все об условиях лучших залоговых компаний'
);
$advantages = array(
    '200 городов РФ',
    '100+ залоговых компаний',
    'Рейтинг лучших с отзывами',
    'Бесплатно для вас'
);
$page->paragraph = 'Простой способ получить займ под залог имущества по всей России. <br> Предложения более 100 залоговых компаний в 200 городах России с подробной информацией без звёздочек*.'
?>

@section('cities-first-section')
    @include("frontend.cities.includes.city_first_section.zalogi")
@endsection


@section('content')

    @include('frontend.includes.breadcrumbs')
    <section class="container main">
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <h1 class="p-h1">{{$page->h1}}</h1>
                <?php echo Shortcode::compile(System::nofollow($page->text_before)); ?>

                <div class="companies-slider">
                    @foreach($zalogiIndexCompanies as $zalogiIndexCompanie)
                        @if($zalogiIndexCompanie->alias != null)
                            <a href="{{$category_url}}/{{$zalogiIndexCompanie->alias}}">
                                <img loading="lazy" src="{{$zalogiIndexCompanie->img}}"
                                     alt="{{$zalogiIndexCompanie->h1}}">
                            </a>
                        @endif
                    @endforeach
                </div>


                <div class="zalogi_regions d-flex">
                    <div class="zalogi_region_div">
                        <ul>
                            @foreach($pagesArr as $region => $city)
                                <li data-id="{{$region}}">{{$region}}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="zalogi_regions_cities">
                        @foreach($pagesArr as $region=>$city)
                            <div class="row" data-id="{{$region}}">
                                <div class="regions_cities_block">
                                    @foreach( $city as $key => $value)
                                        <div class="region_city"><a
                                                    href="{{$category_url}}/{{$value->alias}}">{{$value->imenitelny}}</a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>



                <h2 class="zalogi-h2">Список организаций</h2>
                <div class="companies-wrap">
                    @foreach($companies as $key => $company)
                        <a href="{{$category_url}}/{{$company->alias}}" class="rcl-a"
                           style="background: url({{$company->img}})">
                        </a>

                    @endforeach
                </div>


                <?php echo Shortcode::compile(System::nofollow($page->text_after)); ?>
            </div><?php /* end col-md-9 */ ?>
            <div class="col-lg-3 d-lg-block d-xs-none d-none">
                @include('frontend.includes.sidebar')
            </div><?php /* md-3 */ ?>
        </div><?php /*row */ ?>
    </section>
@endsection
@section('additional-scripts')
    <script src="/old_theme/js/typed.min.js"></script>
<script>
    function initCompaniesSlider() {
        if (document.getElementsByClassName('companies-slider').length > 0) {
            slideShow({
                element: '.companies-slider',
                slidesToShow: 4,
                slidesToScroll: 1,
                circleScroll: true,
                height:'92',
                customArrowsTop:'15',
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
                            slidesToScroll: 1,
                            height:'102'
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            height:'120'
                        }
                    }
                ]
            })
        }
    }
    initCompaniesSlider();
</script>
    @if(Auth::id() == 12467 || Auth::id() == 30154 || Auth::id() == 110510)

    @else
        <script>
            var ArrValues = [
                @foreach($print_text as $value)
                    '{{str_replace("\r",'',$value)}}',
                @endforeach
            ];
            var typed = new Typed('#typed', {
                strings: ArrValues,
                typeSpeed: 60,
                backSpeed: 0,
                smartBackspace: true,
                loop: true
            });

            var linkBefore = '';

            $('#zalogi_select_result').parent().css('opacity', '0.5');
            $('#zalogi_select_result').next().css('pointer-events', 'none');
            $('#zalogi_select_result').next().css('opacity', '0.5');
            $(document).ready(function () {
                var code = $('#credit-select .hidden-elements').html();
                $('.hidd-text').html(code);

                // $("#search-city").keyup(function () {
                //     _this = this;
                //     $.each($(".find-city .hidd-text .line"), function () {
                //         if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                //             $(this).hide();
                //         else
                //             $(this).show();
                //     });
                //     if ($('#search-city').val() == '')
                //         $('.hidd-text').hide();
                //     else
                //         $('.hidd-text').show();
                // });

                // $(document).on('click', '.find-city .hidd-text .line', function () {
                //     //alert($(this).attr('data-val'));
                //     location.href = $(this).attr('data-val');
                // });
                document.getElementById('search-city').addEventListener("keyup", function (event) {
                    let searchCityValue = event.target.value.toLowerCase();
                    let findCityBlock = document.getElementsByClassName('find-city')[0];
                    let hiddTextBlock = findCityBlock.getElementsByClassName('hidd-text')[0];
                    let findCityLines = hiddTextBlock.getElementsByClassName('line');
                    for (let i=0; i < findCityLines.length; i++) {
                        if(findCityLines[i].innerText.toLowerCase().indexOf(searchCityValue) === -1){
                            findCityLines[i].style.display = 'none';
                        } else {
                            findCityLines[i].style.display = 'block';
                            findCityLines[i].classList.add('finded-cities-line');
                        }
                    }
                    if(searchCityValue == ''){
                        hiddTextBlock.style.display = 'none';
                    }else {
                        hiddTextBlock.style.display = 'block';
                    }
                    var findedCitiesLines = hiddTextBlock.getElementsByClassName('finded-cities-line');
                    for (let i = 0; i < findedCitiesLines.length; i++) {
                        findedCitiesLines[i].addEventListener("click", function (event) {
                            let cityName = event.target.innerText;
                            let cityAlias = event.target.dataset.val;
                            let zalogiSelectBlock = document.getElementById('zalogi_select');
                            let selectedCity = zalogiSelectBlock.parentNode.children[0];
                            selectedCity.innerText = cityName;
                            selectedCity.dataset.val = cityAlias;
                            hiddTextBlock.style.display = 'none';
                            document.getElementById('search-city').value = '';
                            get_type(cityAlias);
                            $('#zalogi_select_result').parent().css('opacity', '1');
                            $('#zalogi_select_result').next().css('pointer-events', 'auto');
                            $('#zalogi_select_result').next().css('opacity', '1');
                        }, false);
                    }
                    return;
                }, false);



                $('.hidden-elements .line').on('click', function () {
                    var text = $(this).text();
                    $(this).parent().parent().find('.active-element').html(text);
                    $(this).parent().find('.line').removeClass('active');
                    $(this).addClass('active');
                    get_city_type($(this));
                });

                // $('.go-to-zalogi-page').on('click', function () {
                //     if (linkBefore == '') {
                //         return false;
                //     } else {
                //         location.href = linkBefore;
                //     }
                // });
                document.getElementsByClassName('go-to-zalogi-page')[0].addEventListener("click", function (event) {
                    let cityAlias = document.getElementById('zalogi_select').parentNode.children[0].dataset.val;
                    let tipZaloga = document.getElementById('zalogi_select_result').parentNode.children[0].dataset.val;
                    tipZaloga = (tipZaloga != undefined) ? tipZaloga : '';
                    let linkBefore = cityAlias+tipZaloga;
                    if (linkBefore == '') {
                        return false;
                    } else {
                        location.href = linkBefore;
                    }
                }, false);

                function get_city_type(elem) {
                    if (elem.hasClass('column1')) {
                        linkBefore = elem.data('val');
                        $('#zalogi_select_result').parent().css('opacity', '1');
                        $('#zalogi_select_result').next().css('pointer-events', 'auto');
                        $('#zalogi_select_result').next().css('opacity', '1');
                        get_type(linkBefore);
                    } else {
                        linkBefore += elem.data('val');
                    }
                }

                /* залоги подгрузка типов имуществ*/
                function get_type(linkBefore) {
                    var token = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        type: "GET",
                        url: "/actions/zalogi_child_types",
                        data: {
                            '_token': token,
                            'alias': linkBefore,
                        },
                        success: function (data) {
                            // data = JSON.parse(data);
                            var zalogi_select_content = '';
                            $.each(data, function (key, item) {
                                zalogi_select_content += '<span class="line" data-val="/' + item.alias + '">' + item.name + '</span>';
                            });
                            $('#zalogi_select_result').html(zalogi_select_content);
                            $('#zalogi_select_result').parent().find('b').text('Тип имущества');
                            $('.hidden-elements .line').on('click', function () {
                                get_city_type($(this));
                            });
                        }
                    });
                };
                $('.zalogi_region_div ul li:first-child').addClass('active_region');
                $('.zalogi_regions_cities .row:first-child').addClass('active_region_cities');
                $('.zalogi_region_div ul li').on('click', function () {
                    var hide_region = $('.zalogi_region_div ul li.active_region').data('id');
                    $('.zalogi_region_div ul li.active_region').removeClass('active_region');
                    $(this).addClass('active_region');
                    var show_region = $(this).data('id');
                    $("div").find("[data-id='" + hide_region + "']").removeClass('active_region_cities');
                    $("div").find("[data-id='" + show_region + "']").addClass('active_region_cities');
                    var token = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        type: "POST",
                        url: "actions/zalogi_companies",
                        data: {
                            '_token': token,
                            'region': show_region,
                        },
                        success: function (data) {
                            var items = '';
                            for (let city of data) {
                                if (city.alias != null) {
                                    items += '<a href="' + city.url + '/' + city.alias + '"><img src="' + city.img + '"  alt="' + city.h1 + '"></a>'
                                }
                            }
                            //$('.companies-slider').slick('unslick');
                            $('.companies-slider').html(items);
                            initCompaniesSlider();
                            //$('.companies-slider').slick(add_slick_sliders(), items);
                        }
                    });
                });
                //$('.companies-slider').slick(add_slick_sliders());

                function add_slick_sliders() {
                    return {
                        dots: false,
                        infinite: true,
                        speed: 300,
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        responsive: [
                            {
                                breakpoint: 992,
                                settings: {
                                    slidesToShow: 3,
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
                    }
                }
            });
        </script>
    @endif
@endsection

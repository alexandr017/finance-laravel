@extends('site.v3.layouts.app')
@section ('title', 'Страница не найдена - #FinanceRu')
@section ('h1', '404')
@section ('meta_description', '')

@section('content')

    <?php $breadcrumbs[]['h1'] = '404'; ?>
    @include('site.v3.modules.includes.breadcrumbs')

    <section class="container main">
        <div class="wrapper" style="padding:10px 0 20px">
            <div class="text-block" style="text-align: center;">
                <h1 style="font-size:200px;font-weight:bold">404</h1>
                <h3>К сожалению, такой страницы не существует</h3>
                <br>
                <?php /*
                <p class="first-404-p">Вы можете использовать поиск по сайту:</p>
                <div class="search-form2" style="display:block">
                    <div class="container search-wrap-form">
                        <div class="wrapper">
                            <form action="/search" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input id="searchInputBySite2" type="text" name="s" placeholder="Введите запрос, например Тинькофф" value="" autocomplete="off">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <ul id="search-hint2"></ul>
                    </div>
                </div>
  */ ?>
                <p>Перейти на интересующий вас раздел:</p>

                <ul class="menu-404">
                    <li><a href="/zaimy">Займы</a></li>
                    <li><a href="/kredity">Кредиты</a></li>
                    <li><a href="/avtokredity">Автокредиты</a></li>
                    <li><a href="/kreditnye-karty">Кредитные карты</a></li>
                    <li><a href="/debetovye-karty">Дебетовые карты</a></li>
                    <li><a href="/vklady">Вклады</a></li>
                    <li><a href="/ipoteka">Ипотеки</a></li>
                    <li><a href="/rko">РКО</a></li>
                </ul>
                <br class="clearfix">
            </div>
        </div>
    </section>
@endsection

@section('additional-scripts')
    <script>
        $("#searchInputBySite2").bind("change paste keyup", function() {

            if($(this).val().length > 2){
                var token = $('meta[name="csrf-token"]').attr('content');
                var value = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "/forms/search_hint",
                    data: {
                        '_token': token,
                        's': value
                    },
                    success: function(data){
                        if(data.length>0){
                            var res = '';
                            for(i=0; i<data.length; i++){
                                if(data[i]!= null) res = res + "<li>" + data[i] + "</li>";
                            }
                            $('#search-hint2').html(res);
                            $('#search-hint2').show('block');
                        }
                    }
                });
            } else {
                $('#search-hint2').hide();
                $('#search-hint2').html('');
            }
        });

        $(document).on('click','#search-hint2 li',function(){
            $('#searchInputBySite2').val($(this).text());
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



        var join = $('.search-form2'),
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
            if ($(event.target).closest(".search-form2").length) return;
            join.hide();
            indexClick = 0;
            joinLink.removeClass('fa-remove').addClass('.header-search');
            event.stopPropagation();
        });
    </script>
@endsection


@section('additional-styles')
    <style>
        .text-block{
            text-align: center;
            max-width: 700px;
            margin: auto;
        }
        #search-hint2 {
            display: none;
            max-height: 180px;
            overflow: auto;
            padding: 0 20px;
        }
        #search-hint2 li {
            list-style-type: none;
            padding: 5px 0;
            cursor: pointer;
            border-bottom: 1px solid #f5f5f5;
            text-align: left;
        }
        .menu-404{float: left;;padding: 0;margin: 0;}
        .menu-404 li{display: inline-block;
            margin: 0;
            width: 32%;
            margin-bottom: 3px;}
        .menu-404 li a{color: #292929;
            display: block;
            padding: 10px;
            border: 1px solid #ccc;}
        .first-404-p{
            margin-top: 23px;
        }
        .menu-404 li a:hover{
            background: #063;
            border-bottom: 1px solid #063;
            color: #fff;
            text-decoration: none;
        }
        @media screen and (max-width: 768px){

            .menu-404 li{width: 100%;}

            h1{
                font-size: 100px !important;
            }
            .main>.wrapper{
                padding: 50px 0 !important;
            }
            .first-404-p{
                margin-top: 10px;
            }
        }
    </style>
@endsection
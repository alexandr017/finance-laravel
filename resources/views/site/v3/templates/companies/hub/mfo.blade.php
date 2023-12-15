@extends('site.v3.layouts.app')
@section ('title', $page->title)
@section ('h1', $page->h1)
@section ('meta_description', $page->meta_description)

@section('additional-styles')
    <link rel="stylesheet" href="/old_theme/css/modules/init/4_hubs/hubs.css">
@endsection

@section('content')

    @include('site.v3.modules.includes.breadcrumbs')

    <?php $section_type = 4; ?>
    <section class="container main">
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <h1 class="p-h1">{{$page->h1}}</h1>
                {!! $page->lead !!}

                <input id="search-company" type="text" placeholder="Поиск компании по названию...">

                @include("site.v3.templates.listings.includes.sorting_fields.1")


                <div class="companies_blocks zajm_block offers-list">
                    <?php $i=0; ?>


                    @foreach($cards as $card)
                        @include('site.v3.modules.cards.minimal.card')
                        <?php $i++; ?>
                        <?php if($i>9) break; ?>
                    @endforeach
                </div>

                @if(count($cards)>10)
                    <div class="text-center">
                        <?php $countPrefix = (count($cards) <=20) ? (count($cards) - 10) : 10 ?>
                        <button class="form-btn1" id="load_more">Показать ещё <span>{{$countPrefix}}</span></button>
                    </div>
                @endif

                <div class="text-wrap">
                    {!! TagsParser::compile(Shortcode::compile($page->content)) !!}
                </div>

            </div><?php /* end col-md-9 */ ?>
            <div class="col-lg-3 d-lg-block d-xs-none d-none">
                @include('site.v3.modules.includes.sidebar')
            </div><?php /* md-3 */ ?>
        </div><?php /*row */ ?>
    </section>
@endsection

@section('listings-scripts')
    <?php /*
<script defer src="/old_theme/js/scripts/4_hubs/hubs.js?v=3"></script>
*/ ?>

    <script>
        window.category_id = {{$categoryID}};
        window.count_on_page = 10;
        window.number_page = 1;
    </script>

        <script defer src="/old_theme/js/modules/sorting-fields/sorting-fields.js"></script>
        <script defer src="/old_theme/js/modules/hubs/hub.js"></script>

        <script>

            $(function(){

                $('.sorting-line span').on('click',function(){
                    $('#load_more').show();
                    var field = $(this).parent().attr('data-field');
                    window.field = field;

                    var token = $('meta[name="csrf-token"]').attr('content');


                    /*
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
                                $(this).parent().find('i').addClass('fa-arrow-circle-down').addClass('fa');
                                $(this).parent().addClass('active');

                            }
                    */
                    var sort_type = window.sort_type; // !!
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
                    data['category_id'] = 1;
                    data['listing_id'] = 1; // не используется
                    data['count_on_page'] = window.count_on_page;
                    data['sort_type'] = sort_type;

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
                data['listing_id'] = 1; // не используется
                data['category_id'] = window.category_id;
                data['count_on_page'] = window.count_on_page;
                data['options'] = options;
                data['sort_type'] = window.sort_type;
                data['category_id'] = 1;


                for(var key in window.sidebar_listings) {
                    data[key] = window.sidebar_listings[key];
                }

                offsetTop = $(window).scrollTop();

                $.ajax({
                    type: "GET",
                    url: 'actions/load_cards_for_listings',
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
            $("#search-company").bind("change paste keyup", function() {
                var search_term = $(this).val().toLowerCase();

                if($(this).val().length>=2){
                    $('.one-offer').each(function(val){
                        var title = $(this).find('.card-mn-name');
                        var lower_case_title = title[0].innerHTML.toLowerCase();
                        if(lower_case_title.indexOf(search_term) == -1){
                            $(this).css('display','none');
                        } else {
                            $(this).css('display','block');
                        }
                    })
                }else{
                    $('.one-offer').css('display','block');
                }
            });

            $(document).on('click', '.bvc-read', function (){
                $(this).next().toggleClass('display_hidden_line');
                $(this).find('i').toggleClass('fa-angle-up').toggleClass('fa-angle-down');
            });

        </script>
@endsection

@section('structured-data')
    @parent
    @include('site.structured-data.ProductListing', compact('cards', 'page'))
@endsection
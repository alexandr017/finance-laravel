@extends('frontend.layouts.app')
@section ('title', $companies_category->title)
@section ('h1', $companies_category->h1)
@section ('meta_description', $companies_category->meta_description)

@section('additional-styles')
<link rel="stylesheet" href="/old_theme/css/modules/init/4_hubs/hubs.css">
@endsection

@section('content')

@include('frontend.includes.breadcrumbs')

<section class="container main">
    <div class="row">
        <div class="col-lg-9 col-md-12">
        <h1 class="p-h1">{{$companies_category->h1}}</h1>
        {!! $companies_category->text_before !!}

        @include('frontend.companies.hubs_includes.sorting_fields.' . $companies_category->card_category_id)

            <?php $className = '';
            switch ($companies_category->card_category_id) {
                case 1: $className = 'zajm_block'; break;
                case 2: $className = 'rko_block'; break;
                case 4: $className = 'credits_block'; break;
                case 5: $className = 'credit_cards_block'; break;
                case 6: $className = 'debit_cards_block'; break;
                case 9: $className = 'cards_cache_back_block'; break;
                default: $className = 'zajm_block';
            } ?>
        <div class="companies_blocks {{$className}} offers-list">
        <?php $i=0; ?>
        @foreach($cards as $card)
            @include('frontend.cards.hubs.pc_and_mob.' . $card->category_id , ['card' => $card])
            <?php $i++; ?>
            <?php if($i>9) break; ?>
        @endforeach
        </div>

        @if(count($cards)>10)
            <div class="text-center">
                <?php $countPrefix = (count($cards) <=20) ? (count($cards) - 10) : 10 ?>
                <button class="form-btn1" id="load_more">Показать ещё <span>{{$countPrefix}}</span></button>
                <br>
                <br>
            </div>
        @endif

        <div class="text-wrap">
            {!! TagsParser::compile(Shortcode::compile($companies_category->text_after)) !!}
        </div>

        </div><?php /* end col-md-9 */ ?>
        <div class="col-lg-3 d-lg-block d-xs-none d-none">
            @include('frontend.includes.sidebar')
        </div><?php /* md-3 */ ?>
    </div><?php /*row */ ?>
</section>
@endsection

@section('listings-scripts')
<?php /*
<script defer src="/old_theme/js/scripts/4_hubs/hubs.js?v=3"></script>
*/ ?>

<script>
    window.category_id = {{$card_category_id}};
    window.count_on_page = 10;
    window.number_page = 1;
</script>

@if(Auth::id() == 12467 || Auth::id() == 92879)
    <script defer src="/old_theme/js/modules/sorting-fields/sorting-fields.js"></script>
    <script defer src="/old_theme/js/modules/hubs/hub.js"></script>
@else

    <script>

        $(function(){


            $('.sorting-line span').on('click',function() {
                if ($(this).parent().hasClass('active')) {
                    if ($(this).parent().find('i').hasClass('fa-arrow-circle-up')) {
                        $(this).parent().find('i').removeClass('fa-arrow-circle-up').addClass('fa-arrow-circle-down');
                        var sort_type = 'desc';
                    } else {
                        var sort_type = 'asc';
                        $(this).parent().find('i').addClass('fa-arrow-circle-up').removeClass('fa-arrow-circle-down');
                    }
                    window.sort_type = sort_type;
                    window.default_sorting_counter = 0;
                } else {
                    $('.sorting-line li').each(function () {
                        $(this).removeClass('active');
                        $(this).find('i').attr('class', '');
                    });
                    $(this).parent().find('i').addClass('fa-arrow-circle-down').addClass('fa');
                    $(this).parent().addClass('active');
                }
            });


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
                data['category_id'] = window.category_id;
                data['count_on_page'] = window.count_on_page;
                data['sort_type'] = sort_type;

                $.ajax({
                    type: "GET",
                    url: "/actions/load_cards_for_hubs",
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
                url: '/actions/load_cards_for_hubs',
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
        $("#search-company").bind("change paste keyup", function() {
            var search_term = $(this).val().toLowerCase();

            if($(this).val().length>=2){
                $('.companies-flex-item').each(function(val){
                    var title = $(this).find('.company_title');
                    var lower_case_title = title[0].innerHTML.toLowerCase();
                    if(lower_case_title.indexOf(search_term) == -1){
                        $(this).css('display','none');
                    } else {
                        $(this).css('display','block');
                    }
                })
            }else{
                $('.companies-flex-item').css('display','block');
            }
        });

        $(document).on('click', '.bvc-read', function (){
            $(this).next().toggleClass('display_hidden_line');
            $(this).find('i').toggleClass('fa-angle-up').toggleClass('fa-angle-down');
        });

    </script>

@endif


@endsection

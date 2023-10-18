@extends('frontend.layouts.app')
@section ('title', $page->title)
@section ('h1', $page->h1)
@section ('meta_description', $page->meta_description)

@section('content')

    @include('frontend.includes.breadcrumbs')


    <div class="first-block about">
        <div class="container">
            <div class="jamper">
                <div class="row">
                    <div class="col-md-7 col-sm-12">
                        <p class="first">Цель нашего сайта – помочь вам выбрать лучшее предложение в ситуации, когда срочно требуются деньги. С нашей помощью вы сэкономите время, силы и деньги при выборе и оформлении займа, кредита, карты или другого финансового продукта.
                        </p>
                    </div>
                    <div class="col-md-5 col-sm-12">
                        <p class="two">
                            На нашем сайте вы узнаете об условиях финансовых продуктов в российских банках и микрофинансовых организациях, и сможете выбрать подходящее для вас. Мы предоставляем свои услуги бесплатно и не навязываем невыгодные для клиентов предложения. У нас представлены только надежные компании и только проверенные предложения от них.
                        </p>
                    </div>
                </div>
                <div class="d-flex space-around line-bottom-above">
                    <div class="pret">
                        <i class="fa fa-check-circle"></i><span>1000+  банков и МФК</span>
                    </div>
                    <div class="pret">
                        <i class="fa fa-check-circle"></i><span>12 000+ пользователей</span>
                    </div>
                    <div class="pret">
                        <i class="fa fa-check-circle"></i><span>Помогли 134556 россиянам</span>
                    </div>
                    <div class="pret">
                        <i class="fa fa-check-circle"></i><span> 5 500+ отзывов</span>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <section class="container main single-page">
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <h1 class="p-h1">{{$page->h1}}</h1>
                {!! Shortcode::compile($page->content) !!}
            </div><?php /* end col-md-9 */ ?>
            <div class="col-lg-3 d-lg-block d-xs-none d-none">
                @include('frontend.includes.sidebar')
            </div><?php /* md-3 */ ?>
        </div><?php /*row */ ?>
    </section>

@endsection


@section('additional-scripts')
    <script src="/old_theme/js/scripts/1_pages/about.js?id=3"></script>
@endsection
@extends('site.v3.layouts.app')
@section ('title', 'Ошибка 500 - #FinanceRu')
@section ('h1', '500')
@section ('meta_description', '')

@section('content')

    <?php $breadcrumbs[]['h1'] = '500'; ?>
    @include('site.v3.modules.includes.breadcrumbs')

    <section class="container main">
        <div class="wrapper" style="padding:10px 0 20px">
            <div class="text-block" style="text-align: center;">
                <h1 style="font-size:200px;font-weight:bold">500</h1>
                <h3>Скоро починим попробуйте еще раз позже</h3>
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

                <br class="clearfix">
            </div>
        </div>
    </section>
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
@extends('frontend.layouts.app')
@section ('title', $page->h1.' ВсеЗаймыОнлайн')
@section ('h1', $page->h1)
@section ('meta_description', $page->short_text)

@section('content')

    @include('frontend.includes.breadcrumbs')

    <article class="container main single-page">
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <h1 class="p-h1">{{$page->h1}}</h1>
                <?php echo Shortcode::compile(System::nofollow($page->content)); ?>
            </div><?php /* end col-md-9 */ ?>
            <div class="col-lg-3 d-lg-block d-xs-none d-none">
                @include('frontend.includes.sidebar')
            </div><?php /* md-3 */ ?>
        </div><?php /*row */ ?>
    </article>

@endsection
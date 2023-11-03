@extends('site.v3.layouts.app')
@section ('title', $page->title)
@section ('h1', $page->h1)
@section ('meta_description', $page->meta_description)

@section('content')

    @include('site.v3.modules.includes.breadcrumbs')

    <section class="container main single-page">
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <h1 class="p-h1">{{$page->h1}}</h1>
                {!! TagsParser::compile(Shortcode::compile($page->content)) !!}
            </div><?php /* end col-md-9 */ ?>
            <div class="col-lg-3 d-lg-block d-xs-none d-none">
                @include('site.v3.modules.includes.sidebar')
            </div><?php /* md-3 */ ?>
        </div><?php /*row */ ?>
    </section>

@endsection
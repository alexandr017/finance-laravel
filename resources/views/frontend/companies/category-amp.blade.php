@extends('frontend.layouts.amp')
@section ('title', $companies_category->title)
@section ('h1', $companies_category->h1)
@section ('meta_description', $companies_category->meta_description)

@section('content')

@include('frontend.includes.breadcrumbs')

<section class="container main single">
    <div class="row">
        <div class="col-lg-12 col-md-12">
        <h1 class="p-h1">{{$companies_category->h1}}</h1>
        {!! $companies_category->text_before !!}
        @if(file_exists( base_path() . '/resources/views/frontend/companies/hubs_includes/tables/'.$companies_category->id.'.blade.php'))
        @include('frontend.companies.hubs_includes.tables.'.$companies_category->id)
        @else
        <p class="alert alert-info">Ошибка чтения данных.</p>
        @endif
        {!! AMP::render(Shortcode::compile($companies_category->text_after)) !!}

        </div><?php /* end col-md-12 */ ?>
    </div><?php /*row */ ?>
</section>

@endsection
@extends('frontend.layouts.amp')
@section ('title', $page->title)
@section ('h1', $page->h1)
@section ('meta_description', $page->meta_description)

@section('content')

@include('frontend.includes.breadcrumbs')

<section class="container main">
    <div class="row">
        <div class="col-lg-12 col-md-12">
        <h1 class="p-h1">{{$page->h1}}</h1>
        <?php echo AMP::render(Shortcode::compile(System::nofollow($page->content))); ?>
        </div><?php /* end col-md-12 */ ?>
    </div><?php /*row */ ?>
</section>

@endsection
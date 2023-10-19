@extends('site.v3.layouts.amp')
@section ('title', $title)
@section ('h1', $h1)
@section ('meta_description', $meta_description)

@section('content')


    <section class="container main">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <h1>{{$h1}}</h1>

                <div class="offers-list">
                    <?php $i=0; $amp = true; ?>
                    @foreach($cards as $card)
                        <?php /* dd($card); */ ?>
                        @include('site.v3.modules.cards.minimal.card-amp')
                        <?php $i++; ?>
                        <?php if($i>19) break; ?>
                    @endforeach
                </div>

                <?php echo \App\Algorithms\AMP::render( Shortcode::compile(System::nofollow($content)) ); ?>

                <?php /*
                <h2>Советы</h2>
                @foreach($throughAdvice as $value)
                    <div class="itm">
                        <p>{!! $value->short_content !!} <br><a href="/sovety/{{$value->alias}}.html" rel="noffolow" target="_blank">Читать далее...</a><p>
                    </div>
                @endforeach
                */ ?>


            </div><?php /* end col-md-12 */ ?>
        </div><?php /*row */ ?>
    </section>

@endsection
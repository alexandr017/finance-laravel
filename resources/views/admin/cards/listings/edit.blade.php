@extends ('admin.layouts.app')
@section ('title', 'Редактирование листинга')
@section ('h1', 'Редактирование листинга')

@section('content')
    <form action="{{ route('admin.cards.listings.update',$item->id) }}" method="post">

        {{ method_field('PATCH') }}

        @if(isset($item->urls->url))
        <a class="btn btn-default btn-xs" href="/{{$item->urls->url}}" target="_blank"><i class="fa fa-eye"></i> https://vsezaimyonline.ru/{{$item->urls->url}}</a>
        <br>
        <br>
        @endif

        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        @include('admin.cards.listings._form')

        <button type="submit" class="btn btn-success pull-right"><i class="fas fa-save"></i> Сохранить</button>

    </form>

    <div class="clearfix"></div>
    <br>
@stop

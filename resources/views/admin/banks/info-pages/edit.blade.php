@extends ('admin.layouts.app')
@section ('title', 'Редактирование инфо-страницы для банка')
@section ('h1', 'Редактирование инфо-страницы для банка')

@section('content')

    <form action="{{ route('admin.banks.info-pages.update',[$bankID,$item->id]) }}" method="post">

        {{ method_field('PATCH') }}

        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        @include('admin.banks.info-pages._form')

        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>

    </form>

    <div class="clearfix"></div>
    <br>
@stop

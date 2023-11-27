@extends ('admin.layouts.app')
@section ('title', 'Создание инфо-страницы для банка')
@section ('h1', 'Создание инфо-страницы для банка')

@section('content')
    <form action="{{ route('admin.banks.info-pages.store', $bankID)}}" method="post">

        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        @include('admin.banks.info-pages._form')

        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>

    </form>

    <div class="clearfix"></div>
    <br>
@stop


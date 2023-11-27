@extends ('admin.layouts.app')
@section ('title', 'Создание страницы компании')
@section ('h1', 'Создание страницы компании')

@section('content')

<form method="POST" action="{{ route('admin.companies.store') }}">
    <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

    @include('admin.companies.companies._form')

    <button type="submit" class="btn btn-success pull-right"><i class="fa fa-floppy-o"></i> Добавить</button>
</form>

<div class="clearfix"></div>

@stop
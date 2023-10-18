@extends('admin.v2.layout')
@section('title', 'Компании - Создание')
@section('h1', 'Компании - Создание')

@section('content')
    <form action="{{ route('admin.companies.store') }}" method="post">

        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        @include('admin.v2.companies.companies._form')

        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>

    </form>

    <div class="clearfix"></div>
@stop

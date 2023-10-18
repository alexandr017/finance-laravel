@extends('admin.v2.layout')
@section('title', 'Записи - Создание')
@section('h1', 'Записи - Создание')

@section('content')
    <form action="{{ route('admin.posts.store') }}" method="post">

        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        @include('admin.v2.posts.posts._form')

        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>

    </form>

    <div class="clearfix"></div>
@stop

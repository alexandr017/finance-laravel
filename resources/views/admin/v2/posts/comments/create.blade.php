@extends('admin.v2.layout')
@section('title', 'Комментарии - Создание')
@section('h1', 'Комментарии - Создание')

@section('content')
    <form action="{{ route('admin.post-comments.store') }}" method="post">

        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        @include('admin.v2.posts.comments._form')

        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>

    </form>

    <div class="clearfix"></div>
@stop

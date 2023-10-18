@extends('admin.v2.layout')
@section('title', 'Курсы тегов - Создание')
@section('h1', 'Курсы тегов - Создание')

@section('content')
    <form action="{{ route('admin.course-tags.store') }}" method="post">

        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        @include('admin.v2.courses.tags._form')

        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>

    </form>

    <div class="clearfix"></div>
@stop

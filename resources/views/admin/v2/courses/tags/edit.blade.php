@extends('admin.v2.layout')
@section('title', 'Курсы тегов - Редактирование')
@section('h1', 'Курсы тегов - Редактирование')

@section('content')
    <form action="{{ route('admin.course-tags.update',$item->id) }}" method="post">

        {{ method_field('PATCH') }}

        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        @include('admin.v2.courses.tags._form')

        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>

    </form>

    <div class="clearfix"></div>
@stop

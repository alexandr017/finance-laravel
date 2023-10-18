@extends('admin.v2.layout')
@section('title', 'Категории записей - Редактирование')
@section('h1', 'Категории записей - Редактирование')

@section('content')
    <form action="{{ route('admin.post-categories.update',$item->id) }}" method="post">

        {{ method_field('PATCH') }}

        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        @include('admin.v2.posts.categories._form')

        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>

    </form>

    <div class="clearfix"></div>
@stop

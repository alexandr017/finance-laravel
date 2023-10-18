@extends('admin.v2.layout')
@section('title', 'Пользователи - Редактирование')
@section('h1', 'Пользователи - Редактирование')

@section('content')
    <form action="{{ route('admin.users.update',$item->id) }}" method="post">

        {{ method_field('PATCH') }}

        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        @include('admin.v2.users._form')

        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>

    </form>

    <div class="clearfix"></div>
@stop

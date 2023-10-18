@extends('admin.v2.layout')
@section('title', 'Сотдрудники - Редактирование')
@section('h1', 'Сотдрудники - Редактирование')

@section('content')
    <form action="{{ route('admin.employees.update',$item->id) }}" method="post">

        {{ method_field('PATCH') }}

        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        @include('admin.v2.employees._form')

        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>

    </form>

    <div class="clearfix"></div>
@stop

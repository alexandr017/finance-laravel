@extends('admin.v2.layout')
@section('title', 'Статические страницы')
@section('h1', 'Статические страницы')

@section('content')

    <a href="{{ route('admin.static-pages.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Добавить страницу</a>
    <br>
    <br>

    <table class="table table-hover" id="coolTable">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">h1</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($pages as $item)
            <tr>
                <th scope="row">{{$item->id}}</th>
                <td>{{$item->h1}}</td>
                <td>
                    <a href="{{ route('admin.static-pages.edit',$item->id) }}" class="btn btn-primary btn-sm" title="Редактировать">
                        <i class="fa fa-edit"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection

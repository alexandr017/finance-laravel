@extends('admin.v2.layout')
@section('title', 'Пользователи')
@section('h1', 'Пользователи')

@section('content')

    <a href="{{ route('admin.users.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Добавить пользователя</a>
    <br>
    <br>

    <table class="table table-hover" id="coolTable">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Имя</th>
            <th scope="col">Email</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $item)
            <tr>
                <th scope="row">{{$item->id}}</th>
                <td>{{$item->first_name}} {{$item->last_name}}</td>
                <td>{{$item->email}}</td>
                <td>
                    <a href="{{ route('admin.users.edit',$item->id) }}" class="btn btn-primary btn-sm" title="Редактировать">
                        <i class="fa fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.users.destroy',$item->id) }}" method="post" class="inline">
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
                        <button class="btn btn-danger btn-sm rest-destroy" title="Удалить"><i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection

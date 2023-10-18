@extends('admin.v2.layout')
@section('title', 'Категории записей')
@section('h1', 'Категории записей')

@section('content')

    <a href="{{ route('admin.post-categories.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Добавить категорию</a>
    <br>
    <br>

    <table class="table table-hover" id="coolTable">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">h1</th>
            <th scope="col">Статус</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $item)
            <tr>
                <th scope="row">{{$item->id}}</th>
                <td>{{$item->h1}}</td>
                <td>
                    @if($item->status)
                        <span class="badge badge-success">Вкл</span>
                    @else
                        <span class="badge badge-warning">Выкл</span>
                    @endif
                </td>
                <td>
                    <a href="/{{$item->url}}" class="btn btn-info btn-sm" target="_blank" title="Просмотреть">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.post-categories.edit',$item->id) }}" class="btn btn-primary btn-sm" title="Редактировать">
                        <i class="fa fa-edit"></i>
                    </a>

                    <form action="{{ route('admin.post-categories.destroy',$item->id) }}" method="post" class="inline">
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

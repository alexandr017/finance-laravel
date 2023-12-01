@extends('admin.layouts.app')
@section('title', 'Теги записей')
@section('h1', 'Теги записей')

@section('content')

    <a href="{{route('admin.posts.tags.create')}}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить тег</a>
    <br>
    <br>

    <table id="rowtbl" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>id</th>
            <th>Тег</th>
            <th>Категория</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->tag }}</td>
                <td>{{ $item->postCategoryName }}</td>
                <td>
                    <a href="{{route('admin.posts.tags.edit', [$item->id]) }}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
                    <form action="{{ route('admin.posts.tags.destroy', [$item->id]) }}" method="post" class="inline">
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
                        <button class="btn btn-danger btn-xs rest-destroy" title="Удалить"><i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="clearfix"></div>

@endsection

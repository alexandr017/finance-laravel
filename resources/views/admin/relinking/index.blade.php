@extends('admin.layouts.app')
@section('title', 'Список перелинковки')
@section('h1', 'Список перелинковки')

@section('content')

    <a href="{{route('admin.relinking_groups.index')}}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> Категории перелинковки</a>
    <a href="{{route('admin.relinking.create')}}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить перелинковку</a>
    <br>
    <br>

    <table id="rowtbl" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>id</th>
            <th>Категория</th>
            <th>Название группы</th>
            <th>Название</th>
            <th>Ссылка</th>
            <th>Значение сортировки</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $cardsCategoriesArr[$item->category_id] }}</td>
                <td>{{ $item->group_name }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->link }}</td>
                <td>{{$item->sort_order}}</td>
                <td>
                    <a href="{{route('admin.relinking.edit', $item->id) }}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
                    <form action="{{ route('admin.relinking.destroy', $item->id) }}" method="post" class="inline">
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

@extends ('admin.layouts.app')
@section ('title', 'Список категорий записей')
@section ('h1', 'Список категорий записей')

@section('content')
<a href="/admin/posts/categories/create" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить категорий</a>
<br>
<br>
<table id="rowtbl" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>id</th>
            <th>h1</th>
            <th style="min-width: 90px;">Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rows as $list)
        <tr>
            <td>{{ $list->id }}</td>
            <td>{{ $list->h1 }}</td>
            <td>
                <a href="/{{ $list->alias_category }}" class="btn btn-info btn-xs" title="Перейти" target="_blank"><i class="fa fa-eye"></i></a>
                <a href="/admin/posts/categories/edit/{{ $list->id }}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
                <a href="/admin/posts/categories/edit/{{ $list->id }}/posts" class="btn btn-info btn-xs" title="Открыть записи к категории"><i class="fa fa-list"></i></a>
                <a href="/admin/posts/categories/destroy/{{ $list->id }}" class="btn btn-danger btn-xs destroy" title="Удалить"><i class="fa fa-remove"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


<div class="clearfix"></div>

@stop

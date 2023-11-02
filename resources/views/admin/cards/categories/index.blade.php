@extends ('admin.layouts.app')
@section ('title', 'Список категорий карточек')
@section('h1','Список категорий карточек')

@section('content')
<a href="/admin/cards/categories/create" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить категорию</a>
<br>
<br>

<table id="rowtbl" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>id</th>
            <th>Хлебные крошки</th>
            <th>h1</th>
            <th>URL</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cardsCategories as $list)
        <tr>
            <td>{{ $list->id }}</td>
            <td>{{ $list->breadcrumb }}</td>
            <td>{{ $list->h1 }}</td>
            <td>{{ $list->alias }}</td>
            <td>
                <a href="/{{ $list->alias }}" class="btn btn-info btn-xs" title="Перейти" target="_blank"><i class="fa fa-eye"></i></a>
                <a href="/admin/cards/categories/edit/{{ $list->id }}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
                <!--
                <a href="/admin/cards/categories/destroy/{{ $list->id }}" class="btn btn-danger btn-xs destroy" title="Удалить"><i class="fa fa-remove"></i></a>
            -->
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="clearfix"></div>
     
@endsection

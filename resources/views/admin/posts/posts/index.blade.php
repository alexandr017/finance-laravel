@extends ('admin.layouts.app')
@section ('title', 'Список записей')
@section ('h1', 'Список записей')
@section('content')

<a href="/admin/posts/posts/create"  class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить запись</a>
<br>
<br>
<form class="clearfix" method="POST" action="/admin/posts/posts/search_by_id">
    <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
    <div class="row">
        <label for="post_id" class="col-md-2 col-form-label">Поиск по ID записи:</label>
        <div class="col-md-9">
            <input class="form-control" type="text" name="post_id" value="" id="post_id" required="true">
        </div>
        <button type="submit" class="col-md-1 btn btn-success"><i class="fa fa-search"></i> Найти</button>
    </div>
</form>
<br>
<br>
<table id="rowtbl" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>id</th>
            <th>h1</th>
            <th>URL</th>
            <th>Просмотры</th>
            <th>Рейтинг</th>
            <th>Дата публикации</th>
            <th>Статус</th>
            <th style="min-width: 90px;">Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $list)
        <tr>
            <td>{{ $list->id }}</td>
            <td>{{ $list->h1 }}</td>
            <td>{{ $list->alias }}</td>
            <td>{{ $list->views }}</td>
            <td>{{ $list->average_rating }}</td>
            <td>{{ date('d-m-Y',strtotime($list->date)) }}</td>
            <td>
                @if($list->status ==1)
                <span class="label label-success">Вкл</span>
                @else
                <span class="label label-warning">Выкл</span>
                @endif
            </td>
            <td>
                <a target="_blank" href="/{{$list->alias_category}}/{{$list->alias}}.html" class="btn btn-info btn-xs" title="Перейти"><i class="fa fa-eye"></i></a>
                <a href="/admin/posts/posts/edit/{{ $list->id }}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
                <a href="{{ route('admin.posts.comments_by_post', $list->id) }}" class="btn btn-info btn-xs" title="Открыть комментарии к записи"><i class="fa fa-commenting-o"></i></a>
                <a href="/admin/posts/posts/destroy/{{ $list->id }}" class="btn btn-danger btn-xs destroy" title="Удалить"><i class="fa fa-remove"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{$posts->links()}}

<div class="clearfix"></div>

@stop

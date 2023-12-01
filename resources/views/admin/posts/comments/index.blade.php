@extends ('admin.layouts.app')
@section ('title', 'Список комментариев')
@section ('h1', 'Список комментариев')
@section('content')


<div class="pull-right">
    <form action="{{ route('admin.posts.comments.search') }}" method="POST" class="form-inline">
        <label>Поиск по комментарию:</label>
        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
        <input type="text" name="search" value="@if(isset($search)) {{$search}} @endif" class="form-control">
        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Найти</button>
    </form>
</div>

<a href="{{ route('admin.posts.comments.create') }}" class="btn btn-success btn-xs">
    <i class="fa fa-plus"></i> Добавить комментарий
</a>

<br>
<br>
<table id="rowtbl2" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>id</th>
            <th style="min-width: 100px">Дата</th>
            <th>Запись</th>
            <th>Имя Автора</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($postsComments as $postComment)
        <tr>
            <td>{{ $postComment->id }}</td>
            <td>{{ date('d-m-Y',strtotime($postComment->created_at)) }}</td>
            <td>{{ $postComment->h1 }}</td>
            <td>@if(isset($postComment->vzo_author_name) && $postComment->vzo_author_name != null) {{$postComment->vzo_author_name}} @else {{ $postComment->author_name }} @endif</td>
            <td>
                <a href="{{ route('admin.posts.comments.change_status', $postComment->id) }}">
                @if($postComment->status == 1)
                <span class="label label-success">Вкл</span>
                @else
                <span class="label label-warning">Выкл</span>
                @endif
                </a>
            </td>
            <td>
                <a href="{{ route('admin.posts.comments.edit', $postComment->id) }}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
                <form action="{{ route('admin.posts.comments.destroy', $postComment->id) }}" method="POST" class="inline">
                    {{ method_field('DELETE') }}
                    <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
                    <button class="btn btn-danger btn-xs rest-destroy" title="Удалить"><i class="fa fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $postsComments->links() }}

<div class="clearfix"></div>
<script type="text/javascript">
 $(document).ready(function(){

    $("#rowtbl2").DataTable({
        "sort": true,
        "order": [[ 0, "desc" ]],
        "pageLength": 50,
        "language": {"url": "/admin-assets/dataTables/datatables.json"}
    });

});    
</script>

@stop

@extends ('admin.layouts.app')
@section ('title', 'Список скрытых ссылок')
@section('h1','Список скрытых ссылок')

@section('content')
<a href="{{ route('admin.hide_links.create') }}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить ссылку</a>
<br>
<br>

<table id="rowtbl" class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
        <th>id</th>
        <th>Ссылка на сайте</th>
        <th>Целевая ссылка</th>
        <th>Клики</th>
        <th>Код редиректа</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->in }}</td>
                <td style="max-width: 400px;">{{ $item->out }}</td>
                <td>{{ $item->clicks }}</td>
                <td>{{ $item->redirect_type }}</td>
                <td>
                    <a href="{{ route('admin.hide_links.edit', $item->id) }}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
                    <form action="{{ route('admin.hide_links.destroy',$item->id) }}" method="post" class="inline">
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
                    <button class="btn btn-danger btn-xs " title="Удалить"><i class="fa fa-remove"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="clearfix"></div>

@stop

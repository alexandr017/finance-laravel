@extends ('admin.layouts.app')
@section ('title', 'Список авторов')
@section ('h1', 'Список авторов')

@section('content')
<a href="{{ route('admin.posts.authors.create') }}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить автора</a>
<br>
<br>
<table id="rowtbl" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>id</th>
            <th>Фото</th>
            <th>Имя</th>
            <th>Должность</th>
            <th>Email</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($authors as $author)
        <tr>
            <td>{{ $author->id }}</td>
            <td><img src="{{ $author->small_photo ?? $author->photo}}" alt="" width="56" height="56"></td>
            <td>{{ $author->name }}</td>
            <td>{{ $author->position }}</td>
            <td>{{ $author->email }}</td>
            <td>@if($author->status) <span class="label label-success">Включен</span> @else <span class="label label-warning">Отключен</span>@endif</td>
            <td>
                <a href="{{ route('admin.posts.authors.edit', $author) }}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
                <form action="{{ route('admin.posts.authors.destroy', $author) }}" method="post" class="inline">
                    {{ method_field('DELETE') }}
                    <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
                    <button class="btn btn-danger btn-xs rest-destroy" title="Удалить"><i class="fa fa-trash"></i></button>
                </form>
{{--                <a href="{{route('admin.media.team-certificates.certificatesByAuthor', $author->id) }}" class="btn btn-info btn-xs " title="Сертификаты сотрудника" target="_blank"><i class="fa fa-certificate"></i></a>--}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


<div class="clearfix"></div>

@stop

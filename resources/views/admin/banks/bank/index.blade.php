@extends('admin.layouts.app')
@section('title', 'Список банков')
@section('h1', 'Список банков')

@section('content')

<a href="{{route('admin.banks.banks.create')}}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить банк</a>
<br>
<br>

<table id="rowtbl" class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
        <th>id</th>
        <th>Название</th>
        <th>h1</th>
        <th>Алиас</th>
        <th>Статус</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($items as $item)
    <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->h1 }}</td>
        <td>{{ $item->alias }}</td>
        <td>@if($item->status) <span class="badge badge-success">Включена</span> @else <span class="badge badge-warning">Отключена</span>@endif</td>
        <td>
            <a href="/banki/{{$item->alias}}" target="_blank" class="btn btn-info btn-xs" title="Открыть"><i class="fa fa-eye"></i></a>
            <a href="{{route('admin.banks.banks.edit', $item->id) }}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
            <form action="{{ route('admin.banks.banks.destroy',$item->id) }}" method="post" class="inline">
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

{{ $items->links() }}

<?php /*
<script>
    $('#category_id').on('change',function(){
        var id = $(this).find(":selected").attr('value');
        location.replace('/admin/cards/listings?category_id='+id);
    })
</script>
 */
 ?>

@endsection

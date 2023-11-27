@extends('admin.layouts.app')
@section('title', 'Список привязок')
@section('h1', 'Список привязок')

@section('content')


<table id="rowtbl" class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
        <th>id</th>
        <th>Банк (id)</th>
        <th>h1</th>
        <th>Статус</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($items as $item)
    <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->bank_id }}</td>
        <td>{{ $item->h1 }}</td>
        <td>@if($item->status) <span class="badge badge-success">Включена</span> @else <span class="badge badge-warning">Отключена</span>@endif</td>
        <td>
            <a href="/admin/banks/info/{{$item->id}}"  class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
            <a href="/admin/banks/info/{{$item->id}}/delete" class="btn btn-danger btn-xs" title="Удалить"><i class="fa fa-trash"></i></a>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>

<div class="clearfix"></div>


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

@extends('admin.layouts.app')
@section('title', 'Список привязок')
@section('h1', 'Список привязок')

@section('content')


<table id="rowtbl" class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
        <th>id</th>
        <th>Банк (id)</th>
        <th>Категория (id)</th>
        <th>Продукт (id)</th>
        <th>author</th>
        <th>Отзыв</th>
        <th>Статус</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($items as $item)
    <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->bank_id }}</td>
        <td>{{ $item->bank_category_id }}</td>
        <td>{{ $item->product_id }}</td>
        <td>{{ $item->author }}</td>
        <td>{!! $item->review !!}</td>
        <td>@if($item->status) <span class="badge badge-success">Включен</span> @else <span class="badge badge-warning">Отключен</span>@endif</td>
        <td>
            <a href="/admin/banks/reviews/{{$item->id}}"  class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
            <a href="/admin/banks/reviews/{{$item->id}}/delete" class="btn btn-danger btn-xs" title="Удалить"><i class="fa fa-trash"></i></a>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>

<div class="clearfix"></div>

{{$items->links()}}

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

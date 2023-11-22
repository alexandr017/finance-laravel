@extends ('admin.layouts.app')
@section ('title', 'Список отзывов компаний')
@section('h1','Список отзывов компаний')

@section('content')

<div class="pull-right">
    <form action="{{ route('admin.companies.reviews.search') }}" method="POST" class="form-inline">
        <label>Поиск по комментарию:</label>
        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
        <input type="text" name="search" value="@if(isset($search)) {{$search}} @endif" class="form-control">
        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Найти</button>
    </form>
</div>

<a href="{{ route('admin.companies.reviews.create') }}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить отзыв</a>
<br>
<br>

<table id="rowtbl2" class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
        <th>id</th>
        <th>Имя</th>
        <th>Статус</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($reviews as $review)
            <tr>
                <td>{{ $review->id }}</td>
                <td>{{ $review->author }}</td>
                <td>
                    <a href="{{ route('admin.companies.reviews.change_status', $review->id) }}">
                    @if($review->status == 1)
                        <span class="label label-success">Вкл</span>
                    @else
                        <span class="label label-warning">Выкл</span>
                    @endif
                    </a>
                </td>
                <td>
                    <a href="{{ route('admin.companies.reviews.edit', $review->id) }}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
                    <form action="{{ route('admin.companies.reviews.destroy', $review->id) }}" method="POST" class="inline">
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
                        <button class="btn btn-danger btn-xs rest-destroy" title="Удалить"><i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $reviews->links() }}

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

@extends ('admin.layouts.app')
@section ('title', 'Список дочерних страниц компании ' . $company->breadcrumb)
@section('h1', 'Список дочерних страниц компании ' . $company->breadcrumb)

@section('content')
    <a href="{{ route('admin.companies.children.create', $company->id) }}" class="btn btn-success btn-xs">
        <i class="fa fa-plus"></i> Добавить дочернюю страницу
    </a>
    <br>
    <br>

    <table id="rowtbl2" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>id</th>
            <th>H1</th>
            <th>Тип</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($childrenPages as $childrenPage)
            <tr>
                <td>{{ $childrenPage->id }}</td>
                <td>{{ $childrenPage->h1 }}</td>
                <td>{{ $childrenPage->type }}</td>
                <td>@if($company->status) <span class="label label-success">Активна</span> @else <span class="label label-warning">Отключена</span>@endif</td>
                <td>
                    <a href="{{ route('admin.children.edit', $childrenPage->id) }}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
                    <form action="{{ route('admin.children.destroy', $childrenPage->id) }}" method="POST" class="inline">
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

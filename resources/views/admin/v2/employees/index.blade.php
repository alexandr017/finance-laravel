@extends('admin.v2.layout')
@section('title', 'Сотдрудники')
@section('h1', 'Сотдрудники')

@section('content')

    <a href="{{ route('admin.employees.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Добавить сотрудника</a>
    <br>
    <br>

    <table class="table table-hover" id="coolTable">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Имя</th>
            <th scope="col">Статус</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($employees as $employee)
            <tr>
                <th scope="row">{{$employee->id}}</th>
                <td>{{$employee->name}}</td>
                <td>
                    @if($employee->status)
                        <span class="badge badge-success">Вкл</span>
                    @else
                        <span class="badge badge-warning">Выкл</span>
                    @endif
                </td>
                <td>
                    <a href="/{{$employee->url}}" class="btn btn-info btn-sm" target="_blank" title="Просмотреть">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.employees.edit',$employee->id) }}" class="btn btn-primary btn-sm" title="Редактировать">
                        <i class="fa fa-edit"></i>
                    </a>

                    <form action="{{ route('admin.employees.destroy',$employee->id) }}" method="post" class="inline">
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
                        <button class="btn btn-danger btn-sm rest-destroy" title="Удалить"><i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection

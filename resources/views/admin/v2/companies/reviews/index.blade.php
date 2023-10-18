@extends('admin.v2.layout')
@section('title', 'Отзывы компаний')
@section('h1', 'Отзывы компаний')

@section('content')

    <a href="{{ route('admin.company-reviews.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Добавить отзыв</a>
    <br>
    <br>

    <table class="table table-hover" id="coolTable">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Отзыв</th>
            <th scope="col">Компания</th>
            <th scope="col">Статус</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($reviews as $item)
            <tr>
                <th scope="row">{{$item->id}}</th>
                <td>{{$item->title}}</td>
                <td>{{$item->name}}</td>
                <td>
                    @if($item->status)
                        <span class="badge badge-success">Вкл</span>
                    @else
                        <span class="badge badge-warning">Выкл</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.company-reviews.edit',$item->id) }}" class="btn btn-primary btn-sm" title="Редактировать">
                        <i class="fa fa-edit"></i>
                    </a>

                    <form action="{{ route('admin.company-reviews.destroy',$item->id) }}" method="post" class="inline">
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


@section('additional-scripts')
    @parent

@endsection






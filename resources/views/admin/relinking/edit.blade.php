@extends ('admin.layouts.app')
@section ('title', 'Редактирование перелинковки')
@section ('h1', 'Редактирование перелинковки')

@section('content')

    <form action="{{ route('admin.relinking.update', $item->id) }}" method="post">

        {{ method_field('PATCH') }}

        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        @include('admin.relinking._form')

        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>

    </form>

    <div class="clearfix"></div>
    <br>
@stop

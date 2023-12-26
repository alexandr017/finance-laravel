@extends ('admin.layouts.app')
@section ('title', 'Создание перелинковки')
@section ('h1', 'Создание перелинковки')

@section('content')
<form action="{{ route('admin.relinking_groups.store')}}" method="post">

    <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

    @include('admin.relinking_groups._form')

    <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>

</form>

<div class="clearfix"></div>
<br>
@stop

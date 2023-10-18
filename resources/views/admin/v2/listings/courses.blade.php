@extends('admin.v2.layout')
@section('title', 'Листинги - Привязка курсов')
@section('h1', 'Листинги - Привязка курсов')

@section('content')


        @foreach($courses as $item)
            <div class="form-group">
                <input type="checkbox" name="course_{{$item->id}}" id="course_{{$item->id}}" value="{{$item->id}}">
                <label for="course_{{$item->id}}"><i class="red"></i> {{$item->title}}</label>
            </div>
        @endforeach


@endsection

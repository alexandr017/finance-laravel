@extends ('admin.layouts.app')
@section ('title', 'Список карточек')
@section('h1','Список карточек')

@section('content')
<a href="/admin/cards/cards/create" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить карточку</a>
<br>
<br>

<table id="rowtbl" class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
        <th>id</th>
        <th>Заголовок</th>
        <th>Категория</th>
        <th>Статус</th>
        <th>Привязка</th>
        <th>Партнерка</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($cards as $card)
            <tr>
                <td>{{ $card->id }}</td>
                <td>{{ $card->title }}</td>
                <td>{{ $card->category_h1 }}</td>
                <td>
                    @if($card->status ==1)
                    <span class="label label-success">Вкл</span>
                    @else
                    <span class="label label-warning">Выкл</span>
                    @endif
                </td>
                <td>
                    @if(!$card->company_id && !$card->company_id)
                    -
                    @else
                    +
                    @endif
                </td>
                <td>
                    <?php
                    $index = str_replace('https://vsezaimyonline.ru/', '/', $card->link_1);
                    $index = preg_replace('/^\//','', $index);
                    ?>
                    @if($card->link_type == 1)
                        @if(isset($hideLinks[$index]) && ($hideLinks[$index] != 9 && $hideLinks[$index] != 10))
                        +
                        @else
                        -
                        @endif
                    @else
                    -
                    @endif
                </td>
                <td>
                    <a href="/admin/cards/cards/edit/{{$card->id}}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
                    <?php /*
                    <a href="/admin/cards/cards/destroy/{{$card->id}}" class="btn btn-danger btn-xs destroy" title="Удалить"><i class="fa fa-remove"></i></a>
 */ ?>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="clearfix"></div>
     
@stop

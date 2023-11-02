@extends ('admin.layouts.app')
@section ('title', 'Перстальное ранжирование карточек')
@section('h1','Персональное ранжирование карточек')

@section('content')

    <p style="font-style: italic">
        Рабочая область состоит из двух элементов.
        Задаваемый список содержащий название карточек участвующих в персональном ранжировании,
        а также таблицы, содержащий перечень всех карточек привязанных к странице. Вы должны самостоятельно вписать в список через двоеточие ID карточки, ее название и ее вес.
        Чем больше вес, тем выше будет карточка на странице.
        Ниже после основного списка есть пример для заполнения списка.<br>
        Внимание: персональное ранжирование будет применено для листинга только тогда, когда в редактировани самого листинга поле "Ранжирование" будет переключено в индивидуальный список.
    </p>


    <div style="display: flex; gap: 10px">

        <div style="width: 25%">
            <form method="POST" action="/admin/cards/listings/{{$listingID}}/edit/personal-order">
                <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
                <?php $textareaText = ''; ?>
                @foreach($cards as $card)
                    @if(isset($personalRelation[$card['id']]))
                            <?php $textareaText .= $card->id . ':' . $card->title . ':' . $personalRelation[$card->id] . PHP_EOL; ?>
                    @endif
                @endforeach
                <textarea name="personal-order" style="min-height: 600px; width: 100%">{{$textareaText}}</textarea>
                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-refresh"></i> Обновить</button>
            </form>
            <textarea style="min-height: 300px; width: 100%;" readonly disabled>7:Займер:90{{PHP_EOL}}11:Екапуста:55{{PHP_EOL}}16:Вивус:14
                </textarea>
        </div>

        <div style="width: 75%">
            <table  id="rowtbl" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Персональное ранжирование</th>
                    <th>Заголов</th>
                    <th>Поток</th>
                    <th>Статус</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($cards as $card)
                    <tr>
                        <td>{{ $card->id }}</td>
                        <td>
                            @if(isset($personalRelation[$card->id]))
                                <span class="label label-success">Да</span>
                            @else
                                <span class="label label-warning">Нет</span>
                            @endif
                        </td>
                        <td>{{ $card->title }}</td>
                        <td>{{ $card->flow }}</td>
                        <td>
                            @if($card->status == 1)
                                <span class="label label-success">Вкл</span>
                            @else
                                <span class="label label-warning">Выкл</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


    </div>


    <div class="clearfix"></div>

@stop

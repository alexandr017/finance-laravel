<table>
    @if($bank->full_name != null)
        <tr>
            <td>Полное наименование</td>
            <td>{{$bank->full_name}}</td>
        </tr>
    @endif
    @if($bank->date_opened != null)
        <tr>
            <td>Дата основания</td>
            <td>{{date('d.m.Y', strtotime($bank->date_opened))}}</td>
        </tr>
    @endif
    @if($bank->licence != null)
        <tr>
            <td>Лицензия</td>
            <td>{{$bank->licence}}</td>
        </tr>
    @endif
    @if($bank->site != null)
        <tr>
            <td>Сайт</td>
            <td>{{$bank->site}}</td>
        </tr>
    @endif
    @if($bank->email != null)
        <tr>
            <td>Email</td>
            <td>{{$bank->email}}</td>
        </tr>
    @endif
    @if($bank->phone != null)
        <tr>
            <td>Телефон</td>
            <td>{{$bank->phone}}</td>
        </tr>
    @endif
    @if($bank->address_index != null && $bank->address != null)
        <tr>
            <td>Главное отделение</td>
            <td>
                @if($bank->address_index != null)
                    {{$bank->address_index}},
                @endif
                {{$bank->city_id}}, {{$bank->address}}
            </td>
        </tr>
    @endif
    @if($bank->ogrn != null)
        <tr>
            <td>ОГРН</td>
            <td>{{$bank->ogrn}}</td>
        </tr>
    @endif
    @if($bank->inn != null)
        <tr>
            <td>ИНН</td>
            <td>{{$bank->inn}}</td>
        </tr>
    @endif
    @if($bank->okpo != null)
        <tr>
            <td>ОКПО</td>
            <td>{{$bank->okpo}}</td>
        </tr>
    @endif
    @if($bank->kpp != null)
        <tr>
            <td>КПП</td>
            <td>{{$bank->kpp}}</td>
        </tr>
    @endif
    @if($bank->bik != null)
        <tr>
            <td>БИК</td>
            <td>{{$bank->bik}}</td>
        </tr>
    @endif
    @if($bank->account != null)
        <tr>
            <td>Кор. Счет</td>
            <td>{{$bank->account}}</td>
        </tr>
    @endif
    @if($bank->swift != null)
    <tr>
        <td>SWIFT</td>
        <td>{{$bank->swift}}</td>
    </tr>
    @endif
    @if($bank->okato != null)
    <tr>
        <td>ОКАТО</td>
        <td>{{$bank->okato}}</td>
    </tr>
    @endif
    @if($bank->leadership != null)
        <tr>
            <td>Руководство</td>
            <td>{!! $bank->leadership !!}</td>
        </tr>
    @endif
</table>
@extends ('admin.layouts.app')
@section ('title', 'Создание скрытой ссылки')
@section ('h1', 'Создание скрытой ссылки')

@section('content')

<form action="{{ route('admin.hide_links.store')}}" method="post">
    <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

    <div class="form-group">
        <label for="in"><i>*</i> Категория:</label>
        <select id="category" class="form-control" required="required">
            <option value="">Не выбрано</option>
            <option value="zaim">Займ - zaim</option>
            <option value="biz">РКО - biz</option>
            <option value="zaim">Залог - zaim</option>
            <option value="credit">Кредит - credit</option>
            <option value="crcards">Кредитная карта - crcards</option>
            <option value="dcards">Дебетовая карта - dcards</option>
            <option value="avtocredit">Автокредит - avtocredit</option>
            <option value="ipoteka">Ипотека - ipoteka</option>
            <option value="vklady">Вклад - vklady</option>
            <option value="ins">Страховка - ins</option>
            <option value="eqring">Эквайринг - eqring</option>
            <option value="eqring-torgovyj">Эквайринг (торговый) - eqring-torgovyj</option>
            <option value="eqring-internet">Эквайринг (интернет) - eqring-internet</option>
            <option value="prod">Записи - prod</option>
        </select>
    </div>

        <script>
            $('#category').change(function() {
                let currentLink = $(this).val();

                let inLink = $('#in').val();
                let inLinkSplited = inLink.split('/');

                if (currentLink == '') {
                    if (inLinkSplited[0] != '' && inLinkSplited.length > 1) {
                        inLinkSplited.shift();
                        inLink = inLinkSplited.join('/');
                        $('#in').val(inLink);
                    }
                } else {
                    if (inLinkSplited[0] != '' && inLinkSplited.length > 1) {
                        inLinkSplited[0] = currentLink;
                        inLink = inLinkSplited.join('/');
                        $('#in').val(inLink);
                    } else {
                        inLink = currentLink + '/' + inLink;
                        $('#in').val(inLink)
                    }
                }
            });

        </script>

    <div class="form-group">
        <label for="in"><i>*</i> Ссылка на сайте:</label>
        <input type="text" class="form-control" name="in" id="in" required="required">
    </div>

    <div class="form-group">
        <label for="out"><i>*</i> Целевая ссылка:</label>
        <input type="text" class="form-control" name="out" id="out" required="required">
    </div>

    <div class="form-group">
        <label for="straight"><i>*</i> Прямая ссылка:</label>
        <input type="text" class="form-control" name="straight" id="straight" required="required">
    </div>



    <div class="form-group">
        <label for="redirect_type"><i>*</i> Код редиректа:</label>
        {{ Form::select('redirect_type',[301=>301,307=>307],301,['class'=>'form-control','id'=>'redirect_type', 'required' => true]) }}
    </div>

    <div class="form-group">
        <label for="affiliate_program_id"><i>*</i> Партнерская программа:</label>
        {{ Form::select('affiliate_program_id',$affiliatePrograms,null,['class'=>'form-control','id'=>'affiliate_program_id', 'required' => true]) }}
    </div>

{{--    @if(in_array(\Auth::id(), config('roles.SUPER_ADMINS')))--}}
    <div class="form-group">
        <label for="permission_type"><i>*</i> Тип скрытой ссылки:</label>
        {{ Form::select('permission_type',[0 => 'Резервная (будет доступна КМам)', 1 => 'Основная (будет скрыта от КМов)'],0,['class'=>'form-control','id'=>'permission_type', 'required' => true]) }}
    </div>
{{--    @endif--}}


    <button type="submit" class="btn btn-success pull-right"><i class="fa fa-floppy-o"></i> Создать</button>
</form>

<div class="clearfix"></div>

@stop

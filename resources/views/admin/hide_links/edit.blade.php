@extends ('admin.layouts.app')
@section ('title', 'Редактирование скрытой ссылки - #'.$item->id)
@section ('h1', 'Редактирование скрытой ссылки - #'.$item->id)

@section('content')

<form action="{{ route('admin.hide_links.update',$item->id) }}" method="post">
    {{ method_field('PATCH') }}
    <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        <div class="form-group">
            <label for="in"><i>*</i> Категория:</label>
            <select id="category" class="form-control" required="required">
                <option value="">Не выбрано</option>
                <option value="zaim" @if(explode('/', $item->in)[0] == 'zaim') selected @endif>Займ/Залог - zaim</option>
                <option value="biz" @if(explode('/', $item->in)[0] == 'biz') selected @endif>РКО - biz</option>
                <option value="credit" @if(explode('/', $item->in)[0] == 'credit') selected @endif>Кредит - credit</option>
                <option value="crcards" @if(explode('/', $item->in)[0] == 'crcards') selected @endif>Кредитная карта - crcards</option>
                <option value="dcards" @if(explode('/', $item->in)[0] == 'dcards') selected @endif>Дебетовая карта - dcards</option>
                <option value="avtocredit" @if(explode('/', $item->in)[0] == 'avtocredit') selected @endif>Автокредит - avtocredit</option>
                <option value="ipoteka" @if(explode('/', $item->in)[0] == 'ipoteka') selected @endif>Ипотека - ipoteka</option>
                <option value="vklady" @if(explode('/', $item->in)[0] == 'vklady') selected @endif>Вклад - vklady</option>
                <option value="ins" @if(explode('/', $item->in)[0] == 'ins') selected @endif>Страховка - ins</option>
                <option value="eqring" @if(explode('/', $item->in)[0] == 'eqring') selected @endif>Эквайринг - eqring</option>
                <option value="eqring-torgovyj" @if(explode('/', $item->in)[0] == 'eqring-torgovyj') selected @endif>Эквайринг (торговый) - eqring-torgovyj</option>
                <option value="eqring-internet" @if(explode('/', $item->in)[0] == 'eqring-internet') selected @endif>Эквайринг (интернет) - eqring-internet</option>
                <option value="prod" @if(explode('/', $item->in)[0] == 'prod') selected @endif>Записи - prod</option>
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
        <input type="text" class="form-control" name="in" id="in" required="required" value="{{old('in',$item->in)}}">
    </div>

    <div class="form-group">
        <label for="out"><i>*</i> Целевая ссылка:</label>
        <input type="text" class="form-control" name="out" id="out" required="required" value="{{old('out',$item->out)}}">
    </div>

    <div class="form-group">
        <label for="straight"><i>*</i> Прямая ссылка:</label>
        <input type="text" class="form-control" name="straight" id="out" required="required" value="{{old('straight',$item->straight)}}">
    </div>

    <div class="form-group">
        <label for="redirect_type"><i>*</i> Код редиректа:</label>
        {{ Form::select('redirect_type',[301=>301,307=>307],$item->redirect_type,['class'=>'form-control','id'=>'redirect_type', 'required' => true]) }}
    </div>

    <div class="form-group">
        <label for="affiliate_program_id"><i>*</i> Партнерская программа:</label>
        {{ Form::select('affiliate_program_id',$affiliatePrograms,$item->affiliate_program_id,['class'=>'form-control','id'=>'affiliate_program_id', 'required' => true]) }}
    </div>

{{--    @if(in_array(\Auth::id(), config('roles.SUPER_ADMINS')))--}}
        <div class="form-group">
            <label for="permission_type"><i>*</i> Тип скрытой ссылки:</label>
            {{ Form::select('permission_type',[0 => 'Резервная (будет доступна КМам)', 1 => 'Основная (будет скрыта от КМов)'],$item->permission_type,['class'=>'form-control','id'=>'permission_type', 'required' => true]) }}
        </div>
{{--    @endif--}}

    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-refresh"></i> Обновить</button>
</form>

<div class="clearfix"></div>

@stop

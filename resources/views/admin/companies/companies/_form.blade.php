<input type="hidden" name="id" value="{{ $company->id ?? 0 }}">

<div class="form-group">
    <label for="group_id"><i>*</i> Категория карточки:</label>
    {{ Form::select('card_category_id', $cardCategories, $company->card_category_id ?? 0, ['id' => 'card_category_id', 'class' => 'form-control']) }}
</div>
<div class="form-group">
    <label for="title"><i>*</i> Title:</label>
    <input class="form-control" type="text" name="title" id="title" required="required"
           @if(old('title'))
               value="{{old('title')}}"
           @else
               @if(isset($company))
                   value="{{$company->title}}"
            @endif
            @endif
    >
</div>
<div class="form-group">
    <label for="h1"><i>*</i> H1:</label>
    <input class="form-control" type="text" name="h1" id="h1" required="required"
           @if(old('h1'))
               value="{{old('h1')}}"
           @else
               @if(isset($company))
                   value="{{$company->h1}}"
            @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="alias"><i>*</i> Постоянная ссылка:</label> <span class="btn btn-default btn-xs translate"><i class="fa fa-language"></i></span>
    <input class="form-control" type="text" name="alias" id="alias" required
           @if(old('alias'))
               value="{{old('alias')}}"
           @else
               @if(isset($company))
                   value="{{$company->alias}}"
            @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="breadcrumb">Хлебные крошки:</label>
    <input class="form-control" type="text" name="breadcrumb" id="breadcrumb"
           @if(old('breadcrumb'))
               value="{{old('breadcrumb')}}"
           @else
               @if(isset($company))
                   value="{{$company->breadcrumb}}"
            @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="img">Изобржение:</label>
    <input class="form-control" type="text" name="img" id="img"
           @if(old('img'))
               value="{{old('img')}}"
           @else
               @if(isset($company))
                   value="{{$company->img}}"
            @endif
            @endif
    >
</div>
<div class="form-group">
    <label for="og_img">Изображение OpenGraph:</label>
    <input class="form-control" type="text" name="og_img" id="og_img"
           @if(old('og_img'))
               value="{{old('og_img')}}"
           @else
               @if(isset($company))
                   value="{{$company->og_img}}"
            @endif
            @endif
    >
</div>
<div class="form-group">
    <label for="text_before">Описание компании:</label>
    <textarea class="form-control" name="text_before" id="text_before">{{$company->text_before ?? old('text_before') ?? ''}}</textarea>
</div>

<div class="form-group">
    <label for="company_advantages">Преимущества компании:</label>
    <textarea class="form-control" name="company_advantages" id="company_advantages">{{$company->company_advantages ?? old('company_advantages') ?? ''}}</textarea>
</div>

<div class="form-group">
    <label for="text_after">Текст после карточек:</label>
    <textarea class="form-control" name="text_after" id="text_after">{{$company->text_after ?? old('text_after') ?? ''}}</textarea>
</div>
<div class="form-group">
    <label for="reviews_page">Отзывы на отдельной странице:</label>
    {{ Form::select('reviews_page', ['1' => 'Да', '0' => 'Нет'], $company->reviews_page ?? old('reviews_page') ?? 0, array('id' => 'reviews_page', 'class' => 'form-control')) }}
</div>
<div class="form-group">
    <label for="meta_description"><i>*</i> Мета - описание:</label>
    <textarea class="form-control" type="text" name="meta_description" id="meta_description" required>{{$company->meta_description ?? old('meta_description') ?? ''}}</textarea>
</div>

<?php /*
<div class="form-group">
    <label for="similars">Похожие компании:</label>
    {{ Form::select('similars[]', $companies, $company->similars, array('id' => 'similars', 'class' => 'form-control','multiple'=>true)) }}
</div>
*/ ?>

<div class="form-group">
    <label for="support_link">Ссылка "Служба поддержки":</label>
    <input class="form-control" type="text" name="support_link" id="support_link"
           @if(old('support_link'))
               value="{{old('support_link')}}"
           @else
               @if(isset($company))
                   value="{{$company->support_link}}"
            @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="account_link">Ссылка "Личный кабинет":</label>
    <input class="form-control" type="text" name="account_link" id="account_link"
           @if(old('account_link'))
               value="{{old('account_link')}}"
           @else
               @if(isset($company))
                   value="{{$company->account_link}}"
            @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="reviews_link">Ссылка "Отзывы":</label>
    <input class="form-control" type="text" name="reviews_link" id="reviews_link"
           @if(old('reviews_link'))
               value="{{old('reviews_link')}}"
           @else
               @if(isset($company))
                   value="{{$company->reviews_link}}"
            @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="closed">Закрыта:</label>
    {{ Form::select('closed', ['1' => 'Да', '0' => 'Нет'], $company->closed ?? old('closed') ?? '', ['id' => 'closed', 'class' => 'form-control']) }}
</div>

<div class="form-group">
    <label for="company_name">Название организации:</label>
    <input class="form-control" type="text" name="company_name" id="company_name"
           @if(old('company_name'))
               value="{{old('company_name')}}"
           @else
               @if(isset($company))
                   value="{{$company->company_name}}"
            @endif
            @endif
    >
</div>


<div class="form-group">
    <label for="link_vk">vk.com:</label>
    <input class="form-control" type="text" name="link_vk" id="link_vk"
           @if(old('link_vk'))
               value="{{old('link_vk')}}"
           @else
               @if(isset($company))
                   value="{{$company->link_vk}}"
            @endif
            @endif
    >
</div>
<div class="form-group">
    <label for="link_facebook">facebook.com:</label>
    <input class="form-control" type="text" name="link_facebook" id="link_facebook"
           @if(old('link_facebook'))
               value="{{old('link_facebook')}}"
           @else
               @if(isset($company))
                   value="{{$company->link_facebook}}"
            @endif
            @endif
    >
</div>
<div class="form-group">
    <label for="link_inst">instagram.com:</label>
    <input class="form-control" type="text" name="link_inst" id="link_inst"
           @if(old('link_inst'))
               value="{{old('link_inst')}}"
           @else
               @if(isset($company))
                   value="{{$company->link_inst}}"
            @endif
            @endif
    >
</div>
<div class="form-group">
    <label for="link_youtube">youtube.com:</label>
    <input class="form-control" type="text" name="link_youtube" id="link_youtube"
           @if(old('link_youtube'))
               value="{{old('link_youtube')}}"
           @else
               @if(isset($company))
                   value="{{$company->link_youtube}}"
            @endif
            @endif
    >
</div>
<div class="form-group">
    <label for="link_ok">ok.ru:</label>
    <input class="form-control" type="text" name="link_ok" id="link_ok"
           @if(old('link_ok'))
               value="{{old('link_ok')}}"
           @else
               @if(isset($company))
                   value="{{$company->link_ok}}"
            @endif
            @endif
    >
</div>
<div class="form-group">
    <label for="link_twitter">twitter.com:</label>
    <input class="form-control" type="text" name="link_twitter" id="link_twitter"
           @if(old('link_twitter'))
               value="{{old('link_twitter')}}"
           @else
               @if(isset($company))
                   value="{{$company->link_twitter}}"
            @endif
            @endif
    >
</div>
<div class="form-group">
    <label for="link_telegram">Телеграм:</label>
    <input class="form-control" type="text" name="link_telegram" id="link_telegram"
           @if(old('link_telegram'))
               value="{{old('link_telegram')}}"
           @else
               @if(isset($company))
                   value="{{$company->link_telegram}}"
            @endif
            @endif
    >
</div>


<div class="form-group">
    <label for="company_name">Иконки организации:</label>

    <div class="company_icons_wrap">
        <?php
        $companyArr = (!isset($company->icons) || $company->icons == null) ? [] : explode(',', $company->icons);
        ?>

        @foreach($icons as $name => $icon_category)
            <b>{{$name}} <i class="fa fa-arrows-v"></i></b>

            <div class="company_icons_group hide">
                @foreach($icon_category as $icon)
                    <div class="checkbox-wrap">
                        <label for="icon_{{$icon['id']}}">{{$icon['icon_name']}}</label>
                        @if(in_array($icon['id'], $companyArr))
                            <input type="checkbox" name="icons[]" value="{{$icon['id']}}" checked id="icon_{{$icon['id']}}">
                        @else
                            <input type="checkbox" name="icons[]" value="{{$icon['id']}}" id="icon_{{$icon['id']}}">
                        @endif
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>

<div class="form-group">
    <label for="regions">Регионы:</label><br>
    <?php $company_regions = isset($company->regions) ? explode(',',$company->regions) : []; ?>
    @foreach ($regions as $region_id => $region_name)
        <div class="checkbox width-10">
            <label>
                <input name="regions[]" value="{{$region_id}}" @if(in_array($region_id, $company_regions)) checked="true" @endif type="checkbox">
                {{$region_name}}
            </label>
        </div>
    @endforeach
</div>

<div class="form-group">
    <label for="author_id">ID автора:</label>
    <input class="form-control" type="number" min="1" name="author_id" id="author_id"
           @if(old('author_id'))
               value="{{old('author_id')}}"
           @else
               @if(isset($company))
                   value="{{$company->author_id}}"
            @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="status">Статус:</label>
    {{ Form::select('status', ['1' => 'Включена', '0' => 'Отключена'], $company->status ?? 0, array('id' => 'status', 'class' => 'form-control')) }}
</div>

<script src="/admin-assets/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="/admin-assets/tinymce/wysiwyg.js"></script>

<style>
    .company_icons_wrap{}
    .company_icons_group{
        border: 2px solid #ccc;
        padding: 5px;
        margin: 10px 0;
    }
    .checkbox-wrap{
        display: inline-block;
        width: 33%;
    }
    .company_icons_wrap >b{display: block}
</style>
<script>
    $('.company_icons_wrap >b').on('click',function () {
        $(this).next().toggleClass('hide');
    });

    tInit('#text_after');
</script>
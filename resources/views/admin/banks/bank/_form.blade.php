<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item active">
        <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Основное</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="requisites-tab" data-toggle="tab" href="#requisites" role="tab" aria-controls="requisites" aria-selected="false">Реквизиты</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="social-tab" data-toggle="tab" href="#social" role="tab" aria-controls="social" aria-selected="false">Социальные сети</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="show-tab" data-toggle="tab" href="#show" role="tab" aria-controls="show" aria-selected="false">Отображение</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <!------------------>
    <div class="tab-pane show active" id="home" role="tabpanel" aria-labelledby="home-tab">

        <div class="form-group">
            <label for="name"><i class="red">*</i> Название банка <span class="input_counter"></span></label>
            <input type="text" class="form-control" name="name" id="name" required
                   @if(old('name'))
            value="{{old('name')}}"
            @else
            @if(isset($item))
            value="{{$item->name}}"
            @endif
            @endif
            >
        </div>

        <div class="form-group">
            <label for="full_name"><i class="red">*</i> Полное название банка <span class="input_counter"></span></label>
            <input type="text" class="form-control" name="full_name" id="full_name" required
                   @if(old('full_name'))
            value="{{old('full_name')}}"
            @else
            @if(isset($item))
            value="{{$item->full_name}}"
            @endif
            @endif
            >
        </div>


        <div class="form-group">
            <label for="logo"><i class="red">*</i> Изображение <span class="input_counter"></span></label>
            <input type="text" class="form-control" name="logo" id="logo" required
                   @if(old('logo'))
                   value="{{old('logo')}}"
                   @else
                   @if(isset($item))
                   value="{{$item->logo}}"
                    @endif
                    @endif
            >
        </div>

        <div class="form-group">
            <label for="og_img">Изображение OpenGraph <span class="input_counter"></span></label>
            <input type="text" class="form-control" name="og_img" id="og_img"
                   @if(old('og_img'))
                   value="{{old('og_img')}}"
                   @else
                   @if(isset($item))
                   value="{{$item->og_img}}"
                    @endif
                    @endif
            >
        </div>

        <div class="form-group">
            <label for="alias"><i class="red">*</i> Алиас</label>
            <input type="text" class="form-control" name="alias" id="alias" required
                   @if(old('alias'))
                   value="{{old('alias')}}"
                   @else
                   @if(isset($item))
                   value="{{$item->alias}}"
                    @endif
                    @endif
            >
        </div>


        @include('admin.includes.partials.seo-fields-without-url')

        <div class="form-group">
            <label for="lead">Лид-абзац <span class="input_counter"></span></label>
            <?php
            $lead = old('lead')
                ? old('lead')
                : (isset($item) ? $item->lead : '');
            ?>
            <textarea class="form-control" name="lead" id="lead">{{$lead}}</textarea>
        </div>



        <div class="form-group">
            <label for="content">Контент <span class="input_counter"></span></label>
            <?php
            $content = old('content')
                ? old('content')
                : (isset($item) ? $item->content : '');
            ?>
            <textarea class="form-control" name="content" id="content">{{$content}}</textarea>
        </div>


        <div class="form-group">
            <label for="post_category_id"><i class="red">*</i> Категория базы знаний</label>
            <?php
            $current_post_category_id = old('post_category_id')
                ? old('post_category_id')
                : (isset($item) ? $item->post_category_id : 1);
            ?>
            {!! Form::select('post_category_id',$postCategories,$current_post_category_id,['id'=>'post_category_id','class' => 'form-control']) !!}
        </div>


        <div class="form-group">
            <label for="author_id">ID автора</label>
            <input type="number" class="form-control" min="1" name="author_id" id="author_id"
                   @if(old('author_id'))
                   value="{{old('author_id')}}"
                   @else
                   @if(isset($item))
                   value="{{$item->author_id}}"
                    @endif
                    @endif
            >
        </div>

        <div class="form-group">
            <label for="closed"><i class="red">*</i> Закрытый банк</label>
            <?php
            $current_closed = old('closed')
                ? old('closed')
                : (isset($item) ? $item->closed : 0);
            ?>
            {!! Form::select('closed',[0 => 'Нет', 1 => 'Да'],$current_closed,['id'=>'closed','class' => 'form-control','required' => true]) !!}
        </div>

        <div class="form-group">
            <label for="status"><i class="red">*</i> Статус</label>
            <?php
            $current_status = old('status')
                ? old('status')
                : (isset($item) ? $item->status : 1);
            ?>
            {!! Form::select('status',[0 => 'Выключено', 1 => 'Включено'],$current_status,['id'=>'status','class' => 'form-control','required' => true]) !!}
        </div>


    </div><!------------------>




    <!------------------>
    <div class="tab-pane fade" id="requisites" role="tabpanel" aria-labelledby="profile-tab">


        <div class="form-group">
            <label for="licence">Лицензия</label>
            <input type="text" class="form-control" name="licence" id="licence"
                   @if(old('licence'))
                   value="{{old('licence')}}"
                   @else
                   @if(isset($item))
                   value="{{$item->licence}}"
                    @endif
                    @endif
            >
        </div>

        <div class="form-group">
            <label for="bik">БИК</label>
            <input type="text" class="form-control" name="bik" id="bik"
                   @if(old('bik'))
                   value="{{old('bik')}}"
                   @else
                   @if(isset($item))
                   value="{{$item->bik}}"
                    @endif
                    @endif
            >
        </div>

        <div class="form-group">
            <label for="account">Кор. Счет</label>
            <input type="text" class="form-control" name="account" id="account"
                   @if(old('account'))
                   value="{{old('account')}}"
                   @else
                   @if(isset($item))
                   value="{{$item->account}}"
                    @endif
                    @endif
            >
        </div>


        <div class="form-group">
            <label for="city_id">Город главного отделения</label>
            <input type="text" class="form-control" name="city_id" id="city_id"
                   @if(old('city_id'))
                   value="{{old('city_id')}}"
                   @else
                   @if(isset($item))
                   value="{{$item->city_id}}"
                    @endif
                    @endif
            >
        </div>


        <div class="form-group">
            <label for="address">Адрес</label>
            <input type="text" class="form-control" name="address" id="address"
                   @if(old('address'))
                   value="{{old('address')}}"
                   @else
                   @if(isset($item))
                   value="{{$item->address}}"
                    @endif
                    @endif
            >
        </div>

        <div class="form-group">
            <label for="address_index">Индекс</label>
            <input type="text" class="form-control" name="address_index" id="address_index"
                   @if(old('address_index'))
                   value="{{old('address_index')}}"
                   @else
                   @if(isset($item))
                   value="{{$item->address_index}}"
                    @endif
                    @endif
            >
        </div>


        <div class="form-group">
            <label for="okato">ОКАТО</label>
            <input type="text" class="form-control" name="okato" id="okato"
                   @if(old('okato'))
                   value="{{old('okato')}}"
                   @else
                   @if(isset($item))
                   value="{{$item->okato}}"
                    @endif
                    @endif
            >
        </div>


        <div class="form-group">
            <label for="date_opened">Дата создания</label>
            <input type="date" class="form-control" name="date_opened" id="date_opened"
                   @if(old('date_opened'))
                   value="{{old('date_opened')}}"
                   @else
                   @if(isset($item))
                   value="{{$item->date_opened}}"
                    @endif
                    @endif
            >
        </div>


        <div class="form-group">
            <label for="swift">SWIFT</label>
            <input type="text" class="form-control" name="swift" id="swift"
                   @if(old('swift'))
                   value="{{old('swift')}}"
                   @else
                   @if(isset($item))
                   value="{{$item->swift}}"
                    @endif
                    @endif
            >
        </div>

        <div class="form-group">
            <label for="site">Сайт</label>
            <input type="text" class="form-control" name="site" id="site"
                   @if(old('site'))
                   value="{{old('site')}}"
                   @else
                   @if(isset($item))
                   value="{{$item->site}}"
                    @endif
                    @endif
            >
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" id="email"
                   @if(old('email'))
            value="{{old('email')}}"
            @else
            @if(isset($item))
            value="{{$item->email}}"
            @endif
            @endif
            >
        </div>

        <div class="form-group">
            <label for="phone">Телефон</label>
            <input type="text" class="form-control" name="phone" id="phone"
                   @if(old('phone'))
            value="{{old('phone')}}"
            @else
            @if(isset($item))
            value="{{$item->phone}}"
            @endif
            @endif
            >
        </div>

        <div class="form-group">
            <label for="ogrn">ОГРН</label>
            <input type="text" class="form-control" name="ogrn" id="ogrn"
                   @if(old('ogrn'))
            value="{{old('ogrn')}}"
            @else
            @if(isset($item))
            value="{{$item->ogrn}}"
            @endif
            @endif
            >
        </div>

        <div class="form-group">
            <label for="okpo">ОКПО</label>
            <input type="text" class="form-control" name="okpo" id="okpo"
                   @if(old('okpo'))
            value="{{old('okpo')}}"
            @else
            @if(isset($item))
            value="{{$item->okpo}}"
            @endif
            @endif
            >
        </div>

        <div class="form-group">
            <label for="inn">ИНН</label>
            <input type="text" class="form-control" name="inn" id="inn"
                   @if(old('inn'))
                   value="{{old('inn')}}"
                   @else
                   @if(isset($item))
                   value="{{$item->inn}}"
                    @endif
                    @endif
            >
        </div>

        <div class="form-group">
            <label for="kpp">КПП</label>
            <input type="text" class="form-control" name="kpp" id="kpp"
                   @if(old('kpp'))
                   value="{{old('kpp')}}"
                   @else
                   @if(isset($item))
                   value="{{$item->kpp}}"
                    @endif
                    @endif
            >
        </div>

        <div class="form-group">
            <label for="leadership">Руководство</label>
            <input type="text" class="form-control" name="leadership" id="leadership"
                   @if(old('leadership'))
                   value="{{old('leadership')}}"
                   @else
                   @if(isset($item))
                   value="{{$item->leadership}}"
                    @endif
                    @endif
            >
        </div>


    </div><!------------------>











    <!------------------>
    <div class="tab-pane fade" id="social" role="tabpanel" aria-labelledby="social-tab">

        <div class="form-group">
            <label for="link_vk">vk.com</label>
            <input type="text" class="form-control" name="link_vk" id="link_vk"
                   @if(old('link_vk'))
                   value="{{old('link_vk')}}"
                   @else
                   @if(isset($item))
                   value="{{$item->link_vk}}"
                    @endif
                    @endif
            >
        </div>

        <div class="form-group">
            <label for="link_facebook">facebook.com</label>
            <input type="text" class="form-control" name="link_facebook" id="link_facebook"
                   @if(old('link_facebook'))
                   value="{{old('link_facebook')}}"
                   @else
                   @if(isset($item))
                   value="{{$item->link_facebook}}"
                    @endif
                    @endif
            >
        </div>


        <div class="form-group">
            <label for="link_inst">instagram.com</label>
            <input type="text" class="form-control" name="link_inst" id="link_inst"
                   @if(old('link_inst'))
                   value="{{old('link_inst')}}"
                   @else
                   @if(isset($item))
                   value="{{$item->link_inst}}"
                    @endif
                    @endif
            >
        </div>

        <div class="form-group">
            <label for="link_youtube">youtube.com</label>
            <input type="text" class="form-control" name="link_youtube" id="link_youtube"
                   @if(old('link_youtube'))
                   value="{{old('link_youtube')}}"
                   @else
                   @if(isset($item))
                   value="{{$item->link_youtube}}"
                    @endif
                    @endif
            >
        </div>

        <div class="form-group">
            <label for="link_ok">ok.ru</label>
            <input type="text" class="form-control" name="link_ok" id="link_ok"
                   @if(old('link_ok'))
                   value="{{old('link_ok')}}"
                   @else
                   @if(isset($item))
                   value="{{$item->link_ok}}"
                    @endif
                    @endif
            >
        </div>

        <div class="form-group">
            <label for="link_twitter">twitter.com</label>
            <input type="text" class="form-control" name="link_twitter" id="link_twitter"
                   @if(old('link_twitter'))
                   value="{{old('link_twitter')}}"
                   @else
                   @if(isset($item))
                   value="{{$item->link_twitter}}"
                    @endif
                    @endif
            >
        </div>

        <div class="form-group">
            <label for="link_telegram">Телеграм</label>
            <input type="text" class="form-control" name="link_telegram" id="link_telegram"
                   @if(old('link_telegram'))
            value="{{old('link_telegram')}}"
            @else
            @if(isset($item))
            value="{{$item->link_telegram}}"
            @endif
            @endif
            >
        </div>




    </div><!------------------>







    <!------------------>
    <div class="tab-pane fade" id="show" role="tabpanel" aria-labelledby="show-tab">

        <div class="form-group">
            <label for="show_credits">Показывать кредиты</label>
            <?php
            $current_show_credits = old('show_credits')
                ? old('show_credits')
                : (isset($item) ? $item->show_credits : 1);
            ?>
            {!! Form::select('show_credits',[0 => 'Скрыть', 1 => 'Показать'],$current_show_credits,['id'=>'show_credits','class' => 'form-control']) !!}
        </div>


        <div class="form-group">
            <label for="show_auto_credits">Показывать автокредиты</label>
            <?php
            $current_show_auto_credits = old('show_auto_credits')
                ? old('show_auto_credits')
                : (isset($item) ? $item->show_auto_credits : 1);
            ?>
            {!! Form::select('show_auto_credits',[0 => 'Скрыть', 1 => 'Показать'],$current_show_auto_credits,['id'=>'show_auto_credits','class' => 'form-control']) !!}
        </div>


        <div class="form-group">
            <label for="show_credit_cards">Показывать кредитные карты</label>
            <?php
            $current_show_credit_cards = old('show_credit_cards')
                ? old('show_credit_cards')
                : (isset($item) ? $item->show_credit_cards : 1);
            ?>
            {!! Form::select('show_credit_cards',[0 => 'Скрыть', 1 => 'Показать'],$current_show_credit_cards,['id'=>'show_credit_cards','class' => 'form-control']) !!}
        </div>


        <div class="form-group">
            <label for="show_debit_cards">Показывать дебетовые карты</label>
            <?php
            $current_show_debit_cards = old('show_debit_cards')
                ? old('show_debit_cards')
                : (isset($item) ? $item->show_debit_cards : 1);
            ?>
            {!! Form::select('show_debit_cards',[0 => 'Скрыть', 1 => 'Показать'],$current_show_debit_cards,['id'=>'show_debit_cards','class' => 'form-control']) !!}
        </div>


        <div class="form-group">
            <label for="show_deposits">Показывать вклады</label>
            <?php
            $current_show_deposits = old('show_deposits')
                ? old('show_deposits')
                : (isset($item) ? $item->show_deposits : 1);
            ?>
            {!! Form::select('show_deposits',[0 => 'Скрыть', 1 => 'Показать'],$current_show_deposits,['id'=>'show_deposits','class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            <label for="show_mortgage">Показывать ипотеки</label>
            <?php
            $current_show_mortgage = old('show_mortgage')
                ? old('show_mortgage')
                : (isset($item) ? $item->show_mortgage : 1);
            ?>
            {!! Form::select('show_mortgage',[0 => 'Скрыть', 1 => 'Показать'],$current_show_mortgage,['id'=>'show_mortgage','class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            <label for="show_refinancing">Показывать рефинансирование</label>
            <?php
            $current_show_refinancing = old('show_refinancing')
                ? old('show_refinancing')
                : (isset($item) ? $item->show_refinancing : 1);
            ?>
            {!! Form::select('show_refinancing',[0 => 'Скрыть', 1 => 'Показать'],$current_show_refinancing,['id'=>'show_refinancing','class' => 'form-control']) !!}
        </div>


        <div class="form-group">
            <label for="show_rko">Показывать РКО</label>
            <?php
            $current_show_rko = old('show_rko')
                ? old('show_rko')
                : (isset($item) ? $item->show_rko : 1);
            ?>
            {!! Form::select('show_rko',[0 => 'Скрыть', 1 => 'Показать'],$current_show_rko,['id'=>'show_rko','class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            <label for="show_cashback">Показывать кэшбэки</label>
            <?php
            $current_show_cashback = old('show_cashback')
                ? old('show_cashback')
                : (isset($item) ? $item->show_cashback : 1);
            ?>
            {!! Form::select('show_cashback',[0 => 'Скрыть', 1 => 'Показать'],$current_show_cashback,['id'=>'show_cashback','class' => 'form-control']) !!}
        </div>


        <div class="form-group">
            <label for="show_fast_payment_system">Показывать систему быстрых платежей</label>
            <?php
            $current_show_fast_payment_system = old('show_fast_payment_system')
                ? old('show_fast_payment_system')
                : (isset($item) ? $item->show_fast_payment_system : 1);
            ?>
            {!! Form::select('show_fast_payment_system',[0 => 'Скрыть', 1 => 'Показать'],$current_show_fast_payment_system,['id'=>'show_fast_payment_system','class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            <label for="show_acquiring">Показывать эквайринг</label>
            <?php
            $current_show_acquiring = old('show_acquiring')
                ? old('show_acquiring')
                : (isset($item) ? $item->show_acquiring : 1);
            ?>
            {!! Form::select('show_acquiring',[0 => 'Скрыть', 1 => 'Показать'], $current_show_acquiring, ['id'=>'show_acquiring','class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            <label for="show_other_banks_best_offers">Показывать лучшие предложения других банков</label>
            <?php
            $current_show_other_banks_best_offers = old('show_other_banks_best_offers')
                ? old('show_other_banks_best_offers')
                : (isset($item) ? $item->show_other_banks_best_offers : 0);
            ?>
            {!! Form::select('show_other_banks_best_offers',[0 => 'Скрыть', 1 => 'Показать'], $current_show_other_banks_best_offers, ['id'=>'show_other_banks_best_offers','class' => 'form-control']) !!}
        </div>


    </div>
</div>


<style>
    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        color: #495057;
        background-color: #fff;
        border-color: #dee2e6 #dee2e6 #fff;
    }
    .tab-content>.tab-pane {
        display: none !important;
    }
    .tab-content>.active {
        display: block !important;
    }

</style>

<script src="/admin-assets/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="/admin-assets/tinymce/wysiwyg.js"></script>
<script>
    tInit('#content');
</script>
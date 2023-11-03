<div class="bank-wrap">
    <input type="text" name="searchByBanks" id="searchByBanks" placeholder="Поиск по названию банка...">

    <?php $per_page_items = $banks->chunk(10);?>
    @foreach($per_page_items as $key=>$page_items)
        <div class="banks-page-{{$key+1}} banks-page" data-page="{{$key+1}}">
            @foreach($page_items as $key => $bank)
                <div class="bank-flex-item">
                    <div class="showed-line">
                        <div class="showed-wrapper column-1" data-label="Название банка">
                            <div class="small-img-wrap">
                                <img loading="lazy" class="bank-logo" src="{{$bank->logo}}" alt="">
                            </div>
                            <div class="company_title">
                                <a class="black-uppercase-link" href="/banki/{{$bank->alias}}">{{$bank->name}}</a>
                                <div>Лицензия: {{$bank->licence}}</div>
                            </div>
                        </div>
                        <div class="showed-wrapper column-3" data-label="Контакты">
                            <div>{{$bank->phone}}</div>
                            <a class="hotline-link" href="/banki/{{$bank->alias}}/hotline">Служба поддержки</a>
                        </div>
                        <div class="showed-wrapper column-4" data-label="Оценка пользователей">
                            <div class="banks_reviews_count"><a href="/banki/{{$bank->alias}}/reviews">{{$bank->ratingCount}} {{word_by_count($bank->ratingCount, ['отзыв', 'отзыва', 'отзывов'])}}</a></div>
                            {!! App\Models\System::rating($bank->ratingValue) !!}
                        </div>
                    </div>
                    @if(is_mobile_device())
                    <span class="bvc-read">Продукты банка <i class="fa fa-angle-down"></i></span>
                    <div class="hidden-line">
                        <div class="bank-types-wrap">
                            @if($bank->show_credit_cards)
                                <a href="/banki/{{$bank->alias}}/credit-cards" class="bank-types-a fa-icon fa-credit-card">Кредитные карты</a>
                            @endif
                            @if($bank->show_debit_cards)
                                <a href="/banki/{{$bank->alias}}/debit-cards" class="bank-types-a fa-icon fa-credit-card-alt">Дебетовые карты</a>
                            @endif
                            @if($bank->show_auto_credits)
                                <a href="/banki/{{$bank->alias}}/autocredit" class="bank-types-a fa-icon fa-automobile">Автокредиты</a>
                            @endif
                            @if($bank->show_deposits)
                                <a href="/banki/{{$bank->alias}}/deposits" class="bank-types-a fa-icon fa-gift">Вклады</a>
                            @endif
                            @if($bank->show_credits)
                                <a href="/banki/{{$bank->alias}}/credits" class="bank-types-a fa-icon fa-bank">Кредиты</a>
                            @endif
                            @if($bank->show_mortgage)
                                <a href="/banki/{{$bank->alias}}/mortgage" class="bank-types-a fa-icon fa-life-buoy">Ипотеки</a>
                            @endif
                            @if($bank->show_refinancing)
                                <a href="/banki/{{$bank->alias}}/refinancing" class="bank-types-a fa-icon fa-id-card">Рефинансирование</a>
                            @endif
                            @if($bank->show_rko)
                                <a href="/banki/{{$bank->alias}}/rko" class="bank-types-a fa-icon fa-id-card">РКО</a>
                            @endif
                        </div>
                        <?php /*
                        <div class="bank-btn-wrap">
                            <a href="/banki/{{$bank->alias}}/branches" class="form-btn1">Отделения</a>
                            <a href="/banki/{{$bank->alias}}/bankomates" class="form-btn1">Банкоматы</a>
                        </div>
                        */ ?>
                    </div>
                    @else
                        <span class="bvc-read-pc header-label-rating">Продукты банка</span>
                            <span class="bank-types-wrap">
                                @if($bank->show_credit_cards)
                                    <a href="/banki/{{$bank->alias}}/credit-cards" class="bank-types-a fa-icon fa-credit-card">Кредитные карты</a>
                                @endif
                                @if($bank->show_debit_cards)
                                    <a href="/banki/{{$bank->alias}}/debit-cards" class="bank-types-a fa-icon fa-credit-card-alt">Дебетовые карты</a>
                                @endif
                                @if($bank->show_auto_credits)
                                    <a href="/banki/{{$bank->alias}}/autocredit" class="bank-types-a fa-icon fa-automobile">Автокредиты</a>
                                @endif
                                @if($bank->show_deposits)
                                    <a href="/banki/{{$bank->alias}}/deposits" class="bank-types-a fa-icon fa-gift">Вклады</a>
                                @endif
                                @if($bank->show_credits)
                                    <a href="/banki/{{$bank->alias}}/credits" class="bank-types-a fa-icon fa-bank">Кредиты</a>
                                @endif
                                @if($bank->show_mortgage)
                                    <a href="/banki/{{$bank->alias}}/mortgage" class="bank-types-a fa-icon fa-life-buoy">Ипотеки</a>
                                @endif
                                @if($bank->show_refinancing)
                                    <a href="/banki/{{$bank->alias}}/refinancing" class="bank-types-a fa-icon fa-id-card">Рефинансирование</a>
                                @endif
                                @if($bank->show_rko)
                                    <a href="/banki/{{$bank->alias}}/rko" class="bank-types-a fa-icon fa-id-card">РКО</a>
                                @endif
                            </span>
                            <?php /*
                        <div class="bank-btn-wrap">
                            <a href="/banki/{{$bank->alias}}/branches" class="form-btn1">Отделения</a>
                            <a href="/banki/{{$bank->alias}}/bankomates" class="form-btn1">Банкоматы</a>
                        </div>
                        */ ?>

                    @endif
                </div>
            @endforeach
        </div>
    @endforeach
</div>

<ul class="pagination"></ul>
@section('additional-scripts')
    @parent
@endsection
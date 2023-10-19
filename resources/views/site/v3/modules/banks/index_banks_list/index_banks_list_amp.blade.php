<div class="ltable-wrap">
    @foreach($banks as $bank)
        <div class="amp-bank-block shadow">
            <div class="amp-bank-block-title">
                <div class="small-img-wrap">
                    <amp-img width="125" height="60" layout="fixed" src="{{$bank->logo}}" alt="{{$bank->name}}"></amp-img>
                </div>
                <a class="h4" href="/banks/{{$bank->alias}}">{{$bank->name}}</a>
            </div>
            <div><div class="bank-details">Рейтинг К5М</div> {{App\Algorithms\Frontend\Banks\K5MBank::getRatingByBankID($bank->id)}}</div>
            <div><div class="bank-details">Контакты</div> {{$bank->phone}}</div>
            <div>
                <div class="bank-details">Оценка пользователей</div>
                <div class="bank-rate-block">
                    {!! RatingParser::printImgRatingByValueForAMP($bank->ratingValue) !!}
                    <a href="/banks/{{$bank->alias}}/reviews">{{$bank->number_of_votes}} {{word_by_count($bank->number_of_votes, ['отзыв', 'отзыва', 'отзывов'])}}</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
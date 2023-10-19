<div>
    <span class="card-mn-label">Сумма</span>
    <b>до {{cardHeader1($card->header_1,$card->category_id)}}</b>
</div>
<div>
    <span class="card-mn-label">Ставка</span>
    <b>{{cardHeader3($card->header_3,$card->category_id)}}</b>
</div>
<div>
    <span class="card-mn-label">Срок</span>
    <b>до {{$card->header_2}} {{System::endWordsForLoansDays($card->header_2)}}</b>
</div>
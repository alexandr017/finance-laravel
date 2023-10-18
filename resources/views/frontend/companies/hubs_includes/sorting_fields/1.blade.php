<input id="search-company" type="text" placeholder="Поиск компании по названию...">
@if(Auth::id() != 12467)
<div class="sorting-line habs_items">
    <ul>
        <li class="first-item">Сортировать: </li>
        <li class="sort-item up active" data-field="km5"><i class="fa fa-arrow-circle-down"></i> <span>Рейтинг К5М</span></li>
        <li class="sort-item" data-field="ratingValue"><i></i> <span>Оценка пользователей</span></li>
        <li class="sort-item" data-field="ratingCount"><i></i> <span>Больше всего отзывов</span></li>
        <li class="sort-item" data-field="sum_max"><i></i> <span>Максимальная сумма</span></li>
    </ul>
</div>
@else
<div class="sorting-line habs_items">
    <ul>
        <li class="first-item">Сортировать: </li>
        <li class="sort-item up active" data-field="km5"><i class="fa fa-arrow-circle-down"></i> <span>Рейтинг К5М</span></li>
        <li class="sort-item" data-field="ratingValue"><i></i> <span>Оценка пользователей</span></li>
        <li class="sort-item" data-field="ratingCount"><i></i> <span>Больше всего отзывов</span></li>
        <li class="sort-item" data-field="sum_max"><i></i> <span>Максимальная сумма</span></li>
    </ul>
</div>
@endif
<div class="school_reviews" id="reviews">
    <h2 class="school_reviews_title subblock_title" id="vote">
        Отзывы о школе
        <span class="school_reviews_title_count">
            (22)
        </span>
    </h2>

    <div class="school_reviews_cont">
        <div class="product-sort-cont">
            <button  class="product-sort-btn" data-sort-order="" data-sort-value="rating" onclick="sortPanel(event, {{$company->id}})">
                Рейтинг
                <img src="/images/sort-panel/arrow_up_black.svg" alt="Фильтрация по возрастанию" title="Фильтрация по возрастанию">
            </button>

            <button  class="product-sort-btn" data-sort-order="" data-sort-value="created_at" onclick="sortPanel(event, {{$company->id}})">
                Дата отзыва
                <img src="/images/sort-panel/arrow_up_black.svg" alt="Фильтрация по возрастанию" title="Фильтрация по возрастанию">
            </button>
        </div>

        @include('site.v3.modules.company-reviews.company-reviews', ['reviews' => $company->reviews])

    </div>
</div>


@push('styles')
    <link href="{{ Vite::asset('resources/css/company/company-reviews-main.css') }}" rel="stylesheet">
@endpush

<script>
    let companyId = @json($company->id);
</script>
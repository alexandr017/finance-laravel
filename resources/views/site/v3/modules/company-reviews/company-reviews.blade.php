<div class="school_reviews_cont">

    <div class="bx-section-desc bx-blue">
        <p class="bx-section-desc-post"></p>
    </div>

    <div class="reviews_slider_cont_scroll">

        <div class="reviews_slider_cont bx-blue" id="reviews-block-all" data-entity="container-1">
            <!-- items-container -->
            <div class="row product-item-list-col-2" id="reviews-block" data-entity="items-row">

                @foreach($reviews as $review)
                    @include('site.v3.modules.company-reviews.company-review', ['review' => $review, 'company' => $company ?? $review->company])
                @endforeach

            </div>
            <!-- items-container -->
            <div class="product-items-more-btn show_more_btn_color" data-use="show-more-1" onclick="showMore()">
                Показать ещё
            </div>
        </div>
    </div>

</div>

@push('styles')
    <link href="{{ Vite::asset('resources/css/company/company-reviews.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ Vite::asset('resources/js/company/company-reviews.js') }}"></script>
@endpush

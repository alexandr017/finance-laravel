<li class="categories_slider-cont swiper_styles-item swiper-slide swiper-slide-active" id="bx_1847241719_45" role="group" aria-label="1 / 17">
    <div>
        <a href="{{$listing->url?->url}}" class="listing-link">
            <img class="section_slider-black_img" src="/images/listing-icons/{{__('listing-icons.' . $listing->name)}}_01.svg" alt="{{$listing->name}}" title="{{$listing->name}}">
            <img class="section_slider-grey_img" src="/images/listing-icons/{{__('listing-icons.' . $listing->name)}}_03.svg" alt="{{$listing->name}}" title="{{$listing->name}}">
            <img class="section_slider-blue_img" src="/images/listing-icons/{{__('listing-icons.' . $listing->name)}}_02.svg" alt="{{$listing->name}}" title="{{$listing->name}}">
            <span>
                {{$listing->name}}
            </span>
        </a>
    </div>

    <ul class="second_lvl" id=`second_lvl_{{$listing->id}}`>
        <input type="checkbox" name="" id=`open_section_{{$listing->id}}` value="" onchange="handleCategoryItems(event)">

        <div>
            @foreach($listing->childes as $key => $child)
                @if ( $key < 5 )
                    <li class="" id="bx_1847241719_450">
                        <div>
                            <a href="{{$child->url?->url}}">
                                <span>
                                    {{$child->name}}
                                </span>
                            </a>
                        </div>
                    </li>
                @endif
            @endforeach
        </div>

        <div id='category-items-second-part' style="display: none">
            @foreach($listing->childes as $key => $child)
                @if($key > 4)
                    <li class="" id="bx_1847241719_450">
                        <div>
                            <a href="{{$child->url?->url}}">
                        <span>
                            {{$child->name}}
                        </span>
                            </a>
                        </div>
                    </li>
                @endif
            @endforeach
        </div>

        <label for=`open_section_{{$listing->id}}` class="open_section_btn"> Ещё {{$listing->childes->count() - 5}} </label>
        <label for=`open_section_{{$listing->id}}` class="close_section_btn"> Скрыть {{$listing->childes->count() - 5}} </label>
    </ul>
</li>


@push('styles')
    <link href="{{ Vite::asset('resources/css/mainpage/mainpage-category-item.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ Vite::asset('resources/js/company/company-review.js') }}"></script>
@endpush



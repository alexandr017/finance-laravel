<div class="catalog-section bx-blue" id = 'courses_block' data-entity="container-3">
    <!-- items-container -->
    @foreach($courses as $course)
        {{--items-row--}}
        @include('site.v3.modules.courses.course')
    @endforeach

    <!-- items-container -->
</div>
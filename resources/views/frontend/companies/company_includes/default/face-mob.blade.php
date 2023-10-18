<div class="row" itemscope itemtype="http://schema.org/Article">
    <div class="col-md-4">
        <div class="top-credit-cards">
            <meta itemprop="datePublished" content="{{$company->created_at}}" />
            <meta itemprop="dateModified" content="{{$company->updated_at}}" />
            <meta itemprop="author" content="Максим Иванов" />
            <meta itemprop="headline" content="{{$company->h1}}" />
            <meta itemprop="image" content="{{$company->img}}" />
            <meta itemprop="mainEntityOfPage" content="https://finance.ru{{$_SERVER['REQUEST_URI']}}" />

            <div itemprop="publisher" itemscope="" itemtype="https://schema.org/Organization">
                <meta itemprop="description" content="{{$company->meta_description}}" />
                <meta itemprop="image" content="{{$company->img}}" />
                <meta itemprop="name" content="{{$company->h1}}" />

                <span @if($company->closed) class="closed-company" @endif itemprop="logo image" itemscope="" itemtype="https://schema.org/ImageObject">
                                <img itemprop="url contentUrl" src="https://finance.ru{{$company->img}}" alt="{{$company->h1}}" class="alignleft no-margin">
                                <meta itemprop="width" content="250">
                                <meta itemprop="height" content="120">
                            </span>
                <meta itemprop="url" content="https://finance.ru{{$_SERVER['REQUEST_URI']}}" />
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <?php /* <h1 itemprop="name" class="p2-h1">{{$company->h1}}</h1> */ ?>
        <p class="pupdate">
            <span class="pup-inner">Обновлено в <span class="lowercase">{{System::getCurrentMonth(false)}}</span> {{date('Y')}}</span>
        </p>
        <?php $ratingValue = \App\Algorithms\Frontend\Banks\BankReviews::getRatingByReviews($reviews); ?>
        @if(isset($cards[0]))
        <div class="rating-line micro">
            {!! App\Models\System::rating($ratingValue) !!}
            <div class="text-rating">
                <a rel="nofollow" href="{{$cards[0]->link_to_reviews_page}}">{{count($reviews)}} {{System::endWords(count($reviews), ['отзыв', 'отзыва', 'отзывов'])}}</a>
            </div>
            <div class="val-rating">({{$ratingValue}} из 5)</div>
        </div>
        @endif
        <?php echo Shortcode::compile(System::nofollow($company->text_before)); ?>
    </div>
</div>
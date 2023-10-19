<div id="zero-pos" class="zero-pos">
    @if($page->h2 !=null)
        <h2 class="sub-line">{{Shortcode::compile($page->h2)}}</h2>
    @else
        <h2 class="sub-line">{{Shortcode::compile($page->h1)}} рейтинг {{date('Y')}}</h2>
    @endif
    <?php $textForShortCode = '' ?>
    <ul class="accordeon-list">
        <?php $i=0; ?>
        @foreach($cards as $card)
            <li><a href="#card-{{$card->id}}">{{$card->title}}</a></li>
            <?php $textForShortCode .= $card->title. '. ' ?>
            <?php $i++; ?>
            <?php if($i>9) break;  ?>
        @endforeach
    </ul>
</div>

<?php $titleForShortCode = $page->h2 != null ? Shortcode::compile($page->h2) : Shortcode::compile($page->h1); ?>
<?php
    Shortcode::compile('[sfaq em="128285" type="question"]'.$titleForShortCode.'[/sfaq]');
    Shortcode::compile('[sfaq em="128285" type="answer"]'.$textForShortCode.'[/sfaq]');
?>

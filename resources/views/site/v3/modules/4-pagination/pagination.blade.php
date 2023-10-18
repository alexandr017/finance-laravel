@if(isset($pagesCount) && isset($pageNumber) && isset($pageAlias))
    <!-- <div class="pagination flex" data-pagescount="{{$pagesCount}}" data-pagealias="{{$pageAlias}}"></div>-->
    <div class="pagination flex" data-pagescount="{{$pagesCount}}">
            <?php
            $pagesGetParam = '';
            $pagesGetParam = (request()->get('posttag') != null) ? '?posttag='.request()->get('posttag') : '';
            if(strpos($pageAlias,"-amp")){
                $pageAlias = str_replace("-amp","",$pageAlias);
            }
            ?>
            <?php if(ceil($pagesCount) >= 5) { ?>
            <?php if($pageNumber < 5) : ?>
        <a href="/{{$pageAlias}}{{$pagesGetParam}}" class="pagination-inner-link<?php if($pageNumber==1) echo ' pagination-current-page';?>">1</a>
        <a href="/{{$pageAlias}}/page/2{{$pagesGetParam}}" class="pagination-inner-link<?php if($pageNumber==2) echo ' pagination-current-page';?>">2</a>
        <a href="/{{$pageAlias}}/page/3{{$pagesGetParam}}" class="pagination-inner-link<?php if($pageNumber==3) echo ' pagination-current-page';?>">3</a>
        <a href="/{{$pageAlias}}/page/4{{$pagesGetParam}}" class="pagination-inner-link<?php if($pageNumber==4) echo ' pagination-current-page';?>">4</a>
        <a href="/{{$pageAlias}}/page/5{{$pagesGetParam}}" class="pagination-inner-link<?php if($pageNumber==5) echo ' pagination-current-page';?>">5</a>
        <a href="/{{$pageAlias}}/page/<?= $pagesCount ?>{{$pagesGetParam}}" class="pagination-next-btn next-btn flex">
            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="17" viewBox="0 0 10 17" fill="none">
                <path d="M1 16L9 8.5L1 1" stroke="#888888" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>

        <?php else : ?>
        <a href="/{{$pageAlias}}{{$pagesGetParam}}" class="pagination-prev-btn prev-btn flex">
            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="18" viewBox="0 0 10 18" fill="none">
                <path d="M9 1L1 9L9 17" stroke="#888" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>
        <a href="/{{$pageAlias}}/page/<?= ($pageNumber - 2) ?>{{$pagesGetParam}}" class="pagination-inner-link"><?= ($pageNumber - 2) ?></a>
        <a href="/{{$pageAlias}}/page/<?= ($pageNumber - 1) ?>{{$pagesGetParam}}" class="pagination-inner-link"><?= ($pageNumber - 1) ?></a>
        <a class="pagination-current-page"><?= $pageNumber ?></a>
            <?php if($pageNumber <= (ceil($pagesCount) -2)): ?>
        <a href="/{{$pageAlias}}/page/<?= ($pageNumber + 1) ?>{{$pagesGetParam}}" class="pagination-inner-link"><?= ($pageNumber + 1) ?></a>
            <?php if($pageNumber < (ceil($pagesCount) -1)): ?>
        <a href="/{{$pageAlias}}/page/<?= ($pageNumber + 2) ?>{{$pagesGetParam}}" class="pagination-inner-link"><?= ($pageNumber + 2) ?></a>
            <?php if(($pageNumber != ceil($pagesCount)) && ($pageNumber+2 != ceil($pagesCount))): ?>
        <a href="/{{$pageAlias}}/page/<?= $pagesCount ?>{{$pagesGetParam}}" class="pagination-next-btn next-btn flex">
            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="17" viewBox="0 0 10 17" fill="none">
                <path d="M1 16L9 8.5L1 1" stroke="#888888" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>
        <?php endif ?>
        <?php endif ?>
        <?php else : ?>
            <?php if($pageNumber+1 != ceil($pagesCount) && ($pageNumber != $pagesCount)) : ?>
        <a href="/{{$pageAlias}}/page/<?= $pagesCount ?>{{$pagesGetParam}}" class="pagination-next-btn next-btn flex">
            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="17" viewBox="0 0 10 17" fill="none">
                <path d="M1 16L9 8.5L1 1" stroke="#888888" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>
        <?php else : ?>
            <?php if($pageNumber == ceil($pagesCount)) : ?>
        <?php else : ?>
        <a href="/{{$pageAlias}}/page/<?= $pagesCount ?>{{$pagesGetParam}}" class="pagination-inner-link"><?= $pagesCount ?></a>
        <?php endif; ?>
        <?php endif; ?>
        <?php endif; ?>
        <?php endif; ?>

        <?php } elseif(ceil($pagesCount) == 4){ ?>
        <a href="/{{$pageAlias}}{{$pagesGetParam}}" class="pagination-inner-link<?php if($pageNumber==1) echo ' pagination-current-page';?>">1</a>
        <a href="/{{$pageAlias}}/page/2{{$pagesGetParam}}" class="pagination-inner-link<?php if($pageNumber==2) echo ' pagination-current-page';?>">2</a>
        <a href="/{{$pageAlias}}/page/3{{$pagesGetParam}}" class="pagination-inner-link<?php if($pageNumber==3) echo ' pagination-current-page';?>">3</a>
        <a href="/{{$pageAlias}}/page/4{{$pagesGetParam}}" class="pagination-inner-link<?php if($pageNumber==4) echo ' pagination-current-page';?>">4</a>
        <?php } elseif(ceil($pagesCount) == 3){ ?>
        <a href="/{{$pageAlias}}{{$pagesGetParam}}" class="pagination-inner-link<?php if($pageNumber==1) echo ' pagination-current-page';?>">1</a>
        <a href="/{{$pageAlias}}/page/2{{$pagesGetParam}}" class="pagination-inner-link<?php if($pageNumber==2) echo ' pagination-current-page';?>">2</a>
        <a href="/{{$pageAlias}}/page/3{{$pagesGetParam}}" class="pagination-inner-link<?php if($pageNumber==3) echo ' pagination-current-page';?>">3</a>
        <?php } elseif(ceil($pagesCount) == 2){ ?>
        <a href="/{{$pageAlias}}{{$pagesGetParam}}" class="pagination-inner-link<?php if($pageNumber==1) echo ' pagination-current-page';?>">1</a>
        <a href="/{{$pageAlias}}/page/2{{$pagesGetParam}}" class="pagination-inner-link<?php if($pageNumber==2) echo ' pagination-current-page';?>">2</a>
        <?php } ?>
    </div>
@endif

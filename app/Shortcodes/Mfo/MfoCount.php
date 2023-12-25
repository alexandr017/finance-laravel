<?php

namespace App\Shortcodes\Mfo;

use App\Models\Urls\Url;
use App\Shortcodes\BaseShortcode;
use Request;
use DB;
use App\Repositories\Frontend\Card\CardRepository;

class MfoCount extends BaseShortcode
{
    public function register($shortcode, $content, $compiler, $name, $viewData = false)
    {
        $c = null;

        if ($shortcode->url) {
            $listing = Url::where('url', $shortcode->url)->first();

            if (!$listing) return 0;

            $c = app(CardRepository::class)->getSortedCards($listing->section_type, $listing->section_id);

        } else {
            global $c;
        }

        if ($c == null) {
            return 0;
        }

        $result = [];

        foreach ($c as $card) {
            if ($card->company_id && !in_array($card->company_id, $result)) {
                $result[] = $card->company_id;
            }
        }

        return count($result);
    }
}
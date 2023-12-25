<?php

namespace App\Shortcodes\Banks;

use App\Shortcodes\BaseShortcode;
use App\Models\Banks\Bank;

class BanksCount extends BaseShortcode
{
    public function register($shortcode, $content, $compiler, $name, $viewData = false)
    {
        global $c;

        if ($c == null) {
            return Bank::select('id')
                ->where(['status' => 1])
                ->whereNull('deleted_at')
                ->get()
                ->count();
        }

        $result = [];

        foreach ($c as $card) {
            if ($card->bank_id && !in_array($card->bank_id, $result)) {
                $result[] = $card->bank_id;
            }
        }

        return count($result);
    }

}
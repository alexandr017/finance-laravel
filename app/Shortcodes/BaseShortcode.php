<?php

namespace App\Shortcodes;

class BaseShortcode
{
    protected $template;

    public function __construct()
    {

        if (is_amp_page()) {
            $this->template = 'amp';
            return;
        }

        if (is_turbo_page()) {
            $this->template = 'turbo';
            return;
        }

        if (is_mobile_device()) {
            $this->template = 'mob';
            $GLOBALS['template'] = $this->template;
            return;
        }

        $this->template = 'pc';
        $GLOBALS['template'] = $this->template;
        return;
    }
}

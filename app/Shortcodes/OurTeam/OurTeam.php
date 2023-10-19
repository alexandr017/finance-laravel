<?php
namespace App\Shortcodes\OurTeam;

use App\Models\Posts\Authors;
use App\Shortcodes\BaseShortcode;
use Illuminate\Support\Facades\Cache;
use DB;

class OurTeam extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
        if (! isset($this->template)) {
            return;
        }
        // pc, mob, turbo, amp
        $authors =  DB::table('authors')
            ->orderBy('sort_order','asc')
            ->get();


        if (file_exists(resource_path() . "/views/site/v3/shortcodes/our_team/$this->template.blade.php")) {
            return view("site.v3.shortcodes.our_team.$this->template",compact('authors'));
        }

        return;
    }

}
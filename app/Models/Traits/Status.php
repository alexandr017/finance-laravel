<?php

namespace App\Models\Traits;

trait Status
{
    public static function FindEnableOrFail($id)
    {
        $item = self::findOrFail($id);

        if ($item->status) {
            return $item;
        }

        return abort(404);
    }
}
<?php

namespace App\Models\HideLinks;

use Illuminate\Database\Eloquent\Model;
use Eloquent;

/**
 * Post
 *
 * @mixin Eloquent
 */
class HideLinks extends Model
{
    protected $table = 'hide_links';

    protected $fillable = ['in', 'out', 'straight', 'clicks', 'redirect_type', 'affiliate_program_id', 'permission_type'];



}

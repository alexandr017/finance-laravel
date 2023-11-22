<?php

namespace App\Models\Companies;

use Illuminate\Database\Eloquent\Model;

class CompaniesChildrenPages extends Model
{
    protected $table = 'companies_children_pages';

    protected $fillable = [
        'company_id',
        'type_id',
        'h1',
        'title',
        'breadcrumb',
        'content',
        'meta_description',
        'lead',
        'status',
    ];
}

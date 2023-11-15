<?php

namespace App\Models\Companies;

use Illuminate\Database\Eloquent\Model;

class CompaniesReviews extends Model
{
    protected $table = 'companies_reviews';

    protected $fillable = [
        'company_id', 'author', 'rating', 'review', 'pros', 'minuses', 'status'
    ];
}

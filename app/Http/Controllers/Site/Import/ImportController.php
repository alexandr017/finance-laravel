<?php

namespace App\Http\Controllers\Site\Import;

use App\Http\Controllers\Controller;

class ImportController extends Controller
{
    private const min_average_rating = 4.0;
    private const max_average_rating = 5.0;

    private const min_number_of_votes = 15;
    private const max_number_of_votes = 35;

    use RelinkTrait;
    use BanksTrait;
    use CompaniesTrait;
    use StaticPagesTrait;
    use ListingsTrait;
    use BlogTrait;
    use CardsTrait;
}

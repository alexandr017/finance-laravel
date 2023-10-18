<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CompaniesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $import = new \App\Http\Controllers\ImportController();
        $import->runCompanies();
    }
}

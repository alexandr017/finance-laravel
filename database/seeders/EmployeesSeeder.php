<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class EmployeesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $import = new \App\Http\Controllers\ImportController();
        $import->runEmployee();
    }
}

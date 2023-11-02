<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

include 'site.php';

include 'admin.php';

Route::get('/import/banks', [ImportController::class, 'banks']);
Route::get('/import/bank-children', [ImportController::class, 'bankChildren']);
Route::get('/import/companies', [ImportController::class, 'companies']);
Route::get('/import/static-pages', [ImportController::class, 'staticPages']);


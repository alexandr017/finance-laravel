<?php

use Illuminate\Support\Facades\Route;


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

include 'parsers.php';
Route::get('/tmp-route', [\App\Http\Controllers\TmpController::class, 'index']);


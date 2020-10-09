<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::resource('/', \App\Http\Controllers\ReportsController::class, ['only' => ['index']]);
Route::get('/generate_report', function () {
    (new \App\Services\Salaries\Calculate)->handle();
    echo "Report generated!";
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ProvinceController;

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

Route::get('/', function () {
    return view('home');
});


Route::resource('/province', ProvinceController::class);
Route::resource('/city', CityController::class);

route::get('/report-province', [ProvinceController::class, 'reportPopulation'])->name('report.province');
route::get('/report-city', [CityController::class, 'reportPopulation'])->name('report.city');

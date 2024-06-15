<?php

use App\Http\Controllers\GeoLocationLogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\CustomServices\AbstractApiService;

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

Route::get('/', function (Request $request) {
    $ipLogService = new AbstractApiService();

    $geoLocation = $ipLogService->getIpGeoLocation($request->ip());

    if (is_array($geoLocation)) {
        return view('welcome');
    } else {
        return $geoLocation;
    }
})->name('welcome');

Route::resource('/geo-logs', GeoLocationLogController::class);

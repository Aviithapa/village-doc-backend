<?php

use Illuminate\Http\Request;
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

Route::get('/village-doc', function (Request $request) {
    return response()->json([
        'success'     => true,
        'app'         => config('app.name', 'village doc'),
        'app_version' => config('app.version', '1.0.0'),
        'request_ip'  => $request->ip(),
    ]);
});

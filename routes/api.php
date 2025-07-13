<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Di file ini lo bisa define semua route API lo.
| Middleware 'api' otomatis terpasang dari Kernel.php
| CORS ditangani di config/cors.php, tapi buat kasus stubborn kayak ini,
| kita brute-force header CORS biar browser diem 😤
*/

// ✅ LOGIN route (POST)
Route::post('/login', [AuthController::class, 'login']);

// ✅ CORS preflight fix: brute-force handle OPTIONS /login
Route::options('/login', function (Request $request) {
    return response()->json([], 204)
        ->header('Access-Control-Allow-Origin', 'https://web-bps-framework.netlify.app')
        ->header('Access-Control-Allow-Credentials', 'true')
        ->header('Access-Control-Allow-Methods', 'POST, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
});

// ✅ TEST route buat ngetes apakah CORS kehandle
Route::get('/cors-test', function () {
    return response()->json(['message' => 'CORS OK, bro!']);
});
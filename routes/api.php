<?php

use Illuminate\Support\Facades\Route;

Route::get('/ping', function () {
    return response()->json(["status" => "success", "data" => "Hellow world"]);
});

Route::prefix('v1')->group(base_path('routes/api_v1.php'));

<?php

use App\Http\Controllers\LinkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/ping', function () {
    return response()->json(["status" => "success", "data" => "Hellow world"]);
});

Route::apiResource('links', LinkController::class);

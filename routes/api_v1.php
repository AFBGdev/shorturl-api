<?php

use App\Http\Controllers\Api\V1\LinkController;
use Illuminate\Support\Facades\Route;

Route::apiResource('links', LinkController::class);

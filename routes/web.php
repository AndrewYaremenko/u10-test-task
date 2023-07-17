<?php

use App\Http\Controllers\DeliveryController;
use Illuminate\Support\Facades\Route;

Route::get('/delivery', [DeliveryController::class, 'order']);

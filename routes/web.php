<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaceController;

Route::resource('/api/places', PlaceController::class);

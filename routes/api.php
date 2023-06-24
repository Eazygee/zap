<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\DeliveryAddress\DeliveryAddressController;
use App\Http\Controllers\Api\Order\OrderController;
use App\Http\Controllers\Api\Product\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/register", [RegisterController::class, "register"]);
Route::post("/login", [LoginController::class, "login"]);

Route::middleware("auth:sanctum")->group(function () {
    Route::prefix("delivery-address")->group(function () {
        Route::get("/", [DeliveryAddressController::class, "list"]);
    });
    Route::prefix("products")->group(function () {
        Route::get("/", [ProductController::class, "list"]);
    });

    Route::prefix("orders")->group(function () {
        Route::get("/list", [OrderController::class, "list"]);
        Route::post("/create", [OrderController::class, "create"]);
        Route::get("/single/{id}", [OrderController::class, "single"]);
        Route::patch("/update/{id}", [OrderController::class, "update"]);
    });
});

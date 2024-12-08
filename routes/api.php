<?php

use App\Http\Controllers\ApiClientController;
use App\Http\Controllers\ProductController;
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

Route::post('/clients/client',[ApiClientController::class,'store']);
Route::put('/clients/{id}',[ApiClientController::class,'update']);
Route::get('/clients/clients',[ApiClientController::class,'index']);
Route::get('/clients/{quartier}',[ApiClientController::class,'findClientByQuartier']);
Route::delete('/clients/{id}',[ApiClientController::class,'delete']);
// routes pour la gestion des produits
Route::post('/produits/produit',[ProductController::class,'store']);
Route::put('/produits/{id}',[ProductController::class,'update']);
Route::get('/produits/produits',[ProductController::class,'index']);
Route::get('/produits/{motcles}',[ProductController::class,'show']);
Route::delete('/produits/{id}',[ProductController::class,'destroy']);
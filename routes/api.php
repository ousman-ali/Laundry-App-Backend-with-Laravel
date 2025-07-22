<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\InventoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//customer routes
Route::get('/customers/all', [CustomerController::class, 'index']);       
Route::post('/customers/create', [CustomerController::class, 'store']);        
Route::get('/customers/find/{id}', [CustomerController::class, 'show']);    
Route::put('/customers/update/{id}', [CustomerController::class, 'update']); 
Route::delete('/customers/delete/{id}', [CustomerController::class, 'destroy']);
Route::get('/customers/{id}/orders', [CustomerController::class, 'orders']); //get all orders of one customer

//user routes
Route::get('/users/all', [UserController::class, 'index']);
Route::post('/users/create', [UserController::class, 'store']);
Route::get('/users/find/{id}', [UserController::class, 'show']);
Route::get('/users/role/{role}', [UserController::class, 'getByRole']);
Route::put('/users/update/{id}', [UserController::class, 'update']);
Route::delete('/users/delete/{id}', [UserController::class, 'destroy']);

//order routes
Route::get('/orders/all', [OrderController::class, 'index']);
Route::post('/orders/create', [OrderController::class, 'store']);
Route::get('/orders/find/{id}', [OrderController::class, 'show']);
Route::put('/orders/update/{id}', [OrderController::class, 'update']);
Route::delete('/orders/delete/{id}', [OrderController::class, 'destroy']);
Route::get('/orders/{id}/items', [OrderController::class, 'items']);

//order-item routes
Route::get('/order-items/all', [OrderItemController::class, 'index']);
Route::post('/order-items/create', [OrderItemController::class, 'store']);
Route::get('/order-items/find/{id}', [OrderItemController::class, 'show']);
Route::put('/order-items/update/{id}', [OrderItemController::class, 'update']);
Route::delete('/order-items/delete/{id}', [OrderItemController::class, 'destroy']);

//inventory routes
    Route::get('/inventories/all', [InventoryController::class, 'index']);           // GET all inventories
    Route::post('/inventories/create', [InventoryController::class, 'store']);          // POST create new inventory
    Route::get('/inventories/find/{id}', [InventoryController::class, 'show']);        // GET one inventory item
    Route::put('/inventories/update/{id}', [InventoryController::class, 'update']);      // PUT update inventory
    Route::delete('/inventories/delete/{id}', [InventoryController::class, 'destroy']);  // DELETE inventory


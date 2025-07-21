<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;

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


// // 🛡️ Admin-only routes
// Route::middleware(['role:admin'])->group(function () {
//     // User management
//     Route::get('/users/all', [UserController::class, 'index']);
//     Route::post('/users/create', [UserController::class, 'store']);
//     Route::get('/users/find/{id}', [UserController::class, 'show']);
//     Route::get('/users/role/{role}', [UserController::class, 'getByRole']);
//     Route::put('/users/update/{id}', [UserController::class, 'update']);
//     Route::delete('/users/delete/{id}', [UserController::class, 'destroy']);

//     // Customer management
//     Route::get('/customers/all', [CustomerController::class, 'index']);
//     Route::post('/customers/create', [CustomerController::class, 'store']);
//     Route::get('/customers/find/{id}', [CustomerController::class, 'show']);
//     Route::put('/customers/update/{id}', [CustomerController::class, 'update']);
//     Route::delete('/customers/delete/{id}', [CustomerController::class, 'destroy']);
//     Route::get('/customers/{id}/orders', [CustomerController::class, 'orders']);

//     // Full access to orders
//     Route::get('/orders/all', [OrderController::class, 'index']);
//     Route::post('/orders/create', [OrderController::class, 'store']);
//     Route::get('/orders/find/{id}', [OrderController::class, 'show']);
//     Route::put('/orders/update/{id}', [OrderController::class, 'update']);
//     Route::delete('/orders/delete/{id}', [OrderController::class, 'destroy']);
//     Route::get('/orders/{id}/items', [OrderController::class, 'items']);

//     // Full access to order items
//     Route::get('/order-items/all', [OrderItemController::class, 'index']);
//     Route::post('/order-items/create', [OrderItemController::class, 'store']);
//     Route::get('/order-items/find/{id}', [OrderItemController::class, 'show']);
//     Route::put('/order-items/update/{id}', [OrderItemController::class, 'update']);
//     Route::delete('/order-items/delete/{id}', [OrderItemController::class, 'destroy']);
// });

// // 🧺 Worker routes
// Route::middleware(['role:worker'])->group(function () {
//     // Can view and create orders
//     Route::get('/orders/all', [OrderController::class, 'index']);
//     Route::post('/orders/create', [OrderController::class, 'store']);
//     Route::put('/orders/update/{id}', [OrderController::class, 'update']);
//     Route::get('/orders/find/{id}', [OrderController::class, 'show']);
//     Route::get('/orders/{id}/items', [OrderController::class, 'items']);

//     // Limited access to order items
//     Route::get('/order-items/all', [OrderItemController::class, 'index']);
//     Route::post('/order-items/create', [OrderItemController::class, 'store']);
// });

// // 👤 Customer routes
// Route::middleware(['role:customer'])->group(function () {
//     // Create and view own orders
//     Route::post('/orders/create', [OrderController::class, 'store']);
//     Route::get('/orders/all', [OrderController::class, 'index']);
// });

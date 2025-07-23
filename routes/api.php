<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;


    //user routes
    Route::middleware(['auth:api', 'permission:users.index'])->get('/users/all', [UserController::class, 'index'])->name('users.index');
    Route::middleware(['auth:api', 'permission:users.show'])->get('/users/find/{id}', [UserController::class, 'show'])->name('users.show');
    Route::middleware(['auth:api', 'permission:users.by_role'])->get('/users/role/{role}', [UserController::class, 'getByRole'])->name('users.by_role');
    Route::middleware(['auth:api', 'permission:users.update'])->put('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::middleware(['auth:api', 'permission:users.destroy'])->delete('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::middleware('auth:api')->post('/users/{user_id}/roles', [UserController::class, 'assignRoles']);

    //order routes
    Route::middleware(['auth:api', 'permission:orders.index'])->get('/orders/all', [OrderController::class, 'index'])->name('orders.index');
    Route::middleware(['auth:api', 'permission:orders.store'])->post('/orders/create', [OrderController::class, 'store'])->name('orders.store');
    Route::middleware(['auth:api', 'permission:orders.show'])->get('/orders/find/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::middleware(['auth:api', 'permission:orders.update'])->put('/orders/update/{id}', [OrderController::class, 'update'])->name('orders.update');
    Route::middleware(['auth:api', 'permission:orders.destroy'])->delete('/orders/delete/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::middleware(['auth:api', 'permission:orders.items_order'])->get('/orders/{id}/items', [OrderController::class, 'items'])->name('orders.items_order');

    //customer routes
    Route::middleware(['auth:api', 'permission:customers.index'])->get('/customers/all', [CustomerController::class, 'index'])->name('customers.index');       
    Route::middleware(['auth:api', 'permission:customers.store'])->post('/customers/create', [CustomerController::class, 'store'])->name('customers.store');        
    Route::middleware(['auth:api', 'permission:customers.show'])->get('/customers/find/{id}', [CustomerController::class, 'show'])->name('customers.show');    
    Route::middleware(['auth:api', 'permission:customers.update'])->put('/customers/update/{id}', [CustomerController::class, 'update'])->name('customers.update'); 
    Route::middleware(['auth:api', 'permission:customers.destroy'])->delete('/customers/delete/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    Route::middleware(['auth:api', 'permission:customers.orders_customer'])->get('/customers/{id}/orders', [CustomerController::class, 'orders'])->name('customers.orders_customer'); //get all orders of one customer
    
    //order-item routes
    Route::middleware(['auth:api', 'permission:order-items.index'])->get('/order-items/all', [OrderItemController::class, 'index'])->name('order-items.index');
    Route::middleware(['auth:api', 'permission:order-items.store'])->post('/order-items/create', [OrderItemController::class, 'store'])->name('order-items.store');
    Route::middleware(['auth:api', 'permission:order-items.show'])->get('/order-items/find/{id}', [OrderItemController::class, 'show'])->name('order-items.show');
    Route::middleware(['auth:api', 'permission:order-items.update'])->put('/order-items/update/{id}', [OrderItemController::class, 'update'])->name('order-items.update');
    Route::middleware(['auth:api', 'permission:order-items.destroy'])->delete('/order-items/delete/{id}', [OrderItemController::class, 'destroy'])->name('order-items.destroy');

    //inventory routes
    Route::middleware(['auth:api', 'permission:inventories.index'])->get('/inventories/all', [InventoryController::class, 'index'])->name('inventories.index');           // GET all inventories
    Route::middleware(['auth:api', 'permission:inventories.store'])->post('/inventories/create', [InventoryController::class, 'store'])->name('inventories.store');          // POST create new inventory
    Route::middleware(['auth:api', 'permission:inventories.show'])->get('/inventories/find/{id}', [InventoryController::class, 'show'])->name('inventories.show');        // GET one inventory item
    Route::middleware(['auth:api', 'permission:inventories.update'])->put('/inventories/update/{id}', [InventoryController::class, 'update'])->name('inventories.update');      // PUT update inventory
    Route::middleware(['auth:api', 'permission:inventories.destroy'])->delete('/inventories/delete/{id}', [InventoryController::class, 'destroy'])->name('inventories.destroy');  // DELETE inventory

    //role and permission routes
    Route::middleware('auth:api')->group(function () {
        Route::get('/permissions/all', [RoleController::class, 'permissions']); // List all permissions
        Route::get('/roles/all', [RoleController::class, 'index']); // List roles
        Route::post('/roles/create', [RoleController::class, 'store']); // Create role + assign permissions
        Route::put('/roles/update/{role}', [RoleController::class, 'update']); // Update role + permissions
        Route::delete('/roles/delete/{role}', [RoleController::class, 'destroy']); // Delete role
    });



//Auth routes
Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:api')->group(function () {
        Route::get('me', [AuthController::class, 'me']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
    });
});
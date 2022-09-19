<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ExtractController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::post('users/login', [UserController::class, 'login']);

Route::post('users/registration', [UserController::class, 'register']);
//Route::post('users/account', [AccountController::class, 'account']);
//Route::post('/users/transfer', [TransferController::class, 'transferUser']);

// Route::get('/teste', function(){
//     return response()->json(['teste123']);
// });

Route::middleware('auth:api')->group(function () {
    Route::get('/users', [UserController::class, 'details']);
    Route::post('/users/transfer', [TransferController::class, 'transferUser']);
    Route::get('/users/extract', [ExtractController::class, 'extractUser']);
    Route::post('/users/payment', [PaymentController::class, 'index']);
    //Route::delete('/users/{id}', [UserController::class, 'destroy']);
    //Route::put('/users/{id}', [UserController::class, 'update']);
    //Route::get('/users/{id}/edit', [UserController::class, 'edit']);
    // Route::get('/users', [UserController::class, 'index']);
    //Route::get('/users/getCashIn/{id}', [TransactionController::class, 'getCashIn']);
    //Route::get('/users/{id}', [UserController::class, 'show']);
});

    

// Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
// Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
// Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
// Route::get('/users', [UserController::class, 'index'])->name('users.index');
// Route::get('/users/create', [UserController::class, 'create'])->name('users.create');

// Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
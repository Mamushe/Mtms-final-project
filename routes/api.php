<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\DriverController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/add-admin", [AuthController::class, 'addAdmin']);
Route::post("/login-admin", [AuthController::class, 'adminLogin']);

Route::post("/register-driver", [AuthController::class, 'registerDriver']);
Route::post("/login-driver", [AuthController::class, 'loginDriver']);

// Done by driver
Route::middleware('auth:api-drivers')->group(function (){
    Route::get("/testDriver", [DriverController::class, 'testDriver']);
    Route::post("/get-ticket", [DriverController::class, 'buyTicket']);
    Route::post("/cancel-ticket", [DriverController::class, 'cancelTicket']);
    Route::post("/pay-fine", [DriverController::class, 'payFine']);
});

// Done by Traffic police
Route::middleware("auth:api-police")->group(function(){
    Route::get("/testPolice", [TPoliceController::class, 'testPolice']);
});


// Done by admin

Route::middleware('auth:api')->group(function (){
    // Route::get("/register", [Api\AuthController::class, 'register']);
    Route::post("/register-trafficpolice", [AdminController::class, 'registerTrafficPolice']);
});  


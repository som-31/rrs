<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassengerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [PassengerController::class, 'getPassengerBookings']);
Route::get('/passengersOnParticularDay', [PassengerController::class, 'getPassengersOnSpecifiedDate']);
Route::get('/trainInfoAccToAgeRange',[PassengerController::class, 'getTrainInfoAccToAgeRange']);
Route::get('/passengersCountForTrain',[PassengerController::class, 'getPassengerCountForTrain']);
Route::get('/trainNamePassengers',[PassengerController::class, 'getPassengersAccToTrainName']);
Route::get('/deletePassengerView', [PassengerController::class, 'deletePassengerView']);
Route::delete('/deletePassengerBooking', [PassengerController::class, 'deletePassengerBooking']);

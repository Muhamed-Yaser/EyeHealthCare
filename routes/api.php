<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\doctorController;
use App\Http\Controllers\hospitalController;
use App\Http\Controllers\resetPasswordController;
use App\Http\Controllers\userController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:web')->get('/patient', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:hospital')->get('/hospital', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:doctor')->get('/doctor', function (Request $request) {
    return $request->user();
});

    
    Route::prefix('user')->group(function () {
        Route::post('register', [RegisteredUserController::class, 'store']);
        Route::post('login', [AuthenticatedSessionController::class, 'store']);

        Route::post('sendResetCode', [resetPasswordController::class, 'send']);
        Route::post('checkCode', [resetPasswordController::class, 'checkCode']);
        Route::post('reset', [resetPasswordController::class, 'reset']);

        Route::post('changePassword',[userController::class,'changePassword'])->middleware('checkAuth:api');
        Route::post('createEmergencyCase',[userController::class,'createEmergencyCase'])->middleware('checkAuth:api');
        Route::post('enterPatientHistory',[userController::class,'enterPatientHistory'])->middleware('checkAuth:api');
        Route::post('updatePatientHistory',[userController::class,'updatePatientHistory'])->middleware('checkAuth:api');
        Route::post('reserve',[userController::class,'reservationRoom'])->middleware('checkAuth:api');
        Route::post('clincalReserve',[userController::class,'requestReservationForApp'])->middleware('checkAuth:api'); //For App
        Route::get('cancelReservation/{id}',[userController::class, "cancelReservation"])->middleware('checkAuth:api');
        Route::get('hospitals',[userController::class,'hospitals'])->middleware('checkAuth:api');
        Route::get('patientHistory',[userController::class,'patientHistory'])->middleware('checkAuth:api');
        Route::get('clincals',[userController::class,'clincals'])->middleware('checkAuth:api');
        Route::get('reservations',[userController::class,'reservations'])->middleware('checkAuth:api'); 
        Route::post('searchByName',[userController::class,'searchByName'])->middleware('checkAuth:api');
        Route::post('searchByAddress',[userController::class,'searchByAddress'])->middleware('checkAuth:api');
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('checkAuth:api');
});


    Route::prefix('hospital')->group(function () {
        Route::post('login',[hospitalController::class,'store']);
        Route::post('createDoctor',[hospitalController::class,'createDoctorForApp'])->middleware('checkAuth:hospital-api'); // for app
        Route::get('getDoctors',[hospitalController::class,'getDoctors'])->middleware('checkAuth:hospital-api');
        Route::post('search',[hospitalController::class,'search'])->middleware('checkAuth:hospital-api');
        Route::get('getReservations',[hospitalController::class,'getClincalReservations'])->middleware('checkAuth:hospital-api'); //for app
        Route::get('getEmergencyCases',[hospitalController::class,'getEmergencyCases'])->middleware('checkAuth:hospital-api');
        Route::get('acceptReservation/{id}',[hospitalController::class, "acceptReservation"])->middleware('checkAuth:hospital-api');
        Route::get('rejectReservation/{id}',[hospitalController::class, "rejectReservation"])->middleware('checkAuth:hospital-api');
        Route::get('finishReservation/{id}',[hospitalController::class, "finishReservation"])->middleware('checkAuth:hospital-api');
        Route::post('reserve',[hospitalController::class,'createReservationRoom'])->middleware('checkAuth:hospital-api'); //web -> room
        Route::post('clincalReserve',[hospitalController::class,'createReservation'])->middleware('checkAuth:hospital-api');
        Route::get('getClincals',[hospitalController::class,'clincals'])->middleware('checkAuth:hospital-api');
        Route::post('addClincal',[hospitalController::class,'addClincal'])->middleware('checkAuth:hospital-api');
        Route::get('deleteClincal/{id}',[hospitalController::class, "deleteClincal"])->middleware('checkAuth:hospital-api');
        Route::get('deleteRoom/{id}',[hospitalController::class, "deleteRoom"])->middleware('checkAuth:hospital-api');
        Route::get('deleteDoctor/{id}',[hospitalController::class, "deleteClincal"])->middleware('checkAuth:hospital-api');
        Route::post('logout',[hospitalController::class,'logout'])->middleware('checkAuth:hospital-api');
    });


    Route::prefix('doctor')->group(function () {
        Route::post('login',[doctorController::class,'store']);
        Route::get('getReservations',[doctorController::class, "getReservations"])->middleware('checkAuth:doctor-api');
        Route::post('makePrescription',[doctorController::class, "makePrescription"])->middleware('checkAuth:doctor-api');
        Route::post('logout',[doctorController::class,'logout'])->middleware('checkAuth:doctor-api');

    });


<?php

use App\Http\Controllers\doctorController;
use App\Http\Controllers\hospitalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\userController;
use App\Models\Reservation;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
/*Route::get('/test', function () {
    $reserves = Reservation::get();
    $reseults = [];
    foreach($reserves as $reserve){
        $date = date('Y-m-d' );
        if($reserve->date == $date){
            array_push($reseults , 'yes');
        }
        array_push($reseults , 'no');
    }
    return $reseults;
});*/

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('user')->group(function () {

    Route::post('changePassword',[userController::class,'changePassword'])->middleware('checkAuthWeb:web');
    Route::post('createEmergencyCase',[userController::class,'createEmergencyCase'])->middleware('checkAuthWeb:web');
    Route::post('enterPatientHistory',[userController::class,'enterPatientHistory'])->middleware('checkAuthWeb:web');
    Route::post('updatePatientHistory',[userController::class,'updatePatientHistory'])->middleware('checkAuthWeb:web');
    Route::post('reserve',[userController::class,'reservationRoom'])->middleware('checkAuthWeb:web');
    Route::post('clincalReserve',[userController::class,'requestReservation'])->middleware('checkAuthWeb:web');
    Route::get('cancelReservation/{id}',[userController::class, "cancelReservation"])->middleware('checkAuthWeb:web');
    Route::get('hospitals',[userController::class,'hospitalsWeb'])->middleware('checkAuthWeb:web');
    Route::get('clincals',[userController::class,'clincals'])->middleware('checkAuthWeb:web');
    Route::get('patientHistory',[userController::class,'patientHistory'])->middleware('checkAuthWeb:web');
    Route::get('reservations',[userController::class,'reservations'])->middleware('checkAuthWeb:web');
    Route::post('searchByName',[userController::class,'searchByName'])->middleware('checkAuthWeb:web');
    Route::post('searchByAddress',[userController::class,'searchByAddress'])->middleware('checkAuthWeb:web');
});

Route::prefix('hospital')->group(function () {
    Route::post('createDoctor',[hospitalController::class,'createDoctor'])->middleware('checkAuthWeb:hospital');
    Route::get('getDoctors',[hospitalController::class,'getDoctors'])->middleware('checkAuthWeb:hospital');
    Route::post('search',[hospitalController::class,'search'])->middleware('checkAuthWeb:hospital');
    Route::get('getReservations',[hospitalController::class,'getReservations'])->middleware('checkAuthWeb:hospital');
    Route::get('getEmergencyCases',[hospitalController::class,'getEmergencyCases'])->middleware('checkAuthWeb:hospital');
    Route::get('acceptReservation/{id}',[hospitalController::class, "acceptReservation"])->middleware('checkAuthWeb:hospital');
    Route::get('rejectReservation/{id}',[hospitalController::class, "rejectReservation"])->middleware('checkAuthWeb:hospital');
    Route::get('finishReservation/{id}',[hospitalController::class, "finishReservation"])->middleware('checkAuthWeb:hospital');
    Route::post('reserve',[hospitalController::class,'createReservationRoom'])->middleware('checkAuthWeb:hospital');
    Route::post('clincalReserve',[hospitalController::class,'createReservation'])->middleware('checkAuthWeb:hospital');
    Route::get('getRooms',[hospitalController::class,'rooms'])->middleware('checkAuthWeb:hospital');
    Route::post('addRoom',[hospitalController::class,'addRoom'])->middleware('checkAuthWeb:hospital');
    Route::get('getClincals',[hospitalController::class,'clincals'])->middleware('checkAuthWeb:hospital');
    Route::post('addClincal',[hospitalController::class,'addClincal'])->middleware('checkAuthWeb:hospital');
    Route::get('deleteClincal/{id}',[hospitalController::class, "deleteClincal"])->middleware('checkAuthWeb:hospital');
    Route::get('deleteRoom/{id}',[hospitalController::class, "deleteRoom"])->middleware('checkAuthWeb:hospital');
    Route::get('deleteDoctor/{id}',[hospitalController::class, "deleteClincal"])->middleware('checkAuthWeb:hospital');

});

Route::prefix('doctor')->group(function () {

    Route::get('login',function(){
        return view('Doctor/login');
    });
    Route::post('login',[doctorController::class,'WebLogin'])->name('doctor.login');
    Route::get('getReservations',[doctorController::class, "getReservations"])->middleware('checkAuthWeb:doctor');
    Route::post('makePrescription',[doctorController::class, "makePrescription"])->middleware('checkAuthWeb:doctor');
    Route::post('logout',[doctorController::class,'WebLogout'])->middleware('checkAuthWeb:doctor');

});

require __DIR__.'/auth.php';

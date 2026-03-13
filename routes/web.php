<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingListController;
use App\Http\Controllers\CheckInListController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;
use App\Models\Room;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth','role:admin'])
->prefix('admin')
->name('admin.')
->group(function(){
    Route::get('/dashboard',function(){
        return view ('admin.dashboard');
    })->name('dashboard');

    Route::get('/room',[RoomController::class,'index'])->name('room.index');
    Route::get('/room/create',[RoomController::class,'create'])->name('room.create');
    Route::post('/room/create',[RoomController::class,'store'])->name('room.store');
    Route::get('/room/show/{id}',[RoomController::class,'show'])->name('room.show');
    Route::get('/room/edit/{id}',[RoomController::class,'edit'])->name('room.edit');
    Route::put('/room/update/{id}',[RoomController::class,'update'])->name('room.update');
    Route::delete('/room/destroy/{id}',[RoomController::class,'destroy'])->name('room.destroy');

    Route::get('/room/avaliableList',[RoomController::class,'avaliableList'])->name('room.avaliableList');
    Route::put('/room/avaliableListUpdate/{id}',[RoomController::class,'avaliableListUpdate'])->name('room.avaliableListUpdate');


    Route::get('/room/pendingList',[RoomController::class,'pendingList'])->name('room.pendingList');
    Route::put('/room/pendingListUpdate/{id}',[RoomController::class,'pendingListUpdate'])->name('room.pendingListUpdate');


    Route::get('/room/bookingList',[RoomController::class,'bookingList'])->name('room.bookingList');
    Route::put('/room/bookingListUpdate/{id}',[RoomController::class,'bookingListUpdate'])->name('room.bookingListUpdate');

    Route::get('/room/unavaliableList',[RoomController::class,'unavaliableList'])->name('room.unavaliableList');
    Route::put('/room/unavaliableListUpdate/{id}',[RoomController::class,'unavaliableListUpdate'])->name('room.unavaliableListUpdate');

    Route::get('/booking',[BookingController::class,'index'])->name('booking.index');
    Route::post('/booking',[BookingController::class,'store'])->name('booking.store');
    Route::get('/booking/check-user', [BookingController::class, 'checkUser'])->name('booking.checkUser');
    Route::get('/booking/details/{id}', [BookingController::class, 'show'])->name('booking.details');

    Route::get('/bookingList',[BookingListController::class,'index'])->name('bookingList.index');
    Route::put('/bookingList/update/{id}',[BookingListController::class,'update'])->name('bookingList.update');

     Route::get('/checkInList',[CheckInListController::class,'index'])->name('checkInList.index');
    Route::put('/checkInList/update/{id}',[CheckInListController::class,'update'])->name('checkInList.update');



Route::resource('roomType', RoomTypeController::class);
});
Route::middleware(['auth','role:user'])
->prefix('user')
->name('user.')
->group(function(){
    Route::get('/dashboard',function(){
        return view ('user.dashboard');
    })->name('dashboard');



});

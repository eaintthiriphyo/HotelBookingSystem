<?php

use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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
    // Route::get('/roomTypes/show/{id}',[RoomTypeController::class,'show'])->name('roomType.show');
    // Route::get('/roomTypes/edit/{id}',[RoomTypeController::class,'edit'])->name('roomType.edit');
    // Route::put('/roomTypes/update/{id}',[RoomTypeController::class,'update'])->name('roomType.update');
    // Route::delete('/roomTypes/destroy/{id}',[RoomTypeController::class,'destroy'])->name('roomType.destroy');


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

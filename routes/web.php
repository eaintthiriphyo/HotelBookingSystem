<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingListController;
use App\Http\Controllers\CheckInListController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;




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




use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;


Auth::routes();
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Route::get('/',function(){
//     return view('welcome');
// });

Route::get('/',[AdminController::class,'welcome'])->name('welcome');
Route::get('/reviews',[ReviewController::class,'indexReview'])->name('viewReview');
Route::post('/reviews',[ReviewController::class,'store'])->name('review.store');
  Route::post('/contact',[ContactController::class,'store'])->name('contact.store');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth','role:admin'])
->prefix('admin')
->name('admin.')
->group(function(){


    Route::get('/dashboard',[HomeController::class,'viewDashboard'])->name('viewDashboard');


    Route::get('/room',[RoomController::class,'index'])->name('room.index');
    Route::get('/room/create',[RoomController::class,'create'])->name('room.create');
    Route::post('/room/create',[RoomController::class,'store'])->name('room.store');
    Route::get('/room/show/{id}',[RoomController::class,'show'])->name('room.show');
    Route::get('/room/edit/{id}',[RoomController::class,'edit'])->name('room.edit');
    Route::put('/room/update/{id}',[RoomController::class,'update'])->name('room.update');
    Route::delete('/room/destroy/{id}',[RoomController::class,'destroy'])->name('room.destroy');

    Route::get('/room/search',[RoomController::class,'search'])->name('room.search');


    Route::get('/room/avaliableList',[RoomController::class,'avaliableList'])->name('room.avaliableList');
    Route::put('/room/avaliableListUpdate/{id}',[RoomController::class,'avaliableListUpdate'])->name('room.avaliableListUpdate');


    Route::get('/room/pendingList',[RoomController::class,'pendingList'])->name('room.pendingList');
    Route::put('/room/pendingListUpdate/{id}',[RoomController::class,'pendingListUpdate'])->name('room.pendingListUpdate');


    Route::get('/room/bookingList',[RoomController::class,'bookingList'])->name('room.bookingList');
    Route::put('/room/bookingListUpdate/{id}',[RoomController::class,'bookingListUpdate'])->name('room.bookingListUpdate');

    Route::get('/room/unavaliableList',[RoomController::class,'unavaliableList'])->name('room.unavaliableList');
    Route::put('/room/unavaliableListUpdate/{id}',[RoomController::class,'unavaliableListUpdate'])->name('room.unavaliableListUpdate');

    Route::get('/booking',[BookingController::class,'index'])->name('booking.index');
    Route::get('/booking/create',[BookingController::class,'create'])->name('booking.create');

    Route::post('/booking',[BookingController::class,'store'])->name('booking.store');
        Route::get('/booking/alls',[BookingController::class,'all'])->name('booking.alls');

    Route::get('/booking/check-user', [BookingController::class, 'checkUser'])->name('booking.checkUser');
    Route::get('booking/available-rooms', [BookingController::class, 'availableRooms'])->name('booking.availableRooms');

    Route::get('/booking/pending',[BookingController::class,'pendingList'])->name('booking.pending');
    Route::put('/booking/changePending/{id}',[BookingController::class,'changePending'])->name('booking.changePending');
    // Route::get('/booking/show/{id}',[BookingController::class,'show'])->name('booking.show');

    Route::get('booking/bookingList', [BookingController::class, 'viewTodayBook'])->name('booking.todayBook');

    Route::put('/booking/checkIn/{id}',[BookingController::class,'update'])->name('booking.checkIn');

    Route::get('/booking/details/{id}', [BookingController::class, 'show'])->name('booking.details');

    Route::get('/bookingList',[BookingListController::class,'index'])->name('bookingList.index');
    Route::put('/bookingList/update/{id}',[BookingController::class,'update'])->name('booking.update');

     Route::get('/checkin',[CheckInListController::class,'index'])->name('checkin.index');
          Route::get('/checkin/create',[CheckInListController::class,'create'])->name('checkin.create');
    Route::get('/checkin/check-user', [CheckInListController::class, 'checkUser'])->name('checkin.checkUser');

    Route::post('/checkin/create',[CheckInListController::class,'store'])->name('checkin.store');
Route::put('/checkOut/{id}',[CheckInListController::class,'update'])->name('checkOut.update');
Route::get('customers',[CustomerController::class,'index'])->name('customer.index');
Route::get('customers/create',[CustomerController::class,'create'])->name('customer.create');

Route::post('customers/create',[CustomerController::class,'store'])->name('customer.store');

Route::get('departments/inactive',[DepartmentController::class,'inactiveList'])->name('department.inactiveList');
Route::get('departments',[DepartmentController::class,'index'])->name('department.index');
Route::get('departments/create',[DepartmentController::class,'create'])->name('department.create');
Route::post('departments/create',[DepartmentController::class,'store'])->name('department.store');
Route::get('departments/edit/{id}',[DepartmentController::class,'edit'])->name('department.edit');
Route::put('departments/update/{id}',[DepartmentController::class,'update'])->name('department.update');
Route::put('departments/delete/{id}',[DepartmentController::class,'delete'])->name('department.delete');


Route::get('staff',[StaffController::class,'index'])->name('staff.index');
Route::get('staff/create',[StaffController::class,'create'])->name('staff.create');
Route::post('staff/create',[StaffController::class,'store'])->name('staff.store');
Route::get('staff/edit/{id}',[StaffController::class,'edit'])->name('staff.edit');
Route::put('staff/update/{id}',[StaffController::class,'update'])->name('staff.update');
Route::delete('staff/destroy/{id}',[StaffController::class,'destroy'])->name('staff.destroy');



Route::get('staff/viewProfile/{email}',[StaffController::class,'viewProfile'])->name('staff.viewProfile');
Route::get('staff/viewEditProfile/{email}',[StaffController::class,'viewEditProfile'])->name('staff.viewEditProfile');
Route::put('staff/profileUpdate/{email}',[StaffController::class,'profileUpdate'])->name('staff.profileUpdate');
Route::get('staff/profile/changePassword/{email}',[StaffController::class,'viewChangePassword'])->name('staff.viewChangePassword');
Route::put('staff/profile/changePassword',[StaffController::class,'ChangePassword'])->name('staff.changePassword');



Route::get('/contact',[ContactController::class,'index'])->name('contact.index');

Route::get('/contact/show/{id}',[ContactController::class,'show'])->name('contact.show');
Route::get('/contact/view/{id}',[ContactController::class,'view'])->name('contact.view');

Route::delete('/contact/destroy/{id}',[ContactController::class,'destroy'])->name('contact.destroy');

Route::get('/viewMail/{id}',[ContactController::class,'viewMail'])->name('viewMail');

Route::post('/sendMail/{id}',[ContactController::class,'sendMail'])->name('sendMail');


Route::resource('roomType', RoomTypeController::class);
Route::get('roomTypes/search', [RoomTypeController::class, 'search'])->name('roomTypes.search');
Route::put('roomTypes/delete/{id}', [RoomTypeController::class, 'delete'])->name('roomTypes.delete');
Route::get('/roomType/image/delete/{id}', [RoomTypeController::class, 'deleteImage'])->name('roomTypeImage.delete');
});
Auth::routes();
Route::middleware(['auth','role:user'])
->prefix('user')
->name('user.')
->group(function(){
    Route::get('/dashboard',[HomeController::class,'index'])->name('dashboard');


 Route::get('/viewProfile/{email}',[CustomerController::class,'viewProfile'])->name('viewProfile');
Route::get('/viewEditProfile/{email}',[CustomerController::class,'viewEditProfile'])->name('viewEditProfile');
Route::put('/profileUpdate/{email}',[CustomerController::class,'profileUpdate'])->name('profileUpdate');
Route::get('/profile/changePassword/{email}',[CustomerController::class,'viewChangePassword'])->name('viewChangePassword');
Route::put('staff/profile/changePassword',[CustomerController::class,'ChangePassword'])->name('changePassword');

Route::get('/contact',[ContactController::class,'index'])->name('contact');
Route::get('/booking/room',[BookingController::class,'index'])->name('bookingRoom');
 Route::get('booking/available-rooms', [BookingController::class, 'availableRooms'])->name('booking.availableRooms');
  Route::post('booking/store', [BookingController::class, 'store'])->name('booking.store');

Route::get('/booing/List/{id}',[BookingController::class,'viewAllList'])->name('booking.viewAllList');
Route::get('/booking/{id}',[BookingController::class,'viewbooking'])->name('booking');
Route::get('/reviews',[ReviewController::class,'index'])->name('viewReview');
Route::post('/reviews',[ReviewController::class,'store'])->name('review.store');


});

Auth::routes();


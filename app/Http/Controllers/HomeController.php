<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use App\Models\Room;
use App\Models\RoomType;

use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function viewDashboard(){
    $bcount = Booking::where('status','booked')->count();
    $checkCount = Booking::where('status','check-in')->count();
    $cusCount = User::where('status', "2")
                     ->where('acc_status', 'active')
                     ->count();

     $roomCount = Room::all()->count();

    $staffCount = User::where('status', '!=', 2)
                  ->where('acc_status', 'active')
                  ->count();

    $monthlyBookings = Booking::select(
        DB::raw("COUNT(id) as total"),
        DB::raw("MONTH(created_at) as month")
    )
    ->groupBy('month')
    ->pluck('total','month');


$roomTypeData = DB::table('room_types')
    ->leftJoin('rooms', 'room_types.id', '=', 'rooms.room_type_id')
    ->leftJoin('bookings', 'rooms.id', '=', 'bookings.room_id')
    ->select('room_types.room_type', DB::raw('COUNT(bookings.id) as total'))
    ->groupBy('room_types.room_type')
    ->get();


    return view('admin.dashboard', compact('bcount','checkCount','cusCount','roomCount','staffCount','monthlyBookings','roomTypeData'));
}
}

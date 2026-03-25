<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomType;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Hash;

class CheckInListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $checkInList = Booking::where('status', 'check-in')
                        ->orderBy('created_at', 'desc')
                        ->paginate(5);
        return view('admin.checkIn.index',compact('checkInList'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roomTypes=RoomType::all();
        return view('admin.checkIn.create',compact('roomTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $email = $request->email;
        $user = User::where('email', $email)->first();

        // Validation rules
        $rules = [
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'room_id' => 'required|exists:rooms,id',
        ];

        if(!$user){
            $rules = array_merge($rules, [
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|string',
                'credential' => 'required|string',
            ]);
        }

        $validated = $request->validate($rules);

        // Create user if new
        if(!$user){
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'credential' => $request->credential,
                'role' => 'user',
                'roles'=>'user',
                'status' => '2',
                'password' => Hash::make('12345678'),
            ]);
        }

        // Booking status
        $status = (Auth::check() && Auth::user()->status == '2') ? 'pending' : 'check-in';

        // Create booking
        Booking::create([
            'user_id' => $user->id,
            'room_id' => $request->room_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'status' => $status,
            'booked_date' => now(),
        ]);

        // Update room availability
        $room = Room::find($request->room_id);
        $room->is_avaliable = 'booked';
        $room->save();

        return redirect()->back()->with('succBook','Check In  successfully');
    }

    public function checkUser(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        return response()->json(['user' => $user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


            $booking=Booking::findOrFail($id);
            $booking->status=$request->status;
            $booking->update();
            $room=Room::findOrFail($request->room_id);


             if($booking->status=='check-out'){
                $room->is_avaliable='avaliable';
                $room->update();
            }


            return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

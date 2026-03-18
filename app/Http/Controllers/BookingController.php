<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
           $room = null;

    if($request->has('room_id')){
        $room = Room::find($request->room_id);
    }

    return view('admin.room.booking', compact('room'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          return view('admin.room.booking');
    }
 public function checkUser(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        return response()->json(['user' => $user]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


      public function availableRooms(Request $request)
    {
        $check_in = $request->check_in;
        $check_out = $request->check_out;

        // Get rooms that are NOT booked in this date range
        $bookedRoomIds = Booking::where(function($q) use($check_in, $check_out) {
            $q->whereBetween('check_in', [$check_in, $check_out])
              ->orWhereBetween('check_out', [$check_in, $check_out])
              ->orWhere(function($q2) use ($check_in, $check_out) {
                  $q2->where('check_in', '<=', $check_in)
                     ->where('check_out', '>=', $check_out);
              });
        })->pluck('room_id')->toArray();

        $availableRooms = Room::whereNotIn('id', $bookedRoomIds)->paginate(5);

        $rooms = $availableRooms->map(function($room) {
            return [
                'id' => $room->id,
                'room_number' => $room->room_number,
                'room_type' => $room->room_type->room_type ?? ''
            ];
        });

        return response()->json(['rooms' => $rooms]);
    }




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
        $status = (Auth::check() && Auth::user()->status == '2') ? 'pending' : 'booked';

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

        return redirect()->back()->with('succBook','Booking successfully');
    }


    public function viewTodayBook(){
$todayDay = Carbon::today();

$todayBooks = Booking::where('check_in', $todayDay)->paginate(5);
return view('admin.checkList.index',compact('todayBooks'));
}
// return response()->json(['message' => 'Room booked successfully', 'user' => $user]);}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
        $checkInRoom=Booking::findOrFail($id);
        $checkInRoom->status="check-in";
        $room = Room::find($request->room_id);
        $room->is_avaliable = 'check-in';
        $checkInRoom->update();
        $room->update();
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

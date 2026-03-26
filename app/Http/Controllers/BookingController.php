<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomType;
use Carbon\Carbon;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\View;


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
        $roomTypes=RoomType::all();
        $roomTypes->map(function($type){
            $type->images=collect([
                $type->kitchen,
                $type->bedroom,
                $type->bathroom,
                $type->view,
           ])->filter(function ($img){
            return $img && $img!=='default.jpg';
           })->values();
            return $type;
        });
        $initialRoomTypeId=$request->query('room_type_id');
         $json = file_get_contents(public_path('json/nrc.json'));
    $nrcData = json_decode($json, true);

return view('user.roomBooking',compact('roomTypes','initialRoomTypeId','nrcData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            $roomTypes=RoomType::all();
 $json = file_get_contents(public_path('json/nrc.json'));
    $nrcData = json_decode($json, true);

    return view('admin.room.booking', compact('roomTypes', 'nrcData'));    }
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
    $checkIn = $request->check_in;
    $checkOut = $request->check_out;
    $roomTypeId = $request->room_type_id;

    if (!$checkIn || !$checkOut || !$roomTypeId) {
        return response()->json(['rooms' => []]);
    }

    // Only consider active bookings
    $activeStatuses = ['check-in', 'booked', 'pending']; // add other active statuses if needed

    $rooms = Room::where('room_type_id', $roomTypeId)
        ->whereDoesntHave('bookings', function ($query) use ($checkIn, $checkOut, $activeStatuses) {
            $query->where('check_in', '<', $checkOut)
                  ->where('check_out', '>', $checkIn)
                  ->whereIn('status', $activeStatuses);
        })
        ->get(['id', 'room_number']);

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
                 'address' => 'required|string',
            ]);
        }

        if($user){
            $rules = array_merge($rules, [

                'phone' => 'required|string',
                'credential' => 'required|string',
                'address'=>'required|string'
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
                'address'=>$request->address,
                'role' => 'user',
                'roles'=>'user',
                'status' => '2',
                'password' => Hash::make('12345678'),
            ]);
        }else{
            $user->name=$request->name;
            $user->email=$request->email;
            $user->phone=$request->phone;
            $user->address=$request->address;
            $user->credential=$request->credential;
            $user->update();

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

    return redirect()->back()->with('success', 'Booking Complete!');

      }


 public function viewTodayBook(){
$todayDay = Carbon::today();

$todayBooks = Booking::where('check_in', $todayDay)
 ->where('status', 'booked')
->paginate(5);
return view('admin.checkList.index',compact('todayBooks'));
}



public function pendingList(Request $request){

    $highlightId = $request->query('highlight');

$pending=Booking::where('status','pending')->paginate(5);
$highlightBooking = null;
    if ($highlightId) {
        $highlightBooking = Booking::with(['user', 'room.room_type'])
            ->find($highlightId);
    }
return view('admin.room.pendingList',compact('pending','highlightId','highlightBooking'));
}


public function changePending(Request $request,$id){

$pendingList=Booking::findOrFail($id);
$room=Room::findOrFail($request->room_id);
if($request->status=="booked"){
$room->is_avaliable="booked";
$pendingList->status='booked';

  $details = [
            'greeting' => "Hello ".$pendingList->user->name,
            'body' => "Your booking for room ".$room->name." has been successfully confirmed.",
            'action_text' => "View Booking",
'action_url' => url('/user/booking/'.$pendingList->id),

'end_line' => "Thank you for choosing our hotel!",
            'subject' => "Booking Confirmed"
        ];

        Mail::to($pendingList->user->email)->send(new SendMail($details));
    }

if($request->status=="cancle"){
$room->is_avaliable="avaliable";
$pendingList->status='cancle';

 $details = [
            'greeting' => "Hello ".$pendingList->user->name,
            'body' => "Your booking for room ".$room->name." has been cancelled.",
            'action_text' => "Contact Us",
'action_url' => url('/#contact'),
            'end_line' => "We hope to serve you next time.",
            'subject' => "Booking Cancelled"
        ];

        Mail::to($pendingList->user->email)->send(new SendMail($details));
}

$pendingList->update();
$room->update();

return redirect()->back();
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
        $pending = Booking::find($id);
       return redirect()->route('admin.booking.pending',compact('pending'));
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
        // return $request;
        $checkInRoom=Booking::findOrFail($id);
        $status=$request->status;
         $room = Room::find($request->room_id);
        if($status=="check-in"){
        $checkInRoom->status="check-in";
        $room->update();

        }

        if($status=="cancel"){
        $checkInRoom->status="cancel";
                $room->update();


        }
       
        $checkInRoom->update();
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
    public function viewAllList($id){
$list = Booking::where('user_id', $id)
        ->orderBy('created_at', 'desc')
        ->get();
                return view('user.allBooking',compact('list'));
    }
      public function viewbooking($id){
        $item=Booking::findOrFail($id);
        return view('user.bookingList',compact('item'));
    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\Room;
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
        //
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
  public function store(Request $request)
{
    $email = $request->email; 

    $userCount = User::where('email', $email)->count();
    
    if ($userCount==0) {
       
     $this->userValidator($request->all())->validate();

    $user=new User();
       $user->name=$request->name;
       $user->email=$request->email;
       $user->phone=$request->phone;
       $user->role="user";
       $user->credential=$request->credential;
       $user->status="2";
       $user->password=Hash::make("12345678");

        $user->save();
          
      
    }
   

     $user = User::where('email', $email)->first();
     $uId=$user->id;
     

  

    $this->bookingValidator($request->all())->validate();

    //Set booking status
    $status = (Auth::check() && Auth::user()->status == '2') ? 'pending' : 'booked';

    

    //Create booking
    Booking::create([
        'user_id' => $uId,
        'room_id' => $request->room_id,
        'check_in' => $request->check_in,
        'check_out' => $request->check_out,
        'status' => $status,
        'booked_date' => now(),
    ]);

      $room = Room::find($request->room_id);
         $room->is_avaliable = 'booked';
         $room->update();
   
    return redirect()->route('admin.room.bookingList');
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
        //
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

     protected function userValidator(array $data)
    {
        return Validator::make($data, [
            'name'=>['required','string'],
            'email' => [
            'required',
            'string',
            'max:255',
            'unique:users,email' ,
        ],           
        'phone'=>['required','string'],
        'credential' => ['required','string'],
         
        ]);
    }

    protected function bookingValidator(array $data)
    {
        return Validator::make($data, [
       
        'check_in' => 'required|date|after_or_equal:today',  
        'check_out' => 'required|date|after:check_in',
       
         
        ]);
    }
}
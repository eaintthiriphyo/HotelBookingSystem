<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\Room;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

return $request->email;

    $userEmail=$request->email ;
            return $userEmail;

        $user = User::where('email', $userEmail)->first();
        if(!$user){
     $this->userValidator($request->all())->validate();
  $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'credential' => $request->credential,
        'status' => "2",
        'password' => Hash::make("12345678"),
    ]);
        }

     $this->bookingValidator($request->all())->validate();
$status = $user->status == 2 ? 'pending' : 'booked';

    Booking::create([
        'user_id' => $user->id,
        'room_id' => $request->room_id,
        'check_in' => $request->check_in,
        'check_out' => $request->check_out,
        'status' => $status, 
        'booked_date' => now(),
    ]);
        $room = Room::find($request->room_id);
         $room->is_avaliable = 'booked';
         $room->update();


    return redirect()->back();
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
            'unique:room_types,room_type' ,
        ],           
         'price' => ['required', 'string', 'max:255'],
        'phone'=>['required','string'],
        'credential' => ['required','string'],
         
        ]);
    }

    protected function bookingValidator(array $data)
    {
        return Validator::make($data, [
        'email'=>['required','string','max:255'],    
        'phone' => ['required', 'string', 'max:255'],
        'check_in' => 'required|date|after_or_equal:today',  
        'check_out' => 'required|date|after:check_in',
        'credential' => ['required','string'],
         
        ]);
    }
}
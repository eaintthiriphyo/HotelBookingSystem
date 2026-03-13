<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomType;
use App\Models\Room;
use Illuminate\Support\Facades\Validator;



class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms=Room::all();
        return view('admin.room.index',compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roomType=RoomType::all();
        return view('admin.room.create',compact('roomType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $this->validator($request->all())->validate();
        // return $request;
        $room=new Room();
        $room->room_number='R_' . $request->room_number;
        $room->room_type_id=$request->room_type_id;
        $room->save();
        return redirect()->route('admin.room.index')->with('sucessRoom','Room Created Successfully!!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room=Room::findOrFail($id);
        return view('admin.room.view',compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $room=Room::findOrFail($id);
        $roomType=RoomType::all();
        return view('admin.room.edit',compact('room','roomType'));
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

        $room=Room::findOrFail($id);
        $room->room_number=$request->room_number;
        $room->room_type_id=$request->room_type;
    
        $room->update();
        return redirect()->route('admin.room.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room=Room::findOrFail($id);
        if($room->is_avaliable=="booked" || $room->is_avaliable=='unavaliable'){
        return redirect()->back()->with('errMessage','Can not delete this room');
        }
        $room->delete();
        return redirect()->back();
    }

    protected function validator(array $data,$id = null)
    
    {
        return Validator::make($data,[
            'room_number'=>[
                    'required',
                    'string',
                    'max:255',
                    'unique:rooms,room_number'.($id ? ',' . $id :'')
                    ],
            'room_type_id'=>[
                'required',
                'integer',
                'exists:room_types,id'
            ]
        ]);
    }



    public function avaliableList(){
        $room=Room::all();
        return view('admin.room.avaliableList',compact('room'));
    }

    public function avaliableListUpdate(Request $request,$id){
        $room=Room::findOrFail($id);

        if($request->is_avaliable=='booked'){
          
        return redirect()->route('admin.booking.index', ['room_id' => $room->id]);
        }
        $room->is_avaliable=$request->is_avaliable;
       
        $room->update();
        return redirect()->back();
    }

     public function pendingList(){
        $room=Room::all();
        return view('admin.room.pendingList',compact('room'));
    }

     public function pendingListUpdate(Request $request,$id){
        $roomStatus=Room::findOrFail($id);

      
        $roomStatus->is_avaliable=$request->is_avaliable;

        $roomStatus->update();
        return redirect()->back();
    }

     public function bookingList(){
        $room=Room::all();
        return view('admin.room.bookingList',compact('room'));
    }

     public function bookingListUpdate(Request $request,$id){
        $roomStatus=Room::findOrFail($id);
        $roomStatus->is_avaliable=$request->is_avaliable;
        $roomStatus->update();
        return redirect()->back();
    }


    public function unavaliableList(){
        $room=Room::all();
        return view('admin.room.unavaliableList',compact('room'));
    }

     public function unavaliableListUpdate(Request $request,$id){
        $roomStatus=Room::findOrFail($id);
        $roomStatus->is_avaliable=$request->is_avaliable;
        $roomStatus->update();
        return redirect()->back();
    }

    
}

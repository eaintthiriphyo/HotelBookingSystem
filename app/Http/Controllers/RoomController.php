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
}

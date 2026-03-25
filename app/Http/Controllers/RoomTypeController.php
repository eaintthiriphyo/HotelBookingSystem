<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomType;
use Illuminate\Support\Facades\Validator;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roomTypes=RoomType::paginate(5);
         return view('admin.roomType.index',compact('roomTypes'));
    }


    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roomType.create');
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
        $roomType=new RoomType();
        $roomType->room_type=$request->room_type;
        $roomType->price=$request->price;
        $roomType->description=$request->description;

        if($request->hasFile('kitchen')){
            $kitchenImage=$request->file('kitchen');

            $kitchenPath=time().'_'.$kitchenImage->getClientOriginalName();
            $kitchenImage->move(public_path('images'), $kitchenPath);
            $roomType->kitchen=$kitchenPath;
        }else{
    $roomType->kitchen = 'default.jpg';
}

  if($request->hasFile('bedroom')){
            $bedroomImage=$request->file('bedroom');

            $bedroomPath=time().'_'.$bedroomImage->getClientOriginalName();
            $bedroomImage->move(public_path('images'), $bedroomPath);
            $roomType->bedroom=$bedroomPath;
        }else{
    $roomType->bedroom = 'default.jpg';
}


  if($request->hasFile('bathroom')){
            $bathroomImage=$request->file('bathroom');

            $bathroomPath=time().'_'.$bathroomImage->getClientOriginalName();
            $bathroomImage->move(public_path('images'), $bathroomPath);
            $roomType->bathroom=$bathroomPath;
        }else{
    $roomType->bathroom = 'default.jpg';
}


  if($request->hasFile('view')){
            $viewImage=$request->file('view');

            $viewPath=time().'_'.$viewImage->getClientOriginalName();
            $viewImage->move(public_path('images'), $viewPath);
            $roomType->view=$viewPath;
        }else{
    $roomType->view = 'default.jpg';
}


        $roomType->save();
        return redirect()->back()->with('succRT',"Room Type created successufully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $roomType=RoomType::findOrFail($id);
       return view('admin.roomType.view',compact('roomType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roomType=RoomType::findOrFail($id);
         return view('admin.roomType.edit',compact('roomType'));
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
       $this->validator($request->all(), $id)->validate();
       $roomType=RoomType::findOrFail($id);
       $roomType->room_type=$request->room_type;
       $roomType->price=$request->price;
       $roomType->description=$request->description;

       $imageFields=['kitchen','bedroom','bathroom','view'];
       foreach($imageFields as $field){
         if ($request->hasFile($field)) {
            $image = $request->file($field);
              if($roomType->$field && $roomType->$field != 'default.jpg' && file_exists(public_path('images/'.$roomType->$field))){
                unlink(public_path('images/'.$roomType->$field));
            }
            $name = time().'_'.$field.'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $name);
            $roomType->$field = $name;
        }
       }
       $roomType->update();
        return redirect()->route('admin.roomType.index')
                     ->with('success', 'Room Type updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     ;
    }

     public function delete(Request $request,$id)
    {
        $roomType=RoomType::findOrFail($id);
       $status=$request->status;
       if($status=="inactive"){
        $roomType->status=$status;
       }
        if($status=="active"){
            $roomType->status=$status;
        }
    
                $roomType->update();
                return redirect()->route('admin.roomType.index');
    }


    public function search(Request $request){
        
            $search = $request->input('search');
            $roomTypes = RoomType::when($search, function ($query, $search) {
        $query->where('room_type', 'like', "%{$search}%");
    })->paginate(5);
        return view('admin.roomType.index', compact('roomTypes', 'search'));


    }

      protected function validator(array $data, $id = null)
    {
        return Validator::make($data, [
            'room_type' => [
            'required',
            'string',
            'max:255',
            'unique:room_types,room_type' . ($id ? ',' . $id : ''),
        ],
         'price' => ['required', 'string', 'max:255'],
            'description'=>['required','string'],
            'kitchen' => ['nullable','image','mimes:jpg,jpeg,png','max:2048'],
            'bedroom' => ['nullable','image','mimes:jpg,jpeg,png','max:2048'],
            'bathroom' => ['nullable','image','mimes:jpg,jpeg,png','max:2048'],
            'view' => ['nullable','image','mimes:jpg,jpeg,png','max:2048'],

        ]);
    }
}

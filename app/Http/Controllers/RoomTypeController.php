<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomType;
use App\Models\RoomTypeImage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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
             $roomType->save();




        $roomTypeId = $roomType->id;

        if ($request->hasFile('image')) {
    foreach ($request->file('image') as $image) {
        if ($image == null) continue;

       $imgName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('images'), $imgName);


        $roomTypeImage = new RoomTypeImage();
        $roomTypeImage->img_src = 'images/' . $imgName;
        $roomTypeImage->img_alt = $request->room_type;
        $roomTypeImage->room_type_id = $roomTypeId;
        $roomTypeImage->save();
    }
}
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
       $roomType = RoomType::with('RoomTypeImages')->findOrFail($id);

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
       $roomType=RoomType::findOrFail($id);
              $this->validator($request->all(), $id)->validate();

       $roomType->room_type=$request->room_type;
       $roomType->price=$request->price;
       $roomType->description=$request->description;
       $roomType->save();

       $roomTypeId=$roomType->id;



   if ($request->has('images_to_delete')) {
    $imagesToDelete = json_decode($request->images_to_delete, true);
    foreach ($imagesToDelete as $imgId) {
        $img = RoomTypeImage::find($imgId);
        if ($img) {
            // Delete file from public/images
            $filePath = public_path($img->img_src);
            if (file_exists($filePath)) {
                unlink($filePath); // remove physical file
            }

            // Delete from database
            $img->delete();
        }
    }
}

 if ($request->hasFile('replace_images')) {
    foreach ($request->file('replace_images') as $imgId => $file) {
        $img = RoomTypeImage::find($imgId);
        if ($img) {
            // Delete old file from public/images
            $filePath = public_path($img->img_src);
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Store new file in public/images
            $imgName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $imgName);

            // Update DB
            $img->img_src = 'images/' . $imgName;
            $img->img_alt="image";
            $img->room_type_id=$roomTypeId;
            $img->save();
        }
    }
}

 if ($request->hasFile('image')) {
    foreach ($request->file('image') as $file) {
        $imgName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images'), $imgName);

        $roomType->RoomTypeImages()->create([
            'img_src' => 'images/' . $imgName,
            'img_alt' => "image",
            'room_type_id' => $roomTypeId
        ]);
    }
}


       $roomType->update();
        return redirect()->route('admin.roomType.index')
                     ->with('success', 'Room Type updated successfully!');

    }

    public function deleteImage($id)
{
    $image = RoomTypeImage::findOrFail($id);
    Storage::delete($image->img_src);
    $image->delete();
    return back()->with('success', 'Image deleted successfully!');
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

    public function inactiveList(){
         $roomTypes=RoomType::paginate(5);
         return view('admin.roomType.inactiveroomType',compact('roomTypes'));
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

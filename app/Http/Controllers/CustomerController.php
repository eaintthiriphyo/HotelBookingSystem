<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
 $customers = User::where('role', 'user')->get();

        return view('admin.customer.index', compact('customers'));    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         return view('admin.customer.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $this->userValidator($request->all())->validate();

    $user=new User();
       $user->name=$request->name;
       $user->email=$request->email;
       $user->phone=$request->phone;
       $user->role="user";
       $user->credential=$request->credential;
       $user->status="2";
       $user->password=Hash::make("12345678");

if($request->hasFile('image')){
    $userImage = $request->file('image');
    $imgPath = time().'_'.$userImage->getClientOriginalName();
    $userImage->move(public_path('images/user'), $imgPath);
    $user->image = $imgPath;
} else {
    $user->image = 'default.png';
}

        $user->save();

        return redirect()->back()->with('succCus', 'Customer Created Successfully');

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


    public function viewProfile($email){


          $profile=User::where('email',$email)->firstOrFail();
        // return $profile;
        return view('user.viewProfile',compact('profile'));
     }

      public function viewEditProfile($email){
        $profile=User::where('email',$email)->firstOrFail();

        return view('user.viewEditProfile',compact('profile'));
     }


      public function profileUpdate(Request $request,$email){
        $profile=User::where('email',$email)->firstOrFail();

         $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string',
        'address' => 'required|string',
        'credential' => 'required|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);
     if ($request->hasFile('image')) {

        $file = $request->file('image');
        $filename = time().'.'.$file->getClientOriginalExtension();

        $file->move(public_path('images/user'), $filename);

        $profile->image = $filename;
        $profile->name = $request->name;
    $profile->phone = $request->phone;
    $profile->credential = $request->credential;
    $profile->update();

    }
        return redirect()->back()->with('succUpdateProfile',"Profile Update Successfully");
     }


     public function viewChangePassword($email){
        return view('user.viewChangePassword');
     }



     public function changePassword(Request $request ){
           $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:6',
        'confirm_password' => 'required|same:new_password'
    ]);
        $user=Auth::user();
         if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'Current password is incorrect']);
         }

          $user->password = Hash::make($request->new_password);
    $user->save();
        return back()->with('succPass','Password Updated Successfully');


     }

      protected function userValidator(array $data, $id = null)
    {
        return Validator::make($data, [
            'name'=>['required','string'],
            'email' => [
            'required',
            'string',
            'max:255',
            'unique:users,email'.($id ? ',' . $id :'') ,
        ],
        'phone'=>['required','string'],
        'credential' => ['required','string'],
        'image' => ['nullable','image','mimes:jpg,jpeg,png','max:2048'],

        ]);
    }
}

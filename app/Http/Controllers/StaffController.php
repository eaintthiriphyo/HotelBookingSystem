<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


use App\Models\Department;
use App\Models\User;
class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
$staff = User::where('status', '!=', '2')->get();
        return view('admin.staff.index',compact('staff'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    $department=Department::all();
        return view('admin.staff.create',compact('department'));
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

        $staff=new User();

        $staff->name=$request->name;
        $staff->email=$request->email;
        $staff->phone=$request->phone;
        $staff->role='admin';
        $staff->status="1";
        $staff->roles=$request->role;
        $staff->address=$request->address;
        $staff->credential=$request->credential;

        $staff->password=Hash::make('admin123456');
        $staff->department_id=$request->department_id;
        $staff->save();
        return redirect()->back()->with('succStaff','Staff Added Successfully');
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
        return $id;
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
        return view('admin.staff.viewProfile',compact('profile'));
     }

      public function viewEditProfile($email){
        $profile=User::where('email',$email)->firstOrFail();

        return view('admin.staff.viewEditProfile',compact('profile'));
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
    $profile->address = $request->address;
    $profile->credential = $request->credential;
    $profile->update();

    }
        return redirect()->back()->with('succUpdateProfile',"Profile Update Successfully");
     }


     public function viewChangePassword($email){
        return view('admin.staff.viewChangePassword');
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

      /** @var \App\Models\User $user */
$user = Auth::user();
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
          'role'=>['required','string'],
        'credential' => ['required','string'],
        'image' => ['nullable','image','mimes:jpg,jpeg,png','max:2048'],
        'address'=>['required','string'],
'department_id' => ['required', 'exists:departments,id'],

        ]);
    }
}

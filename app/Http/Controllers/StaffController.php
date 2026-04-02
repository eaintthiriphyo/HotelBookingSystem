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
        $staff = User::where('status', '!=', '2')->paginate(5);

        return view('admin.staff.index',compact('staff'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $json = file_get_contents(public_path('json/nrc.json'));
    $nrcData = json_decode($json, true);

           $department=Department::where('status','active')->get();

        return view('admin.staff.create',compact('department','nrcData'));
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
        $staff->roles=$request->roles;
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
        $staff=User::findOrFail($id);
        $departments=Department::where('status','active')->get();
         $json = file_get_contents(public_path('json/nrc.json'));
        $nrcData = json_decode($json, true);
        return view('admin.staff.edit',compact('staff','departments'));
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
         $staff=User::findOrFail($id);
        $this->userValidator($request->all(),$id)->validate();

        $staff->name=$request->name;
        $staff->email=$request->email;
        $staff->phone=$request->phone;
        $staff->roles=$request->roles;
        $staff->address=$request->address;
        $staff->credential=$request->credential;
        $staff->department_id=$request->department_id;
        $staff->update();
        return redirect()->back()->with('succStaff','Staf Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $staff=User::findOrFail($id);
        $staff->delete();
        return redirect()->back();

    }

    public function viewProfile($id){
        $profile=User::findOrFail($id);
         $json = file_get_contents(public_path('json/nrc.json'));
        $nrcData = json_decode($json, true);
        return view('admin.staff.viewProfile',compact('profile','nrcData'));
     }

      public function viewEditProfile($id){
        $profile=User::findOrFail($id);
         $json = file_get_contents(public_path('json/nrc.json'));
        $nrcData = json_decode($json, true);

        return view('admin.staff.viewEditProfile',compact('profile','nrcData'));
     }




     public function viewChangePassword($id){
        return view('admin.staff.viewChangePassword');
     }
public function profileUpdate(Request $request, $id){
    $profile = User::findOrFail($id);


        // Validate form
    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'address' => 'required|string|max:255',
        'credential' => 'required|string|max:50',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);
    // Image upload
    if ($request->hasFile('image')) {

     if ($profile->image && $profile->image != 'default.png') {
            @unlink(public_path('images/user/'.$profile->image));
        }
        $file = $request->file('image');
        $filename = time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('images/user'), $filename);
        $profile->image = $filename;
    }



    // Update
    $profile->name = $request->name;
    $profile->phone = $request->phone;
    $profile->address = $request->address;
    $profile->credential = $request->credential;

    $profile->update();

    return redirect()->back()->with('succUpdateProfile', 'Profile Updated Successfully');
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
          'roles'=>['required','string'],
        'credential' => ['required','string'],
        'image' => ['nullable','image','mimes:jpg,jpeg,png','max:2048'],
        'address'=>['required','string'],
'department_id' => ['required', 'exists:departments,id'],

        ]);
    }
}

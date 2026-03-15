<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Validator;


class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $dep = Department::orderBy('title', 'asc')->get();

        return view ('admin.department.index',compact('dep'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
                return view ('admin.department.create');

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

        $dep=new Department();
        $dep->title=$request->title;
        $dep->details=$request->details;
        $dep->save();
        return redirect()->back()->with('successDep',"Department created successfully");
    }

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

    $dep=Department::findOrFail($id);
     return view('admin.department.edit',compact('dep'));

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
        $dep=Department::findOrFail($id);
        $dep->title=$request->title;
        $dep->details=$request->details;
        $dep->update();
        return redirect()->back()->with('updateDep',"Department updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dep=Department::findOrFail($id);
        $dep->delete();
        return redirect()->back();
    }



    protected function validator(array $data, $id = null)
    {
        return Validator::make($data, [
            'title' => [
            'required',
            'string',
            'max:255',
            'unique:departments,title' . ($id ? ',' . $id : ''),
        ],
         'details' => ['required', 'string', 'max:255'],


        ]);
    }
  }


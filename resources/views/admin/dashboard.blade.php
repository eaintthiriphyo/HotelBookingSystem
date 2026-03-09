@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-3">
            @include('layouts.sidebar')
        </div>
        <div class="col-8">
            <div class="card p-3">
                <div class="card-header"><h3><b>Course Lists</b></h3></div>
                <div class="card-body">

              <a href="">
                <button class="btn btn-success">Add New Course</button>
              </a>
                <a href="" class="float-end">
                <button class="btn btn-warning">Pending Course</button>
              </a>

              <table class="table mt-3">
                 
               
          
              <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Duration</th>
                    <th>Action</th>
                </tr>
              </thead>
           
              <tbody>
              
               
            
               
              </tbody>
              
              </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
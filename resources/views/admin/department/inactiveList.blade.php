@extends('layouts.adminLayout')

@section('content')
<div class="container-fluid pt-4">

    <div class="card shadow-sm border-0">
        <div class="card-header  d-flex justify-content-between align-items-center" style="background-color:navy;color:white">
            <h3 class="mb-0"><b>Department Lists</b></h3>
            <a href="{{ route('admin.department.create') }}" class="btn btn-light btn-sm">
                <i class="fas fa-plus"></i> Add New
            </a>
        </div>

         <div class="mt-3">
            <a href="{{route('admin.department.index')}}" class="btn "style="background-color:navy;color:white">Active List</a>
        </div>
        <div class="card-body p-3">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center">
                    <thead style="background-color:navy;color:white">
                        <tr>
                            <th>Department Title</th>
                            <th>Details</th>
                            <th>Status</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dep as $d)
                       @if($d->status=="inactive")
                        <tr>
                            <td>{{ $d->title }}</td>
                            <td>{{ $d->details }}</td>
                            <td  >{{ $d->status}}</td>
                                                      <td>
                                <div  class="btn-group" role="group">
                                    <a href="{{ route('admin.department.edit', $d->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                   
                                </div>



                          
                                
                             <form action="{{ route('admin.department.delete', $d->id) }}" method="POST" class="d-inline" >
                                        @csrf
                                        @method('PUT')
                                       @if($d->status==="active")
                                       <input type="hidden" name="status" value="inactive">
                                        <button class="btn btn-sm btn-danger" type="submit">
                                            Inactive
                                        </button>
                                        @else
                                      <input type="hidden" name="status" value="active" >
                                          <button class="btn btn-sm btn-success" type="submit">
                                            Active
                                        </button>
                                       @endif
                                       
                                    </form>
                            </td>
                           
                        </tr>
                       @endif
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">No departments found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {{ $dep->links() }}
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 12px;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
        transition: 0.3s;
    }
    .table td{
        color:black;
    }

    .btn-group .btn, .d-flex.gap-2 .btn {
        min-width: 70px;
    }

    .table td, .table th {
        vertical-align: middle;
    }

    .pagination .page-link {
        color: #343a40;
    }

    .pagination .page-item.active .page-link {
        background-color: #343a40;
        border-color: #343a40;
    }
</style>
@endsection

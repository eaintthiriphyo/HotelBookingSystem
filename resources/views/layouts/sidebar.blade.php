<div id='sidebar'>
<div class="card p-3 bg-light vh-100">
    <ul class="list-unstyled">

      <li class="mb-2">
            <a href="{{route('admin.dashboard')}}"
                class="d-block p-2 text-decoration-none text-dark rounded active {{request()->routeIs('admin.dashboard') ? 'bg-primary text-white' : ''}}">
                Home
            </a>
        </li>
        <li class="mb-2">
            <a href="{{route('admin.roomType.index')}}"
                class="d-block p-2 text-decoration-none text-dark rounded active {{request()->routeIs('admin.roomType.*') ? 'bg-primary text-white' : ''}}">
                Room Type
            </a>
        </li>

             <li class="mb-2">
            <a href="{{route('admin.room.index')}}"
                class="d-block p-2 text-decoration-none text-dark rounded active {{request()->routeIs('admin.room.*') ? 'bg-primary text-white' : ''}}">
                Room 
            </a>
        </li>

        <li class="mb-2">
            <a href=""
                class="d-block p-2 text-decoration-none text-dark rounded  ">
                Booking
            </a>
        </li>
        <li class="mb-2">
            <a href=""
                class="d-block p-2 text-decoration-none text-dark rounded ">
                Admin Management
            </a>
        </li>

        <li class="mb-2">
            <a href=""
                class="d-block p-2 text-decoration-none text-dark rounded  ">
                Batch
            </a>
        </li>
        <li class="mb-2">
            <a href=""
                class="d-block p-2 text-decoration-none text-dark rounded ">
                Enrollment
            </a>
        </li>
    </ul>


</div>
</div>
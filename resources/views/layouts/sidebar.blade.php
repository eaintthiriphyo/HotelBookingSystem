<div id='sidebar'>
<div class="card p-3 bg-light vh-100">
    <ul class="list-unstyled">

        <li class="mb-2">
            <a href="{{route('admin.room.index')}}"
                class="d-block p-2 text-decoration-none text-dark rounded {{request()->routeIs('admin.room.index') ? 'bg-primary text-white' : ''}}">
                Home
            </a>
        </li>

        <li class="mb-2">
            <a href=""
                class="d-block p-2 text-decoration-none text-dark rounded  ">
                Students
            </a>
        </li>
        <li class="mb-2">
            <a href=""
                class="d-block p-2 text-decoration-none text-dark rounded ">
                Course
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
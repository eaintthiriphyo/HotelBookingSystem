@extends('layouts.adminLayout')

@section('content')
<div class="container-fluid">

    <!-- Page Title -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800">Dashboard</h1>
    </div>

    <!-- Statistic Cards -->
    <div class="row">

        <!-- Bookings -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Today Bookings</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $bcount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Bookings ({{ \Carbon\Carbon::now()->format('F') }})
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $monthBook }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Check In -->



          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Today Check In</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $todayCheckIn }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-sign-in-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customers -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                   Monthly Check In ({{ \Carbon\Carbon::now()->format('F') }})
                            </div>
                             <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $thisMonthCheckIn }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rooms -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Rooms</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $roomCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bed fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Staff -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Staff</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $staffCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Charts Section -->
    <div class="row">

        <!-- Monthly Booking Area Chart -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Monthly Bookings</h6>
                </div>
                <div class="card-body">
                    <canvas id="myAreaChart" style="height:300px;"></canvas>
                </div>
            </div>
        </div>

        <!-- Room Type Pie Chart -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Room Type Popularity</h6>
                </div>
                <div class="card-body">
                    <div style="max-height:300px;">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <!-- Custom Legend -->
                    <div id="pieLegend" class="mt-3"></div>
                </div>
            </div>
        </div>

    </div>

</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Monthly Bookings Area Chart
    var ctx = document.getElementById("myAreaChart").getContext('2d');
    var monthlyData = JSON.parse('@json($monthlyBookings)');
    var chartData = new Array(12).fill(0);
    for (var month in monthlyData) {
        chartData[month - 1] = monthlyData[month];
    }

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: "Bookings",
                data: chartData,
                backgroundColor: "rgba(78,115,223,0.2)",
                borderColor: "rgba(78,115,223,1)",
                borderWidth: 2,
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });


    var roomTypes = JSON.parse('@json($roomTypeData)');
    var labels = [];
    var data = [];
    var colors = ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796'];

    roomTypes.forEach(function(item) {
        labels.push(item.room_type);
        data.push(item.total);
    });

    // Create Pie Chart
    var pieChart = new Chart(document.getElementById("myPieChart"), {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: colors
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });






  var legend = document.getElementById("pieLegend");
        var row = document.createElement("div");
        row.className = "row";

        labels.forEach(function(label, i) {
            var col = document.createElement("div");
            col.className = "col-6 mb-2";

            var item = document.createElement("div");
            item.style.display = "flex";
            item.style.alignItems = "center";
            item.style.background = "#f8f9fc";
            item.style.padding = "6px 10px";
            item.style.borderRadius = "6px";

            var box = document.createElement("span");
            box.style.width = "20px";
            box.style.height = "20px";
            box.style.backgroundColor = colors[i];
            box.style.marginRight = "8px";

            var text = document.createElement("span");
            text.innerText = label + " ( booked" + data[i] + ")";

            item.appendChild(box);
            item.appendChild(text);
            col.appendChild(item);
            row.appendChild(col);
        });

        legend.appendChild(row);
</script>
@endsection

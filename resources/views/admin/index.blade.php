@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>150</h3>

                            <p>New Orders</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>53<sup style="font-size: 20px">%</sup></h3>

                            <p>Bounce Rate</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>44</h3>

                            <p>User Registrations</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>65</h3>

                            <p>Unique Visitors</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-7 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Teachers
                            </h3>
                            <div class="card-tools">
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <canvas id="myChart" width="400" height="400"></canvas>
                        </div><!-- /.card-body -->
                    </div>
                </section>
                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-5 connectedSortable">
                    {{-- <section class="content"> --}}
                        <div class="container-fluid text-center">
                            <div class="row">
                                <div class="col-12">
                                  <div class="card">
                                    <div class="card-header">
                                      <h3 class="card-title">Student Joining Comparison Data</h3>
                                      <div class="card-tools">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <select name="" id="SelectDataToGet" class="form-control float-right">
                                                <option value="today">Today</option>
                                                <option value="yesterday">Yesterday</option>
                                                <option value="thisweek">This Week</option>
                                                <option value="lastweek">Last Week</option>
                                                <option value="thismonth">This Month</option>
                                                <option value="thisyear">This Year</option>
                                                <option value="lastyear">Last Year</option>
                                            </select>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body card-header d-flex justify-content-center table-responsive p-0 mt-2">
                                        <div id="ComparisonChart" class="mt-4 mb-4"></div>
                                    </div>
                                    <div class="d-flex justify-content-center p-4">
                                        <div class="list-group-item" id="income"></div>
                                        <div class="list-group-item ml-4" id="expense"></div>
                                    </div>
                                    </div>
                                  <!-- /.card -->
                                </div>
                            </div>
                        </div>
                    {{-- </section> --}}
                </section>
                <!-- right col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>

const ctx = document.getElementById('myChart');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: '# joins',
            data: [{{ $data }}],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

<script>
    // <!--+==== Ajax ====+-->
        var value = 'today';
         // <!--+==== Page Load ====+-->
        GetData(value);
         // <!--+==== When Select ====+-->
        $('#SelectDataToGet').on('change', function () {
            this.value = $('#SelectDataToGet').val();
            GetData(this.value);
        });
         // <!--+==== Ajax ====+-->
        function GetData(value){
            $.ajax(
            {
                url: "/expense/income/data",
                dataType: "JSON",
                type: 'POST',
                data: {
                    '_token': $('meta[name=csrf-token]').attr("content"),
                    "value": value
                },
                success:function(data){
                    $("#income").html('Income: '+ data.income + '$');
                    $("#expense").html('Expense: '+ data.expense + '$');
                    var json = [data.income,data.expense]
                    // <!--+==== Chart ====+-->
                    var options = {
                    series: json,
                    chart: {
                    width: 380,
                    type: 'pie',
                    },
                    labels: ['Income','Expense'],
                    colors:["#008000", "#FF0000"],
                    responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                        width: 200
                        },
                        legend: {
                        position: 'bottom'
                        }
                    }
                    }]
                    };
                    // <!--+==== Chart Render ====+-->
                    $("#ComparisonChart").html('');
                    var chart = new ApexCharts(document.querySelector("#ComparisonChart"), options);
                    console.log(chart);
                    chart.render();
                }
            });
        }
</script>
@endsection

@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Export Data</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Export Data</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Export Data</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-3 text-center m-auto">
                    <form id="students" action="{{ route('export-student-data') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="students">Choose a type:</label>
                            <select class="form-control" name="students" id="students" form="students">
                              <option value="daily">Daily Student List</option>
                              <option value="monthly">Monthly Students List</option>
                              <option value="yearly">Yearly Students list</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Download</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-3 text-center m-auto">
                    <form action="">
                        <div class="form-group">
                            <label for="teachers">Choose a type:</label>
                            <select class="form-control" name="students" id="students" form="studentform">
                              <option value="daily">Daily Teacher List</option>
                              <option value="monthly">Monthly Teachers List</option>
                              <option value="yearly">Yearly Teachers list</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
@endsection

@section('js')
<script type="text/javascript">

</script>
@endsection

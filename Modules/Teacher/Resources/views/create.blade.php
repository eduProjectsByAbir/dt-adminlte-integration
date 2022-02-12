@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Teacher</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Teacher</li>
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
                <div class="card-tools">
                    <a href="{{ route('teachers.index') }}" class="btn btn-success">View Teacher</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="col-md-6 m-auto">
                <div class="card-body">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            {{-- Form starts --}}
                            <form action="{{ route('teachers.store') }}" class="form-group" method="POST">
                                @csrf
                                <ul class="list-group list-group-unbordered mb-3">
                                    {{-- Name starts --}}
                                    <li class="list-group-item">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" id="name" placeholder="Enter Your name">
                                        @error('name')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </li>
                                    {{-- email starts --}}
                                    <li class="list-group-item">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" id="email" placeholder="Enter Your email">
                                        @error('email')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </li>
                                    {{-- number starts --}}
                                    <li class="list-group-item">
                                        <label for="number">Mobile</label>
                                        <input type="number" class="form-control @error('number') is-invalid @enderror"
                                            name="number" id="number" placeholder="Enter Your mobile number">
                                        @error('number')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </li>
                                </ul>
                                {{-- submit button --}}
                                <div class="form-group ml-4">
                                    <input type="submit" class="btn btn-success" name="submit" value="Add Teacher">
                                </div>
                            </form>
                            {{-- form ends --}}
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
            <!-- /.card-footer-->
        </div>
    </section>
    @endsection

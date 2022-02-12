@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Teacher</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Teacher</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

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
                <form action="{{ route('teachers.update', $teacher->id ) }}"
                    class="form-group" method="POST">
                    @method('PUT')
                    @csrf
                    <ul class="list-group list-group-unbordered mb-3">
                        {{-- Name starts --}}
                        <li class="list-group-item">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" value="{{ $teacher->name }}" placeholder="Enter Your name">
                            @error('name')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </li>
                        {{-- email starts --}}
                        <li class="list-group-item">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                id="email" value="{{ $teacher->email }}" placeholder="Enter Your email">
                            @error('email')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </li>
                        {{-- Number starts --}}
                        <li class="list-group-item">
                            <label for="number">Mobile Number</label>
                            <input type="number" class="form-control @error('number') is-invalid @enderror" name="number"
                                id="number" value="{{ $teacher->number }}" placeholder="Enter Your number">
                            @error('number')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </li>
                    </ul>
                    {{-- submit button --}}
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" name="update" value="Update">
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
            <!-- /.card-footer-->
        </div>
    </section>
    @endsection

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
                <form action="{{ route('students.update', $studentData->id ) }}" class="form-group" method="POST">
                    @method('PUT')
                    @csrf
                    <h3 class="profile-username text-center">{{ $studentData->name }}</h3>

                    <ul class="list-group list-group-unbordered mb-3">
                        {{-- Name starts --}}
                        <li class="list-group-item">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" id="name" value="{{ $studentData->name }}"
                                placeholder="Enter Your name">
                            @error('name')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </li>
                        {{-- email starts --}}
                        <li class="list-group-item">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" id="email" value="{{ $studentData->email }}"
                                placeholder="Enter Your email">
                            @error('email')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </li>
                        {{-- image upload starts --}}
                        <li class="list-group-item">
                            <label for="avatar">Upload Image</label>
                            <input type="file" name="avatar"
                                class="form-control @error('avatar') is-invalid @enderror" id="avatar"
                                accept="image/*" onchange="loadFile(event)">
                            @error('avatar')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </li>
                        {{-- change password --}}
                        <li class="list-group-item">
                            <label for="change_password">Change password?</label>
                            <input type="checkbox" value="1" @if(session()->has('error')) checked @endif
                            @error('current_password') checked @enderror || @error('ChangePassword') checked
                            @enderror name="change_password" class="form-control"
                            onclick="changePassword()" id="change_password">
                        </li>
                        <div id="showPass" style="display: none">
                            {{-- new password --}}
                            <li class="list-group-item">
                                <label for="password">New Password</label>
                                <input type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password" id="password" placeholder="Enter Your New Password">
                                @error('password')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                                {{-- confirm password --}}
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    name="password_confirmation" id="password_confirmation"
                                    placeholder="Retype your new Password">
                                @error('password_confirmation')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </li>
                        </div>
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

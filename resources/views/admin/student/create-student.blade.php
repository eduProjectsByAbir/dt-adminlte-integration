@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Student</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Student</li>
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
          <h3 class="card-title"></h3>

          <div class="card-tools">
            <a href="{{ route('students.index') }}" class="btn btn-success">View Student</a>
          </div>
        </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img id="output" class="profile-user-img img-fluid img-circle"
                                src=" {{ asset('backend/admin/dist/img/avatar.png') }}" alt="User profile picture">
                        </div>
                        {{-- Form starts --}}
                        <form action="{{ route('students.store')}}" class="form-group" method="POST" enctype="multipart/form-data">
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
                                {{-- image upload starts --}}
                                <li class="list-group-item">
                                    <label for="avatar">Upload Avatar</label>
                                    <input type="file" name="avatar"
                                        class="form-control @error('avatar') is-invalid @enderror" id="avatar"
                                        accept="image/*" onchange="loadFile(event)">
                                    @error('avatar')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </li>
                                {{-- change password --}}

                                    <li class="list-group-item">
                                        <label for="password">Password</label>
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
                            <div class="form-group ml-4">
                                <input type="submit" class="btn btn-success" name="submit" value="Add User">
                            </div>
                        </form>
                        {{-- form ends --}}
                    </div>
                    <!-- /.card-body -->
                </div>
              </div>
        <!-- /.card-body -->
        <div class="card-footer">

        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
@endsection

@section('js')
<script>

    // Show image preview
    var loadFile = function (event) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById('output');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    };

</script>
@endsection

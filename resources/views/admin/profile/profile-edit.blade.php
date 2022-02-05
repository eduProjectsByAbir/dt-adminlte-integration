@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">

            <div class="card-body">
                <div class="col-md-9 m-auto">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img id="output" class="profile-user-img img-fluid img-circle"
                                    src="{{ $user->dpicture }}" alt="User profile picture">
                            </div>
                            <form action="" class="form-group" method="post">
                                @csrf
                                <h3 class="profile-username text-center">{{ $user->name }}</h3>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" id="name" value="{{ $user->name }}"
                                            placeholder="Enter Your name">
                                    </li>
                                    <li class="list-group-item">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" id="email" value="{{ $user->email }}"
                                            placeholder="Enter Your email">
                                    </li>
                                    <li class="list-group-item">
                                        <label for="dpicture">Upload Image</label>
                                        <input type="file" name="dpicture"
                                            class="form-control @error('dpicture') is-invalid @enderror" id="dpicture"
                                            accept="image/*" onchange="loadFile(event)">
                                    </li>
                                    <li class="list-group-item">
                                        <label for="change_password">Change password?</label>
                                        <input type="checkbox" class="form-control" onclick="changePassword()"
                                            id="change_password">
                                    </li>
                                    <div id="showPass" style="display: none">
                                        <li class="list-group-item">
                                            <label for="password">Current Password</label>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" id="password" placeholder="Enter Your Current Password">
                                        </li>
                                        <li class="list-group-item">
                                            <label for="ChangePassword">New Password</label>
                                            <input type="password"
                                                class="form-control @error('ChangePassword') is-invalid @enderror"
                                                name="ChangePassword" id="ChangePassword"
                                                placeholder="Enter Your New Password">
                                            <label for="ConfirmPassword">Confirm Password</label>
                                            <input type="password"
                                                class="form-control @error('ConfirmPassword') is-invalid @enderror"
                                                name="ConfirmPassword" id="ConfirmPassword"
                                                placeholder="Retype your new Password">
                                        </li>
                                    </div>
                                </ul>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-success" name="update" value="Update">
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- /.card -->
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<script>
    function changePassword() {
        // Get the checkbox
        var checkBox = document.getElementById("change_password").checked;
        var showPass = document.getElementById("showPass");
        console.log(checkBox);
        if (checkBox == true) {
            showPass.style.display = "block";
        } else {
            showPass.style.display = "none";
        }
    }
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

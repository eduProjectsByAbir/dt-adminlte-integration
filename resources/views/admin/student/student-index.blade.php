@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Student List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Students</li>
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
          <h3 class="card-title">Student list</h3>

          <div class="card-tools">
            <a href="{{ route('students.create') }}" class="btn btn-success">Add Student</a>
          </div>
        </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="studentsTbl" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Avatar</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach($students as $key => $student)
                  <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td><img src="{{ asset('backend/admin/images/1644051749.png') }}" alt="Profile Image - 1" height="50px" width="50px"></td>
                    <td><a href="{{route('students.edit', $student->id)}}" title="edit" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a> <a href="{{route('students.destroy', $student->id)}}" id="delete" title="delete" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Avatar</th>
                    <th>Actions</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
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
    $(function () {
      $("#studentsTbl").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#studentsTbl_wrapper .col-md-6:eq(0)');
    });
  </script>
  <script type="text/javascript">
    $(function (){
        $(document).on('click', '#delete', function (e){
            e.preventDefault();
            var link = $(this).attr("href");
             Swal.fire({
                 title: 'Are you sure?',
                 text: "You won't be able to revart this!",
                 icon: 'warning',
                 showCancelButton: true,
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Yes, Delete it!'
             }).then((result)=> {
                 if (result.value){
                     window.location.href = link;
                     Swal.fire(
                         'Deleted!',
                         'Your user has been Deleted!',
                         'success'
                     )
                 }
             })
        });
    });
</script>
@endsection

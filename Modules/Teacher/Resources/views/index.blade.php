@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Teacher List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Teachers</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Teacher list</h3>

                <div class="card-tools">
                    <a href="{{ route('teachers.create') }}" class="btn btn-success">Add Teacher</a>
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
                            <th>Number</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teachers as $teacher)
                            <tr>
                                <td>{{ $teacher->id }}</td>
                                <td>{{ $teacher->name }}</td>
                                <td>{{ $teacher->email }}</td>
                                <td>{{ $teacher->number }}</td>
                                <td>
                                    <a href="{{ route('teachers.edit', $teacher->id) }}"
                                        title="edit" class="btn btn-sm btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a
                                        href="{{$teacher->id}}" id="delete" title="delete" class="btn btn-sm btn-danger">
                                        <i
                                            class="fa fa-trash">
                                        </i>
                                    </a>
                                    <form id="delete-form-{{ $teacher->id }}" action="{{ route('teachers.destroy', $teacher->id) }}"
                                        method="POST">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Number</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
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
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#studentsTbl_wrapper .col-md-6:eq(0)');
    });

</script>
<script type="text/javascript">
    $(function () {
        $(document).on('click', '#delete', function (e) {
            e.preventDefault();
            var id = $(this).attr('href');
            var form = document.getElementById('delete-form-'+id);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revart this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete it!'
            }).then((result) => {
                if (result.value) {
                    form.submit();
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

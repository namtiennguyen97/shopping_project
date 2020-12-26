@extends('admin.layouts.master')
@section('content')
    @include('admin.layouts.navbarLeft')
    @include('admin.layouts.rightNavBar')
    @include('admin.layouts.mainSideBar')

    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>User List</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">User List</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">DataTable for Admin</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Full Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Role</th>
                                        <th>Delete</th>
                                        <th>Update</th>
                                    </tr>
                                    </thead>
                                    <tbody id="showUserData">

{{--                                   data appen here--}}

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Full Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Role</th>
                                        <th>Delete</th>
                                        <th>Update</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>



    <!-- Modal Edit -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="userEditForm">
                        @csrf
                        <table class="table table-dark">
                            <tr>
                                <td>Name</td>
                                <td><input type="text" name="name" id="editName" placeholder="Edit User Name" required></td>
                            </tr>
                            <tr>
                                <td>Full Name</td>
                                <td><input type="text" name="full_name" id="editFullName" placeholder="Edit User FullName" required></td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td><input type="number" name="phone" id="editPhone" placeholder="Edit User Phone" required></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><input type="email" name="email" id="editEmail" placeholder="Edit User Email" required></td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td><input type="text" name="address" id="editAddress" placeholder="Edit User Address" required></td>
                            </tr>
                            <tr>
                                <td>Change/Promote Role</td>
                                <td><select name="role_id">
                                        @foreach(\App\Models\Roles::all() as $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                            @endforeach
                                    </select></td>
                            </tr>
{{--                            <tr>--}}
{{--                                <td><input hidden id="editID"></td>--}}
{{--                            </tr>--}}
                        </table>
                        <button class="btn btn-success" type="submit">User Change</button>
                    </form>
                </div>
{{--                <div class="modal-footer">--}}
{{--                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                    <button type="button" class="btn btn-primary">Save changes</button>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>

    <script>
        renderUser();
        function renderUser() {
            $.ajax({
               url: "{{route('render.user')}}",
               method: 'get',
               dataType: 'json',
               success: function (data) {
                    $('#showUserData').html(data.data_table);
               }
            });
        }

        $('#showUserData').on('click','.deleteUser', function (e) {
                e.preventDefault();
                let id = $(this).data('id');
                $.ajax({
                    url: "deleteUser/" + id,
                    method: 'get',
                    success: function () {
                        alertify.success("Delete successfully!");
                        renderUser();
                    }
                })
        })

        //show modal update
        let id;
        $('#showUserData').on('click','.editUser', function () {
            $('#editUserModal').modal('show');
            id = $(this).data('id');
            let name = $(this).data('name');
            let full_name = $(this).data('full_name');
            let email = $(this).data('email');
            let address = $(this).data('address');
            let phone = $(this).data('phone');
            $('#editName').val(name);
            $('#editFullName').val(full_name);
            $('#editPhone').val(phone);
            $('#editAddress').val(address);
            $('#editEmail').val(email);
            console.log(id);
        })

        $('#userEditForm').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: "updateUser/" + id,
                method: 'post',
                success: function () {
                    alertify.success("Update Successfully");
                    renderUser();
                }
            });

        })
    </script>
    @endsection

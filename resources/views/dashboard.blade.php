@include('template.master')
@include('template.menuBar')
@include('template.bottomBar')
    <div class="breadcrumb-wrap">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                <li class="breadcrumb-item active">My Account</li>
            </ul>
        </div>
    </div>
{{--My account--}}
<div class="my-account">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="dashboard-nav" data-toggle="pill" href="#dashboard-tab" role="tab"><i class="fa fa-tachometer-alt"></i>Dashboard</a>
                    <a class="nav-link" id="orders-nav" data-toggle="pill" href="#orders-tab" role="tab"><i class="fa fa-shopping-bag"></i>Orders</a>
                    <a class="nav-link" id="payment-nav" data-toggle="pill" href="#payment-tab" role="tab"><i class="fa fa-credit-card"></i>Payment Method</a>
                    <a class="nav-link" id="address-nav" data-toggle="pill" href="#address-tab" role="tab"><i class="fa fa-map-marker-alt"></i>address</a>
                    <a class="nav-link" id="account-nav" data-toggle="pill" href="#account-tab" role="tab"><i class="fa fa-user"></i>Account Details</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            <i class="fa fa-sign-out-alt"></i> Logout </a>
                    </form>
                </div>
            </div>
            <div class="col-md-9">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="dashboard-tab" role="tabpanel" aria-labelledby="dashboard-nav">
                        <h4>{{\Illuminate\Support\Facades\Auth::user()->name}} Dashboard</h4>
                        <p>
                            Fbi waring black desert nier automata bla bla
                            {{\Illuminate\Support\Facades\Auth::user()->desc}}

                        </p>
                    </div>
                    <div class="tab-pane fade" id="orders-tab" role="tabpanel" aria-labelledby="orders-nav">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Product</th>
                                    <th>Date</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Product Name</td>
                                    <td>01 Jan 2020</td>
                                    <td>$99</td>
                                    <td>Approved</td>
                                    <td><button class="btn">View</button></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Product Name</td>
                                    <td>01 Jan 2020</td>
                                    <td>$99</td>
                                    <td>Approved</td>
                                    <td><button class="btn">View</button></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Product Name</td>
                                    <td>01 Jan 2020</td>
                                    <td>$99</td>
                                    <td>Approved</td>
                                    <td><button class="btn">View</button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="payment-tab" role="tabpanel" aria-labelledby="payment-nav">
                        <h4>Payment Method</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. In condimentum quam ac mi viverra dictum. In efficitur ipsum diam, at dignissim lorem tempor in. Vivamus tempor hendrerit finibus. Nulla tristique viverra nisl, sit amet bibendum ante suscipit non. Praesent in faucibus tellus, sed gravida lacus. Vivamus eu diam eros. Aliquam et sapien eget arcu rhoncus scelerisque.
                        </p>
                    </div>
                    <div class="tab-pane fade" id="address-tab" role="tabpanel" aria-labelledby="address-nav">
                        <h4>Address</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Payment Address</h5>
                                <p>123 Payment Street, Los Angeles, CA</p>
                                <p>Mobile: 012-345-6789</p>
                                <button class="btn">Edit Address</button>
                            </div>
                            <div class="col-md-6">
                                <h5>Shipping Address</h5>
                                <p>123 Shipping Street, Los Angeles, CA</p>
                                <p>Mobile: 012-345-6789</p>
                                <button class="btn">Edit Address</button>
                            </div>
                        </div>
                    </div>

{{--                    acount--}}
                    <div class="tab-pane fade" id="account-tab" role="tabpanel" aria-labelledby="account-nav">
                        <h4>Account Details</h4>
                        <div id="appendData">
                            <form id="updateUserForm">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        Name:
                                        <input class="form-control" id="editName" name="name" type="text" value="{{\Illuminate\Support\Facades\Auth::user()->name}}" placeholder="Name">
                                    </div>
                                    <div class="col-md-6">
                                        Full Name:
                                        <input class="form-control" id="editFullName" name="full_name" type="text" value="{{\Illuminate\Support\Facades\Auth::user()->full_name}}" placeholder="Full Name">
                                    </div>
                                    <div class="col-md-6">
                                        Phone Number
                                        <input class="form-control" id="editPhone" name="phone" type="text" value="{{\Illuminate\Support\Facades\Auth::user()->phone}}" placeholder="Phone Number">
                                    </div>
                                    <div class="col-md-6">
                                        Email
                                        <input class="form-control" name="email" type="email" value="{{\Illuminate\Support\Facades\Auth::user()->email}}" readonly>
                                    </div>
                                    <div class="col-md-12">
                                        Address
                                        <input class="form-control" id="editAddress" name="address" type="text" value="{{\Illuminate\Support\Facades\Auth::user()->address}}" placeholder="Address">
                                    </div>
                                    <input hidden id="showId" data-id="{{\Illuminate\Support\Facades\Auth::user()->id}}">
                                    <div class="col-md-12">
                                        <button class="btn" type="submit">Update Account</button>
                                        <br><br>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <h4>Password change</h4>

                        <form id="changePassword">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                Old Password:
                                <input class="form-control" id="currentPassword" name="currentPassword" type="password" required  placeholder="Current Password">
                                <span id="showErrorsCRPassword" class="text-danger"></span>
                            </div>
                            <div class="col-md-6">
                                New Password:
                                <input class="form-control" id="newPassword" name="newPassword" type="text" required placeholder="New Password">
{{--                                show validate--}}
                                <span id="showErrorsNewPassword" class="text-danger"></span>
                            </div>
                            <div class="col-md-6">
                                Confirm New Password:
                                <input class="form-control" id="confirmNewPassword" name="confirmNewPassword" required type="text" placeholder="Confirm Password">
{{--                               show validate--}}
                                <span id="showErrorsCFPassword" class="text-danger"></span>

                            </div>
                            <div class="col-md-12">
                                <button type="submit"  class="btn">Change Password</button>
                            </div>

                        </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{--end my account--}}


<script>

    $('#updateUserForm').on('submit', function (e) {
        e.preventDefault();
        let id = $('#showId').data('id');
        console.log(id);
        $.ajax({
            url: "updateUser/" +id,
            method: 'post',
            data: $('#updateUserForm').serialize(),
            success: function (data) {
                $('#editName').val(data.name);
                $('#editPhone').val(data.phone);
                $('#editFullName').val(data.full_name);
                $('#editAddress').val(data.address);
                $('#accountName').text(data.name);
                alertify.success("Updated successfully!");

            }
        });
    });

    $('#changePassword').on('submit', function (e) {
        e.preventDefault()
        let id = $('#showId').data('id');
        $.ajax({
            url: "updatePassword/" + id,
            method: 'post',
            data: $('#changePassword').serialize(),
            success: function (response) {
                alertify.success("Password changed successfully!");
                alertify.alert("ALERT","You have to re-Login");
                window.location.reload();
            },
            error: function (response) {
                console.log(response.responseJSON.errors.newPassword);
                $('#showErrorsCRPassword').text(response.responseJSON.errors.currentPassword);
                $('#showErrorsNewPassword').text(response.responseJSON.errors.newPassword);
                $('#showErrorsCFPassword').text(response.responseJSON.errors.confirmNewPassword);
                if(response.responseJSON.errors.newPassword){
                    $('#newPassword').removeClass('is-valid');
                    $('#newPassword').addClass('is-invalid');
                }
                else{
                    $('#newPassword').removeClass('is-invalid');
                    $('#newPassword').addClass('is-valid');
                }
                if(response.responseJSON.errors.confirmNewPassword){
                    $('#confirmNewPassword').removeClass('is-valid');
                    $('#confirmNewPassword').addClass('is-invalid');
                }
                else{
                    $('#confirmNewPassword').removeClass('is-invalid');
                    $('#confirmNewPassword').addClass('is-valid');
                }
                if(response.responseJSON.errors.currentPassword){
                    $('#currentPassword').removeClass('is-valid');
                    $('#currentPassword').addClass('is-invalid');
                }
                else{
                    $('#currentPassword').removeClass('is-invalid');
                    $('#currentPassword').addClass('is-valid');
                }

                alertify.error("Something has wrong! Please check again...");
            }
        });
    })

    {{--renderUser();--}}
    {{--function renderUser() {--}}
    {{--    $.ajax({--}}
    {{--        url: "{{route('user.render')}}",--}}
    {{--        method: 'get',--}}
    {{--        dataType: 'json',--}}
    {{--        success: function (data) {--}}
    {{--            $('#appendData').html(data.data_table);--}}
    {{--        }--}}
    {{--    });--}}
    {{--}--}}




</script>

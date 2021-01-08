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
                    <a class="nav-link active" id="dashboard-nav" data-toggle="pill" href="#dashboard-tab" role="tab"><i
                            class="fa fa-tachometer-alt"></i>Dashboard</a>
                    <a class="nav-link" id="orders-nav" data-toggle="pill" href="#orders-tab" role="tab"><i
                            class="fa fa-shopping-bag"></i>Orders</a>
                    <a class="nav-link" id="payment-nav" data-toggle="pill" href="#payment-tab" role="tab"><i
                            class="fa fa-credit-card"></i>Payment Method</a>
                    <a class="nav-link" id="address-nav" data-toggle="pill" href="#address-tab" role="tab"><i
                            class="fa fa-map-marker-alt"></i>address</a>
                    <a class="nav-link" id="account-nav" data-toggle="pill" href="#account-tab" role="tab"><i
                            class="fa fa-user"></i>Account Details</a>
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
                    <div class="tab-pane fade show active" id="dashboard-tab" role="tabpanel"
                         aria-labelledby="dashboard-nav">
                        <h4>{{\Illuminate\Support\Facades\Auth::user()->name}} Dashboard</h4>
                        <p>
                            <div class="row">
                            <div class="col-md-4 dashboard">
                                <div id="user-avatar-dashboard">
                                    <img src="storage/{{\Illuminate\Support\Facades\Auth::user()->image}}" class="img-thumbnail avatar-dashboard"
                                         alt="image">
                                </div>
                            </div>
                            <div class="col-md-4">
                               <b>About Dashboard:</b> <textarea class="form-control userDesc" style=" margin-top: 0px; margin-bottom: 15px;  height: 150px;" readonly>You can change/update your profile detail, also can post some review/comment...</textarea>
                            </div>

                            <div class="col-md-4">
                                <b>About {{\Illuminate\Support\Facades\Auth::user()->name}}:</b> <textarea class="form-control userDesc" style=" margin-top: 0px; margin-bottom: 15px;  height: 150px;" readonly>{{\Illuminate\Support\Facades\Auth::user()->desc}}</textarea>
                            </div>
                            <div class="col-md-4">
                                <b>Email: <i class="fas fa-envelope-square"></i></b>  <input readonly class="form-control"
                                                      value=" {{\Illuminate\Support\Facades\Auth::user()->email}}">
                            </div>
                            <div class="col-md-4">
                                <b>Time Purchased: <i class="fas fa-shopping-cart"></i></b>  <input readonly class="form-control"
                                                      value=" {{\Illuminate\Support\Facades\Auth::user()->full_name}}">
                            </div>
                            <div class="col-md-4">
                                <b>Profile View: <i class="fas fa-users"></i></b>  <input readonly class="form-control"
                                                      value=" {{\Illuminate\Support\Facades\Auth::user()->phone}}">
                            </div>
                            <div class="col-lg-12">
                                <b>Total $ Cost: <i class="fas fa-money-check-alt"></i></b>  <input readonly class="form-control"
                                                      value=" {{\Illuminate\Support\Facades\Auth::user()->address}}">
                            </div>
                        </div>




                        {{--                        Post comment--}}
                        <div class="col border-post">
                            <h6 style="text-align: center"><b>Comment <i class="far fa-comment-dots"></i></b></h6>
                            <form id="form-post">
                                @csrf
                                <textarea class="form-control form-post" name="comment"
                                          placeholder="Tell us how you feel today/ or how your satifised our website"></textarea>
                                <button class="btn btn-success btn-post form-control" type="submit">Post</button>
                            </form>
                        </div>

                        {{--end post comment--}}
                        <div class="col all-post-form">
                            <h5 style="text-align: center"><b>All your post: <i class="far fa-comments"></i></b></h5>
                            <div id="showPost">
                                @if(\App\Models\Post::all() != null)
                                    @foreach(\App\Models\Post::all() as $comment)
                                        @if(\Illuminate\Support\Facades\Auth::user()->id === $comment->user_id)
                                            <div class="user-post{{$comment->id}}">
                                                <div class="avatar-comment">
                                                    <img src="{{asset('/storage/'.\Illuminate\Support\Facades\Auth::user()->image)}}"
                                                         class="img-thumbnail avatar-comment" alt="image">
                                                </div>


                                                <a><b>{{\Illuminate\Support\Facades\Auth::user()->name}}</b></a>
                                                <a>{{$comment->created_at}}</a>
                                                <button class="btn btn-info btn-edit-post" data-id="{{$comment->id}}"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-danger btn-del-post" data-id="{{$comment->id}}"><i class="fas fa-trash-alt"></i>
                                                </button>
                                                <textarea class="form-control" readonly>{{$comment->comment}}</textarea>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <h6>No comment</h6>
                                @endif
                            </div>
                        </div>
                        {{--end post comment--}}

{{--                        Modal edit comment--}}
                    <!-- Modal edit comment -->
                        <div class="modal fade" id="modalEditPost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit your post</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="editPostForm">
                                        @csrf
                                    <div class="modal-body">
                                        <textarea class="form-control" id="showEditComment" placeholder="Comment here..."name="comment"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
{{--                        end Modal edit comment--}}

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
                                    <td>
                                        <button class="btn">View</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Product Name</td>
                                    <td>01 Jan 2020</td>
                                    <td>$99</td>
                                    <td>Approved</td>
                                    <td>
                                        <button class="btn">View</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Product Name</td>
                                    <td>01 Jan 2020</td>
                                    <td>$99</td>
                                    <td>Approved</td>
                                    <td>
                                        <button class="btn">View</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="payment-tab" role="tabpanel" aria-labelledby="payment-nav">
                        <h4>Payment Method</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. In condimentum quam ac mi viverra
                            dictum. In efficitur ipsum diam, at dignissim lorem tempor in. Vivamus tempor hendrerit
                            finibus. Nulla tristique viverra nisl, sit amet bibendum ante suscipit non. Praesent in
                            faucibus tellus, sed gravida lacus. Vivamus eu diam eros. Aliquam et sapien eget arcu
                            rhoncus scelerisque.
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
                        <h4>Account Details / Edit</h4>

{{--                        update Avatar--}}
                        <div class="row">
                            <div class="col-lg-12">
                                <img src='{{asset('storage/'.\Illuminate\Support\Facades\Auth::user()->image)}}' class='img-thumbnail' id="previewUserAvatar" alt='image'>
                            </div>
                            <div class="col-lg-12">
                                <form id="avatarForm" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <label class="btn btn-default btn-file uploadImage">
                                        Upload <input type="file" name="userImage" onchange="loadImage(event)" id="imgSrc" style="display: none;">
                                    </label>
                                    <label class="btn btn-default btn-file uploadImageBtn">
                                        Save <input type="submit" style="display: none">
                                    </label>
                                </form>
                            </div>
                        </div>

{{--    Update account--}}
                        <div id="appendData">
                            <form id="updateUserForm">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        Name:
                                        <input class="form-control" id="editName" name="name" type="text"
                                               value="{{\Illuminate\Support\Facades\Auth::user()->name}}"
                                               placeholder="Name">
                                        <span id="showErrorName" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-6">
                                        Full Name:
                                        <input class="form-control" id="editFullName" name="full_name" type="text"
                                               value="{{\Illuminate\Support\Facades\Auth::user()->full_name}}"
                                               placeholder="Full Name">
                                        <span id="showErrorFullName" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-6">
                                        Phone Number
                                        <input class="form-control" id="editPhone" name="phone" type="text"
                                               value="{{\Illuminate\Support\Facades\Auth::user()->phone}}"
                                               placeholder="Phone Number">
                                        <span id="showErrorPhone" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-6">
                                        Email
                                        <input class="form-control" name="email" type="email"
                                               value="{{\Illuminate\Support\Facades\Auth::user()->email}}" readonly>
                                    </div>
                                    <div class="col-md-12">
                                        Address
                                        <input class="form-control" id="editAddress" name="address" type="text"
                                               value="{{\Illuminate\Support\Facades\Auth::user()->address}}"
                                               placeholder="Address">
                                        <span id="showErrorAddress" class="text-danger"></span>
                                    </div>
                                    <input hidden id="showId"
                                           data-id="{{\Illuminate\Support\Facades\Auth::user()->id}}">
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
                                    <input class="form-control" id="currentPassword" name="currentPassword"
                                           type="password" required placeholder="Current Password">
                                    <span id="showErrorsCRPassword" class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    New Password:
                                    <input class="form-control" id="newPassword" name="newPassword" type="text" required
                                           placeholder="New Password">
                                    {{--                                show validate--}}
                                    <span id="showErrorsNewPassword" class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    Confirm New Password:
                                    <input class="form-control" id="confirmNewPassword" name="confirmNewPassword"
                                           required type="text" placeholder="Confirm Password">
                                    {{--                               show validate--}}
                                    <span id="showErrorsCFPassword" class="text-danger"></span>

                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn">Change Password</button>
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

{{--show user name--}}
<input id="authUserName" hidden value="{{\Illuminate\Support\Facades\Auth::user()->name}}">
{{--end show user name--}}
show user image src
<input hidden id="userAvatarSrc" value="{{\Illuminate\Support\Facades\Auth::user()->image}}">
<script>

    $('#updateUserForm').on('submit', function (e) {
        e.preventDefault();
        let id = $('#showId').data('id');
        console.log(id);
        $.ajax({
            url: "updateUser/" + id,
            method: 'post',
            data: $('#updateUserForm').serialize(),
            success: function (data) {
                $('#editName').val(data.name);
                $('#editPhone').val(data.phone);
                $('#editFullName').val(data.full_name);
                $('#editAddress').val(data.address);
                $('#accountName').text(data.name);

                // ko hien thi loi nua
                $('#showErrorName').text("");
                $('#showErrorFullName').text("");
                $('#showErrorPhone').text("");
                $('#showErrorAddress').text("");
                //cac o input ko hien thi in-invalid nua

                $('#editName').removeClass('is-invalid');
                $('#editName').addClass('is-valid');

                $('#editFullName').removeClass('is-invalid');
                $('#editFullName').addClass('is-valid');

                $('#editPhone').removeClass('is-invalid');
                $('#editPhone').addClass('is-valid');

                $('#editAddress').removeClass('is-invalid');
                $('#editAddress').addClass('is-valid');

                alertify.success("Updated successfully!");
                // $.toast({
                //     heading: 'Success',
                //     text: 'And these were just the basic demos! Scroll down to check further details on how to customize the output.',
                //     showHideTransition: 'slide',
                //     icon: 'success'
                // })

            },
            error: function (response) {
                console.log(response);
                $('#showErrorName').text(response.responseJSON.errors.name);
                $('#showErrorAddress').text(response.responseJSON.errors.address);
                $('#showErrorFullName').text(response.responseJSON.errors.full_name);
                $('#showErrorPhone').text(response.responseJSON.errors.phone);
                if (response.responseJSON.errors.name) {
                    $('#editName').removeClass('is-valid');
                    $('#editName').addClass('is-invalid');
                } else {
                    $('#editName').removeClass('is-invalid');
                    $('#editName').addClass('is-valid');
                    $('#showErrorName').text("");
                }
                if (response.responseJSON.errors.full_name) {
                    $('#editFullName').removeClass('is-valid');
                    $('#editFullName').addClass('is-invalid');
                } else {
                    $('#editFullName').removeClass('is-invalid');
                    $('#editFullName').addClass('is-valid');
                    $('#showErrorFullName').text("");
                }
                if (response.responseJSON.errors.phone) {
                    $('#editPhone').removeClass('is-valid');
                    $('#editPhone').addClass('is-invalid');
                } else {
                    $('#editPhone').removeClass('is-invalid');
                    $('#editPhone').addClass('is-valid');
                    $('#showErrorPhone').text("");
                }
                if (response.responseJSON.errors.address) {
                    $('#editAddress').removeClass('is-valid');
                    $('#editAddress').addClass('is-invalid');
                } else {
                    $('#editAddress').removeClass('is-invalid');
                    $('#editAddress').addClass('is-valid');
                    $('#showErrorAddress').text("");
                }

            }
        });
    });

    $('#changePassword').on('submit', function (e) {
        e.preventDefault();
        let id = $('#showId').data('id');
        $.ajax({
            url: "updatePassword/" + id,
            method: 'post',
            data: $('#changePassword').serialize(),
            success: function (response) {
                alertify.success("Password changed successfully!");
                alertify.alert("ALERT", "You have to re-Login");

                window.location.reload();
            },
            error: function (response) {
                console.log(response.responseJSON.errors.newPassword);
                if (response.responseJSON.errors.newPassword) {
                    $('#newPassword').removeClass('is-valid');
                    $('#newPassword').addClass('is-invalid');
                    $('#showErrorsNewPassword').text(response.responseJSON.errors.newPassword);
                } else {
                    $('#newPassword').removeClass('is-invalid');
                    $('#newPassword').addClass('is-valid');
                    $('#showErrorsNewPassword').text("");
                }
                if (response.responseJSON.errors.confirmNewPassword) {
                    $('#confirmNewPassword').removeClass('is-valid');
                    $('#confirmNewPassword').addClass('is-invalid');

                    $('#showErrorsCFPassword').text(response.responseJSON.errors.confirmNewPassword);
                } else {
                    $('#confirmNewPassword').removeClass('is-invalid');
                    $('#confirmNewPassword').addClass('is-valid');
                    $('#showErrorsCFPassword').text("");
                }
                if (response.responseJSON.errors.currentPassword) {
                    $('#currentPassword').removeClass('is-valid');
                    $('#currentPassword').addClass('is-invalid');

                    $('#showErrorsCRPassword').text(response.responseJSON.errors.currentPassword);
                } else {
                    $('#currentPassword').removeClass('is-invalid');
                    $('#currentPassword').addClass('is-valid');

                    $('#showErrorsCRPassword').text("");
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

    // Post comment
    {{--showAllPost();--}}
    {{--    function showAllPost(){--}}
    {{--        $.ajax({--}}
    {{--            url: "{{route('post.index')}}",--}}
    {{--            method: 'get',--}}
    {{--            dataType: 'json',--}}
    {{--            success: function (data) {--}}
    {{--                console.log(data);--}}
    {{--                let html = '';--}}
    {{--                for(let i =0; i< data.length; i++){--}}
    {{--                    html += "<textarea class='form-control' readonly>"+ data[i].comment +"</textarea>" +--}}
    {{--                        "<a>"+ data[i].created_at +"</a>";--}}
    {{--                }--}}
    {{--                $('#showPost').html(html);--}}
    {{--            }--}}
    {{--        });--}}
    {{--    }--}}

    $('#form-post').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: "{{route('post.create')}}",
            method: 'post',
            data: $('#form-post').serialize(),
            success: function (data) {

                alertify.success('Have fun ^^');
                $('#showPost').append("<div class='user-post"+data.id+"'>" +
                    "<img src='storage/"+$("#userAvatarSrc").val()+"' class='img-thumbnail avatar-comment' width='40' alt='image'>" +
                    "<a><b>"+ $('#authUserName').val() +"</b></a>"+
                    " <a>"+ data.created_at +"</a>" +
                    "<button class='btn btn-info btn-edit-post' data-id="+ data.id+"><i class='fas fa-edit'></i></button>"+
                    " <button class='btn btn-danger btn-del-post' data-id="+ data.id +"><i class='fa fa-trash-alt'></i></button>" +
                    "<textarea class='form-control' readonly>" + data.comment + "</textarea>"+
                    "</div> ");
            }
        })
    });

    $('#showPost').on('click','.btn-del-post', function (e) {
        e.preventDefault();
        let r = confirm('Do you want to delete this?');
        if (r == true){
            $.ajax({
                url: '/post/destroy/' + $(this).data('id'),
                method: 'get',

                success: function (data) {
                    console.log(data.id);
                    $('.user-post' + data.id).remove();

                    alertify.success("Deleted!");
                }
            });
        }

    });

    //hien thi modal edit post
    let editPostId;
    $('#showPost').on('click','.btn-edit-post', function () {
        editPostId = $(this).data('id');
        $('#modalEditPost').modal('show');
        $.ajax({
            url: "showOnePost/" + editPostId ,
            method: 'get',
            success: function (data) {
                console.log(data);
                $('#showEditComment').val(data.comment);
            }
        });
    });
    //edit post method form

    $('#editPostForm').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: "post/update/" + editPostId,
            method: 'post',
            data: $('#editPostForm').serialize(),
            success: function (data) {
            console.log(data.comment);
            alertify.success("Updated");
                $('#modalEditPost').modal('hide');
                // $('.user-post' + data.id).empty();
                $('.user-post' + data.id).replaceWith("<div class='user-post"+data.id+"'>" +
                    "<img src='storage/"+$("#userAvatarSrc").val()+"' class='img-thumbnail avatar-comment' width='40' alt='image'>" +
                    "<a><b>"+ $('#authUserName').val() +"</b></a>"+
                    " <a>"+ data.created_at +"</a>" +
                    "<button class='btn btn-info btn-edit-post' data-id="+ data.id+"><i class='fas fa-edit'></i></button>"+
                    " <button class='btn btn-danger btn-del-post' data-id="+ data.id +"><i class='fa fa-trash-alt'></i></button>" +
                    "<textarea class='form-control' readonly>" + data.comment + "</textarea>"+
                    "</div>");
            }
        });
    });

    // preview avatar image
    function loadImage(event) {
        let output = document.getElementById('previewUserAvatar');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    }

    // update avatar
    $('#avatarForm').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: "updateUserAvatar/"+ $('#showId').data('id'),
            method: 'post',
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,

            success: function (data) {
                console.log(data);
                $('#load-dashboard-avatar').empty();
                $('#load-dashboard-avatar').html(data.requested_image);
                $('#user-avatar-dashboard').empty();
                $('#user-avatar-dashboard').html(data.dashboard_image);
                $('.avatar-comment').empty();
                $('.avatar-comment').html(data.comment_image);
                alertify.success("Avatar changed!");
            }
        });
    })
    // function render image after change


</script>

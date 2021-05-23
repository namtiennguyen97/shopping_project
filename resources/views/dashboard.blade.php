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
                    <form method="POST" action="{{ route('custom.logout') }}">
                        @csrf

                        <a class="nav-link" href="{{ route('custom.logout') }}"
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
                        <h4>{{$user->name}} Dashboard</h4>

                            <div class="row">
                            <div class="col-md-4 dashboard">
                                <div id="user-avatar-dashboard">
                                    @if($user->image == null)
                                        <img src="{{asset('storage/images/user-avatar.jpg')}}" class="img-thumbnail avatar-dashboard" alt="image">
                                    @else
                                    <img src="storage/{{$user->image}}" class="img-thumbnail avatar-dashboard"
                                         alt="image">
                                        @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                               <b>About Dashboard:</b> <textarea class="form-control userDesc" style=" margin-top: 0px; margin-bottom: 15px;  height: 150px;" readonly>You can change/update your profile detail, also can post some review/comment...</textarea>
                            </div>

                            <div class="col-md-4">
                                <b>About {{$user->name}}:</b><i class="btn btn-success fas fa-edit desc-edit"></i> <textarea class="form-control userDesc" style=" margin-top: 0px; margin-bottom: 15px;  height: 150px;" readonly>{{$user->desc}}</textarea>
                            </div>
                            <div class="col-md-4">
                                <b>Email: <i class="fas fa-envelope-square"></i></b>  <input readonly class="form-control"
                                                      value=" {{$user->email}}">
                            </div>
                            <div class="col-md-4">
                                <b>Time Purchased: <i class="fas fa-shopping-cart"></i></b>  <input readonly class="form-control"
                                                      value=" {{$user->full_name}}">
                            </div>
                            <div class="col-md-4">
                                <b>Profile View: <i class="fas fa-users"></i></b>  <input readonly class="form-control"
                                                      value=" {{$user->phone}}">
                            </div>
                            <div class="col-lg-12">
                                <b>Total $ Cost: <i class="fas fa-money-check-alt"></i></b>  <input readonly class="form-control"
                                                      value=" {{$user->address}}">
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
                                        @if($user->id === $comment->user_id)
                                            <div class="user-post{{$comment->id}}">
                                                <div class="avatar-comment">
                                                    @if($user->image == null)
                                                        <img src="{{asset('storage/images/user-avatar.jpg')}}" class="img-thumbnail avatar-comment" alt="image">
                                                        @else
                                                    <img src="{{asset('/storage/'.$user->image)}}"
                                                         class="img-thumbnail avatar-comment" alt="image">
                                                        @endif
                                                </div>


                                                <a><b>{{$user->name}}</b></a>
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
                                @if($user->image == null)
                                    <img src='{{asset('storage/images/user-avatar.jpg')}}' class='img-thumbnail' id="previewUserAvatar" alt='image'>
                                    @else
                                <img src='{{asset('storage/'.$user->image)}}' class='img-thumbnail' id="previewUserAvatar" alt='image'>
                                    @endif
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
                                               value="{{$user->name}}"
                                               placeholder="Name">
                                        <span id="showErrorName" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-6">
                                        Full Name:
                                        <input class="form-control" id="editFullName" name="full_name" type="text"
                                               value="{{$user->full_name}}"
                                               placeholder="Full Name">
                                        <span id="showErrorFullName" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-6">
                                        Phone Number
                                        <input class="form-control" id="editPhone" name="phone" type="text"
                                               value="{{$user->phone}}"
                                               placeholder="Phone Number">
                                        <span id="showErrorPhone" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-6">
                                        Email
                                        <input class="form-control" name="email" type="email"
                                               value="{{$user->email}}" readonly>
                                    </div>
                                    <div class="col-md-12">
                                        Address
                                        <input class="form-control" id="editAddress" name="address" type="text"
                                               value="{{$user->address}}"
                                               placeholder="Address">
                                        <span id="showErrorAddress" class="text-danger"></span>
                                    </div>

{{--                                    hidden role_id--}}
                                    <input hidden name="role_id" value="{{$user->role_id}}">
{{--                                    end of hidden role_id--}}

                                    <input hidden id="showId"
                                           data-id="{{\App\Http\UserFacade::getUser()->id}}">
                                    <div class="col-md-12">
                                        <button class="btn" type="submit">Update Account</button>
                                        <br><br>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <h4>Password change</h4>

                        <form id="changePassword" method="post">
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
                                    <input class="form-control" id="newPassword" name="newPassword" type="password" required
                                           placeholder="New Password">
                                    {{--                                show validate--}}
                                    <span id="showErrorsNewPassword" class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    Confirm New Password:
                                    <input class="form-control" id="confirmNewPassword" name="confirmNewPassword"
                                           required type="password" placeholder="Confirm Password">
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
<input id="authUserName" hidden value="{{$user->name}}">
{{--end show user name--}}
{{--show user image src--}}
<input hidden id="userAvatarSrc" value="{{$user->image}}" data-image="{{$user->image}}">
<script src="{{asset('dashboardJs.js')}}"></script>

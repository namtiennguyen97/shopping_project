
            <div class="modal-header">
                <h5 class="modal-title user-profile-name" id="staticBackdropLabel">{{$user->name}} Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        @if($user->image == null)
                            <img src="storage/images/user-avatar.jpg" class="img-thumbnail avatar-dashboard">
                            @else
                        <img src="{{asset('storage/'. $user->image)}}" class="img-thumbnail avatar-dashboard">
                            @endif
                    </div>
                    <div class="col-md-6">
                        <textarea readonly class="userDesc">{{$user->desc}}</textarea>
                    </div>
                    <div class="col-md-6">
                        <b>Account Name:</b>
                       <input class="form-control" readonly value="{{$user->name}}">
                    </div>
                    <div class="col-md-6">
                       <b>Full Name:</b>
                        <input class="form-control" readonly value="{{$user->full_name}}">
                    </div>
                    <div class="col-md-6">
                        <b>Email: <i class="fas fa-envelope-square"></i></b>
                        <input class="form-control" readonly value="{{$user->email}}">
                    </div>
                    <div class="col-md-6">
                        <b>Phone: <i class="fas fa-phone"></i></b>
                        <input class="form-control" readonly value="{{$user->phone}}">
                    </div>
                    <div class="col-md-6">
                        <b>Role: <i class="fas fa-user-tag"></i></b>
                        <input class="form-control" readonly value="{{$user->userRole->name}}">
                    </div>
                    <div class="col-md-6">
                        <b>View Profile count: <i class="fas fa-eye"></i></b>
                        <input class="form-control" readonly value="{{$user->view_count}}">
                    </div>
                    <div class="col-lg-12">
                        <b>Address: <i class="fas fa-home"></i></b>
                        <input class="form-control" readonly value="{{$user->address}}">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
{{--                <button type="button" class="btn btn-primary">Understood</button>--}}
            </div>


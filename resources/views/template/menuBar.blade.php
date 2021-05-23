<div class="nav">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <a href="#" class="navbar-brand">MENU</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav mr-auto">
                    <a href="{{route('index')}}" class="nav-item nav-link active">Trang chủ</a>
                    <a href="{{route('product.view.all')}}" class="nav-item nav-link">Sản phẩm</a>
{{--                    <a href="product-detail.html" class="nav-item nav-link">Product Detail</a>--}}
                    <a href="{{route('cart.view')}}" class="nav-item nav-link">Giỏ hàng</a>
                    <a href="{{route('cart.view')}}" class="nav-item nav-link">Thanh toán</a>
                    @if(\Illuminate\Support\Facades\Session::has('logged'))
                    <a href="{{ route('custom.user.dashboard') }}" class="nav-item nav-link">Tài khoản của bạn</a>
                    @else
{{--                       khong de gi neu ko dang nhap--}}
                        @endif
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Xem thêm</a>
                        <div class="dropdown-menu">
                            <a href="wishlist.html" class="dropdown-item">Wishlist</a>
                            <a href="login.html" class="dropdown-item">Login & Register</a>
                            <a href="contact.html" class="dropdown-item">Contact Us</a>
                        </div>
                    </div>
                </div>
                <div class="navbar-nav ml-auto">
                    <div class="nav-item dropdown">
                        @if (session()->has('logged'))

                                <div id="load-dashboard-avatar">
                                    @if(\App\Http\UserFacade::getUser()->image == null)
                                        <img src="{{asset('storage/images/user-avatar.jpg')}}" class="img-thumbnail user-avatar" alt="image">
                                    @else
                                    <a><img src="{{asset('storage/'.\App\Http\UserFacade::getUser()->image)}}" class="img-thumbnail user-avatar" width="40" alt="image"></a>
                                        @endif
                                </div>

                                <a href="{{ route('custom.user.dashboard') }}" class="nav-link dropdown-toggle" data-toggle="dropdown" id="accountName">{{\App\Http\UserFacade::getUser()->name}}</a>

                                <div class="dropdown-menu">

                                    <a href="{{ route('custom.user.dashboard') }}" class="dropdown-item">Profile <i class="fas fa-user"></i></a>
                                    @if(\App\Http\UserFacade::getUser()->role_id == 2)
                                        <a href="{{ route('admin.user') }}" class="dropdown-item">Admin Control<i class="fas fa-user"></i></a>
                                    @endif

                                        <form method="POST" action="{{ route('custom.logout') }}" class="dropdown-item">
                                            @csrf

                                            <a style="color: black" href="{{ route('custom.logout') }}"
                                                                       onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                            Logout <i class="fas fa-sign-out-alt"></i></a>
                                        </form>


                                </div>
                            @else
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">User Account</a>
                                <div class="dropdown-menu">
                                    <a href="javascript:" id="customLogin" class="dropdown-item">Login</a>
                                        <a href="javascript:" id="customeRegister" class="dropdown-item">Register</a>
                                </div>
                            @endif
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>

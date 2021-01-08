<div class="nav">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <a href="#" class="navbar-brand">MENU</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav mr-auto">
                    <a href="{{route('index')}}" class="nav-item nav-link active">Home</a>
                    <a href="product-list.html" class="nav-item nav-link">Products</a>
                    <a href="product-detail.html" class="nav-item nav-link">Product Detail</a>
                    <a href="cart.html" class="nav-item nav-link">Cart</a>
                    <a href="checkout.html" class="nav-item nav-link">Checkout</a>
                    <a href="{{ url('/dashboard') }}" class="nav-item nav-link">My Account</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">More Pages</a>
                        <div class="dropdown-menu">
                            <a href="wishlist.html" class="dropdown-item">Wishlist</a>
                            <a href="login.html" class="dropdown-item">Login & Register</a>
                            <a href="contact.html" class="dropdown-item">Contact Us</a>
                        </div>
                    </div>
                </div>
                <div class="navbar-nav ml-auto">
                    <div class="nav-item dropdown">
                        @if (Route::has('login'))
                            @auth
                                <div id="load-dashboard-avatar">
                                    <a><img src="{{asset('storage/'.\Illuminate\Support\Facades\Auth::user()->image)}}" class="img-thumbnail user-avatar" width="40" alt="image"></a>
                                </div>

                                <a href="{{ url('/dashboard') }}" class="nav-link dropdown-toggle" data-toggle="dropdown" id="accountName">{{\Illuminate\Support\Facades\Auth::user()->name}}</a>

                                <div class="dropdown-menu">

                                    <a href="{{ route('profile.show') }}" class="dropdown-item">Profile <i class="fas fa-user"></i></a>

                                        <form method="POST" action="{{ route('logout') }}" class="dropdown-item">
                                            @csrf

                                            <a style="color: black" href="{{ route('logout') }}"
                                                                       onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                            Logout <i class="fas fa-sign-out-alt"></i></a>
                                        </form>

                                </div>
                            @else
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">User Account</a>
                                <div class="dropdown-menu">
                                    <a href="{{ route('login') }}" class="dropdown-item">Login</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="dropdown-item">Register</a>
                                    @endif
                                    @endauth
                                </div>
                            @endif
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>

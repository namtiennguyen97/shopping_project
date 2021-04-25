<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>N Store</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="eCommerce HTML Template Free Download" name="keywords">
    <meta content="eCommerce HTML Template Free Download" name="description">

   @include('cdn')

</head>

<body>


<!-- Top bar Start -->
<div class="top-bar">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <i class="fa fa-envelope"></i>
                namtiennguyen@email.com
            </div>
            <div class="col-sm-6">
                <i class="fa fa-phone-alt"></i>
                +012-345-6789
            </div>
        </div>
    </div>
</div>
<!-- Top bar End -->

<!-- Nav Bar Start -->
<div class="nav">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <a href="#" class="navbar-brand">MENU</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav mr-auto">
                    <a href="index.html" class="nav-item nav-link active">Trang chủ</a>
                    <a href="product-list.html" class="nav-item nav-link">Sản phẩm</a>
                    <a href="product-detail.html" class="nav-item nav-link">Chi tiết mặt hàng</a>
                    <a href="cart.html" class="nav-item nav-link">Giỏ hàng</a>
                    <a href="checkout.html" class="nav-item nav-link">Thanh toán</a>
                    <a href="{{ url('/dashboard') }}" class="nav-item nav-link">Tài khoản</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Xem thêm</a>
                        <div class="dropdown-menu">
                            <a href="wishlist.html" class="dropdown-item">Danh sách yêu thích</a>
                            <a href="login.html" class="dropdown-item">Đăng nhập/ đăng kí</a>
                            <a href="{{route('admin.index')}}" class="dropdown-item">Quản lý</a>
                        </div>
                    </div>
                </div>
                <div class="navbar-nav ml-auto">
                    <div class="nav-item dropdown">
                        @if (session()->has('logged'))

                                @if($user->image == null)
                                    <a href="{{ route('custom.user.dashboard') }}" class="nav-link"><img src="{{asset('storage/images/user-avatar.jpg')}}" class="img-thumbnail index-user-avatar" alt="image"> {{$user->name}}  <i class="fas fa-user"></i></a>
                                    <form method="post" action="{{route('custom.logout')}}">
                                        @csrf
                                        <button class="btn btn-primary">Logout</button>
                                    </form>

                                    @else
                                <a href="{{ route('custom.user.dashboard') }}" class="nav-link"><img src="{{asset('storage/'.$user->image)}}" class="img-thumbnail index-user-avatar" alt="image"> {{$user->name}}  <i class="fas fa-user"></i></a>
                                @endif
                            @else
                            <a href="javascript:" class="displayAuth" id="customLogin" >Đăng nhập<i class="fas fa-sign-in-alt"></i></a>
                            <a>/</a>
                            <a href="javascript:" class="displayAuth" id="customeRegister">Đăng kí</a>

                    </div>
                        @endif
                    </div>
                </div>
        </nav>

    </div>
</div>
<!-- Nav Bar End -->

<!-- Bottom Bar Start -->
<div class="bottom-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-3">
                <div class="logo">
                    <a href="index.html">
                        <img src="{{asset('mainTemplate/img/logo.png')}}" alt="Logo">
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="search">
                    <input type="text" placeholder="Search">
                    <button><i class="fa fa-search"></i></button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="">
                    <a href="wishlist.html" class="btn wishlist">
                        <i class="fa fa-heart"></i>
                        <span>(0)</span>
                    </a>
                    <div class="dropdownA">
{{--add data here--}}
                        <a class="btn cart">
                            <i class="fa fa-shopping-cart cart-show-list"></i>

                                @if(\Illuminate\Support\Facades\Session::has('Cart')!= null)
                                <span id="total-Qty-Product">{{\Illuminate\Support\Facades\Session::get('Cart')->totalQty}}
                                    </span>
                            @else
                                <span id="total-Qty-Product">0</span>
                                    @endif


                            <div class="dropdown-contentA">
                                <div class="backGroundColor">
                                    <h1 class="font-italic">Cart<i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    </h1>
                                </div>

                                <div id="change-cart-items">
                                    {{--                                start here--}}
                                    @if(\Illuminate\Support\Facades\Session::has('Cart') != null)

                                        <div class="shopping-cart">
                                            <table>
                                                <tbody>
                                                @foreach(\Illuminate\Support\Facades\Session::get('Cart')->product as $item)
                                                    <tr>
                                                        <td><img src="{{asset('storage/'.$item['productInfo']->image)}}" style="width: 60px; height: 60px" class="img img-thumbnail"></td>
                                                        <td>
                                                            <div>
                                                                <p>{{number_format($item['productInfo']->price)}} x {{$item['qty']}}</p>
                                                                <h5>{{$item['productInfo']->name}}</h5>
                                                            </div>
                                                        </td>
                                                        <td class="si-close">
                                                            <i class="fa fa-times deleteProduct" data-id="{{$item['productInfo']->id}}" aria-hidden="true"></i>
                                                        </td>
                                                    </tr>
                                                    <input id="qtyCart-cart" hidden type="number" value="{{\Illuminate\Support\Facades\Session::get('Cart')->totalQty}}">
                                                @endforeach

                                                </tbody>
                                            </table>
                                            <div class="select-total">
                                                <span class="totalProduct">Total:{{\Illuminate\Support\Facades\Session::get('Cart')->totalQty}}</span>
                                                <h5>{{number_format(\Illuminate\Support\Facades\Session::get('Cart')->totalPrice)}}</h5>
                                            </div>
                                        </div>

                                    @endif

                                </div>

                                <div>
                                    <a class="btn btn-warning show-cart-detail"><h2>View Cart<i class="fa fa-cart-arrow-down" aria-hidden="true"></i></h2></a>
                                    <a class="btn btn-success confirm-checkout"><h2>Check Out<i class="fas fa-credit-card"></i></h2></a>
                                </div>

                            </div>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Bottom Bar End -->

<!-- Main Slider Start -->
<div class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <nav class="navbar bg-light">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-home"></i>Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-shopping-bag"></i>Sản phẩm bán chạy nhất</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-plus-square"></i>Mặt hàng mới nhất</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-female"></i>Fashion & Beauty</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-child"></i>Quần áo trẻ em</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-tshirt"></i>Quần áo nam / nữ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-mobile-alt"></i>Trang sức/ Phụ kiện</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-microchip"></i>Electronics & Accessories</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-6">
                <div class="header-slider normal-slider">
                    <div class="header-slider-item">
                        <img src="{{asset('mainTemplate/img/slider-1.jpg')}}" alt="Slider Image" />
                        <div class="header-slider-caption">
                            <p>Some text goes here that describes the image</p>
                            <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Shop Now</a>
                        </div>
                    </div>
                    <div class="header-slider-item">
                        <img src="{{asset('mainTemplate/img/slider-2.jpg')}}" alt="Slider Image" />
                        <div class="header-slider-caption">
                            <p>Some text goes here that describes the image</p>
                            <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Shop Now</a>
                        </div>
                    </div>
                    <div class="header-slider-item">
                        <img src="{{asset('mainTemplate/img/slider-3.jpg')}}" alt="Slider Image" />
                        <div class="header-slider-caption">
                            <p>Some text goes here that describes the image</p>
                            <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="header-img">
                    <div class="img-item">
                        <img src="{{asset('mainTemplate/img/category-1.jpg')}}" />
                        <a class="img-text" href="">
                            <p>Some text goes here that describes the image</p>
                        </a>
                    </div>
                    <div class="img-item">
                        <img src="{{asset('mainTemplate/img/category-2.jpg')}}" />
                        <a class="img-text" href="">
                            <p>Some text goes here that describes the image</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Slider End -->

<!-- Brand Start -->
{{--<div class="brand">--}}
{{--    <div class="container-fluid">--}}
{{--        <div class="brand-slider">--}}
{{--            <div class="brand-item"><img src="{{asset('mainTemplate/img/brand-1.png')}}" alt=""></div>--}}
{{--            <div class="brand-item"><img src="{{asset('mainTemplate/img/brand-2.png')}}" alt=""></div>--}}
{{--            <div class="brand-item"><img src="{{asset('mainTemplate/img/brand-3.png')}}" alt=""></div>--}}
{{--            <div class="brand-item"><img src="{{asset('mainTemplate/img/brand-4.png')}}" alt=""></div>--}}
{{--            <div class="brand-item"><img src="{{asset('mainTemplate/img/brand-5.png')}}" alt=""></div>--}}
{{--            <div class="brand-item"><img src="{{asset('mainTemplate/img/brand-6.png')}}" alt=""></div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- Brand End -->

<!-- Feature Start-->
<div class="feature">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-6 feature-col">
                <div class="feature-content fc1">
                    <i class="fab fa-cc-mastercard"></i>
                    <h2>Thanh toán an toàn</h2>
                    <p>
                        Thanh toán nhanh và an toàn
                    </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 feature-col">
                <div class="feature-content fc2">
                    <i class="fa fa-truck"></i>
                    <h2>Ship toàn quốc</h2>
                    <p>
                       Ship mọi nơi với phí rẻ đến bất ngờ!
                    </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 feature-col">
                <div class="feature-content fc3">
                    <i class="fa fa-sync-alt"></i>
                    <h2>90 Days Return</h2>
                    <p>
                        Hoàn trả trong vòng 90 ngày
                    </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 feature-col">
                <div class="feature-content fc4">
                    <i class="fa fa-comments"></i>
                    <h2>Hỗ trợ 24/7</h2>
                    <p>
                        Hãy cho liên hệ nếu bạn cần hỗ trợ
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Feature End-->

<!-- Category Start-->
<div class="category">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="category-item ch-400">
                    <img src="{{asset('mainTemplate/img/category-3.jpg')}}" />
                    <a class="category-name" href="">
                        <p>Some text goes here that describes the image</p>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="category-item ch-250">
                    <img src="{{asset('mainTemplate/img/category-4.jpg')}}" />
                    <a class="category-name" href="">
                        <p>Some text goes here that describes the image</p>
                    </a>
                </div>
                <div class="category-item ch-150">
                    <img src="{{asset('mainTemplate/img/category-5.jpg')}}" />
                    <a class="category-name" href="">
                        <p>Some text goes here that describes the image</p>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="category-item ch-150">
                    <img src="{{asset('mainTemplate/img/category-6.jpg')}}" />
                    <a class="category-name" href="">
                        <p>Some text goes here that describes the image</p>
                    </a>
                </div>
                <div class="category-item ch-250">
                    <img src="{{asset('mainTemplate/img/category-7.jpg')}}" />
                    <a class="category-name" href="">
                        <p>Some text goes here that describes the image</p>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="category-item ch-400">
                    <img src="{{asset('mainTemplate/img/category-8.jpg')}}" />
                    <a class="category-name" href="">
                        <p>Some text goes here that describes the image</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Category End-->

<!-- Call to Action Start -->
<div class="call-to-action">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1>Shop thời trang giá rẻ/ Sự lựa chọn của bạn! </h1>
            </div>
            <div class="col-md-6">
                <a href="tel:0342842005">+0342842005</a>
            </div>
        </div>
    </div>
</div>
<!-- Call to Action End -->

<!-- Featured Product Start -->
<div class="featured-product product">
    <div class="container-fluid">
        <div class="section-header">
            <h1>Tiêu điểm</h1>
        </div>
        <div class="row align-items-center product-slider product-slider-4">
{{--            Foreach product data here--}}
            @foreach(\App\Models\Product::all() as $row)
            <div class="col-lg-3">
                <div class="product-item">
                    <div class="product-title">
                        <a href="#">{{$row->name}}</a>
                        <div class="ratting">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                    </div>
                    <div class="product-image">
                        <a href="product-detail.html">
                            <img src="{{asset('storage/'. $row->image)}}" class="productImageFeather img img-thumbnail" alt="Product Image">
                        </a>
                        <div class="product-action">
                            <a href="javascript:"><i class="fa fa-cart-plus" onclick="addCart({{$row->id}})"></i></a>
                            <a href="#"><i class="fa fa-heart"></i></a>
                            <a href="#"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="product-price">
                        <h3><span>$</span>{{number_format($row->price)}}</h3>
                        <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Buy Now</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Featured Product End -->

<!-- Newsletter Start -->
<div class="newsletter">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h1>Đăng kí để nhận thông báo những sản phẩm mới nhất</h1>
            </div>
            <div class="col-md-6">
                <div class="form">
                    <input type="email" value="Your email here">
                    <button>Đăng kí</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Newsletter End -->

<!-- Recent Product Start -->
<div class="recent-product product">
    <div class="container-fluid">
        <div class="section-header">
            <h1>Mặt hàng mới</h1>
        </div>
        <div class="row align-items-center product-slider product-slider-4">
            <div class="col-lg-3">
                <div class="product-item">
                    <div class="product-title">
                        <a href="#">Product Name</a>
                        <div class="ratting">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                    </div>
                    <div class="product-image">
                        <a href="product-detail.html">
                            <img src="{{asset('mainTemplate/img/product-6.jpg')}}" alt="Product Image">
                        </a>
                        <div class="product-action">
                            <a href="#"><i class="fa fa-cart-plus"></i></a>
                            <a href="#"><i class="fa fa-heart"></i></a>
                            <a href="#"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="product-price">
                        <h3><span>$</span>99</h3>
                        <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Buy Now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="product-item">
                    <div class="product-title">
                        <a href="#">Product Name</a>
                        <div class="ratting">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                    </div>
                    <div class="product-image">
                        <a href="product-detail.html">
                            <img src="{{asset('mainTemplate/img/product-7.jpg')}}" alt="Product Image">
                        </a>
                        <div class="product-action">
                            <a href="#"><i class="fa fa-cart-plus"></i></a>
                            <a href="#"><i class="fa fa-heart"></i></a>
                            <a href="#"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="product-price">
                        <h3><span>$</span>99</h3>
                        <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Buy Now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="product-item">
                    <div class="product-title">
                        <a href="#">Product Name</a>
                        <div class="ratting">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                    </div>
                    <div class="product-image">
                        <a href="product-detail.html">
                            <img src="{{asset('mainTemplate/img/product-8.jpg')}}" alt="Product Image">
                        </a>
                        <div class="product-action">
                            <a href="#"><i class="fa fa-cart-plus"></i></a>
                            <a href="#"><i class="fa fa-heart"></i></a>
                            <a href="#"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="product-price">
                        <h3><span>$</span>99</h3>
                        <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Buy Now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="product-item">
                    <div class="product-title">
                        <a href="#">Product Name</a>
                        <div class="ratting">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                    </div>
                    <div class="product-image">
                        <a href="product-detail.html">
                            <img src="{{asset('mainTemplate/img/product-9.jpg')}}" alt="Product Image">
                        </a>
                        <div class="product-action">
                            <a href="#"><i class="fa fa-cart-plus"></i></a>
                            <a href="#"><i class="fa fa-heart"></i></a>
                            <a href="#"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="product-price">
                        <h3><span>$</span>99</h3>
                        <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Buy Now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="product-item">
                    <div class="product-title">
                        <a href="#">Product Name</a>
                        <div class="ratting">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                    </div>
                    <div class="product-image">
                        <a href="product-detail.html">
                            <img src="{{asset('mainTemplate/img/product-10.jpg')}}" alt="Product Image">
                        </a>
                        <div class="product-action">
                            <a href="#"><i class="fa fa-cart-plus"></i></a>
                            <a href="#"><i class="fa fa-heart"></i></a>
                            <a href="#"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="product-price">
                        <h3><span>$</span>99</h3>
                        <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Buy Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Recent Product End -->

<!-- Review Start -->
<div class="review">
    <div class="container-fluid">
        <div class="row align-items-center review-slider normal-slider">

            @foreach(\App\Models\Post::all() as $post)
            <div class="col-md-6">
                <div class="review-slider-item">
                    <div class="review-img">
                        @if($post->user->image == null)
                            <img src="{{asset('storage/images/user-avatar.jpg')}}" class="footer-user-image showUserProfile" data-id="{{$post->user->id}}" style="width: 200px; height: 200px" alt="Image">
                        @else
                        <img src="{{asset('storage/'. $post->user->image)}}" class="footer-user-image showUserProfile" data-id="{{$post->user->id}}" style="width: 200px; height: 200px" alt="Image">
                            @endif
                    </div>
                    <div class="review-text">
                        <h2><a class="showUserProfile" data-id="{{$post->user->id}}"><b>{{$post->user->name}}</b></a></h2>
                        <h3>{{$post->user->job}}</h3>
                        <div class="ratting">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <p>
                           @if($post->user->id === $post->user_id)
                               {{$post->comment}}
                               @endif
                        </p>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
<!-- Review End -->







<!-- Footer Start -->
<div class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <h2>Get in Touch</h2>
                    <div class="contact-info">
                        <p><i class="fa fa-map-marker"></i>123 E Store, Los Angeles, USA</p>
                        <p><i class="fa fa-envelope"></i>email@example.com</p>
                        <p><i class="fa fa-phone"></i>+123-456-7890</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <h2>Follow Us</h2>
                    <div class="contact-info">
                        <div class="social">
                            <a href=""><i class="fab fa-twitter"></i></a>
                            <a href=""><i class="fab fa-facebook-f"></i></a>
                            <a href=""><i class="fab fa-linkedin-in"></i></a>
                            <a href=""><i class="fab fa-instagram"></i></a>
                            <a href=""><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <h2>Company Info</h2>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms & Condition</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <h2>Purchase Info</h2>
                    <ul>
                        <li><a href="#">Pyament Policy</a></li>
                        <li><a href="#">Shipping Policy</a></li>
                        <li><a href="#">Return Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row payment align-items-center">
            <div class="col-md-6">
                <div class="payment-method">
                    <h2>We Accept:</h2>
                    <img src="{{asset('mainTemplate/img/payment-method.png')}}" alt="Payment Method" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="payment-security">
                    <h2>Secured By:</h2>
                    <img src="{{asset('mainTemplate/img/godaddy.svg')}}" alt="Payment Security" />
                    <img src="{{asset('mainTemplate/img/norton.svg')}}" alt="Payment Security" />
                    <img src="{{asset('mainTemplate/img/ssl.svg')}}" alt="Payment Security" />
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Footer Bottom Start -->
<div class="footer-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-6 copyright">
                <p>Copyright &copy; <a href="https://htmlcodex.com">HTML Codex</a>. All Rights Reserved</p>
            </div>

            <div class="col-md-6 template-by">
                <p>Template By <a href="https://htmlcodex.com">HTML Codex</a></p>
            </div>
        </div>
    </div>
</div>
<!-- Footer Bottom End -->


<!-- Modal userProfile -->
<div class="modal fade" id="userProfileModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="appendUserProfile">
            <h2>Loading...</h2>
        </div>

    </div>
</div>



<!-- Modal Login-->
<div class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content" >
{{--            <img src="{{asset('2b.jpeg')}}" style="max-width: 100%; max-height: 100%; position: absolute">--}}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="loginForm" action="{{route('custom.login')}}">
                @csrf
                <div class="modal-body">
                   <table class="table table-striped ">
                       <tr>
                           <td>Email:</td>
                           <td><input type="email" class="form-control" name="email" placeholder="Enter Your email..."></td>
                       </tr>
                       <tr>
                           <td>Password:</td>
                           <td><input type="password" class="form-control" name="password" placeholder="Enter your password..."></td>
                       </tr>
                       <tr>
                           <td>If you dont have any account, pls register!</td>
                           <td><button type="button" class="btn btn-info form-control" id="registerOnLoginModal">Register</button></td>
                       </tr>
                   </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Login</button>
                </div>
            </form>

        </div>
    </div>
</div>
{{--end of modal login--}}

<!-- Modal Register-->
<div class="modal fade" id="modalRegister" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Register new Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="registerForm" action="{{route('custom.register')}}">
                @csrf
                <div class="modal-body">
                    <table class="table table-striped ">
                        <tr>
                            <td>Name:</td>
                            <td><input type="text" class="form-control" name="name" placeholder="Enter Your name..."></td>
                        </tr>
                        <tr>
                            <td>FullName:</td>
                            <td><input type="text" class="form-control" name="full_name" placeholder="Enter Your full name..."></td>
                        </tr>

                        <tr>
                            <td>Phone</td>
                            <td><input type="number" class="form-control" name="phone" placeholder="Enter Your phone..."></td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td><input type="email" class="form-control" name="email" placeholder="Enter Your email..."></td>
                        </tr>
                        <tr>
                            <td>Address:</td>
                            <td><input type="text" class="form-control" name="address" placeholder="Enter Your address..."></td>
                        </tr>
                        <tr>
                            <td>Role:</td>
                            <td><select name="role_id">
                                    @foreach(\App\Models\Roles::all() as $value)
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                </select></td>
                        </tr>
                        <tr>
                            <td>Password:</td>
                            <td><input type="password" class="form-control" name="password" placeholder="Enter your password..."></td>
                        </tr>
                        <tr>
                            <td>Re-enter your password:</td>
                            <td><input type="password" class="form-control" name="rePassword" placeholder="Re-enter your password"></td>
                        </tr>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Register</button>
                </div>
            </form>

        </div>
    </div>
</div>




<!-- Back to Top -->
<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('mainTemplate/lib/easing/easing.min.js')}}"></script>
<script src="{{asset('mainTemplate/lib/slick/slick.min.js')}}"></script>
<!-- Template Javascript -->
<script src="{{asset('mainTemplate/js/main.js')}}"></script>

<script>

    //login custom
    $('#customLogin').click(function () {
        $('#modalLogin').modal('show');
    });

    $('#registerOnLoginModal').click(function () {
        $('#modalLogin').modal('hide');
        $('#modalRegister').modal('show');
    });

    $('#customeRegister').click(function () {

        $('#modalRegister').modal('show');
    });


    $('#loginForm').on('submit', function () {

        $.ajax({
            url: "{{route('custom.login')}}",
            method: 'post',
            dataType: 'json',
            data: $('#loginForm').serialize(),
            success: function (data) {
                console.log(data);
            },
            error: function (response) {
                console.log(response);
            }
        });
    });
    //end login custom

    $('#registerForm').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: "{{route('custom.register')}}",
            method: 'post',
            data: $('#registerForm').serialize(),
            dataType: 'json',
            success: function () {
                $('#modalRegister').modal('hide');
                $('#modalLogin').modal('show');
            },
            error: function (response) {
                console.log(response);
            }
        });
    })
</script>


<script>

function addCart(id) {
    $.ajax({
        url: "addCart/" + id,
        method: 'get',
        success: function (data) {
            $('#change-cart-items').empty();
            $('#change-cart-items').html(data);
            $('#total-Qty-Product').text($('#qtyCart-cart').val());
            console.log($('#qtyCart-cart').val());
            alertify.success('Added to Your Cart!');
        }
    })
}

    $('#change-cart-items').on('click', '.si-close .deleteProduct', function () {
        $.ajax({
            url: 'deleteCart/' + $(this).data('id'),
            type: 'GET',
            success: function (data) {
                $('#change-cart-items').empty();
                $('#change-cart-items').html(data);
                $('#total-Qty-Product').text($('#qtyCart-cart').val());
                if(!$('#qtyCart-cart').val()){
                    $('#total-Qty-Product').text('0');
                }
                console.log($('#qtyCart-cart').val());
                alertify.success('Delete Your Item!');
            }
        });
    });

    $('.review-slider-item').on('click','.showUserProfile', function () {
        $('#userProfileModal').modal('show');
            $.ajax({
                url: "showUserProfile/" + $(this).data('id'),
                method: 'get',
                success: function (data) {
                    console.log(data);
                    $('#appendUserProfile').empty();
                    $('#appendUserProfile').html(data);
                }
            });
    })


</script>
</body>
</html>

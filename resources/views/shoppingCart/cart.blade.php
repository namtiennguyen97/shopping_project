@include('template.master')

@include('template.menuBar')
@include('template.bottomBar')

<body>




<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Products</a></li>
            <li class="breadcrumb-item active">Cart</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Cart Start -->
<div class="cart-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="cart-page-inner">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                            </thead>
                            <tbody class="align-middle" id="appendCartData">
{{--                            bat dau du lieu cart o day--}}
                            @if(\Illuminate\Support\Facades\Session::has('Cart')== null)
                                <span class="text-danger">You did not make any product, let look around and make some!</span>
                                @else
                                @foreach(\Illuminate\Support\Facades\Session::get('Cart')->product as $item)
                                    <tr class="cartItem{{$item['productInfo']->id}}">
                                        <td>
                                            <div class="img">
                                                <a href="#"><img src="{{asset('storage/'.$item['productInfo']->image)}}" style="width: 60px; height: 60px" class="img img-thumbnail"></a>
                                                <p>{{$item['productInfo']->name}}</p>
                                            </div>
                                        </td>
                                        <td>{{number_format($item['productInfo']->price)}}</td>
                                        <td>
                                            <div class="qty">
                                                <button class="btn-minus"><i class="fa fa-minus"></i></button>
                                                <input type="text" value="{{$item['qty']}}">
                                                <button class="btn-plus"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </td>
                                        <td>$99</td>
                                        <td><button><i  data-id="{{$item['productInfo']->id}}" onclick="deleteItemCart({{$item['productInfo']->id}})" class="fa fa-trash"></i></button></td>
                                    </tr>
                                    @endforeach
                                @endif



{{--                            ket thuc du lieu cart o day--}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart-page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="coupon">
                                <input type="text" placeholder="Coupon Code">
                                <button>Apply Code</button>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="cart-summary">
                                <div class="cart-content">
                                    <h1>Cart Summary</h1>
                                    <p>Sub Total<span>$99</span></p>
                                    <p>Shipping Cost<span>$1</span></p>
                                    <h2>Grand Total<span>$100</span></h2>
                                </div>
                                <div class="cart-btn">
                                    <button>Update Cart</button>
                                    <button>Purchase</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->

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



<!-- Back to Top -->
<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
{{--<script src="{{asset('mainTemplate/lib/easing/easing.min.js')}}"></script>--}}
{{--<script src="{{asset('mainTemplate/lib/slick/slick.min.js')}}"></script>--}}

<!-- Template Javascript -->
<script src="{{asset('mainTemplate/js/main.js')}}"></script>
<script>
    function deleteItemCart(id) {
        $.ajax({
            url: 'deleteCart/'+id,
            type: 'GET',
            success: function (data) {
                $('#change-cart-items').empty();
                $('#change-cart-items').html(data);
                $('#total-Qty-Product').text($('#qtyCart-cart').val());
                $('.cartItem'+id).remove();

                if(!$('#qtyCart-cart').val()){
                    $('#total-Qty-Product').text('0');
                }
                console.log($('#qtyCart-cart').val());
                alertify.success('Delete Your Item!');
            },
            error: function (response) {
                console.log('error delete: ' + response);
                // alertify.error('You have to login!');
            }
        });
    }
</script>
</body>



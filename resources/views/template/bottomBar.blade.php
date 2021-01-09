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

<script>
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
                alertify.success('Delete Your Item!');
            }
        });
    })
</script>
<!-- Bottom Bar End -->

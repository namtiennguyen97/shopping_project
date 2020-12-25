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
                            <span>(0)</span>

                            <div class="dropdown-contentA">
                                <div class="backGroundColor">
                                    <h1 class="font-italic">Cart<i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    </h1>
                                </div>

                                <div id="change-cart-items">
                                    {{--                                start here--}}

                                    <div class="shopping-cart">
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td><img src="{{asset('mainTemplate/img/category-2.jpg')}}" width="180" class="img img-thumbnail"></td>
                                                <td>
                                                    <div>
                                                        <p>3000 x 6</p>
                                                        <h5>Blouse f</h5>
                                                    </div>
                                                </td>
                                                <td class="si-close">
                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><img src="{{asset('mainTemplate/img/category-2.jpg')}}" width="180" class="img img-thumbnail"></td>
                                                <td>
                                                    <div>
                                                        <p>3000 x 6</p>
                                                        <h5>Blouse hhfhffffffrf</h5>
                                                    </div>
                                                </td>
                                                <td class="si-close">
                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>

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

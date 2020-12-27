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

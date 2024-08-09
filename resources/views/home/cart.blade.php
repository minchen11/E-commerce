@extends('layout.home')

@section('title', 'Cart')

@section('content')
<!-- Cart -->
<section class="section-wrap shopping-cart">
    <div class="container relative">
        <form class="form-cart">
            <input type="hidden" name="id_member" value="{{Auth::guard('webmember')->user()->id}}">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-wrap mb-30">
                        <table class="shop_table cart table">
                            <thead>
                                <tr>
                                    <th class="product-name" colspan="2">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal" colspan="2">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carts as $cart)
                                <input type="hidden" name="id_produk[]" value="{{$cart->product->id}}">
                                <input type="hidden" name="jumlah[]" value="{{$cart->jumlah}}">
                                <input type="hidden" name="size[]" value="{{$cart->size}}">
                                <input type="hidden" name="color[]" value="{{$cart->color}}">
                                <input type="hidden" name="total[]" value="{{$cart->total}}">
                                <tr class="cart_item">
                                    <td class="product-thumbnail">
                                        <a href="#">
                                            <img src="/uploads/{{$cart->product->gambar}}" alt="">
                                        </a>
                                    </td>
                                    <td class="product-name">
                                        <a href="#">{{$cart->product->nama_barang}}</a>
                                        <ul>
                                            <li>Size: {{$cart->size}}</li>
                                            <li>Color: {{$cart->color}}</li>
                                        </ul>
                                    </td>
                                    <td class="product-price">
                                        <span class="amount">{{ "Rp. " . number_format($cart->product->harga)}}</span>
                                    </td>
                                    <td class="product-quantity">
                                        <span class="amount">{{ $cart->jumlah }}</span>
                                    </td>
                                    <td class="product-subtotal">
                                        <span class="amount">{{ "Rp. " . number_format($cart->total)}}</span>
                                    </td>
                                    <td class="product-remove">
                                        <a href="/delete_from_cart/{{$cart->id}}" class="remove"
                                            title="Remove this item">
                                            <i class="ui-close"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row mb-50">
                        <div class="col-md-5 col-sm-12">
                        </div>
                        <div class="col-md-7">
                            <div class="actions">
                                <div class="wc-proceed-to-checkout">
                                    <a href="#" class="btn btn-lg btn-dark checkout"><span>proceed to
                                            checkout</span></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- end col -->
            </div> <!-- end row -->

            <div class="row">

                <div class="col-md-6">
                    <div class="cart_totals">
                        <h2 class="heading relative bottom-line full-grey uppercase mb-30">Cart Totals</h2>

                        <table class="table shop_table">
                            <tbody>
                                <tr class="cart-subtotal">
                                    <th>Cart Subtotal</th>
                                    <td>
                                        <span class="amount cart-total">{{$cart_total}}</span>
                                    </td>
                                </tr>
                                <tr class="order-total">
                                    <th>Order Total</th>
                                    <td>
                                        <input type="hidden" name="grand_total" value="{{$cart_total}}" class="grand_total">
                                        <strong><span class="amount grand-total">{{$cart_total}}</span></strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div> <!-- end col cart totals -->

            </div> <!-- end row -->
        </form>

    </div> <!-- end container -->
</section> <!-- end cart -->
@endsection

@push('js')
<script>
    $(function(){

            $('.checkout').click(function(e){
                e.preventDefault()
                $.ajax({
                    url : '/checkout_orders',
                    method : 'POST',
                    data : $('.form-cart').serialize(),
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}",
                    },
                    success : function(){
                        location.href = '/checkout'
                    }
                })
            })
        });
</script>
@endpush

@extends('layouts.base')

@section('content')
<section id="breadcrumb" class="mb-4 mt-1 d-none d-lg-block">
    <nav aria-label="breadcrumb" class="bread py-1 bg-light shadow-none">
        <ol class="breadcrumb mt-3">
          <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Checkout</li>
        </ol>
      </nav>
</section>

<section id="cart">
    @if ($orders !== null)
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-6 col-11">
                <div class="card border-0 shadow rounded-3 mb-4">
                    <div class="card-header bg-transparent border-0 card-title h4 p-3">Order Summary</div>
                    <hr>
                    <div class="card-body">
                        @foreach ($orders->cart_item as $item)
                        <div class="mb-4 row shadow-sm rounded py-3">
                            <div class="col-lg-3">
                                <img src="{{ asset('images/products/'.$item->cartItems->image) }}" alt="" class="img-fluid rounded shadow-sm">
                            </div>
                            <div class="col-lg-9">
                                <h5>{{ $item->cartItems->name }}</h5>
                                <p class="small text-muted"><strong>seller :</strong>{{ $item->cartItems->seller->user_name }}</p>
                                <p class="small fw-bold" style="margin-top: -10px;">₹ {{ $item->cartItems->offer_price }} /-</p>
                            </div>
                        </div>
                        @endforeach
                        <h5>Address Details</h5>
                        <hr>
                        <div class="form-check">
                            <label class="form-check-label" for="10">
                                <h4 class="h5 "> {{ $orders->address->first_name ." ". $orders->address->last_name }}</h4>
                                <h5 class="h6 small">+91 {{ $orders->address->phone }}</h5>
                                <h5 class="h6 small">{{ $orders->address->email }}</h5>
                                <p>{{ $orders->address->address }},  {{ $orders->address->city }}, 854031</p>
                                <p class="mt-n3 ">{{ $orders->address->state }}</p>
                            </label>
                        </div>
                        <a href="" class="btn btn-light rounded-0 shadow-sm float-start ms-3">Change Address</a>
                    </div>
                </div>

                <button class="btn btn-info shadow-none">Continue Shopping</button>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-6 col-11">

                <div class="card border-0 shadow rounded-3">
                    <div class="card-header bg-transparent border-0 card-title h4 p-3">Order Details</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Product Name</th>
                                <th>Total</th>
                            </tr>
                            @php
                                $total_price = 0;
                                $cod_check = 0;
                                $free_ship = 0;
                                $coup_discount = 0;
                            @endphp
                            @foreach ($orders->cart_item as $item)
                            <tr>
                                <th>{{ $item->cartItems->name }}</th>
                                <th>₹ {{ $item->cartItems->offer_price }}</th>
                            </tr>
                            @php
                                $total_price += $item->cartItems->offer_price * $item->qty;
                                $cod_check += $item->cartItems->codcheck;

                                $free_ship += $item->cartItems->free_shipping;
                                if ($item->coupon_id !== null) {
                                    $coup_discount  += $item->coupon->amount;
                                }
                            @endphp
                            @endforeach
                            <tr>
                                <th>Cart Subtotal</th>
                                <th>₹ {{ $total_price }}</th>
                            </tr>
                            <tr>
                                <th>Shipping</th>
                                @if ( $free_ship > 0 && ship_set()->max_cart_amount <= $total_price)
                                <th>free</th>
                                @else
                                    <th>{{ ship_set()->shipping_charge }}</th>
                                @endif
                            </tr>
                            @if ($coup_discount > 0)
                            <tr>
                                <th>Coupon Discount</th>
                                <th>- ₹ {{ $coup_discount }}</th>
                            </tr>
                            <tr>
                                <th>Order Total</th>
                                <th>₹ {{ $total_price - $coup_discount  }}</th>
                            </tr>
                            @else
                            <tr>
                                <th>Order Total</th>
                                <th>₹ {{ $total_price }}</th>
                            </tr>
                            @endif
                        </table>
                    </div>
                    {{-- <div class="card-footer bg-white pb-3 border-0">
                        <a href="" class="btn btn-warning w-100">Continue</a>
                    </div> --}}
                </div>
                <div class="card border-0 shadow rounded-3 my-3 py-4">
                    <form action="{{ route('payment.redirect') }}" method="post">
                        @csrf
                        @if ($coup_discount > 0)
                        <input type="hidden" name="amount" value="{{ $total_price - $coup_discount}}">
                        @else
                        <input type="hidden" name="amount" value="{{ $total_price }}">
                        @endif
                        <input type="hidden" name="order_id" value="{{ $orders->id }}">
                        <div class="card-body">
                            @if ($cod_check > 0)
                            <div class="form-check mb-3">
                                <input type="radio"  class="form-check-input"
                                    value="cod" id="payment_type_cod" name="payment_type">
                                <label class="form-check-label fw-bold" for="payment_type_cod">Cash On Delivery ( ₹ {{ $total_price*(5/100) }} )</label>
                                {{-- @if (ship_set()->cod_charge > 0) --}}
                                <p class="small text-muted">You have to pay 5% of the cart amount for cod charges.</p>
                                {{-- <p class="small text-muted">Cod Charge is ₹ {{ ship_set()->cod_charge }}.</p> --}}
                                {{-- @endif --}}
                            </div>
                            @endif
                            @if (payment_config()->paytm_enable == 1)
                            <div class="form-check mb-3">
                                <input type="radio"  class="form-check-input"
                                    value="paytm" id="payment_type_paytm" name="payment_type">
                                <label class="form-check-label fw-bold" for="payment_type_paytm">Paytm</label>
                            </div>
                            @endif
                            @if (payment_config()->razorpay_enable == 1)
                            <div class="form-check ">
                                <input type="radio"  class="form-check-input"
                                    value="razorpay" id="payment_type_razorpay" name="payment_type">
                                <label class="form-check-label fw-bold" for="payment_type_razorpay">RazorPay</label>
                            </div>
                            @endif
                        </div>

                        <div class="card-footer border-0 bg-transparent">
                            <button class="btn btn-warning w-100 place_order_button">Place Order</button>
                        </div>
                    </form>
                    <style>
                        .razorpay-payment-button{
                            display: none;
                        }
                    </style>
                    <div class="card-footer mt-0 border-0 bg-transparent razorpay-payment d-none">
                        <form action="{{ route('razorpay.pay') }}" method="POST">
                            @csrf
                            <input type="hidden" name="order_id" value="{{ $orders->id }}">
                            <script src="https://checkout.razorpay.com/v1/checkout.js"
                                data-key="{{ env('RAZORPAY_KEY') }}"
                                data-amount="{{ $total_price * 100 }}"
                                data-currency="INR"
                                data-name="{{ Auth::user()->user_name }}"
                                data-description="Rozerpay"
                                data-image="https://realprogrammer.in/wp-content/uploads/2020/10/logo.jpg"
                                data-prefill.name="{{ Auth::user()->phone }}"
                                data-prefill.email="{{ Auth::user()->email }}"
                                data-theme.color="#F37254">
                            </script>
                            <button class="btn btn-warning w-100">Place Order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</section>

  <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script>
    $(document).ready(function() {
    $("input[name$='payment_type']").click(function() {
        var pt = $(this).val();

        if(pt == 'razorpay'){
            $(".place_order_button").hide();
            $(".razorpay-payment").removeClass('d-none');
        }else{
            $(".place_order_button").show();
            $(".razorpay-payment").addClass('d-none');
        }
        // $("div.desc").hide();
        // $("#Cars" + test).show();
    });
});
</script>

@endsection

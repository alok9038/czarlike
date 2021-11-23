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
                    <div class="card-header bg-transparent border-0 card-title h4 p-3">Delivery Address</div>
                    <form id="address_form" action="{{ route('checkout.payment') }}" method="post">
                        @csrf
                        <div class="card-body">
                            @if ($addresses->count() > 0)
                                @foreach ($addresses as $address)
                                <div class="form-check mb-4">
                                    <input type="radio"  class="form-check-input new_add"
                                        value="{{ $address->id }}" id="10" name="address_check">
                                    <label class="form-check-label" for="10">
                                        <h4 class="h5 "> {{ $address->first_name ." ". $address->last_name }}</h4>
                                        <h5 class="h6 small">+91 {{ $address->phone }}</h5>
                                        <h5 class="h6 small">{{ $address->email }}</h5>
                                        <p>{{ $address->address }},  {{ $address->city }}, {{ $address->zip }}</p>
                                        <p class="mt-n3 ">{{ $address->state }}</p>
                                    </label>
                                </div>
                                @endforeach
                            @endif

                            {{--  --}}
                            <div class="form-check">
                                <input type="radio" name="address_check" value="new_add" onclick="view_new_add()"  class="form-check-input new_add" id="add_new">
                                <label class="form-check-label" for="add_new">
                                    <h3 class="title h5">Add New Address</h3>
                                </label>
                                <script type="text/javascript">
                                    $(document).ready(function() {
                                        $('.new_add').click(function() {
                                            var inputValue = $(this).attr("value");
                                            if(inputValue == 'new_add'){
                                                $("#address_box").show();
                                            }
                                            else{
                                                $("#address_box").hide();
                                            }
                                        });
                                    });
                                </script>
                            </div>
                            <div id="address_box" style="display: none;">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>First Name <span class="required">*</span></label>
                                        <input type="text" name="first_name" class="form-control ">
                                                                            </div>
                                </div>

                                <div class="col-lg-6 col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Last Name <span class="required">*</span></label>
                                        <input type="text" name="last_name" class="form-control ">
                                                                            </div>
                                </div>

                                <div class="col-lg-12 col-md-12 mb-3">
                                    <div class="form-group">
                                        <label>Company Name</label>
                                        <input type="text" name="company_name" class="form-control ">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Address <span class="required">*</span></label>
                                        <input type="text" name="address" class="form-control ">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Town / City <span class="required">*</span></label>
                                        <input type="text" name="city" class="form-control ">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>State / County <span class="required">*</span></label>
                                        <input type="text" name="state" class="form-control ">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Postcode / Zip <span class="required">*</span></label>
                                        <input type="text" name="zip_code" class="form-control ">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Email Address <span class="required">*</span></label>
                                        <input type="email" name="email" value="test@gmail.com" class="form-control ">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Phone <span class="required">*</span></label>
                                        <input type="text" name="phone" class="form-control ">
                                    </div>
                                </div>
                                <input type="text" hidden name="order_id"  value="{{ $orders->id }}">
                                <div class="col-lg-12 col-md-12 mt-3">
                                    <div class="form-group">
                                        <textarea name="order_notes" id="notes" cols="30" rows="5" placeholder="Order Notes" class="form-message form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </form>
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
                                $total_offer_price = 0;
                                $free_ship = 0;
                                $coup_discount = 0;
                            @endphp
                            @foreach ($orders->cart_item as $item)
                            <tr>
                                <th>{{ $item->cartItems->name }}</th>
                                <th>₹ {{ $item->cartItems->offer_price }}</th>
                            </tr>
                            @php
                                $total_offer_price += $item->cartItems->offer_price * $item->qty;

                                $free_ship += $item->cartItems->free_shipping;
                                if ($item->coupon_id !== null) {
                                    $coup_discount  += $item->coupon->amount;
                                }
                            @endphp
                            @endforeach
                            <tr>
                                <th>Cart Subtotal</th>
                                <th>₹ {{ $total_offer_price }}</th>
                            </tr>
                            <tr>
                                <th>Shipping</th>
                                @if ( $free_ship > 0 && ship_set()->max_cart_amount <= $total_offer_price)
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
                                <th>₹ {{ $total_offer_price - $coup_discount  }}</th>
                            </tr>
                            @else
                            <tr>
                                <th>Order Total</th>
                                <th>₹ {{ $total_offer_price }}</th>
                            </tr>
                            @endif
                        </table>
                    </div>
                    <div class="card-footer bg-white pb-3 border-0">
                        <a href="#" class="btn btn-warning w-100" onclick="javascript:$('#address_form').submit();">Continue</a>
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

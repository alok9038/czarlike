@extends('layouts.base')

@section('content')
<section id="breadcrumb" class="mb-4 mt-1 d-none d-lg-block">
    <nav aria-label="breadcrumb" class="bread py-1 bg-light shadow-none">
        <ol class="breadcrumb mt-3">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Cart</li>
        </ol>
      </nav>
</section>
@if ($orders !== null)

<section id="cart">
    <div class="container">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                      <th scope="col">Id</th>
                      <th scope="col">Product</th>
                      <th scope="col">Price</th>
                      <th scope="col">Qty</th>
                      <th scope="col">Unit offer_price</th>
                      <th scope="col"></th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $sr = 0
                    @endphp
                    @foreach ($orders->cart_item as $item)
                    @php
                        $sr += 1
                    @endphp
                    <tr>
                        <th scope="row">{{ $sr }}</th>
                        <td class="">
                            <img src="{{ asset('images/products/'.$item->cartItems->image) }}" class="img-fluid rounded-2" alt="{{ $item->cartItems->image }}">
                            <span>{{ $item->cartItems->name }}</span>
                        </td>
                        <td>₹ {{ $item->cartItems->price }}</td>
                        <td>
                          <div class="input-group">
                            <form action="{{ route('decrease.cart.item') }}" method="post">
                                @csrf
                                <input type="text" hidden value="{{ $item->cartItems->id }}" name="product_id">
                                <button type="submit" class="btn btn-light shadow-none {{ $item->qty == 1 ? 'disabled' : ""}}">-</button>
                            </form>
                            <button class="btn btn-light shadow-none disabled">{{  $item->qty }}</button>
                            <form action="{{ route('add.to.cart') }}" method="post">
                                @csrf
                                <input type="text" hidden value="{{ $item->cartItems->id }}" name="product_id">
                                <input type="text" hidden value="{{ $item->cartItems->vender_id }}" name="vendor_id">
                                <button type="submit" class="btn btn-light shadow-none">+</button>
                            </form>
                          </div>
                        </td>
                        <td>
                            ₹ {{ $item->cartItems->offer_price * $item->qty }}
                        </td>
                        <td>
                            <form action="{{ route('remove.cart.item') }}" method="post">
                                @csrf
                                <input type="text" hidden value="{{ $item->cartItems->id }}" name="product_id">
                                <button class="btn shadow-none text-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                        @if ($item->coupon_id == null)
                        <td>
                            <a href="#coupon_modal" class="text-decoration-none text-muted float-end" data-bs-toggle="modal" data-bs-target="#coupon_modal"><i class="fa fa-tag"></i> have Coupon code?</a>
                        </td>
                        <div class="modal fade" id="coupon_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog ">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Redeem Coupon Code</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('redeem.coupon') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{ $item->id }}">
                                        <input type="hidden" name="product_id" value="{{ $item->cartItems->id }}">
                                        <div class="input-group">
                                            <input type="text" placeholder="Coupon Code" name="code" class="form-control">
                                            <button class="btn btn-warning">Redeem</button>
                                        </div>
                                    </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        @else
                            <td >
                                <div class="d-">
                                    <a href="" class="text-decoration-none text-uppercase text-muted "> <i class="fa fa-tag"></i> {{ $item->coupon->code }}  </a><span class="text-dark text-end ms-2">applied</span>
                                    <form action="{{ route('remove.coupon') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{ $item->id }}">
                                        <input type="hidden" name="coupon_id" value="{{ $item->coupon->id }}">
                                        <button class="btn bg-white shadow-none p-0"><i class="far ms fa-times-circle text-danger"> </i> <span class="text-danger small">remove</span></button>
                                    </form>
                                </div>
                            </td>
                        @endif
                    </tr>
                    @endforeach
                  </tbody>
            </table>
          </div>


          <div class="amount my-5">
              <div class="row">
                  <div class="col-lg-4">
                      <a href="{{ route('homepage') }}" class="btn btn-secondary">Continue Shopping</a>
                    {{-- @if ($orders->cart_item->count() == 1)
                    <form action="{{ route('redeem.coupon') }}" class="mb-2" method="POST">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $item->id }}">
                        <input type="hidden" name="product_id" value="{{ $item->cartItems->id }}">
                        <div class="input-group">
                            <input type="text" placeholder="Coupon Code" name="code" class="form-control">
                            <button class="btn">Redeem</button>
                        </div>
                    </form>
                    <a href="" class="text-muted text-uppercase text-decoration-none"><i class="fa fa-trash" style="color: red"></i> {{ $item->coupon->code }}</a>
                    @endif --}}
                  </div>

                  <div class="col-lg-5">

                  </div>
                  @php
                        $total_offer_price = 0;
                        $free_ship = 0;
                        $coup_discount = 0;
                        foreach($orders->cart_item as $item){
                            $total_offer_price += $item->cartItems->offer_price * $item->qty;

                            $free_ship += $item->cartItems->free_shipping;
                            if ($item->coupon_id !== null) {
                                $coup_discount  += $item->coupon->amount;
                            }
                        }

                  @endphp
                  <div class="col-lg-3">
                        <div class="total-amount">
                            <p>
                                <a class="">Subtotal</a>
                                <a class="float-end">₹ {{ $total_offer_price }}</a>
                            </p>

                            <p>
                                <a class="">Shipping Fee</a>
                                @if ( $free_ship > 0 && ship_set()->max_cart_amount <= $total_offer_price)
                                    <a class="float-end">free</a>
                                @else
                                    <a class="float-end">{{ ship_set()->shipping_charge }}</a>
                                @endif
                            </p>
                            <p>
                                <a class="active">Coupon</a>
                                @if ($coup_discount > 0)
                                <a class="float-end active">- {{ $coup_discount }}<b>%</b></a>
                                @else
                                <a class="float-end active">No</a>
                                @endif
                            </p>
                            <hr>
                            <p>
                                <a class="">Total</a>
                                @if ($coup_discount > 0)
                                @php
                                $a = $total_offer_price * $coup_discount / 100;
                                $b = $total_offer_price - $a ;
                                @endphp
                                <a class="float-end active">₹ {{  $b }}</a>
                                @else
                                <a class="float-end">₹ {{ $total_offer_price }}</a>
                                @endif
                            </p>

                            {{-- <button class="btn w-100 mt-4" data-bs-toggle="modal" data-bs-target="#checkout">Check Out</button> --}}
                            <a href="{{ route('checkout') }}" class="btn btn-warning w-100 mt-4">Check Out</a>
                        </div>
                  </div>
              </div>
          </div>
    </div>
</section>

@else
<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTaDSg9RUO2cni53wHS9uZHm1LcZE3mEw3SBpsXMn012wpUuXi9tRnJEq9xf_3XrnVqwe4&usqp=CAU" alt="" style="height: 223px" class="img-fluid d-flex mx-auto">
    <h4 class="text-center text-muted">No Items In Cart!</h4>
@endif
@endsection

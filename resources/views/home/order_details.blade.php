@extends('layouts.base')
@section('content')

<style>
    /* progress bar */
  #progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: #455A64;
    padding-left: 0px;
    margin-top: 30px
  }

  #progressbar li {
    list-style-type: none;
    font-size: 13px;
    width: 33.33%;
    float: left;
    position: relative;
    font-weight: 400;
    color: #455A64 !important
  }

  #progressbar #step1:before {
    content: "1";
    color: #fff;
    width: 29px;
    margin-left: 15px !important;
    padding-left: 11px !important
  }

  #progressbar #step2:before {
    content: "2";
    color: #fff;
    width: 29px
  }

  #progressbar #step3:before {
    content: "3";
    color: #fff;
    width: 29px;
    margin-right: 15px !important;
    padding-right: 11px !important
  }

  #progressbar li:before {
    line-height: 29px;
    display: block;
    font-size: 12px;
    background: #455A64;
    border-radius: 50%;
    margin: auto
  }

  #progressbar li:after {
    content: '';
    width: 121%;
    height: 2px;
    background: #455A64;
    position: absolute;
    left: 0%;
    right: 0%;
    top: 15px;
    z-index: -1
  }

  #progressbar li:nth-child(2):after {
    left: 50%
  }

  #progressbar li:nth-child(1):after {
    left: 25%;
    width: 121%
  }

  #progressbar li:nth-child(3):after {
    left: 25% !important;
    width: 50% !important
  }

  #progressbar li.active:before,
  #progressbar li.active:after {
    background: #ff1744;
  }
  </style>
<div class="container my-5 mb-3">
    <div class="col-lg-12 p-4 bg-white mat-shadow-sm">
        <h6 class="h5 text-dark">Delivery Address</h6>
        <h6 class="text-dark">{{ $order->orders->address->first_name ." ". $order->orders->address->last_name }}</h6>
        <p class="small text-dark" style="margin-top: -8px; line-height: 1.9;">{{ $order->orders->address->address }}, {{ $order->orders->address->city }} - {{ $order->orders->address->zip }}, {{ $order->orders->address->state }}.</p>
        <p class="text-dark" style="margin-top: -18px;"><strong>Phone number</strong> : {{ $order->orders->address->phone }}</p>
    </div>
</div>
<div class="container px-4 mb-4">
    <div class="row shadow-sm my-2 bg-white">
        <div class="col-lg-5 ">
             <div class="d-flex p-3" style="">
                 <img src="{{ asset('images/products/'.$order->cartItems->image) }}" class="img-fluid " style="height: 160px; width:160px; border-radius:3px; " alt="">
                 <div class="ms-3">
                     <p class="text-dark fw-bold">{{ $order->cartItems->name }}</p>
                     <p style="margin-top: -20px; font-size:12px;">{{ $order->cartItems->product_cat->title }}</p>
                     <p class="small text-dark fw-bold"><del>₹ {{ $order->cartItems->price }}</del></p>
                     <p class="text-muted">Price : ₹ {{ $order->cartItems->offer_price }}</p>
                    <p class="small">Qty : {{ $order->qty }}</p>
                 </div>
             </div>
        </div>
        <div class="col-lg-3 col-12 py-lg-5">
            @if ($order->payment_status == 0)
                    <p class="fw-bold">₹ {{ ($order->cartItems->offer_price * $order->qty) + ($order->cartItems->offer_price * $order->qty)*(5/100) }}</p>
                    <p>₹ {{ ($order->cartItems->offer_price * $order->qty) }} + {{ ($order->cartItems->offer_price * $order->qty)*(5/100) }} <strong>Cod charge</strong></p>
                    {{-- <p>₹ {{ $order->cartItems->offer_price }} + {{ ship_set()->cod_charge }} Cod charge</p> --}}
                    @else
                        <p class="text-dark fw-bold h4">₹ {{ $order->cartItems->offer_price }}</p>
                    @endif
        </div>
        <div class="col-lg-3 col py-4">
            @if ($order->status == 3)
            <p class="small fw-bold text-capitalize text-dark"><i class="fa fa-circle text-danger"></i> Canceled
                <p style="font-size: 12px; margin-top:-15px;">Your have canceled this order</p>
            </p>
            @endif
            {{-- <a href="" class="btn btn-danger py-1">Cancel Order</a> --}}
            @if ($order->status != 3)
            <form action="{{ route('cancel.orders') }}" method="post">
                @csrf
                <input type="hidden" name="order_id" value="{{ $order->order_id }}">
                <button class="btn btn-danger py-1">Cancel Order</button>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection

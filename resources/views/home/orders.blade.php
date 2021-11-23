@extends('layouts.base')
@section('content')
    <style>
        .order-card{
            box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important;
            transition: .3s linear all;
        }
        .order-card:hover{
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        }
    </style>

    <div class="container my-5">
        @foreach ($orders as $order)
            @foreach ($order->cart_item as $item)
                <div class="card border-0 order-card mb-3" style="border-radius: 10px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-2">
                                <img src="{{ asset('images/products/'.$item->cartItems->image) }}" alt="{{ $item->cartItems->image }}"  style="height: 100px;" class="img-fluid rounded">
                            </div>
                            <div class="col-lg-4">
                                <h5 class="card-title">{{ $item->cartItems->name }}</h5>
                                <p class="small fw-bold">Seller : {{ $item->cartItems->seller->user_name }}</p>
                                <p class="small">Qty : {{ $item->qty }}</p>
                            </div>
                            <div class="col-lg-3">
                            @if ($item->payment_status == 0)
                            <p class="fw-bold">₹ {{ ($item->cartItems->offer_price * $item->qty) + ($item->cartItems->offer_price * $item->qty)*(5/100) }}</p>
                            <p>₹ {{ $item->cartItems->offer_price * $item->qty }} + {{ ($item->cartItems->offer_price * $item->qty)*(5/100) }} <strong>Cod charge</strong></p>
                            {{-- <p>₹ {{ $item->cartItems->offer_price }} + {{ ship_set()->cod_charge }} Cod charge</p> --}}
                            @else
                                <p>₹ {{ $item->cartItems->offer_price }}</p>
                            @endif
                            </div>
                            <div class="col-3">
                                @if ($item->status == 3)
                            <p class="small fw-bold text-capitalize text-dark"><i class="fa fa-circle text-danger"></i> Canceled
                                <p style="font-size: 12px; margin-top:-15px;">Your have canceled this order</p>
                            </p>
                            @endif
                            {{-- <a href="" class="btn btn-danger py-1">Cancel Order</a> --}}
                            @if ($item->status != 3)
                            <form action="{{ route('cancel.orders') }}" method="post">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $item->order_id }}">
                                <button class="btn btn-danger py-1">Cancel Order</button>
                            </form>
                            @endif
                            </div>
                            <a href="{{ route('order.detials',['order_id'=>$item->id]) }}" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
@endsection

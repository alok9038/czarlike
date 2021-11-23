@extends('layouts.sellerBase')
@section('title','Order Details | Seller')
@section('orders','mm-active')
@section('all_orders','mm-active')
@section('content')
    <div class="container my-4">
        <div class="card border-0 rounded-10 card-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                {{-- <span class="ms-auto"><a href="
                    {{ route('super.admin.add.driver.view') }}
                    " class="btn btn-info btn-sm"><i class="bx bx-plus-circle"></i>Add new</a></span> --}}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <img src="{{ asset('images/products/'.$order->cartItems->image) }}" alt="" class="img-fluid rounded shadow-sm w-100" style="height: 270px;">
                    </div>
                    <div class="col-lg-8">
                        <h5 class="h4">{{ $order->cartItems->name }}</h5>
                        <p class="small"><strong>Seller :</strong> {{ $order->cartItems->seller->user_name }}</p>
                        @if ($order->cartItems->store_id !== null)
                        <p class="small" style="margin-top: -10px"><strong>Store :</strong> {{ $order->cartItems->store->store_name }}</p>
                        @endif
                        @if ($order->cartItems->store_id !== null && $order->cartItems->store->is_verified == 1)
                            <span class="bg-success rounded text-white p-1 d-inline-flex align-items-center"><i class="bx bx-check-circle pt-1"></i>verified</span>
                        @endif
                        <h3 class="h4 mt-4">₹ {{ $order->cartItems->offer_price }}/-</h3>
                        <h3 class="h4 mt-4 h5"><del>₹ {{ $order->cartItems->price }}</del>/-</h3>
                    </div>
                </div>
                <div class="mt-4 row">
                    <div class="col-lg-5">
                        <h5>Customer Details</h5>
                        <hr>
                        <label class="form-check-label" for="10">
                            <h4 class="h5 "> <strong>Name :</strong> {{ $order->orders->address->first_name ." ". $order->orders->address->first_name }}</h4>
                            <h4 class="h5" style="font-size: 14px;"><strong>Phone :</strong> +91 {{ $order->orders->address->phone}}</h4>
                            <h4 class="h5" style="font-size: 14px;"> <strong>Email :</strong> {{ $order->orders->address->email}}</h4>
                            <p><strong>Address: </strong>{{ $order->orders->address->address }}</p>
                            <p class="" style="margin-top: -10px"><strong>City : </strong>{{ $order->orders->address->city }}</p>
                            <p class="" style="margin-top: -10px"><strong>Pincode : </strong>{{ $order->orders->address->zip }}</p>
                            <p class="" style="margin-top: -10px"><strong>State : </strong>{{ $order->orders->address->state }}</p>
                        </label>
                    </div>
                    <div class="col-lg-4">
                        <h5>Order Details</h5>
                        <hr>
                        <p class="" style="margin-top: -10px"><strong>Order Date : </strong>{{ $order->created_at }}</p>
                        <p class="" style="margin-top: -10px"><strong>Order Status : </strong>{{ $order->ordered }}</p>
                        <p class="" style="margin-top: -10px"><strong>Payment Status : </strong>{{ $order->payment_status }}</p>

                    </div>
                </div>
                <div class="my-3">
                    <button class="btn btn-dark d-flex mx-auto">Assign Order to Driver</button>
                </div>
            </div>
        </div>
    </div>

    @section('js')

    @endsection
@endsection

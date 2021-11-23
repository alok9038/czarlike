@extends('layouts.adminBase')
@section('title','All Orders | Admin')
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
                        <img src="{{ asset('images/products/'.$order->cartItems->image) }}" alt="" class="img-fluid rounded shadow-sm w-100" style="height: 300px;">
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
                        <h3 class="h4 mt-4 h6"><del>MRP : ₹ {{ $order->cartItems->price }}/-</del></h3>
                        {{-- <h4>₹ {{ $order->cartItems->offer_price }} X  {{ $order->qty }}</h4> --}}
                        @php
                            $cod_charge =($order->cartItems->offer_price*$order->qty)*(5/100);
                            if ($order->coupon_id !== null):
                                $total_pay_amount  = ($order->cartItems->offer_price*$order->qty)+$cod_charge - $order->coupon->amount;
                            else:
                                if($order->payment_status == 0){
                                    $total_pay_amount  = ($order->cartItems->offer_price*$order->qty)+$cod_charge ;
                                }
                                else{
                                    $total_pay_amount  = ($order->cartItems->offer_price*$order->qty) ;
                                }
                            endif;
                        @endphp
                        <table class="table table-sm mt-4 w-50 table-borderless">
                            <tr>
                                <th>Offer Price</th>
                                <th>₹ {{ $order->cartItems->offer_price }}</th>
                            </tr>
                            <tr>
                                <th>Qty</th>
                                <th> {{ $order->qty }}</th>
                            </tr>
                            <tr>
                                <th>Cod Charge</th>
                                <th>₹
                                    @if($order->payment_status == 0)
                                    {{ $cod_charge }}
                                    @else
                                    0
                                    @endif
                                </th>
                            </tr>
                            <tr>
                                <th>Shipping Charge</th>
                                @if ( $order->cartItems->free_shipping == 1 && ship_set()->max_cart_amount <= $total_pay_amount)
                                <th> free</th>
                                @else
                                <th>{{ ship_set()->shipping_charge }}</th>
                                @endif
                            </tr>
                            <tr >
                                <th>Coupon Discount</th>
                                @if ($order->coupon_id !== null)
                                <th>- ₹ {{ $order->coupon->amount }}</th>
                                @else
                                <th>0</th>
                                @endif
                            </tr>
                            <tr class="border-top border-dark">
                                <th>Total</th>
                                @if ( $order->cartItems->free_shipping == 1 && ship_set()->max_cart_amount <= $total_pay_amount)
                                    <th>₹ {{ $total_pay_amount }}</th>
                                @else
                                    <th>₹ {{ $total_pay_amount + ship_set()->shipping_charge }}</th>
                                @endif
                            </tr>
                        </table>
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
                            <p class="mb-2" style="margin-top: -10px"><strong>Order Status : </strong>

                                @if ($order->status == null || $order->status == 1)
                                    <span class="badge rounded-pill text-info bg-light-info p-2 ms-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i>Pending</span>
                                @elseif ($order->status == 3)
                                    <span class="badge rounded-pill text-danger bg-light-danger ms-2 p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i>Canceled</span>
                                @endif
                            </p>
                        </p>
                        <p class="" style="margin-top: -10px"><strong>Payment Status : </strong>

                            @if ($order->payment_status == 0)
                                <span class="badge rounded-pill text-info bg-light-info p-2 ms-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i>Cod</span>
                            @else
                                <span class="badge rounded-pill text-success bg-light-success ms-2 p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i>Prepaid</span>
                            @endif
                        </p>
                        @if ($order->color_id !== 0 && $order->color_id !== null)
                        <p class="mt-3" style="margin-top: -10px"><strong>Color : </strong>
                            <span class="p-2 rounded text-white-50" style="background-color: {{ $order->orderColor->color }}; height:50px; width:50px;">{{ $order->orderColor->color_name }}</span>
                        </p>
                        @endif
                        @if ($order->size_id !== 0 && $order->size_id !== null)
                        <p class="mt-4" style="margin-top: -10px"><strong>Size : </strong>
                            <span class="p-2 rounded text-white bg-secondary fw-bold px-3 mt-3" style="height:50px; width:50px;">{{ $order->orderSize->size }}</span>
                        </p>
                        @endif


                    </div>
                </div>
                <div class="my-3">
                    <button class="btn btn-dark d-flex mx-auto" data-bs-toggle="modal" data-bs-target="#exampleModal">Assign Order to Driver</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Assign Order</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('assign.order') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                    <div class="mb-3">
                        <label for="Driver" class="fw-bold">Select Driver</label>
                        <select name="driver_id" id="Driver" class="form-select">
                            <option value="" selected hidden disabled>select</option>
                            @foreach ($drivers as $driver)
                                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="fw-bold">Notes</label>
                        <textarea name="notes" id="notes" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Assign</button>
                </div>
            </form>
        </div>
        </div>
  </div>
    @section('js')

    @endsection
@endsection

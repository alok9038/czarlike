@extends('layouts.base')

@section('content')

<div class="container my-5">
    <div class="row row-cols-lg-2">
        <div class="col-lg-3 col">
            <div class="sticky-top">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item list-group-item-action">My Profile</a>
                            <a href="{{ route('my.orders') }}" class="list-group-item list-group-item-action">My Orders</a>
                            <a href="{{ route('view.wishlist') }}" class="list-group-item list-group-item-action">My Wishlist</a>
                            <a href="" class="list-group-item list-group-item-action"><i class="fa fa-power-off text-danger"></i> Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col">
            <div class="card border-0 shadow-sm">
                <div class="card-header border-bottom border-0 bg-white">
                    <h5 class="fw-light">My Wishlist ( {{ wishlist()->count() }} )</h5>
                </div>
                <div class="card-body py-0">
                    @if (wishlist()->count() > 0)
                    @foreach (wishlist() as $item)
                    @php
                        $total_rating = 0;
                        foreach ($item->product->ratings as $rating) {
                            $total_rating += $rating->ratings;
                        }

                        $count = $item->product->ratings->count();
                        if($count > 0){
                            $rating_count = $count;
                        }
                        else{
                            $rating_count = 1;
                        }

                        $avg_rating = ($total_rating/$rating_count);
                    @endphp
                    <div class="box row py-2">
                        <div class="col-lg-2">
                        <img src="{{ asset('images/products/'.$item->product->image) }}" alt="{{ $item->product->image }}" style="height: 120px; widht:120px; border-radius:10px;" class="img-fluid border">
                        </div>
                        <div class="col-lg-8">
                            <a class="text-decoration-none" href="{{ route('view.product',['slug'=>$item->product->slug,'pid='.\Crypt::encrypt($item->product->id)],) }}"><h4 class="text-dark h5" style="font-weight: 550;">{{ $item->product->name }}</h4></a>
                            <span class="badge bg-success me-2">{{ $avg_rating }} <i class="fa fa-star"></i> </span>( {{ $rating_count }} ratings & reviews)
                            @if ($item->product->store_id !== null)
                                @if ($item->product->store->is_verified == 1)
                                <span class="badge bg-success"> verified </span>
                                @endif
                            @endif
                            <h4 class="mt-3">₹ {{  $item->product->offer_price }} <span class="ms-3"><del>{{ $item->price }}</del></span></h4>
                        </div>
                        <div class="col-lg-2 d-flex justify-items-center align-items-center">
                            <form action="{{ route('remove.from.wishlist') }}" method="post">
                                @csrf
                                <input type="text" name="wishlist_id" value="{{ $item->id }}" hidden>
                                <button class="btn shadow-none"><i class="fa fa-trash text-danger"></i></button>
                            </form>

                        </div>
                    </div>
                    @endforeach
                    @else
                    <p class=" mt-2 text-center">No Products in Your Wishlist!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

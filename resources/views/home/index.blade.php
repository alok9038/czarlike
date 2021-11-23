@extends('layouts.base')

@section('content')

<section id="category">
    <main class="main">
        <div class="container">
          <div class="glider-contain">
            <div class="glider">
                @foreach (categories() as $category)
                    <a href="{{ route('products','cat_id='.$category->id) }}" class="text-decoration-none text-dark">
                    <div class="card-image">
                        <img src="{{ asset('images/category/'.$category->image) }}" alt="Slider Image" class="shadow img-fluid" style="object-fit: cover;">
                        <div class="content">
                            {{ $category->title }}
                        </div>
                    </div>
                    </a>
                @endforeach
            </div>
            <span role="button" aria-label="Previous" class="glider-prev"><i class="fas fa-chevron-left"></i></span>
            <span role="button" aria-label="Next" class="glider-next"><i class="fas fa-chevron-right"></i></span>
            <span role="tablist" class="dots"></span>
          </div>
        </div>
      </main>
</section>

@if ($dealsoftheday->count() > 0)
<section id="new-arrival">
    <div class="container-fluid">
        <p class="title text-center pt-4 mb-2">Deals of the Day</p>
        <div id="the-final-countdown" class="text-center text-muted">
            <b><small></small></b>
          </div>
        <script>
            setInterval(function time(){
            var d = new Date();
            var hours = 24 - d.getHours();
            if((hours + '').length == 1){
                hours = '0' + hours;
            }
            var min = 60 - d.getMinutes();
            if((min + '').length == 1){
                min = '0' + min;
            }
            var sec = 60 - d.getSeconds();
            if((sec + '').length == 1){
                    sec = '0' + sec;
            }
            jQuery('#the-final-countdown small').html(`<i class="fas fa-stopwatch text-danger"></i>&nbsp;`+' '+hours+' '+':'+' '+min+' '+':'+' '+sec+' '+'Left')
            }, 1000);
        </script>

        <div class="product my-4">
            <div class="row">
                    @foreach ($dealsoftheday as $feature)
                    <div class="col-lg-3 col-6 mb-2">
                        <div class="p-card">
                                <a href="{{ route('view.product',['slug'=>$feature->slug,'pid='.\Crypt::encrypt($feature->id)],) }}" class="text-decoration-none text-dark">
                            <img src="{{ asset('images/products/'.$feature->image) }}" alt="">
                            <div class="p-content text-center p-2">
                                <h5 class="p-name">{{ $feature->name }}</h5>
                                <div class="ratings">
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                </div>

                                <h5 class="price mt-2">
                                    @if ($feature->offer_price !== null)
                                        ₹ {{ $feature->offer_price }} <span class="small text-danger"><del>₹ {{ $feature->price }}</del></span>
                                    @else
                                        ₹ {{ $feature->price }}
                                    @endif
                                </h5>
                            </div>
                        </a>
                        </div>
                    </div>
                    @endforeach
                    <form action="{{ route('products') }}" method="get">
                        <div class="btn text-center d-flex mx-auto mt-5 mb-3">
                            <button type="submit" class="d-flex mx-auto">VIEW MORE</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</section>
@endif

@if ($featureds->count() > 0)
<section id="new-arrival">
    <div class="container-fluid">
        <p class="title text-center py-4">Featured Products</p>

        <div class="product my-4">
            <div class="row">
                    @foreach ($featureds as $feature)
                    <div class="col-lg-3 col-6 mb-3">
                        <div class="p-card">
                                <a href="{{ route('view.product',['slug'=>$feature->slug,'pid='.\Crypt::encrypt($feature->id)],) }}" class="text-decoration-none text-dark">
                            <img src="{{ asset('images/products/'.$feature->image) }}" alt="">
                            <div class="p-content text-center p-2">
                                <h5 class="p-name">{{ $feature->name }}</h5>
                                <div class="ratings">
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                </div>

                                <h5 class="price mt-2">
                                    @if ($feature->offer_price !== null)
                                        ₹ {{ $feature->offer_price }} <span class="small text-danger"><del>₹ {{ $feature->price }}</del></span>
                                    @else
                                        ₹ {{ $feature->price }}
                                    @endif
                                </h5>
                            </div>
                        </a>
                        </div>
                    </div>
                    @endforeach
                    <form action="{{ route('products') }}" method="get">
                        <div class="btn text-center d-flex mx-auto mt-5 mb-3">
                            <button type="submit" class="d-flex mx-auto">VIEW MORE</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</section>
@endif

<!-- large products section -->


<section id="large-p">
    <div class="container-fluid mt-5">
        <!-- <p class="title text-center py-4">NEW ARRIVAL</p> -->
        <div class="row g-2">
        @php
            $sr = 0;
        @endphp

        @foreach (categories(5) as $category)
        @php
            $sr += 1
        @endphp
        @if ($sr < 3 )
        <div class="col-lg-6">
            <div class="product">
                    <img src="{{ asset('images/category/'.$category->image) }}" alt="">
                <div class="content">
                    <div class="name text-center">
                        <h5>{{ $category->title }}</h5>
                        <form action="{{ route('products') }}" method="get">
                            <input type="hidden" name="cat_id" value="{{ $category->id }}">
                            <button>BUY NOW</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="col-lg-4 col-6">
            <div class="product">
                <img src="{{ asset('images/category/'.$category->image) }}" alt="">
            <div class="content">
            <div class="name text-center">
                <h5>{{ $category->title }}</h5>
                <form action="{{ route('products') }}" method="get">
                    <input type="hidden" name="cat_id" value="{{ $category->id }}">
                    <button>BUY NOW</button>
                </form>
            </div>
            </div>
            </div>
        </div>
        @endif
        @endforeach
        </div>
    </div>
</section>


<section id="new2">
    <div class="container-fluid mt-5">
        <p class="title text-center py-4">NEW ARRIVAL</p>
        <div class="product my-4">
            <div class="row">
                @foreach ($products as $product)
                <div class="col-lg-3 col-6">
                    <div class="p-card card border-0">
                        <div class="card-body p-0">
                        <img src="{{ asset('images/products/'.$product->image) }}" alt="{{ $product->image }}">
                        <div class="p-content text-center p-2">
                            <h5 class="p-name">{{ $product->name }}</h5>
                            @php
                                $total_rating = 0;
                                foreach ($product->ratings as $rating) {
                                    $total_rating += $rating->ratings;
                                }

                                $count = $product->ratings->count();
                                if($count > 0){
                                    $rating_count = $count;
                                }
                                else{
                                    $rating_count = 1;
                                }

                                $avg_rating = ($total_rating/$rating_count);
                            @endphp
                            {{-- {{ $product->ratings }} --}}
                            <div class="ratings">
                                <span><i class="fas fa-star {{ ($avg_rating >= 1)?"text-warning":"text-dark" }}"></i></span>
                                {{-- <span><i class="fas fa-star-half-alt {{ ($avg_rating < 2)?"text-warning":"d-none" }}"></i></span> --}}
                                <span><i class="fas fa-star {{ ($avg_rating >= 2)?"text-warning":"text-dark" }}"></i></span>
                                {{-- <span><i class="fas fa-star-half-alt {{ ($avg_rating < 3)?"text-warning":"d-none" }}"></i></span> --}}
                                <span><i class="fas fa-star {{ ($avg_rating >= 3)?"text-warning":"text-dark" }}"></i></span>
                                {{-- <span><i class="fas fa-star-half-alt {{ ($avg_rating < 4)?"text-warning":"d-none" }}"></i></span> --}}
                                <span><i class="fas fa-star {{ ($avg_rating >= 4)?"text-warning":"text-dark" }}"></i></span>
                                {{-- <span><i class="fas fa-star-half-alt {{ ($avg_rating < 5)?"text-warning":"d-none" }}"></i></span> --}}
                                <span><i class="fas fa-star {{ ($avg_rating >= 5)?"text-warning":"text-dark" }}"></i></span>
                            </div>

                            <h5 class="price mt-2">
                                @if ($product->offer_price !== null)
                                    ₹ {{ $product->offer_price }} <span class="small text-danger"><del>₹ {{ $product->price }}</del></span>
                                @else
                                    ₹ {{ $product->price }}
                                @endif
                            </h5>
                        </div>
                        <a href="{{ route('view.product',['slug'=>$product->slug,'pid='.\Crypt::encrypt($product->id)],) }}" class="text-decoration-none stretched-link text-dark"></a>
                        </div>
                        {{-- </a> --}}
                    </div>
                </div>
                @endforeach
                <form action="{{ route('products') }}">
                    <div class="btn text-center d-flex mx-auto mt-5 mb-3">
                        <button type="submit" class="d-flex mx-auto">VIEW MORE</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
</section>


@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
    $(function() {
    var owl = $("#brand-carousel");
    owl.owlCarousel({
      items: 5,
      margin: 10,
      loop: true,
      autoplay:true,
      autoplayTimeout:2000,
      autoplayHoverPause:true
    });
  });
  </script>
@endsection


<div class="home-demo">
  <div class="owl-carousel owl-theme" id="brand-carousel">
      @foreach (brands() as $item)
        <a href="{{ route('products','brand='.($item->id*987654321)) }}">
            <img src="{{ asset('images/brand/'.$item->brand_logo) }}" style="height:150px" alt="{{ $item->brand_logo }}" srcset="">
        </a>
      @endforeach
  </div>
</div>
@endsection

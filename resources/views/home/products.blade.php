@extends('layouts.base')

@section('content')


<section id="breadcrumb" class="mb-4 mt-1 d-none d-lg-block">
    <nav aria-label="breadcrumb" class="bread py-1 bg-light shadow-none">
        <ol class="breadcrumb mt-3">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Products</li>
        </ol>
      </nav>
</section>


<section id="product-page">
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-3 d-none d-lg-block">
               <div class="side sticky-top">
                <div id="brand-filter" class="">
                    <div class="brands p-3 bg-light">
                        <h5 class="mb-4">Hot Deals</h5>
                        @foreach (categories() as $category)
                        <p>
                            <a href="{{ route('products','cat_id='.$category->id) }}" class="">{{ $category->title }}</a>
                            <a class="float-end">{{ $category->products->count() }}</a>
                        </p>
                        @endforeach
                    </div>
                </div>

                <div id="brands">
                    <div class="brands p-3 bg-light mt-4">
                        <h5 class="mb-4">Brands</h5>
                        @foreach (brands() as $brand)
                        <p>
                            <a class="" href="{{ route('products','brand='.($brand->id*987654321)) }}">{{ $brand->brand_name }}</a>
                            <a class="float-end">{{ $brand->products->count() }}</a>
                        </p>
                        @endforeach
                    </div>
                </div>
               </div>
            </div>
            <div class="col-lg-9">
                @if(isset($_GET['cat_id']))
                <div style="background-image:url({{ asset('images/category/'.$url_cat->image) }})!important; height:330px; background-size:cover;">
                      <div class="pro-advert p-4" style=" height:330px; background-color:rgba(0, 0, 0, 0.583);">
                          <img src="img\laptop-poster1.png" alt="">
                         <div class="content text-white mt-4">
                            <h4>{{ $url_cat->title }}</h4>
                            <p class="small">{{ substr($url_cat->description,0,199) }} ...</p>
                            <a href="#products" class="btn btn-warning">SHOP NOW</a>
                         </div>
                      </div>
                </div>
                @elseif(isset($_GET['sub_cat_id']))
                <div style="background-image:url({{ asset('images/category/'.$url_cat->image) }}); background-size:cover;">
                      <div class="pro-advert p-4" style=" height:330px; background-color:rgba(0, 0, 0, 0.583);">
                          <img src="img\laptop-poster1.png" alt="">
                         <div class="content text-white mt-4">
                            <h4>{{ $url_cat->title }}</h4>
                            <p class="small">{{ substr($url_cat->description,0,199) }} ...</p>
                            <a href="#products" class="btn btn-warning">SHOP NOW</a>
                         </div>
                      </div>
                </div>
                @elseif(isset($_GET['child_cat_id']))
                <div style="background-image:url({{ asset('images/category/'.$url_cat->image) }}); background-size:cover;">
                      <div class="pro-advert p-4" style=" height:330px; background-color:rgba(0, 0, 0, 0.583);">
                          <img src="img\laptop-poster1.png" alt="">
                         <div class="content text-white mt-4">
                            <h4>{{ $url_cat->title }}</h4>
                            <p class="small">{{ substr($url_cat->description,0,199) }} ...</p>
                            <a href="#products" class="btn btn-warning">SHOP NOW</a>
                         </div>
                      </div>
                </div>
                @endif

                <div id="sorting-nav" class="">
                    <navs class="navbar navbar-expand-lg bg-light my-4">
                        <div class="sort">

                            <div class="item ms-2">
                                <span>  {{ $products->count() }} Items
                                </span>
                            </div>
                            <form action="
                            {{ route('products') }}
                            {{-- @if (isset($_GET['cat_id']))
                            {{ route('products') }}      
                            @endif --}}
                            ">
                                <div class="sort mx-4 d-lg-flex d-none " style="width: 300px;">
                                    <span class="w-50">Sort By</span>
                                    <select name="sort" onchange="this.form.submit()" id="" class="form-select">
                                        <option value="" selected hidden disabled>select</option>
                                        @if (isset($_GET['low_to_high']) == 'low_to_high')
                                        <option value="low_to_high" selected>Price -- Low to high</option>
                                        <option value="high_to_low">Price -- Hight to Low</option>
                                        <option value="newest">Newest</option>
                                        @elseif (isset($_GET['high_to_low']) == 'high_to_low')
                                        <option value="low_to_high">Price -- Low to high</option>
                                        <option value="high_to_low" selected>Price -- Hight to Low</option>
                                        <option value="newest">Newest</option>
                                        @elseif (isset($_GET['newest'])  == 'newest')
                                        <option value="low_to_high">Price -- Low to high</option>
                                        <option value="high_to_low">Price -- Hight to Low</option>
                                        <option value="newest" selected>Newest</option>
                                        @else
                                        <option value="" selected hidden disabled>select</option>
                                        <option value="low_to_high">Price -- Low to high</option>
                                        <option value="high_to_low">Price -- Hight to Low</option>
                                        <option value="newest">Newest</option>
                                        @endif
                                    </select>
                                   </div>
                            </form>



                           {{-- <div class="select d-none d-lg-block">
                            Show

                            <select name="" id="" class="">
                                <option value="">filter</option>
                                <option value="">Name</option>
                                <option value="">Type</option>
                                <option value="">Date</option>
                            </select>
                           </div> --}}

                        </div>


                        <div class="ms-auto">
                            <button class="btn btn-light"><i class="fas fa-th"></i></button>
                            <button class="btn btn-light"><i class="fas fa-sliders-h"></i></button>
                        </div>
                    </navs>
                </div>

                <div id="products">
                    <div class="row mb-5">
                        @if (count($products) > 0)
                        @foreach ($products as $product)
                        <div class="col-lg-4 col-6 mb-2">
                            <div class="card-product">
                               <a href="{{ route('view.product',['slug'=>$product->slug,'pid='.\Crypt::encrypt($product->id)],) }}">
                                <div class="pro-img">
                                    <img src="{{ asset('images/products/'.$product->image) }}" alt="{{ $product->image }}">
                                    <div class="hover-action">
                                        <div class="action">
                                            <button><i class="fas fa-heart"></i></button>
                                            <button class="ms-4"><i class="fas fa-shopping-cart"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="content py-1 px-2 text-center">
                                    <h6 class="p-title">{{ $product->name }}</h6>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <div class="price d-flex mt-2 justify-content-center">
                                        @if ($product->offer_price !== null)
                                            <h5 class="c-price">₹ {{ $product->offer_price }}</h5>
                                            <h5 class="o-price mx-3">₹ {{ $product->price }}</h5>
                                            <h5 class="discount">@php $percent = (($product->price - $product->offer_price)*100) /$product->price @endphp {{ round($percent) }}% Off </h5>
                                        @else
                                            <h5 class="c-price mx-3">₹ {{ $product->price }}</h5>
                                        @endif
                                    </div>
                                </div>
                                <div class="tag">
                                    <span>HOT</span>
                                </div>
                               </a>

                            </div>
                        </div>
                        @endforeach
                        @else
                            <p class="text-center">No Products Found! Please try With Another Category :)</p>
                        @endif
                    </div>
                </div>

                <style>
                    .pagination{
                        justify-content: center;
                        margin: auto;
                    }
                    .page-item.active .page-link {
                        background-color: rgb(255 145 2);
                        border-color: rgb(255 145 2);
                    }
                    .page-link{
                        box-shadow: none;
                        color: rgb(255 145 2);
                    }
                </style>
                <div class="mx-auto align-items-center justify-items-center">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

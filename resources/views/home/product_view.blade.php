@extends('layouts.base')
@section('page_title','| '.$product['name'])
@section('meta')
    <meta property="og:image" itemprop="image" content="{{ asset('images/products/'.$product->image) }}">
    <meta property="og:type" content="website" />
@endsection
@section('css')
<style>

    .custom-radios div {
        display: inline-block;
    }
    .custom-radios input[type="radio"] {
        display: none;
    }
    .custom-radios input[type="radio"] + label {
        color: #333;
        font-family: Arial, sans-serif;
        font-size: 14px;
    }
    .custom-radios input[type="radio"] + label span {
        display: inline-block;
        width: 40px;
        justify-content: center;
        align-items: center;
        height: 40px;
        margin: -1px 4px 0 0;
        vertical-align: middle;
        cursor: pointer;
        border-radius: 50%;
        border: 2px solid #fff;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
        background-repeat: no-repeat;
        background-position: center;
        text-align: center;
        line-height: 44px;
    }
    .custom-radios input[type="radio"] + label span img {
        opacity: 0;
        transition: all 0.3s ease;
    }
    .custom-radios input[type="radio"]:checked + label span img {
        opacity: 1;
    }

    /* social share */
    #social-links ul{
        padding: 0px;
    }
    #social-links ul li{
        list-style: none;
        background: #e2e2e2;
        margin-left: 5px;
        text-align: center;
        border-radius:5px;
    }
    #social-links ul li span{
        font-size: 20px;
    }
    #social-links ul li{
        display: inline-block;
        padding: 10px 10px 5px;
    }

    /* size */

    fieldset {
        border: 0;
    }
    .control {
        display: inline-flex;
        position: relative;
        margin: 5px;
        cursor: pointer;
        border-radius: 50px;
    }
    .control input {
        position: absolute;
        opacity: 0;
        z-index: -1;
    }
    .control__content {
        display: inline-flex;
        align-items: center;
        padding: 6px 10px;
        font-size: 17px;
        line-height: 32px;
        color: rgba(0, 0, 0, 0.54);
        background-color: rgba(0, 0, 0, 0.05);
        border-radius: 10px;
        padding: 5px 15px;
    }
    .control:hover .control__content {
        background-color: rgba(0, 0, 0, 0.1);
    }
    .control input:focus ~ .control__content {
        box-shadow: 0 0 0 0.25rem rgba(12, 242, 143, .2);
        background-color: rgba(0, 0, 0, 0.1);
    }
    .control input:checked ~ .control__content {
        background-color: rgba(12, 242, 143, .2);
    }


</style>
@endsection
@section('content')

<section id="breadcrumb" class="mb-4 mt-1 d-none d-lg-block">
    <nav aria-label="breadcrumb" class="bread py-1 bg-light shadow-none">
        <ol class="breadcrumb mt-3">
          <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('products','cat_id='.$product->product_cat->id) }}">{{ $product->product_cat->title }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
      </nav>
</section>
@php
    $ratings = rating($product->id);
    $count = count(rating($product->id));
    $total_rating = 0;
    if ($count > 0){
        foreach ($ratings as $rating) {
            $total_rating += $rating->ratings;
        }
    }

    $id =  Illuminate\Support\Facades\Crypt::encryptString($product->id);
@endphp

<section id="viewpage">
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="product">
                    <div class="row">
                        <div class="col-lg-5 sticky-lg-top">
                            <div class="sticky-lg-top" style="top: 50px">
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
                            <link rel="stylesheet" href="{{ asset('assets/css/slider.css') }}">
                            <div class="slider-wrapper rounded-10">
                                <div class="slider-for" style="height: auto">
                                    <div class="slider-for__item p-0" data-src="{{ asset('images/products/'.$product->image) }}">
                                        <img src="{{ asset('images/products/'.$product->image) }}" style="height: 350px; width:auto; object-fit:cover;" class="img-fluid border rounded-10 w-100" alt="" />
                                    </div>
                                    @foreach ($product->images as $image)
                                    <div class="slider-for__item p-0" data-src="{{ asset('images/products/multiple_images/'.$image->image) }}">
                                        <img src="{{ asset('images/products/multiple_images/'.$image->image) }}" style="height: 300px; width:auto; object-fit:cover;" class="img-fluid border rounded-10 w-100" alt="" />
                                    </div>
                                    @endforeach
                                </div>

                                <div class="slider-nav mx-auto" style="width:90%;">
                                    <div class="slider-nav__item m-1">
                                        <img src="{{ asset('images/products/'.$product->image) }}"  class="border img-fluid h-100 rounded-10" alt="" />
                                    </div>
                                    @foreach ($product->images as $image)
                                    <div class="slider-nav__item m-1">
                                        <img src="{{ asset('images/products/multiple_images/'.$image->image) }}"  class="border img-fluid h-100 rounded-10" alt="" />
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                            <script>
                                // SLICK
                                    $('.slider-for').slick({
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                    arrows: false,
                                    fade: true,
                                    asNavFor: '.slider-nav'
                                    });
                                    $('.slider-nav').slick({
                                    slidesToShow: 4,
                                    arrows:false,
                                    slidesToScroll: 1,
                                    asNavFor: '.slider-for',
                                    dots: false,
                                    focusOnSelect: true
                                    });


                            </script>
                            </div>
                            {{-- <div class="share ms-3 mt-3">
                                {!! $socialShare !!}
                            </div> --}}
                        </div>
                        <div class="col-lg-7">
                            <h4 class="p-name">{{ $product->name }}</h4>
                            <div class="review mt-4">
                                @if ($count !== 0) <span class="badge bg-success">{{ ($total_rating/$count) }} <i class="fa fa-star text-white" style="font-size: 10px;"> </i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span class="count mx-3 small">({{ $count }} reviews & ratings) </span>
                                @else No ratings @endif

                                <span class="submit ms-4">
                                    <a href="{{ route('home.review',['slug'=>$product->slug , 'id'=>$id]) }}" class="small">Submit a Review</a>
                                </span>

                            </div>
                            <div class="share ps-0 ms-0 mt-3">
                                {!! $socialShare !!}
                            </div>
                            <hr>

                            <div class="price d-flex mt-4">
                                @if ($product->offer_price !== "")
                                    <h5 class="c-price">₹ {{ $product->offer_price }}</h5>
                                    <h5 class="o-price mx-3">₹ {{ $product->price }}</h5>
                                    <h5 class="discount">@php $percent = (($product->price - $product->offer_price)*100) /$product->price @endphp {{ round($percent) }}% Off </h5>
                                @else
                                    <h5 class="o-price mx-3">₹ {{ $product->price }}</h5>
                                @endif
                            </div>

                            @if ($product->coupons->count() > 0)
                            <div class="coupons-div mb-3 mt-3">
                                <h5 class="h6">Available Offers</h5>
                                <ul class="list-unstyled">
                                    @foreach ($product->coupons as $coupon)
                                        <li><span><i class="fa fa-tag text-success"></i></span> <strong>Flat {{ $coupon->amount }}% off</strong> on order over ₹ {{ $coupon->min_amount }} ( <b>COUPON CODE : <span class="text-success">{{ $coupon->code }}</span></b> )</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            @if ($product->variants->count() > 0)
                            <div class="color row">
                                @csrf
                                <input type="text" name="product_id" hidden value="{{ $product->id }}">
                                <input type="text" name="vendor_id" hidden value="{{ $product->vender_id }}">
                                    @php
                                        $arrSize = [];
                                        $arrColor = [];
                                        $arrStorage = [];

                                        $arrId = [];
                                        $color_key = [];

                                        foreach($product->variants as $key =>$sizeAttr){
                                            if($sizeAttr->size !== null){
                                                $arrSizes[] = $sizeAttr->Vsize;
                                            }
                                            else{
                                                $arrSizes = null;
                                            }

                                            if($sizeAttr->color !== null){
                                                $arrColor[] = $sizeAttr->Vcolor;
                                            }else{
                                                $arrColor = null;
                                            }
                                            // ram_rom
                                            if($sizeAttr->ram_rom !== null){
                                                $arrStorage[] = $sizeAttr->vStorage;
                                            }else{
                                                $arrStorage = null;
                                            }
                                        }


                                        foreach($product->variants as $vId){
                                            $arrId[] = $vId->id ;
                                        }
                                        foreach($product->variants as $mrpAttr){
                                            $mrpPrice[] = $mrpAttr->mrp ;
                                        }

                                        if ($arrSizes != null) {
                                            $arrSize = array_unique($arrSizes);
                                        }
                                        else{
                                            $arrSize = $arrSizes;
                                        }

                                        if ($arrColor != null) {
                                            $arrColor = array_unique($arrColor);
                                        }
                                        else{
                                            $arrColor = null;
                                        }

                                        if ($arrStorage != null) {
                                            $arrStorage = array_unique($arrStorage);
                                        }
                                        else{
                                            $arrStorage = null;
                                        }

                                        // print_r($arrSize);
                                    @endphp
                                    @if ($arrStorage != null)
                                    <div class="col-12 col-lg-6 p-0">
                                        <h6>Variants : </h6>
                                        <div class="d-flex">
                                            <div class="ms-2">
                                                @foreach ($arrStorage as $index => $s_size)
                                                <label class="control m-0">
                                                    <input onclick="showVariant({{ $product->id }}, {{ $arrId[$index] }}, {{ $s_size->id }})" required type="radio" name="size">
                                                    <span  class="control__content fw-bold">
                                                        {{ $s_size->ram}} GB / {{ $s_size->storage }} GB
                                                    </span>
                                                </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                        @if ($arrColor != null)
                                        <div class="custom-radios col-lg-6 col-12">
                                            <h6>Colors : </h6>
                                            <div class="d-flex " id="color_div">
                                            @foreach ($arrColor as $attr)
                                                <input type="radio" required id="color_{{ $attr->id }}" disabled  name="color_id">
                                                <label for="color_{{ $attr->id }}" class="product_color" onclick="checkSize()" >
                                                    <span class="d-flex product_color" style="background-color: {{ $attr->color }}!important">
                                                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/242518/check-icn.svg" alt="Checked Icon" />
                                                    </span>
                                                </label>
                                            @endforeach
                                            </div>
                                        </div>
                                        <script>
                                            function checkSize(){
                                                var size = jQuery('#storage_id').val();
                                                if(size == ""){
                                                    jQuery('#add_to_cart_error').html('Please select Storage first!!');
                                                }
                                            }

                                        </script>

                                        @endif

                                        <script>
                                            function showVariant(product, variant_id, storage){
                                                jQuery('#get_product_id').val(product*92119211);
                                                jQuery('#get_variant_id').val(variant_id*18841884);
                                                jQuery('#storage_id').val(storage*921118849038);

                                                jQuery('#show_variant_product').submit();

                                            }
                                        </script>

                                        <form id="show_variant_product" action="{{ route('variant.product') }}" method="get">
                                            <input type="hidden" name="product_id" id="get_product_id" value="">
                                            <input type="hidden" name="slug" value="{{ $product->slug }}">
                                            <input type="hidden" name="storage" id="storage_id" value="">
                                            <input type="hidden" name="variant_id" id="get_variant_id" value="">
                                        </form>
                                    @elseif ($arrSize != null)
                                        <div class="col-12 col-lg-6 p-0">
                                            <h6>Sizes : </h6>
                                            <div class="d-flex">
                                                <div class="ms-2">
                                                    @foreach ($arrSize as $index => $size)
                                                    <label class="control m-0">
                                                        <input onclick="showVariant({{ $product->id }}, {{ $arrId[$index] }}, {{ $size->id }})" required type="radio" name="size">
                                                        <span  class="control__content fw-bold">
                                                            {{ $size->size}}
                                                        </span>
                                                    </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        @if ($arrColor != null)
                                        <div class="custom-radios col-lg-6 col-12">
                                            <h6>Colors : </h6>
                                            <div class="d-flex " id="color_div">
                                            @foreach ($arrColor as $attr)
                                                <input type="radio" required id="color_{{ $attr->id }}" disabled  name="color_id">
                                                <label for="color_{{ $attr->id }}" class="product_color" onclick="checkSize()" >
                                                    <span class="d-flex product_color" style="background-color: {{ $attr->color }}!important">
                                                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/242518/check-icn.svg" alt="Checked Icon" />
                                                    </span>
                                                </label>
                                            @endforeach
                                            </div>
                                        </div>
                                        <script>
                                            function checkSize(){
                                                var size = jQuery('#size_id').val();
                                                if(size == ""){
                                                    jQuery('#add_to_cart_error').html('Please select size first!!');
                                                }
                                            }

                                        </script>
                                        @endif
                                        <script>
                                            function showVariant(product, variant_id, size){
                                                jQuery('#get_product_id').val(product*92119211);
                                                jQuery('#get_variant_id').val(variant_id*18841884);
                                                jQuery('#size_id').val(size*921118849038);

                                                jQuery('#show_variant_product').submit();

                                            }
                                        </script>
                                        <form id="show_variant_product" action="{{ route('variant.product') }}" method="get">
                                            <input type="hidden" name="product_id" id="get_product_id" value="">
                                            <input type="hidden" name="slug" value="{{ $product->slug }}">
                                            <input type="hidden" name="size" id="size_id" value="">
                                            <input type="hidden" name="variant_id" id="get_variant_id" value="">
                                        </form>
                                    @elseif($arrColor != null)
                                        @if ($arrColor != null)
                                        <div class="custom-radios col-lg-6 col-12">
                                            <h6>Colors : </h6>
                                            <div class="d-flex " id="color_div">
                                            @foreach ($arrColor as $attr)
                                                <input type="radio" required id="color_{{ $attr->id }}" onclick="setColor({{ $attr->id }})" name="color_id">
                                                <label for="color_{{ $attr->id }}" class="product_color">
                                                    <span class="d-flex product_color" style="background-color: {{ $attr->color }}!important">
                                                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/242518/check-icn.svg" alt="Checked Icon" />
                                                    </span>
                                                </label>
                                                {{-- <div class="rounded-circle" style="background-color: {{ $attr->color }}; height:50px; wis"></div> --}}
                                            @endforeach
                                            </div>
                                        </div>

                                        <script>
                                            function setColor(color){
                                                jQuery('#color_id').val(color);
                                            }
                                        </script>
                                        @endif
                                    @endif

                            </div>
                            <p class="small text-danger mt-3" id="add_to_cart_error"></p>

                            @endif
                            <div class="pe-5 my-4 row">
                                <div class="col-lg-6 mb-3">
                                    <p class="bg-opacity-10 active text-white btn btn-sm" style="background-color: rgba(8, 182, 8, 0.624)">In stock</p>
                                </div>
                               <div class="col-lg-6 mb-3 d-flex">
                                   <h5 class="text-muted h6 fs-6">Services :</h5>
                                    <span class="service-div ms-1">
                                        <span>
                                            @if ($product->free_shipping == 1 && $product->offer_price > 500)
                                                <p class="small fw-bold"> <i class="fa fa-check text-success"></i> Free Shipping</p>
                                            @endif
                                            @if ($product->codcheck == 1 )
                                                <p class="small fw-bold"><i class="fa fa-check text-success"></i> cash on delivery</p>
                                            @endif
                                            @if ($product->return_avbl == 1 )
                                                <p class="small fw-bold"><i class="fa fa-check text-success"></i> Return available</p>
                                            @endif
                                            @if ($product->cancel_avl == 1 )
                                                <p class="small fw-bold"><i class="fa fa-check text-success"></i> Cancel available</p>
                                            @endif
                                        </span>
                                    </span>
                               </div>
                            </div>
                            <hr>

                            <form action="{{ route('add.to.cart') }}" id="atc_form" method="POST">
                                <div class="color row">
                                    @csrf
                                    <input type="text" name="product_id" hidden value="{{ $product->id }}">
                                    <input type="text" name="vendor_id" hidden value="{{ $product->vender_id }}">
                                    <input type="text" name="color_id" id="color_id" hidden value="">
                                </div>
                            </form>

                            <div class="atc my-4">
                                <div class="row">
                                    <div class="col-6">

                                    </div>
                                    <div class="col-6 d-flex">
                                        @if ($product->variants->count() > 0)
                                            @php

                                                $arrSizes = [];
                                                foreach($product->variants as $key =>$sizeAttr){
                                                if($sizeAttr->size != null){
                                                    $arrSize[] = $sizeAttr->Vsize;
                                                }
                                                else{
                                                    $arrSize = null;
                                                }

                                                if($sizeAttr->color != null){
                                                    $arrColor[] = $sizeAttr->Vcolor;
                                                }
                                                else{
                                                    $arrColor = null;
                                                }

                                                if ($arrStorage != null) {
                                                    $arrStorage = array_unique($arrStorage);
                                                }
                                                else{
                                                    $arrStorage = null;
                                                }
                                            }
                                            @endphp
                                            @if ($arrStorage != null)
                                            <script>
                                                function addToCartCheck(){
                                                    jQuery('#add_to_cart_error').html('Please select Storage!!');
                                                }
                                            </script>
                                            @elseif ($arrSize != null)
                                            <script>
                                                function addToCartCheck(){
                                                    jQuery('#add_to_cart_error').html('Please select size first!!');
                                                }
                                            </script>
                                            @elseif ($arrColor != null)
                                            <script>
                                                function addToCartCheck(){

                                                    var color = jQuery('#color_id').val();

                                                    if(color == ""){
                                                        jQuery('#add_to_cart_error').html('Please select Color first!!');
                                                    }
                                                    else{
                                                        jQuery('#atc_form').submit();
                                                    }
                                                }
                                            </script>
                                            @endif
                                        @else
                                        <script>
                                            function addToCartCheck(){
                                                jQuery('#atc_form').submit();
                                            }
                                        </script>
                                        @endif

                                        {{-- <form action="{{ route('add.to.cart') }}" method="POST">
                                            @csrf
                                            <input type="text" name="product_id" hidden value="{{ $product->id }}">
                                            <input type="text" name="vendor_id" hidden value="{{ $product->vender_id }}"> --}}
                                            <button class="atc-btn" onclick="addToCartCheck()"><i class="fas fa-shopping-cart me-3"></i> Add To Cart</button>
                                            {{-- <button onclick="document.getElementById('atc_form').submit();" class="atc-btn"><i class="fas fa-shopping-cart me-3"></i> Add To Cart</button> --}}
                                        {{-- </form> --}}
                                        <form action="{{ route('add.to.wishlist') }}" method="post">
                                            @csrf
                                            <input type="text" name="product_id" hidden value="{{ $product->id }}">
                                            <button class="wishlist ms-4"><i class="fas fa-heart"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div><hr>

                            {{-- <div class="share">
                                {!! $socialShare !!}
                            </div> --}}


                            <div class="description">
                                <div class="container bg-light p-4 my-4">
                                    {{-- <h5 class="mb-4">Product Information</h5> --}}
                                    <?= $product->key_features; ?>
                                </div>
                            </div>
                            <div class="description">
                                <div class="container bg-light p-4 my-4">
                                    {{-- <h5 class="mb-4">Product Information</h5> --}}
                                    <?= $product->description; ?>
                                </div>
                            </div>

                            <div class="customer-reviews p-5 bg-light">
                                <div class="d-flex">
                                    <h5 class="mb-4">Customer Reviews</h5>

                                    <a href="{{ route('home.review',['slug'=>$product->slug , 'id'=>$id]) }}" class="btn btn-white float-end ms-auto border rounded-0 shadow-sm d-flex justify-items-center align-items-center">Rate Product</a>
                                </div>

                                <div class="clearfix"></div>
                                {{-- @include('home.include.rating') --}}
                                @php
                                    $rating_data = count_ratings(['product_id'=>$product->id])
                                @endphp
                                @foreach ($rating_data as $rd)
                                <div class="cr mb-4 mt-3">
                                    <span><i class="fas fa-star {{ ($rd->ratings >= 1)?"text-warning":"" }}"></i></span>
                                    <span><i class="fas fa-star {{ ($rd->ratings >= 2)?"text-warning":"" }}"></i></span>
                                    <span><i class="fas fa-star {{ ($rd->ratings >= 3)?"text-warning":"" }}"></i></span>
                                    <span><i class="fas fa-star {{ ($rd->ratings >= 4)?"text-warning":"" }}"></i></span>
                                    <span><i class="fas fa-star {{ ($rd->ratings >= 5)?"text-warning":"" }}"></i></span><br>
                                    <em class="small">{{ $rd->body }}!</em>
                                    <p class="float-end mt-3">- By {{ $rd->user->user_name }}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            <section id="related">
                <h2 class="text-center my-5">Related Products</h2>

                <div class="r-pro">
                    <div class="row">
                        @foreach (related_products($product->category_id, $product->id) as $product)
                        <div class="col-lg-3 col-6 mb-2">
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
                                            <h5 class="o-price mx-3">₹ {{ $product->price }}</h5>
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
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>

@endsection

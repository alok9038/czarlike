

<script>
    $(document).ready(function(){
        $(".top-slider").owlCarousel({
            items: 1,
            smartSpeed: 1000,
            autoplay: true,
            lazyLoad: true,
            loop:true,
            dots: true,
            autoplayTimeout: 10000
        });
    });
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/slider.css') }}">
        <div class="section-padding p-0">
            <div class="container-fluid ">
                <div class="row">
                    <div class="col-md-12 p-0">
                        <div class="owl-carousel top-slider" style="height:auto!important;">
                        @foreach (sliders() as $slider)
                            <div class="single-banner-slide " style="height:450px!important; background:url({{ asset('images/slider/'.$slider->image) }}); background-size:cover;">
                                <div class="single-banner-slide">
                                    <span class="d-lg-flex d-md-flex d-none" style="color:{{ $slider->sub_heading_color }}">{{ $slider->subheading_text }}</span>
                                <h2 class="d-lg-flex d-md-flex d-none h4 text-capitalize" style="color:{{ $slider->heading_color }}">{{ $slider->heading_text }}</h2>
                                {{-- <p class="d-lg-flex d-md-flex d-none">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p> --}}
                                <a class="d-lg-flex d-md-flex d-none" href="
                                @if($slider->linked_by == 'url')
                                    {{ $slider->url }}
                                @elseif($slider->linked_by == 'product')
                                    {{ route('view.product',['slug'=>$slider->product_slider->slug,'pid='.\Crypt::encrypt($slider->product)],) }}
                                @elseif($slider->linked_by == 'category')
                                    {{ route('products','cat_id='.$slider->category) }}
                                @endif
                                ">{{ $slider->button_text }}</a>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
